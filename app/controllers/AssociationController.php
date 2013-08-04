<?php

class AssociationController  extends BaseController {

    public function getAdd() {
        return View::make('association.add');
    }
    public function postAdd(){
        $v = new validators_associationAdd;
        $result = $v->register();
        if(isset($result['success'])){
            $id_assoc = Association::add($result['data']);

            // if the association has been created by one of his authorised user
            if($result['data']['choice']=="true"){
                User::addAssoc(Session::get('idUser'),$id_assoc,$result['data']['link']);
            }
            $result['redirect_url'] = '/';
            $result['data']=null; //Remove data
        }
        return Response::json($result);
    }
    
    public function getGererMaintenant($idAssoc) {
        Session::put('associationEnManagement',$idAssoc);
        User::changerAssociationManagement(Session::get('idUser'),$idAssoc);
        Session::put('associationEnManagementNom',Association::getName($idAssoc));
        Session::put('myassocs',Association::getAssociations(Session::get('idUser')));
        return Redirect::action('AssociationController@getEdit',array($idAssoc));
    }
    
    public function getEdit($idAssoc) {
        return View::make('association.edit');
            //->with('logo',Association::getLogo($idAssoc))
            //->with('rang',Association::getRangUser(Session::get('idUser'), $idAssoc))
            //->with('associationEnGestationNom',Association::getName($idAssoc));
    }
    public function getProfile($idAssoc) {
        return View::make('association.profile');
    }
    public function getEditGeneralInformations($idAssoc){
        return View::make('association.edit-general-informations');
    }
    public function getEditVieAssociativeInformations($idAssoc){
        return View::make('association.edit-vieassociative-informations');
    }
    public function getListNews($idAssoc){
        $news = Post::listNews($idAssoc);
        return View::make('association.list-news')->with('news',$news);
    }
    public function getAddNews($idAssoc){
        $idPost = Post::addNews($idAssoc);
        return Redirect::to('/'.$idAssoc.'/edit/news/'.$idPost.'/edit');;
    }
    public function getEditNews($idAssoc, $idNews){
        return View::make('association.edit-news');
    }
    public function getEditSocial($idAssoc){
        return View::make('association.edit-social');
    }
    public function getEditAdministrator($idAssoc){
        return View::make('association.edit-administrator');
    }
    public function getHistory($idAssoc){
        return View::make('association.history');
    }
}