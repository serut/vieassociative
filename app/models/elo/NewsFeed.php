<?php
class elo_NewsFeed extends Eloquent
{
	protected $table = 'wall';
    protected $primaryKey = 'id';
   	public $timestamps = true;
   	public function post()
    {
        return $this->belongsTo('elo_Post','id_post');
    }
}