<?php
class elo_User extends Eloquent
{
	protected $table = 'user';
    protected $primaryKey = 'id';
   	public $timestamps = true;
}