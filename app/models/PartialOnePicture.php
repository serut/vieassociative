<?php

class PartialOnePicture extends Eloquent
{
    protected $table = 'partial_one_picture';
    public $timestamps = true;

    public static function add($text)
    {
        $partialOnePicture = new PartialOnePicture();
        $partialOnePicture->var1 = $text;
        $partialOnePicture->touch();
        return $partialOnePicture->id;
    }

    public static function edit($id, $value)
    {
        $partialOnePicture = PartialOnePicture::find($id);
        $partialOnePicture->var1 = $value;
        $partialOnePicture->touch();
    }
}