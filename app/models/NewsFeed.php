<?php
class NewsFeed extends Eloquent{
    static function addNews($id_assoc,$id_post){
        $w = new elo_NewsFeed;
        $w->id_assoc = $id_assoc;
        $w->id_post = $id_post;
        $w->type = "text";
        $w->touch();
    }
    static function get($id_assoc){
    	return elo_NewsFeed::where('id_assoc',$id_assoc)->with('post')->orderBy('id','desc')->get();
    }
}