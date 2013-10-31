<?php

class SitemapController extends BaseController {

	public function getSitemap() {
		header("Content-type:application/xml");
        return View::make('sitemap.sitemap')
        	//->header('Content-Type', 'text/xml, application/xml')
            ->with('listAssocs',elo_Association::all()); 
    }
}