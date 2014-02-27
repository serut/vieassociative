<?php
class Folder  extends Eloquent
{
	protected $table = 'folder';
    protected $primaryKey = 'id';
   	public $timestamps = true;
   	static function getGallery($idAssoc){
   		$a = Association::find($idAssoc);
   		$elements = FolderFileImg::where('id_folder',$a->id_folder)
   								->with('img')->with('file')->get();
   		$f = Folder::find($a->id_folder);
   		return $return = array(
   			'name'=>$f->name,
   			'element'=>$elements
   			);
   	}
}