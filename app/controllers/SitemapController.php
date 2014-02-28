<?php

/**
 * Class SitemapController
 */
class SitemapController extends BaseController
{

    /**
     * @return \Illuminate\Http\Response
     */
    public function getSitemap()
    {
        $localURL = array(
            'http://www.vieassociative.fr/',
            'http://www.vieassociative.fr/user/log',
            'http://www.vieassociative.fr/legal',
            'http://www.vieassociative.fr/info/condition',
            'http://doc.vieassociative.fr/',
            'http://association.vieassociative.fr/add',
        );
        $view = View::make('sitemap.sitemap')
            ->with('localURL', $localURL)
            ->with('listAssocs', Association::all());
        return Response::make(
            $view
            , 200
            , array('Content-type' => 'text/xml; charset=utf-8')
        );
    }
}