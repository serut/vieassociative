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
    static function get($idPost){
        return Partial::get($idPost);
    }
    static function edit($id_news,$id_assoc, $data){
        if($id_news == 0){
            $news = new News();
            $news->id_assoc=$id_assoc;
            $news->touch();
            Partial::add($news->id, $data);
        }else{
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