<?php

/**
 * An Eloquent Model: 'PartialTitle'
 *
 * @property integer $id
 * @property string $var1
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class PartialTitle extends Eloquent
{
    protected $table = 'partial_title';
    public $timestamps = true;

    /**
     * @param $title
     * @return int
     */
    public static function add($title)
    {
        $partialTitle = new PartialTitle();
        $partialTitle->var1 = $title;
        $partialTitle->touch();
        return $partialTitle->id;
    }

    /**
     * @param $id
     * @param $value
     */
    public static function edit($id, $value)
    {
        $partialTitle = PartialTitle::find($id);
        $partialTitle->var1 = $value;
        $partialTitle->touch();
    }
}