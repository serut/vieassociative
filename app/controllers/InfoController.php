<?php

/**
 * Class InfoController
 */
class InfoController extends BaseController
{
    /**
     * @return \Illuminate\View\View
     */
    public function getCondition()
    {
        return View::make('info.condition');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return View::make('index.index')
            ->with('association', Association::all());
    }
}