<?php

class UserController extends BaseController
{
    public function getEdit($id)
    {
        return View::make('user.edit');
    }
    public function getProfil($id)
    {
        return View::make('user.edit');
    }
}
