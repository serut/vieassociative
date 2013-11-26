<?php
class File  extends Eloquent
{
	static function addFile($name, $extension){
		$f = new elo_File();
		$f->name = $name;
		$f->extension = $extension;
		$f->id_user = Auth::user()->id;
		$f->touch();
	}
	static function addImg($name, $extension){
		$i = new elo_Img();
		$f->name = $name;
		$f->extension = $extension;
		$f->id_user = Auth::user()->id;
		$i->touch();
		return $i->id;
	}
}