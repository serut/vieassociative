<?php

/**
 * An Eloquent Model: 'Files'
 *
 * @property integer $id
 * @property string $name
 * @property string $extension
 * @property integer $id_user
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Files extends Eloquent
{
    protected $table = 'file';
    protected $primaryKey = 'id';
    public $timestamps = true;

    static function add($name, $extension)
    {
        $f = new Files();
        $f->name = $name;
        $f->extension = $extension;
        $f->id_user = Auth::user()->id;
        $f->touch();
        return $f->id;
    }
}