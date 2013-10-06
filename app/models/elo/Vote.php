<?php
class elo_Vote  extends Eloquent
{
	protected $table = 'vote';
    protected $primaryKey = 'id';
   	public $timestamps = true;
}