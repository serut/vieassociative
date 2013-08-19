<?php
class elo_Association  extends Eloquent
{
	protected $table = 'association';
    protected $primaryKey = 'id';
   	public $timestamps = true;
   	public function admitted_public_utility_display(){
   		return $this->admitted_public_utility ? 'Oui' : 'Non';
   	}
}
