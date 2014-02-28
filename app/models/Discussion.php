<?php

/**
 * An Eloquent Model: 'Discussion'
 *
 * @property integer $id
 * @property string $title
 * @property integer $level_access
 * @property boolean $closed
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 */
class Discussion extends Eloquent
{
    protected $table = 'discussion';
    protected $primaryKey = 'id';
    public $timestamps = true;
}