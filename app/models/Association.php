<?php

/**
 * An Eloquent Model: 'Association'
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $acronym
 * @property string $legal_name
 * @property string $goal
 * @property string $website_url
 * @property string $official_date_creation
 * @property string $headquarter
 * @property boolean $admitted_public_utility
 * @property integer $nb_publications
 * @property integer $nb_photos
 * @property integer $nb_administrator
 * @property integer $nb_evenements
 * @property string $statuts
 * @property string $internal_regulation
 * @property string $contact_adress
 * @property integer $plan
 * @property string $page_facebook
 * @property string $page_googleplus
 * @property string $page_youtube
 * @property string $page_paypal
 * @property string $page_twitter
 * @property integer $id_folder
 * @property string $cover_img
 * @property string $logo_img
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \user_association $userAssociation
 */
class Association extends Eloquent
{
    protected $table = 'association';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userAssociation()
    {
        return $this->belongsTo('user_association', 'id_user');
    }

    /**
     * @param $value
     */
    public function setNameAttribute($value)
    {
        //TO DO
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    /**
     * @return string
     */
    public function admitted_public_utility_display()
    {
        return $this->admitted_public_utility ? 'Oui' : 'Non';
    }

    /**
     * @param $assoc
     * @return int
     */
    static function add($assoc)
    {
        $gallery = new Folder;
        $gallery->name = "/";
        $gallery->touch();
        $a = new Association;
        $a->name = $assoc['name'];
        $a->slug = Str::slug($assoc['name'], '-');
        $a->id_folder = $gallery->id;
        $a->plan = 1; // It's a private page
        $a->touch();
        return $a->id;
    }

    /**
     * @param $id_user
     * @param $id_assoc
     * @return mixed|string
     */
    static function getRangUser($id_user, $id_assoc)
    {
        $l = UserAssociation::where('id_user', $id_user)->where('id_assoc', $id_assoc)->firstOrFail();
        return empty($l) ? $l->link : '';
    }

    /**
     * @param $id_assoc
     * @return mixed|string
     */
    static function getName($id_assoc)
    {
        $a = Association::findOrFail($id_assoc);
        return $a->name;
    }

    /**
     * @param array $id_assoc
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|static
     */
    static function get($id_assoc)
    {
        $a = Association::findOrFail($id_assoc);
        return $a;
    }

    /**
     * @param $idAssoc
     * @return int
     */
    static function countAdmin($idAssoc)
    {
        return UserAssociation::where('id_assoc', $idAssoc)->count();
    }

    /**
     * @param $idUser
     * @return array
     */
    static function getAssociations($idUser)
    {
        $sql = 'SELECT id_assoc as id,link FROM user_association WHERE user_association.id_user = ?';
        $result = DB::select($sql, array($idUser));
        return $result;
    }

    /**
     * @param $nom
     * @return bool
     */
    static function existeNomAssociation($nom)
    {
        $sql = 'SELECT id FROM association WHERE nom= ?';
        $result = DB::select($sql, array($nom));
        $next = $result->current();
        return !empty($next);
    }

    /**
     * @param $idUser
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    static function getListWhereAdmin($idUser)
    {
        return UserAssociation::with('association')->where('id_user', $idUser)->get();
    }

    /**
     * @return string
     */
    public function getLogo()
    {
        if (empty($this->logo_img)) {
            return "http://cdn.vieassociative.fr/img/items/default_logo.jpg";
        }
        //The prefix of images
        if (App::environment() == "production") {
            $prefix = 'a';
        } else {
            $prefix = 'deva';
        }
        return "http://img.vieassociative.fr/" . $prefix . $this->id . '/' . $this->logo_img . '-200x200.jpg';
    }

    /**
     * @return string
     */
    public function getCover()
    {
        if (empty($this->cover_img)) {
            return "http://cdn.vieassociative.fr/img/items/default_cover.jpg";
        }
        //The prefix of images
        if (App::environment() == "production") {
            $prefix = 'a';
        } else {
            $prefix = 'deva';
        }
        return "http://img.vieassociative.fr/" . $prefix . $this->id . '/' . $this->cover_img . '-1130x400.jpg';
    }

}