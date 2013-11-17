<?php
class File  extends Eloquent
{
	static function addFile($name, $extension, $id_assoc){
		$f = new elo_File();
		$f->name = $name;
		$f->extension = $extension;
		$f->id_assoc = $id_assoc;
		$f->touch();
	}
	static function addImg($original,$crop){
		$i = new elo_Img();
		$i->original = $original;
		$i->crop = $crop;
		$i->touch();
		return $i->id;
	}
}