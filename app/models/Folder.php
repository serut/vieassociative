<?php

/**
 * An Eloquent Model: 'Folder'
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Folder extends Eloquent
{
    protected $table = 'folder';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * @param $idAssoc
     * @return array
     */
    static function getGallery($idAssoc)
    {
        $a = Association::find($idAssoc);
        $elements = FolderFileImg::where('id_folder', $a->id_folder)
            ->with('img')->with('file')->get();
        $f = Folder::find($a->id_folder);
        return $return = array(
            'name' => $f->name,
            'element' => $elements
        );
    }
}