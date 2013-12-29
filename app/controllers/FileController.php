<?php

class FileController  extends BaseController {
    public function getUpload($idAssoc,$idGallery,$typeCrop,$action){
        if(App::environment() == "prod"){
            $prefix = 'a';
        }else{
            $prefix = 'deva';
        }
        return View::make('picture.upload')
                ->with('association',Association::find($idAssoc))
                ->with('gallery',Folder::getGallery($idAssoc))
                ->with('prefix',$prefix)
                ->with('typeCrop',$typeCrop)
                ->with('action',$action)
                ->with('hasNextStep',!empty($typeCrop));
    }
    public function getCrop($idAssoc,$typeCrop,$action,$namePic){
        if(App::environment() == "prod"){
            $prefix = 'a';
        }else{
            $prefix = 'deva';
        }
        switch ($typeCrop) {
            case '400x400':
                $x = 400;
                $y = 400;
                break;
            case '120x120':
                $x = 120;
                $y = 120;
                break;
            case '200x200':
                $x = 200;
                $y = 200;
                break;
            case '940x350':
                $x = 940;
                $y = 350;
                break;
            case '400x400':
                $x = 150;
                $y = 150;
                break;

            case '400x400':
                $x = 150;
                $y = 150;
                break;

            default:
                return Response::view('errors.404', array(), 404);
                break;
        }
        return View::make('picture.crop')
                ->with('prefix',$prefix)
                ->with('name',$namePic)
                ->with('x',$x)
                ->with('y',$y)
                ->with('association',Association::find($idAssoc))
                ->with('type',Input::get('change'));
    }
}