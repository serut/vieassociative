<?php

class DiscussionController  extends BaseController {

    public function getIndex() {
        return View::make('discussion.index');
    }
    
}