<?php

class WallGallery extends Eloquent
{
    protected $table = 'wall_gallery';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function folder()
    {
        return $this->belongsTo('Folder', 'id_folder');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function association()
    {
        return $this->belongsTo('Association', 'id_assoc');
    }

}