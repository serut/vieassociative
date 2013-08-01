<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;

App::error(function(ModelNotFoundException $e)
{
    return  Response::view('errors.database_refuse', array(), 404);
});