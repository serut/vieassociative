<?php
class PartialTitle extends Eloquent
{
    protected $table = 'partial_title';
    public $timestamps = true;
    public static function add($title){
    	$partialTitle = new PartialTitle();
    	$partialTitle->title=$title;
    	$partialTitle->touch();
    	return $partialTitle->id;
    }
}