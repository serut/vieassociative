<?php

class WallNews extends Eloquent
{
    protected $table = 'wall_news';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function association()
    {
        return $this->belongsTo('Association', 'id_assoc');
    }

}