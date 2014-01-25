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
    	if(isset($data['title']) && !empty($data['title'])){
    		$idTitle = PartialTitle::add($data['title']);
    		$partial = new Partial();
    		$partial->order=0;
    		$partial->partial_type="PartialTitle";
    		$partial->partial_id = $idTitle;
    		$partial->id_news = $id_news;
    		$partial->touch();
    	}

    	if(isset($data['text']) && !empty($data['text'])){
    		$idText = PartialText::add($data['text']);
    		$partial = new Partial();
    		$partial->order=1;
    		$partial->partial_type="PartialText";
    		$partial->partial_id = $idText;
    		$partial->id_news = $id_news;
    		$partial->touch();
    	}

        if(isset($data['soundcloud']) && !empty($data['soundcloud'])){
            $idTitle = PartialSoundCloud::add($data['soundcloud']);
            $partial = new Partial();
            $partial->order=2;
            $partial->partial_type="PartialSoundCloud";
            $partial->partial_id = $idTitle;
            $partial->id_news = $id_news;
            $partial->touch();
        }

        if(isset($data['youtube']) && !empty($data['youtube'])){
            $idText = PartialYoutube::add($data['youtube']);
            $partial = new Partial();
            $partial->order=3;
            $partial->partial_type="PartialYoutube";
            $partial->partial_id = $idText;
            $partial->id_news = $id_news;
            $partial->touch();
        }

        if(isset($data['onepicture']) && !empty($data['onepicture'])){
            $idText = PartialOnePicture::add($data['onepicture']);
            $partial = new Partial();
            $partial->order=4;
            $partial->partial_type="PartialOnePicture";
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
        	$query = DB::select('select *,partial.updated_at as updated_at,partial.id as id 
                    ,partial_title.var1 as title
                    ,partial_text.var1 as text
                    ,partial_soundcloud.var1 as soundcloud
                    ,partial_youtube.var1 as youtube
                    ,partial_one_picture.var1 as url_img
                    from partial 
        			LEFT JOIN partial_title ON partial.partial_type = "PartialTitle" AND partial_title.id = partial.partial_id
                    LEFT JOIN partial_text ON partial.partial_type = "PartialText" AND partial_text.id = partial.partial_id
                    LEFT JOIN partial_soundcloud ON partial.partial_type = "PartialSoundCloud" AND partial_soundcloud.id = partial.partial_id
                    LEFT JOIN partial_youtube ON partial.partial_type = "PartialYoutube" AND partial_youtube.id = partial.partial_id
                    LEFT JOIN partial_one_picture ON partial.partial_type = "PartialOnePicture" AND partial_one_picture.id = partial.partial_id
    	    		where partial.id_news in ('.implode(',',$listNews).')
    	    		ORDER BY partial.id_news DESC, partial.order ASC');
        	$id_news = -1;
        	$i = 0;
        	foreach ($query as $q) {
        		if($id_news != $q->id_news){
        			$i++;
        			$id_news = $q->id_news;
        		}
                switch ($q->partial_type) {
                    case 'PartialTitle':
                        $result[$id_news][] = array("type"=>$q->partial_type,"title"=>$q->title);
                        break;
                    case 'PartialText':
                        $result[$id_news][] = array("type"=>$q->partial_type,"text"=>$q->text);
                        break;
                    case 'PartialSoundCloud':
                        $result[$id_news][] = array("type"=>$q->partial_type,"soundcloud_url"=>$q->soundcloud);
                        break;
                    case 'PartialYoutube':
                        $result[$id_news][] = array("type"=>$q->partial_type,"youtube_slug"=>$q->youtube);
                        break;
                    case 'PartialOnePicture':
                        $result[$id_news][] = array("type"=>$q->partial_type,"img_url"=>$q->url_img);
                }
        	}
        }
    	return $result;
    }
}