<?php

/**
 * Class BaseController
 */
class BaseController extends Controller
{

    /**
     * Setup the layout used by the controller.
     * @important It's a controller created by Laravel. Don't edit it.
     * @return void
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

}