<?php

/**
 * An Eloquent Model: 'UserAssociation'
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_assoc
 * @property string $link
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \User $author
 * @property-read \Association $association
 */
class UserAssociation extends Eloquent
{
    protected $table = 'user_association';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('User', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function association()
    {
        return $this->belongsTo('Association', 'id_assoc');
    }

    /**
     * @param $id_user
     * @param $id_assoc
     * @param $link
     */
    static function add($id_user,$id_assoc,$link){
        $el = new UserAssociation();
        $el->id_user = $id_user;
        $el->id_assoc = $id_assoc;
        $el->link = $link;
        $el->touch();
        $association = Association::findOrFail($id_assoc);
        $association->nb_administrator = UserAssociation::where('id_assoc', $id_assoc)->count();
        $association->touch();
    }


    static function addByMail($mail,$id_assoc,$link){
        $user = User::where('email', $mail)->firstOrFail();
        if (!User::isUserAdministrator($id_assoc, $user->id)) {
            return UserAssociation::add($user->id, $id_assoc, $link);
        }
        //TODO return array error
    }

    /**
     * @param $id
     */
    static function remove($id){

        $userassociation = UserAssociation::findOrFail($id);
        $association = Association::findOrFail($userassociation->id_assoc);
        $userassociation->delete();
        $association->nb_administrator = UserAssociation::where('id_assoc', $association->id)->count();
        $association->touch();
    }

}