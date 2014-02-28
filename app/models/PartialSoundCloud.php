<?php

/**
 * An Eloquent Model: 'PartialSoundCloud'
 *
 * @property integer $id
 * @property string $var1
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class PartialSoundCloud extends Eloquent
{
    protected $table = 'partial_soundcloud';
    public $timestamps = true;

    /**
     * @param $text
     * @return int
     */
    public static function add($text)
    {
        $partialSoundCloud = new PartialSoundCloud();
        $partialSoundCloud->var1 = $text;
        $partialSoundCloud->touch();
        return $partialSoundCloud->id;
    }

    /**
     * @param $id
     * @param $value
     */
    public static function edit($id, $value)
    {
        $partialSoundCloud = PartialSoundCloud::find($id);
        $partialSoundCloud->var1 = $value;
        $partialSoundCloud->touch();
    }
}