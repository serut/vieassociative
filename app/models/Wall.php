<?php
class Wall extends Eloquent
{
    protected $table = 'wall';
    public $timestamps = true;
    
    public function getModificatedDate(){
        return $this->update_at;
          return date("g:i a F j, Y ", strtotime($this->update_at));  
    }
    static function get($idPost){
        $p = Post::where('id',$idPost)->first();
        if($p){
            return $p;
        }
        return new Post();
    }
    static function listNews($idAssoc){
        return Post::where('id_association',$idAssoc)->get();
    }

    static function countNews($idAssoc){
        return Post::where('id_association',$idAssoc)->count();
    }

}