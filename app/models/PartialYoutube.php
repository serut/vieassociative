<?php

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