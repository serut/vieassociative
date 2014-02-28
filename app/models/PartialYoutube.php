<?php

/**
 * An Eloquent Model: 'PartialYoutube'
 *
 * @property integer $id
 * @property string $var1
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class PartialYoutube extends Eloquent
{
    protected $table = 'partial_youtube';
    public $timestamps = true;

    public static function add($text)
    {
        $partialYoutube = new PartialYoutube();
        $partialYoutube->var1 = $text;
        $partialYoutube->touch();
        return $partialYoutube->id;
    }

    public static function edit($id, $value)
    {
        $partialYoutube = PartialYoutube::find($id);
        $partialYoutube->var1 = $value;
        $partialYoutube->touch();
    }
}