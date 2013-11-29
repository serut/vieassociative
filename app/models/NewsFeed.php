<?php
class NewsFeed extends Eloquent{
    protected $table = 'wall';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public function post()
    {
        return $this->belongsTo('Post','id_post');
    }
    static function addNews($id_assoc,$id_post){
        $w = new NewsFeed;
        $w->id_assoc = $id_assoc;
        $w->id_post = $id_post;
        $w->type = "text";
        $w->touch();
    }
    static function get($id_assoc){
    	return NewsFeed::where('id_assoc',$id_assoc)->with('post')->orderBy('id','desc')->get();
    }
}