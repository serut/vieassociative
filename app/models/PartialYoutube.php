<?php
class PartialYoutube extends Eloquent
{
    protected $table = 'partial_youtube';
    public $timestamps = true;
    public static function add($text){
    	$partialYoutube = new PartialYoutube();
    	$partialYoutube->var1=$text;
    	$partialYoutube->touch();
    	return $partialYoutube->id;
    }
}