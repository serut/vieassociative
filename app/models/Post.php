<?php
class Post extends Eloquent
{
    
    static function listNews($idAssoc){
        return elo_Post::where('id_association',$idAssoc)->get();
    }

    static function addNews($idAssoc){
        $proposition_post = new elo_PropositionPost;
        $proposition_post->id_author = Auth::user()->id;
        $proposition_post->touch();

        $post = new elo_Post;
        $post->active = 0;
        $post->id_proposition_post = $proposition_post->id;
        $post->id_association = $idAssoc;
        $post->touch();
        return $post->id;
    }
}