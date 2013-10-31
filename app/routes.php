<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//if it's in prod, the server will use subdomains to navigate on the website, otherwise it will use prefix
//if(App::environment() == 'production'){
    $server = explode('.', Request::server('HTTP_HOST')); // sweet routing - not fully reliable
    switch ($server['0']) {
        case 'www':
            Route::get('/', function()
            {
                return View::make('index.index');
            });
            Route::get('/maintenance', function()
            {
                return View::make('index.maintenance');
            });
            //user.vieassociative.fr/*
            Route::group(array('prefix' => 'user'), function()
            {
                Route::get('log', 'LoginController@getConnexion');
                Route::post('log/register', 'LoginController@postRegister');
                Route::post('log/login', 'LoginController@postLogin');

                Route::group(array('before' => 'auth'), function(){
                    Route::get('logout', 'LoginController@getLogout');
                    Route::get('{id}/edit', 'UserController@getEdit')->where('id', '[0-9]+');
                    Route::get('{id}-{text}', 'UserController@getProfil')->where('id', '[0-9]+')->where('text', '[a-z-]+');
                });
            });
            Route::get('sitemap.xml', 'SitemapController@getSitemap');
            break;
        case 'association':
        //association.vieassociative.fr/*
            Route::get('/', function()
            {
                return View::make('index.association');
            });
            Route::get('{id}-{text}', 'AssociationController@getProfile')->where('id', '[0-9]+')->where('text', '[a-z-]+');
            Route::group(array('before'=>'auth'), function()
            {
                Route::post('discussion/add', 'DiscussionController@postAdd');
                Route::post('discussion/vote', 'DiscussionController@postVote');
                Route::post('discussion/validate', 'DiscussionController@postValidate');
                Route::get('{id}/edit', 'AssociationController@getEdit')->where('id', '[0-9]+');
                Route::get('{id}/edit/general-informations', 'AssociationController@getEditGeneralInformations')->where('id', '[0-9]+');
                Route::get('{id}/edit/vieassociative-informations', 'AssociationController@getEditVieAssociativeInformations')->where('id', '[0-9]+');
                Route::get('{id}/edit/evenement', 'EvenementController@getEvenementAssociation')->where('id', '[0-9]+');
                Route::get('{id}/edit/evenement/{idEv}/edit', 'EvenementController@getEdit')->where('id', '[0-9]+')->where('idEv', '[0-9]+');
                Route::get('{id}/edit/picture', 'PictureController@getAssociationPictures')->where('id', '[0-9]+');
                
                Route::get('{id}/edit/news', 'AssociationController@getListNews')->where('id', '[0-9]+');
                Route::get('{id}/edit/news/add', 'AssociationController@getAddNews')->where('id', '[0-9]+');
                Route::get('{id}/edit/news/{idNews}/edit', 'AssociationController@getEditNews')->where('id', '[0-9]+')->where('idNews', '[0-9]+');
                Route::post('{id}/edit/news/{idNews}/edit', 'AssociationController@postEditNews')->where('id', '[0-9]+')->where('idNews', '[0-9]+');
                
                Route::get('{id}/edit/social', 'AssociationController@getEditSocial')->where('id', '[0-9]+');
                Route::get('{id}/edit/administrator', 'AssociationController@getEditAdministrator')->where('id', '[0-9]+');
                Route::get('{id}/discussion/{idDiscu}', 'DiscussionController@getConversation')->where('id', '[0-9]+')->where('idDiscu', '[0-9]+');
                Route::get('{id}/form/{origin}/{item}', function($id,$origin,$item)
                {
                    $associationForm = new AssociationFormController;
                    return $associationForm->getForm($id,$origin,$item);
                })->where('id', '[0-9]+')->where('origin', '[a-z-]+')->where('item', '[a-z-_]+');
                Route::post('{id}/form/{origin}/{item}', function($id,$origin,$item)
                {
                    $associationForm = new AssociationFormController;
                    return $associationForm->postForm($id,$origin,$item);
                })->where('id', '[0-9]+')->where('origin', '[a-z-]+')->where('item', '[a-z-_]+');
                Route::get('add', 'AssociationController@getAdd');
                Route::post('add', 'AssociationController@postAdd');
                Route::controller('{id}/evenement', 'EvenementController');
                Route::group(array('before' => 'assoc'), function(){
                    // Protected URL
                });
            });
            break;
        case 'alive':
            Route::get('/alive',function(){
                try{
                    $abusePingdom = fopen('http://www.vieassociative.fr', 'r');
                    fclose($abusePingdom);
                    $abusePingdom = fopen('http://faitesdelamusique.vieassociative.fr', 'r');
                    fclose($abusePingdom);
                    $abusePingdom = fopen('http://association.vieassociative.fr', 'r');
                    fclose($abusePingdom);
                    $abusePingdom = fopen('http://news.vieassociative.fr', 'r');
                    fclose($abusePingdom);
                    $abusePingdom = fopen('http://doc.vieassociative.fr', 'r');
                    fclose($abusePingdom);
                }
                catch(Exception $e)
                {
                    echo $e->getMessage();
                }
                TentativeConnexion::deleteOldEntries();
                return 'Thanks !';
            });
            break;
    }

/*
Route::controller('contact', 'ContactController');
Route::controller('image', 'ImgsController');
Route::get('voir-evenement/{:ville}/{:categorie}/{:titre}-{:id}', 'EvenementController@voir');
Route::controller('search/{:action}/{:id}', 'EvenementController');
*/
App::missing(function($exception)
{
    switch ($exception->getStatusCode()) {
        case '404':
            return Response::view('errors.404', array(), 404);;
        case '403':
            return Response::view('errors.403', array(), 403);;
        case '500':
            //Log::error('http error 500 on page ' . Request::url());
            return Response::view('errors.500', array(), 500);;
        default:
            //Log::error('http error '.$exception->getStatusCode().' on page ' . Request::url());
            return Response::view('errors.500', array(), 500);;
    }
});