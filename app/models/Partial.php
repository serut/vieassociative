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

    	if(isset($data['text'])){
    		$idText = PartialText::add($data['text']);
    		$partial = new Partial();
    		$partial->order=1;
    		$partial->partial_type="PartialText";
    		$partial->partial_id = $idText;
    		$partial->id_news = $id_news;
    		$partial->touch();
    	}
    }
    static function getNews($news){
        $result = array();
        if(!$news->isEmpty()){

        	$listNews = array();
        	foreach ($news as $n) {
        		$listNews[] = $n->id;
        	}
        	$query = DB::select('select *,partial.updated_at as updated_at from partial 
        			LEFT JOIN partial_title ON partial.partial_type = "PartialTitle" AND partial_title.id = partial.partial_id
        			LEFT JOIN partial_text ON partial.partial_type = "PartialText" AND partial_text.id = partial.partial_id
    	    		where partial.id_news in ('.implode(',',$listNews).')
    	    		ORDER BY partial.id_news DESC, partial.order ASC');
        	$id_news = -1;
        	$i = 0;
        	foreach ($query as $q) {
        		if($id_news != $q->id_news){
        			$i++;
        			$id_news = $q->id_news;
        		}
        		$result[$id_news][] = $q;
        	}
        }
    	return $result;
    }
}