<?php
class UserAssociation  extends Eloquent
{
	protected $table = 'user_association';
    protected $primaryKey = 'id';
   	public $timestamps = false;
   	
   	public function author()
    {
        return $this->belongsTo('User','id_user');
    }
    public function association()
    {
        return $this->belongsTo('Association','id_assoc');
    }
}