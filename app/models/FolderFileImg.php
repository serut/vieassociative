<?php

/**
 * An Eloquent Model: 'FolderFileImg'
 *
 * @property integer $id
 * @property integer $id_folder
 * @property string $name_img
 * @property string $extension
 * @property integer $id_file
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Img $img
 * @property-read \Files $file
 */
class FolderFileImg extends Eloquent
{
    protected $table = 'folder_file_img';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * @param $idFolder
     * @param $name
     * @param $extension
     */
    static function addImg($idFolder, $name, $extension)
    {
        $f = new FolderFileImg;
        $f->id_folder = $idFolder;
        $f->name_img = $name;
        $f->extension = $extension;
        $f->touch();
    }

    /**
     * @param $idFolder
     * @param $idFile
     */
    static function addFile($idFolder, $idFile)
    {
        $f = new FolderFileImg;
        $f->id_folder = $idFolder;
        $f->id_file = $idFile;
        $f->touch();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function img()
    {
        return $this->belongsTo('Img', 'name_img');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function file()
    {
        return $this->belongsTo('Files', 'id_file');
    }
}