<?php

/**
 * An Eloquent Model: 'Partial'
 *
 * @property integer $id
 * @property integer $id_news
 * @property integer $order
 * @property string $partial_type
 * @property integer $partial_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 */
class Partial extends Eloquent
{
    protected $table = 'partial';
    public $timestamps = true;

    /**
     * @param $container
     * @param $type
     * @return mixed
     * @throws Exception
     */
    static function search($container, $type)
    {
        foreach ($container['data'] as $value) {
            if ($value['type'] == $type) {
                return $value;
            }
        }
        throw new Exception("Error Processing Request", 1);
    }

    /**
     * @param string $id_partial
     * @param string $container
     * @param int $type
     * @return bool
     */
    static function has($id_partial, $container, $type)
    {
        if (!isset($container['data']) || empty($container['data'])) {
            return false;
        }
        foreach ($container['data'] as $value) {
            if ($value['type'] == $type && $value['partial_id'] == $id_partial) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $data
     * @param $result
     * @return mixed
     */
    static function edit($data, $result)
    {
        $id_news = $data['id_news'];
        $p = News::where('id', $id_news)->get();
        $newsBefore = Partial::get($p);
        if (isset($data['title']) && !empty($data['title'])) {
            if (!Partial::has($data['id'], $newsBefore, 'PartialTitle')) {
                //add
                $idTitle = PartialTitle::add($data['title']);
                $partial = new Partial();
                $partial->order = $data['order'];
                $partial->partial_type = "PartialTitle";
                $partial->partial_id = $idTitle;
                $partial->id_news = $id_news;
                $partial->touch();
                $result['id_title'] = $idTitle;
            } else {
                $precedent_val = Partial::search($newsBefore, 'PartialTitle');
                if ($data['title'] != $precedent_val['title']) {
                    //edit
                    PartialTitle::edit($precedent_val['partial_id'], $data['title']);
                }
            }
        }
        if (isset($data['textarea']) && !empty($data['textarea'])) {
            if (!Partial::has($data['id'], $newsBefore, 'PartialText')) {
                //add
                $idText = PartialText::add($data['textarea']);
                $partial = new Partial();
                $partial->order = $data['order'];
                $partial->partial_type = "PartialText";
                $partial->partial_id = $idText;
                $partial->id_news = $id_news;
                $partial->touch();
                $result['id_textarea'] = $idText;
            } else {
                $precedent_val = Partial::search($newsBefore, 'PartialText');
                if ($data['textarea'] != $precedent_val['text']) {
                    //edit
                    PartialText::edit($precedent_val['partial_id'], $data['textarea']);
                }
            }
        }


        if (isset($data['soundcloud']) && !empty($data['soundcloud'])) {
            if (!Partial::has($data['id'], $newsBefore, 'PartialSoundCloud')) {
                //add
                $idSoundcloud = PartialSoundCloud::add($data['soundcloud']);
                $partial = new Partial();
                $partial->order = $data['order'];
                $partial->partial_type = "PartialSoundCloud";
                $partial->partial_id = $idSoundcloud;
                $partial->id_news = $id_news;
                $partial->touch();
                $result['id_soundcloud'] = $idSoundcloud;
            } else {
                $precedent_val = Partial::search($newsBefore, 'PartialSoundCloud');
                if ($data['soundcloud'] != $precedent_val['soundcloud_url']) {
                    //edit
                    PartialSoundcloud::edit($precedent_val['partial_id'], $data['soundcloud_url']);
                }
            }
        }


        if (isset($data['youtube']) && !empty($data['youtube'])) {
            if (!Partial::has($data['id'], $newsBefore, 'PartialYoutube')) {
                //add
                $idYoutube = PartialYoutube::add($data['youtube']);
                $partial = new Partial();
                $partial->order = $data['order'];
                $partial->partial_type = "PartialYoutube";
                $partial->partial_id = $idYoutube;
                $partial->id_news = $id_news;
                $partial->touch();
                $result['id_youtube'] = $idYoutube;
            } else {
                $precedent_val = Partial::search($newsBefore, 'PartialYoutube');
                if ($data['youtube'] != $precedent_val['youtube_slug']) {
                    //edit
                    PartialYoutube::edit($precedent_val['partial_id'], $data['youtube_slug']);
                }
            }
        }
        if (isset($data['onepicture']) && !empty($data['onepicture'])) {
            if (!Partial::has($data['id'], $newsBefore, 'PartialOnePicture')) {
                //add
                $idOnePicture = PartialOnePicture::add($data['onepicture']);
                $partial = new Partial();
                $partial->order = $data['order'];
                $partial->partial_type = "PartialOnePicture";
                $partial->partial_id = $idOnePicture;
                $partial->id_news = $id_news;
                $partial->touch();
                $result['id_onepicture'] = $idOnePicture;
            } else {
                $precedent_val = Partial::search($newsBefore, 'PartialOnePicture');
                if ($data['onepicture'] != $precedent_val['img_url']) {
                    //edit
                    PartialOnePicture::edit($precedent_val['img_url'], $data['img_url']);
                }
            }
        }
        return $result;
    }

    /**
     * @param array $news
     * @return array
     */
    static function get($news)
    {
        if (!empty($news)) {
            $result = Partial::getNews($news);
            foreach ($result as $r) {
                return $r;
            }
        }
        return $news;
    }

    /**
     * @param $news
     * @return array
     */
    static function getNews($news)
    {
        $result = array();
        if (!$news->isEmpty()) {

            $listNews = array();
            foreach ($news as $n) {
                $listNews[] = $n->id;
            }
            $query = DB::select('select *,partial.updated_at as updated_at,partial.id as id
                    ,partial.partial_id as partial_id 
                    ,partial_title.var1 as title
                    ,partial_text.var1 as text
                    ,partial_soundcloud.var1 as soundcloud_url
                    ,partial_youtube.var1 as youtube_slug
                    ,partial_one_picture.var1 as img_url
                    from partial 
        			LEFT JOIN partial_title ON partial.partial_type = "PartialTitle" AND partial_title.id = partial.partial_id
                    LEFT JOIN partial_text ON partial.partial_type = "PartialText" AND partial_text.id = partial.partial_id
                    LEFT JOIN partial_soundcloud ON partial.partial_type = "PartialSoundCloud" AND partial_soundcloud.id = partial.partial_id
                    LEFT JOIN partial_youtube ON partial.partial_type = "PartialYoutube" AND partial_youtube.id = partial.partial_id
                    LEFT JOIN partial_one_picture ON partial.partial_type = "PartialOnePicture" AND partial_one_picture.id = partial.partial_id
    	    		where partial.id_news in (' . implode(',', $listNews) . ')
    	    		ORDER BY partial.id_news DESC, partial.order ASC');
            $id_news = -1;
            $i = 0;
            foreach ($query as $q) {
                if ($id_news != $q->id_news) {
                    $i++;
                    $id_news = $q->id_news;
                    $result[$id_news]['updated_at'] = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $q->updated_at)->toISO8601String();
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
                    "type" => $q->partial_type,
                    $arg1_name => $q->$arg1_name,
                    "partial_id" => $q->partial_id,
                );
            }
        }
        return $result;
    }
}