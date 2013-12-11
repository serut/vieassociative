<?php
class Files  extends Eloquent
{
	protected $table = 'file';
    protected $primaryKey = 'id';
   	public $timestamps = true;
	static function addFile($name, $extension){
		$f = new Files();
		$f->name = $name;
		$f->extension = $extension;
		$f->id_user = Auth::user()->id;
		$f->touch();
	}
	static function addImg($name, $extension){
		$i = new Img();
		$f->name = $name;
		$f->extension = $extension;
		$f->id_user = Auth::user()->id;
		$i->touch();
		return $i->id;
	}
}