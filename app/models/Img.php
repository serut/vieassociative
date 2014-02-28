<?php

/**
 * An Eloquent Model: 'Img'
 *
 * @property string $name
 * @property string $extension
 * @property integer $id_user
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Img extends Eloquent
{
    protected $table = 'img';
    protected $primaryKey = 'name';
    public $timestamps = true;

    /**
     * @param $name
     * @param $extension
     * @return mixed
     */
    static function add($name, $extension)
    {
        $i = new Img();
        $i->name = $name;
        $i->extension = strtolower($extension);
        $i->id_user = Auth::user()->id;
        $i->touch();
        return $i->id;
    }
}