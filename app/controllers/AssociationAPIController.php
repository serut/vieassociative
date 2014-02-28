<?php

/**
 * Class AssociationAPIController
 *
 *
 */
class AssociationAPIController extends BaseController
{
    /**
     * @param $idAssoc
     * @return Json all news from an association
     */
    public function getNews($idAssoc)
    {
        $association = Association::findOrFail($idAssoc);
        return Response::json(News::listNews($idAssoc));
    }
} 