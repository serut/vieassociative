<?php
class News extends Eloquent
{
    protected $table = 'news';
    public $timestamps = true;
    public function partial(){
        return $this->hasMany('Partial','id_news');
    }
    public function getModificatedDate(){
        return $this->update_at;
          return date("g:i a F j, Y ", strtotime($this->update_at));  
    }
    static function get($idNews){
        if(intval($idNews) == 0){
            return array();
        }else{
            $p = News::where('id',$idNews)->get(); 
            return Partial::get($p);
        }
    }
    static function edit($id_news,$id_assoc, $data){
        if(intval($id_news) == 0){
            //add
            $news = new News();
            $news->id_assoc=$id_assoc;
            $news->touch();
            Partial::edit($news->id, $data);
        }else{
            //edit
            Partial::edit($id_news, $data);
        }
    }
    static function listNews($idAssoc){
        $news = News::where('id_assoc',$idAssoc)->get();
        return Partial::getNews($news);
    }
    static function countNews($idAssoc){
        return News::where('id_assoc',$idAssoc)->count();
    }
}