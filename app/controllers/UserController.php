<?php

class UserController extends BaseController
{
    public function getEdit($id)
    {
        return View::make('user.edit');
    }
}

