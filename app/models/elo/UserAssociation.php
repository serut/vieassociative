<?php
class elo_UserAssociation  extends Eloquent
{
	protected $table = 'user_association';
    protected $primaryKey = 'id';
   	public $timestamps = false;
   	
   	public function author()
    {
        return $this->belongsTo('elo_User','id_user');
    }
}