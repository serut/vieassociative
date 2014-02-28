<?php

/**
 * An Eloquent Model: 'UserToken'
 *
 * @property integer $id_user
 * @property string $token
 * @property \Carbon\Carbon $date_fin
 */
class UserToken extends Eloquent
{
    protected $table = 'user_token';
    protected $primaryKey = 'id_user'; // meme si c'est faux !?
    public $timestamps = false;
}