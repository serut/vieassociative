<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application;

/*
|--------------------------------------------------------------------------
| Detect The Application Environment
|--------------------------------------------------------------------------
|
| Laravel takes a dead simple approach to your application environments
| so you can just specify a machine name for the host that matches a
| given environment, then we will automatically detect it for you.
|
*/


$env = $app->detectEnvironment(array(
	'local' => array('*.vieassoc.lo'),
	'prod' => array('*.vieassociative.fr'),
));

/*
|--------------------------------------------------------------------------
| Bind Paths
|--------------------------------------------------------------------------
|
| Here we are binding the paths configured in paths.php to the app. You
| should not be changing these here. If you need to change these you
| may do so within the paths.php file and they will be bound here.
|
*/

$app->bindInstallPaths(require __DIR__.'/paths.php');

/*
|--------------------------------------------------------------------------
| Load The Application
|--------------------------------------------------------------------------
|
| Here we will load this Illuminate application. We will keep this in a
| separate location so we can isolate the creation of an application
| from the actual running of the application with a given request.
|
*/

// Constants
if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARTDED_FOR'] != '') {
    @define('IP', $_SERVER["HTTP_X_FORWARDED_FOR"]);
} else {
    @define('IP', $_SERVER["REMOTE_ADDR"]);
}
$framework = $app['path.base'].'/vendor/laravel/framework/src';

require $framework.'/Illuminate/Foundation/start.php';

include($app['path.base'].'/app/libraries/views/blade.php'); 
include($app['path.base'].'/app/libraries/SiteError.php'); 
include($app['path.base'].'/app/libraries/SiteHelpers.php'); 
include($app['path.base'].'/app/libraries/URLSubdomain.php'); 
include($app['path.base'].'/app/libraries/HTMLPurifier.php'); 
include($app['path.base'].'/app/libraries/Pubnub.php'); 


/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;