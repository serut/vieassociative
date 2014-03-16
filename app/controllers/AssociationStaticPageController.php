<?php

/**
 * This is the controller for association static's pages
 *Actions Handled By Resource Controller
Verb 	Path 	Action 	Route Name
GET 	/resource 	index 	resource.index
GET 	/resource/create 	create 	resource.create
POST 	/resource 	store 	resource.store
GET 	/resource/{resource} 	show 	resource.show
GET 	/resource/{resource}/edit 	edit 	resource.edit
PUT/PATCH 	/resource/{resource} 	update 	resource.update
DELETE 	/resource/{resource} 	destroy 	resource.destroy
 * @author  Mieulet Léo <l.mieulet@gmail.com>
 */
class AssociationStaticPageController extends BaseController
{
    public function index($idAssoc)
    {
        return View::make('association.staticpage.index')
            ->with('association', Association::findOrFail($idAssoc))
            ->with('news', News::listNews($idWallNews));
    }
    public function create($idAssoc){

    }

    static function store($idAssoc){
        //Edition d'une liste de static page
        // NEVERDOIT
    }

    public function show($idAssoc, $idWallNews, $idNews)
    {
        return View::make('association.staticpage.show-editor')
            ->with('association', Association::findOrFail($idAssoc))
            ->with('id_wall_news', $idWallNews)
            ->with('id_news', $idNews)
            ->with('news', News::get($idNews));
    }

    static function edit($idAssoc)
    {
        //edition d'une static page
    }
    static function update($idAssoc)
    {
        // NEVERDOIT
    }

    static function destroy(){
        // TODO one day baby
    }

}