<?php

/**
 * Class AssociationAPIController
 * @category
 * @package
 * @author
 * @licence
 * @link
 */
class AssociationAPIController extends BaseController
{
    /**
     * @param $idAssoc integer
     * @return Json all news from an association
     */
    public function getNews($idAssoc)
    {
        Association::findOrFail($idAssoc);
        return Response::json(News::listNews(AssociationMenu::getFirstNewsFeed($idAssoc)));
    }
} 