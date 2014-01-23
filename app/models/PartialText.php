<?php
class PartialText extends Eloquent
{
    protected $table = 'partial_text';
    public $timestamps = true;
    public static function add($text){
    	$partialText = new PartialText();
    	$partialText->text=$text;
    	$partialText->touch();
    	return $partialText->id;
    }
}