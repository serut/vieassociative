<?php
/**
	* This is the controller for association news
	*
	* @author  Mieulet Léo <l.mieulet@gmail.com>
*/
 class AssociationNewsController  extends BaseController {
	/**
		* @see http://association.vieassociative.fr/{$idAssoc}/edit/news
		* @param int $idAssoc The ID of this association
		* @return View Page that display all news from an association
	*/
	public function getListNews($idAssoc){
		return View::make('association.list-news')
			->with('news',News::listNews($idAssoc))
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
			->with('post',News::get($idPost))
			->with('association',Association::find($idAssoc));
	}
	/**
		* API : Edit or create a news
		* @return JSON
	*/
	public function postEditNews($idAssoc, $idPost){
		$v = new validators_associationEditPost;
		$result = $v->validate();
		if(isset($result['success'])){
			News::edit($idPost,$idAssoc,$result['data']);
			$result['redirect_url'] = '/'.$idAssoc.'/edit';
			$result['data']=null; //Remove data
		}
		return Response::json($result);
	}

}