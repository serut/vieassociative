<?php

class PasswordReset extends Eloquent
{
    protected $table = 'password_reset';
    protected $primaryKey = 'id';
    public $timestamps = true;
}