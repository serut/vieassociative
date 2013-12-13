<?php

class FileController  extends BaseController {
    public function getUpload($idAssoc){
        if(App::environment() == "prod"){
            $prefix = 'a';
        }else{
            $prefix = 'deva';
        }
        return View::make('picture.upload')
                ->with('association',Association::find($idAssoc))
                ->with('gallery',Folder::getGallery($idAssoc))
                ->with('prefix',$prefix)
                ->with('hasNextStep',true);
    }
    public function getCrop($idAssoc){
        return View::make('picture.crop')
                ->with('type',Input::get('change'));
    }
}