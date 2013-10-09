<?php
class elo_Answer  extends Eloquent
{
	protected $table = 'answer';
    protected $primaryKey = 'id';
   	public $timestamps = true;


   	public function author()
    {
        return $this->belongsTo('elo_User','id_user');
    }
}