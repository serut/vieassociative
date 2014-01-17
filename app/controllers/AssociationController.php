<?php
/**
	* This is the controller for association pages
	*
	* @author  Mieulet Léo <l.mieulet@gmail.com>
*/
 class AssociationController  extends BaseController {
 	/**
		* @see http://association.vieassociative.fr/
		* @return View Search associations
	*/
	public function getIndex() {
        return View::make('index.listing')
            ->with('association',Association::all());
	}


 	/**
		* @see http://association.vieassociative.fr/add 
		* @return View Users can add an other association on this page
	*/
	public function getAdd() {
		return View::make('association.add');
	}

 	/**
		* @see http://association.vieassociative.fr/{$idAssoc}/edit 
		* @param int $idAssoc The ID of this association
		* @return View Users can view the admin association pannel from there
	*/
	public function getEdit($idAssoc) {
		return View::make('association.edit')
			->with('count_news',Post::countNews($idAssoc))
			->with('count_admin',Association::countAdmin($idAssoc))
			->with('association',Association::find($idAssoc))
			->with('proposition',Proposition::getPropositions($idAssoc));
	}

 	/**
		* @see http://association.vieassociative.fr/{$idAssoc}-{$slug} 
		* @param int $idAssoc The ID of this association
		* @return View The wall of the association
	*/
	public function getProfile($idAssoc) {
		return View::make('association.profile')
			->with('association',Association::find($idAssoc))
			->with('newsFeed',NewsFeed::get($idAssoc));
	}
	
 	/**
		* @see http://association.vieassociative.fr/{$idAssoc}/edit/general-informations
		* @param int $idAssoc The ID of this association
		* @param string $slug The slug corresponding of the name of the association
		* @return View Page where you can edit general information
	*/
	public function getEditGeneralInformations($idAssoc){
		return View::make('association.edit-general-informations')
			->with('association',Association::find($idAssoc));
	}
	
 	/**
 		* @todo Page non fonctionnelle : edition de paramètre propre à notre site
		* @see http://association.vieassociative.fr/{$idAssoc}/edit/general-informations
		* @param int $idAssoc The ID of this association
		* @return View Page where you can edit vieassociative information
	*/
	public function getEditVieAssociativeInformations($idAssoc){
		return View::make('association.edit-vieassociative-informations')
			->with('association',Association::find($idAssoc));
	}

	/**
		* @see http://association.vieassociative.fr/{$idAssoc}/edit/news
		* @param int $idAssoc The ID of this association
		* @return View Page that display all news from an association
	*/
	public function getListNews($idAssoc){
		return View::make('association.list-news')
			->with('news',Post::listNews($idAssoc))
			->with('association',Association::find($idAssoc));
	}

	/**
		* @see http://association.vieassociative.fr/{$idAssoc}/edit/news/{$idNews}
		* @param int $idAssoc The ID of this association
		* @param int $idPost ==> if $idPost = 0 then the user wants to create a new post
		* @return View Edit or create a news
	*/
	public function getEditNews($idAssoc, $idPost){
		return View::make('association.edit-news')
			->with('post',Post::get($idPost))
			->with('association',Association::find($idAssoc));
	}

	/**
		* @todo Page non fonctionnelle
	*/
	public function getEditSocial($idAssoc){
		return View::make('association.edit-social');
	}

	/**
		* @see http://association.vieassociative.fr/{$idAssoc}/edit/administrator
		* @param int $idAssoc The ID of this association
		* @return View Edit administrator for this association
	*/
	public function getEditAdministrator($idAssoc){
		return View::make('association.edit-administrator')
			->with('association',Association::find($idAssoc))
			->with('is_admin',User::isAdministrator($idAssoc))
			->with('admin',UserAssociation::where('id_assoc',$idAssoc)->with('author')->get());
	}
	
	/**
		* @todo Page non fonctionnelle
	*/
	public function getHistory($idAssoc){
		return View::make('association.history');
	}
	
	/**
		* API : Create a new association
		* @return JSON
	*/
	public function postAdd(){
		$v = new validators_associationAdd;
		$result = $v->add();
		if(isset($result['success'])){
			$id_assoc = Association::add($result['data']);
			// if the association has been created by one of his authorised user
			if($result['data']['choice']=="true"){
				User::addAssoc(Auth::user()->id,$id_assoc,$result['data']['link']);
				$result['redirect_url'] = '/'.$id_assoc.'/edit';
			}else{
				$result['redirect_url'] = '/'.$id_assoc.'-'.Str::slug($result['data']['name'],'-');;
			}
			$result['data']=null; //Remove data
		}
		return Response::json($result);
	}
	
	/**
		* API : Edit or create a news
		* @return JSON
	*/
	public function postEditNews($idAssoc, $idPost){
		$v = new validators_associationEditPost;
		$result = $v->validate();
		if(isset($result['success'])){
			Post::edit($idPost,$idAssoc,$result['data']);
			$result['redirect_url'] = '/'.$idAssoc.'/edit/';
			$result['data']=null; //Remove data
		}
		return Response::json($result);
	}




	
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