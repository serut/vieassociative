<?php
class Post extends Eloquent
{
    protected $table = 'post';
    public $timestamps = true;
    
    public function getModificatedDate(){
        return $this->update_at;
          return date("g:i a F j, Y ", strtotime($this->update_at));  
    }
    static function get($idPost){
        $p = Post::where('id',$idPost)->first();
        if($p){
            return $p;
        }
        return new Post();
    }
    static function listNews($idAssoc){
        return Post::where('id_association',$idAssoc)->get();
    }

    static function countNews($idAssoc){
        return Post::where('id_association',$idAssoc)->count();
    }

    static function edit($idPost,$idAssoc,$data){
        if($idPost){
            $post = Post::where('id',$idPost)->first();
        }else{
            $post = new Post();
            $post->id_association = $idAssoc;
        }
        $post->title = $data['title'];
        $post->text = $data['text'];
        if(isset($data['publish_later']) && $data['publish_later'] =="true"){
            $post->wish_time_publish = SiteHelpers::datepicker_to_timestamp($data['published_at']);
        }
        $post->touch();
        if(! $idPost && (! isset($data['publish_later']) ||  $data['publish_later'] =="false")){
            NewsFeed::addNews($idAssoc,$post->id);
        }
    }
}