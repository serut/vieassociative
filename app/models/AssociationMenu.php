<?php

class AssociationMenu extends Eloquent
{
    protected $table = 'association_menu';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public static function getIndex($menu)
    {
        foreach($menu as $m){
            if($m->order == 1 && $m->id_menu_parent ==null){
                return $m;
            }
        }
        App::abort(403);
    }

    public static function getFirstNewsFeed($idAssoc)
    {
        $menu = AssociationMenu::where('id_assoc',$idAssoc)->get();
        foreach($menu as $m){
            if($m->id_wall_news != null && $m->id_menu_parent ==null){
                return $m->id_wall_news;
            }
        }
        App::abort(403);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function association()
    {
        return $this->belongsTo('Association', 'id_assoc');
    }

}