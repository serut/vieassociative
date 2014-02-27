<?php

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