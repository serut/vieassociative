<?php
class elo_Proposition  extends Eloquent
{
	protected $table = 'proposition';
    protected $primaryKey = 'id';
	protected $softDelete = true;
   	public $timestamps = true;

   	
   	public function discussion()
    {
        return $this->belongsTo('elo_Discussion','id_discussion');
    }
}