<?php
class elo_Post  extends Eloquent
{
    protected $table = 'post';
   	public $timestamps = true;
   	public function getModificatedDate(){
   		return $this->update_at;
		return date("g:i a F j, Y ", strtotime($this->update_at));  
   	}
   	public function propositionPost()
    {
        return elo_Post::hasOne('elo_PropositionPost','id_post');
    }
}