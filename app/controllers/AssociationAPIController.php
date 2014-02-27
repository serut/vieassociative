<?php

class AssociationAPIController extends BaseController
{
    /**
     * @return Json all news from an association
     */
    public function getNews($idAssoc)
    {
        $association = Association::findOrFail($idAssoc);
        return Response::json(News::listNews($idAssoc));
    }
} 