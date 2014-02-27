<?php

class UserToken extends Eloquent
{
    protected $table = 'user_token';
    protected $primaryKey = 'id_user'; // meme si c'est faux !?
    public $timestamps = false;
}