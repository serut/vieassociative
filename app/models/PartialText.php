<?php
class PartialText extends Eloquent
{
    protected $table = 'partial_text';
    public $timestamps = true;
    public static function add($text){
    	$partialText = new PartialText();
    	$partialText->var1=$text;
    	$partialText->touch();
    	return $partialText->id;
    }
    public static function edit($id,$value){
    	$partialText = PartialText::find($id);
    	$partialText->var1=$value;
    	$partialText->touch();
    }
}