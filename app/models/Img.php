<?php
class Img extends Eloquent
{
	protected $table = 'img';
    protected $primaryKey = 'name';
   	public $timestamps = true;
	static function add($name, $extension){
		$i = new Img();
		$i->name = $name;
		$i->extension = $extension;
		$i->id_user = Auth::user()->id;
		$i->touch();
		return $i->id;
	}
}