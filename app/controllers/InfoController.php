<?php

class InfoController extends BaseController
{
    public function getCondition(){
        return View::make('info.condition');
    }
    public function getIndex(){
        return View::make('index.index')
            ->with('association',Association::all());
    }
}