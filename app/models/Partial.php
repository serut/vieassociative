<?php
class Partial extends Eloquent
{
    protected $table = 'partial';
    public $timestamps = true;
    public function partiable(){
        return $this->morphTo();
    }
    static function edit($id_news, $data){
    }
    static function add($id_news, $data){
    	if(isset($data['title'])){
    		$idTitle = PartialTitle::add($data['title']);
    		$partial = new Partial();
    		$partial->order=0;
    		$partial->partial_type="PartialTitle";
    		$partial->partial_id = $idTitle;
    		$partial->id_news = $id_news;
    		$partial->touch();
    	}
    }
    static function getNews($news){
    	$listNews = array();
    	foreach ($news as $n) {
    		$listNews[] = $n->id;
    	}
    	return Partial::with('partiable')->get();
    }
}