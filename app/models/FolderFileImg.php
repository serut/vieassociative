<?php
class FolderFileImg  extends Eloquent
{
	protected $table = 'folder_file_img';
    protected $primaryKey = 'id';
   	public $timestamps = true;
   	static function addImg($idFolder,$name){
   		$f = new FolderFileImg;
   		$f->id_folder = $idFolder;
   		$f->name_img = $name;
   		$f->touch();
   	}
   	static function addFile($idFolder,$idFile){
   		$f = new FolderFileImg;
   		$f->id_folder = $idFolder;
   		$f->id_file = $idFile;
   		$f->touch();
   	}

   	public function img(){
        return $this->belongsTo('Img','name_img');
    }

   	public function file(){
        return $this->belongsTo('Files','id_file');
    }
}