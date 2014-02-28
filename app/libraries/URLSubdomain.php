<?php

class URLSubdomain extends Symfony\Component\HttpFoundation\Request{
    /**
     * Generate a absolute URL to the given path.
     *
     * @param $domain
     * @param  string $path
     * @param array $get
     * @param  bool $secure
     * @internal param mixed $parameters
     * @return string
     */
	static function to($domain, $path, $get = array(), $secure = true)
	{
		 
		
		$pattern = '/([a-z]+)\.([a-z]+)/s';
		$root =  preg_replace($pattern, 'http://'.$domain.'.$2',Request::getHost());
		 
		// Since SSL is not often used while developing the application, we allow the
		// developer to disable SSL on all framework generated links to make it more
		// convenient to work with the site while developing locally.
		if ($secure and Config::get('application.ssl')){
			$root = preg_replace('~http://~', 'https://', $root, 1);
		}
		$tail = implode('/', (array) $get);
		$url= rtrim($root, '/').'/'.ltrim($path, '/').$tail; // replace result

		return $url;
	}

}