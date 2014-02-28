<?php

/**
 * An Eloquent Model: 'Vote'
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_answer
 * @property integer $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Vote extends Eloquent
{
    protected $table = 'vote';
    protected $primaryKey = 'id';
    public $timestamps = true;
}