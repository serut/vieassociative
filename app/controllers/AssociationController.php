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
        return View::make('association.edit')
            ->with('count_news',Post::countNews($idAssoc))
            ->with('count_admin',Association::countAdmin($idAssoc))
            ->with('association',elo_Association::find($idAssoc));
            //->with('rang',Association::getRangUser(Session::get('idUser'), $idAssoc))
            //->with('associationEnGestationNom',Association::getName($idAssoc));
    }
    public function getProfile($idAssoc) {
        return View::make('association.profile')
            ->with('association',elo_Association::find($idAssoc));
    }
    public function getEditGeneralInformations($idAssoc){
        return View::make('association.edit-general-informations')
            ->with('association',elo_Association::find($idAssoc));
    }
    public function getEditVieAssociativeInformations($idAssoc){
        return View::make('association.edit-vieassociative-informations')
            ->with('association',elo_Association::find($idAssoc));
    }
    public function getListNews($idAssoc){
        return View::make('association.list-news')
            ->with('news',Post::listNews($idAssoc))
            ->with('association',elo_Association::find($idAssoc));
    }
    public function getAddNews($idAssoc){
        $idPost = Post::addNews($idAssoc,Auth::user()->id);
        return Redirect::to('/'.$idAssoc.'/edit/news/'.$idPost.'/edit');
    }
    public function getEditNews($idAssoc, $idPost){
        return View::make('association.edit-news')
            ->with('post',Post::get($idPost,Auth::user()->id))
            ->with('association',elo_Association::find($idAssoc));
    }
    public function postEditNews($idAssoc, $idPost){
        $v = new validators_associationEditPost;
        $result = $v->validate();
        if(isset($result['success'])){
            Post::addProposition($idPost,Auth::user()->id,$result['data']);
            $result['redirect_url'] = '/'.$idAssoc.'/edit/';
            $result['data']=null; //Remove data
        }
        return Response::json($result);
    }
    public function getEditSocial($idAssoc){
        return View::make('association.edit-social');
    }
    public function getEditAdministrator($idAssoc){
        return View::make('association.edit-administrator')
            ->with('association',elo_Association::find($idAssoc))
            ->with('is_admin',false)
            ->with('admin',elo_UserAssociation::where('id_assoc',$idAssoc)->get());
    }
    public function getHistory($idAssoc){
        return View::make('association.history');
    }
}