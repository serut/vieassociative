<?php
class Partial extends Eloquent
{
    protected $table = 'partial';
    public $timestamps = true;
    
    public function partiable(){
        return $this->morphTo();
    }
    static function search($container, $type){
        foreach ($container['data'] as $key => $value) {
            if($value['value'] == $type){
                return $value;
            }
        }
        throw new Exception("Error Processing Request", 1);
    }
    static function has($container, $type){
        foreach ($container['data'] as $key => $value) {
            if($value['value'] == $type){
                return true;
            }
        }
        return false;
    }
    static function edit($id_news, $data){

        $newsBefore = $this->get($id_news);
        if(isset($data['title']) && !empty($data['title']) && !Partial::has($newsBefore,'title')){
            //add
            $idTitle = PartialTitle::add($data['title']);
            $partial = new Partial();
            $partial->order=0;
            $partial->partial_type="PartialTitle";
            $partial->partial_id = $idTitle;
            $partial->id_news = $id_news;
            $partial->touch();
        }else{
            if($data['title']!=$newsBefore['title']){
                //edit
                PartialTitle::edit($newsBefore['partial_id'],$newsBefore['title']);
            }
        }

        if(isset($data['text']) && !empty($data['text']) && !Partial::has($newsBefore,'text')){
            //add
            $idText = PartialText::add($data['text']);
            $partial = new Partial();
            $partial->order=1;
            $partial->partial_type="PartialText";
            $partial->partial_id = $idText;
            $partial->id_news = $id_news;
            $partial->touch();
        }else{
            if($data['text']!=$newsBefore['text']){
                //edit
                PartialText::edit($newsBefore['partial_id'],$newsBefore['text']);
            }
        }

        if(isset($data['soundcloud']) && !empty($data['soundcloud']) && !Partial::has($newsBefore,'soundcloud')){
            //add
            $idTitle = PartialSoundCloud::add($data['soundcloud']);
            $partial = new Partial();
            $partial->order=2;
            $partial->partial_type="PartialSoundCloud";
            $partial->partial_id = $idTitle;
            $partial->id_news = $id_news;
            $partial->touch();
        }else{
            if($data['soundcloud']!=$newsBefore['soundcloud']){
                //edit
                PartialSoundcloud::edit($newsBefore['partial_id'],$newsBefore['soundcloud']);
            }
        }

        if(isset($data['youtube']) && !empty($data['youtube']) && !Partial::has($newsBefore,'youtube')){
            //add
            $idText = PartialYoutube::add($data['youtube']);
            $partial = new Partial();
            $partial->order=3;
            $partial->partial_type="PartialYoutube";
            $partial->partial_id = $idText;
            $partial->id_news = $id_news;
            $partial->touch();
        }else{
            if($data['youtube']!=$newsBefore['youtube']){
                //edit
                PartialYoutube::edit($newsBefore['partial_id'],$newsBefore['youtube']);
            }
        }

        if(isset($data['onepicture']) && !empty($data['onepicture']) && !Partial::has($newsBefore,'onepicture')){
            //add
            $idText = PartialOnePicture::add($data['onepicture']);
            $partial = new Partial();
            $partial->order=4;
            $partial->partial_type="PartialOnePicture";
            $partial->partial_id = $idText;
            $partial->id_news = $id_news;
            $partial->touch();
        }else{
            if($data['onepicture']!=$newsBefore['onepicture']){
                //edit
                PartialOnePicture::edit($newsBefore['partial_id'],$newsBefore['onepicture']);
            }
        }
    }
    static function get($idNews){
        $p = News::find($idNews); 
        if(!$p->isEmpty()){
            $result = Partial::getNews(array($idPost));
            foreach ($result as $r) {
                return $r;
            }
        }
        return $p;
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
                    $result[$id_news]['updated_at'] = $q->updated_at;
        		}
                switch ($q->partial_type) {
                    case 'PartialTitle':
                        $arg1_name = "title";
                        break;
                    case 'PartialText':
                        $arg1_name = "text";
                        break;
                    case 'PartialSoundCloud':
                        $arg1_name = "soundcloud_url";
                        break;
                    case 'PartialYoutube':
                        $arg1_name = "youtube_slug";
                        break;
                    case 'PartialOnePicture':
                        $arg1_name = "img_url";
                }
                $result[$id_news]['data'][] = array(
                                                "type"=>$q->partial_type,
                                                $arg1_name=>$q->title
                                            );
        	}
        }
    	return $result;
    }
}