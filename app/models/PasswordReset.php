<?php

/**
 * An Eloquent Model: 'PasswordReset'
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $pass
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class PasswordReset extends Eloquent
{
    protected $table = 'password_reset';
    protected $primaryKey = 'id';
    public $timestamps = true;
}