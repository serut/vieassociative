<?php
class Association  extends Eloquent
{
    protected $table = 'association';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public function userAssociation()
    {
        return $this->belongsTo('user_association','id_user');
    }
    public function setNameAttribute($value){
        //TO DO
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value,'-');
    }
    public function admitted_public_utility_display(){
        return $this->admitted_public_utility ? 'Oui' : 'Non';
    }
    static function add($assoc){
        $gallery = new Folder;
        $gallery->name = "/";
        $gallery->touch();
        $a = new Association;
        $a->name = $assoc['name'];
        $a->slug = Str::slug($assoc['name'],'-');
        $a->id_folder = $gallery->id;
        $a->touch();
        return $a->id;
    }
    static function getRangUser($id_user, $id_assoc){
        $l = UserAssociation::where('id_user',$id_user)->where('id_assoc',$id_assoc)->firstOrFail();
        return empty($l) ? $l->link : '';
    }
    
    static function getName($id_assoc){
        $a = Association::findOrFail($id_assoc);
        return $a->name;
    }
    static function get($id_assoc){
        $a = Association::findOrFail($id_assoc);
        return $a;
    }
    static function countAdmin($idAssoc){
        return UserAssociation::where('id_assoc',$idAssoc)->count();
    }

    static function getAssociations($idUser){
        $sql = 'SELECT id_assoc as id,link FROM user_association WHERE user_association.id_user = ?';
        $result = DB::select($sql, array($idUser));
        return $result;
    }
    
    static function existeNomAssociation($nom){
        $sql = 'SELECT id FROM association WHERE nom= ?';
        $result = DB::select($sql, array($nom));
        $next = $result->current();
        return !empty($next);
    }
    static function getListWhereAdmin($idUser){
        return UserAssociation::with('association')->where('id_user',$idUser)->get();
    }
    public function getLogo(){
        if(empty($this->logo_img)){
            return "http://cdn.vieassociative.fr/img/items/default_logo.jpg";
        }
        //The prefix of images
        if(App::environment() == "production"){
            $prefix = 'a';
        }else{
            $prefix = 'deva';
        }
        return "http://img.vieassociative.fr/".$prefix.$this->id.'/'.$this->logo_img.'-200x200.jpg';
    }
    public function getCover(){
        if(empty($this->cover_img)){
            return "http://cdn.vieassociative.fr/img/items/default_cover.jpg";
        }
        //The prefix of images
        if(App::environment() == "production"){
            $prefix = 'a';
        }else{
            $prefix = 'deva';
        }
        return "http://img.vieassociative.fr/".$prefix.$this->id.'/'.$this->cover_img.'-1130x400.jpg';
    }
    
}