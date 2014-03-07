<?php

/**
 * This is the controller for association news
 *
 * @author  Mieulet Léo <l.mieulet@gmail.com>
 */
class AssociationNewsController extends BaseController
{
    /**
     * @see http://association.vieassociative.fr/{$idAssoc}/edit/news
     * @param int $idAssoc The ID of this association
     * @return View Page that display all news from an association
     */
    public function getListNews($idAssoc, $idWallNews)
    {
        return View::make('association.list-news')
            ->with('id_wall_news', $idWallNews)
            ->with('association', Association::findOrFail($idAssoc))
            ->with('news', News::listNews($idWallNews));
    }

    /**
     * @see http://association.vieassociative.fr/{$idAssoc}/edit/news/{$idNews}
     * @param int $idAssoc The ID of this association
     * @param int $idNews ==> if $idNews = 0 then the user wants to create a new post
     * @return View Edit or create a news
     */
    public function getEditNews($idAssoc, $idWallNews, $idNews)
    {
        return View::make('association.edit-news')
            ->with('association', Association::findOrFail($idAssoc))
            ->with('id_wall_news', $idWallNews)
            ->with('id_news', $idNews)
            ->with('news', News::get($idNews));
    }

    /**
     * API : Create a news
     * @param $idAssoc
     * @return JSON
     */
    static function addNews($idAssoc)
    {
        $v = new validators_associationEditPost;
        $result = $v->create();
        if (isset($result['success'])) {
            $result['id_news'] = News::add($idAssoc, $result['data']['id_wall_news']);
        }
        return $result;
    }


    /**
     * API : Edit or create a news
     * @param $idAssoc
     * @param $partial
     * @param $item
     * @return JSON
     */
    static function editPartialNews($idAssoc, $partial, $item)
    {
        $v = new validators_associationEditPost;
        $result = $v->$item();
        if (isset($result['success'])) {
            $result = Partial::edit($result['data'], $result);
            $association = Association::find($idAssoc);
            $result['redirect_url'] = '/' . $idAssoc . '-' . $association->slug;
        }
        return $result;
    }
}