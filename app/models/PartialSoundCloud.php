<?php
class PartialSoundCloud extends Eloquent
{
    protected $table = 'partial_soundcloud';
    public $timestamps = true;
    public static function add($text){
    	$partialSoundCloud = new PartialSoundCloud();
    	$partialSoundCloud->var1=$text;
    	$partialSoundCloud->touch();
    	return $partialSoundCloud->id;
    }
}