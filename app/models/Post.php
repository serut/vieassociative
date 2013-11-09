<?php
class Post extends Eloquent
{
    static function get($idPost){
        $p = elo_Post::where('id',$idPost)->first();
        if($p){
            return $p;
        }
        return new elo_Post();
    }
    static function listNews($idAssoc){
        return elo_Post::where('id_association',$idAssoc)->get();
    }

    static function countNews($idAssoc){
        return elo_Post::where('id_association',$idAssoc)->count();
    }

    static function edit($idPost,$idAssoc,$data){
        if($idPost){
            $post = elo_Post::where('id',$idPost)->first();
        }else{
            $post = new elo_Post();
            $post->id_association = $idAssoc;
        }
        $post->title = $data['title'];
        $post->text = $data['text'];
        if($data['publish_later'] =="true"){
            $post->wish_time_publish = SiteHelpers::datepicker_to_timestamp($data['published_at']);
        }
        $post->touch();
    }
}