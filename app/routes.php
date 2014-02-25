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
$server = explode('.', Request::server('HTTP_HOST')); // routing according to subdomain
switch ($server['0']) {
    case 'www': // For www.vieassociative.fr/*

        Route::get('/', 'InfoController@getIndex');
        Route::get('/info/condition', 'InfoController@getCondition');
        Route::get('/notifications', 'NotificationController@getIndex');
        Route::post('/proposition', 'ContactController@postProposition');
        //www.vieassociative.fr/user/*
        Route::group(array('prefix' => 'user'), function()
        {
            Route::get('log', 'LoginController@getConnexion');
            Route::get('reset-password', 'LoginController@getResetPassword');
            Route::get('reset/{pass}', 'LoginController@getResetPasswordAfter')->where('pass', '[a-zA-Z0-9]+');
            /*
            TODO : Connexion depuis un réseau social
            Route::get('log/fb', 'LoginController@getFacebook');
            Route::get('log/google', 'LoginController@getGoogle');
            Route::get('log/live', 'LoginController@getLive');*/
            Route::post('reset-password', 'LoginController@postResetPassword');
            Route::post('log/register', 'LoginController@postRegister');
            Route::post('log/login', 'LoginController@postLogin');
            Route::group(array('before' => 'auth'), function(){
                Route::get('logout', 'LoginController@getLogout');
                Route::get('{id}/edit', 'UserController@getEdit')->where('id', '[0-9]+');
                Route::get('{id}/form/{item}', 'UserController@getForm')->where('id', '[0-9]+')->where('item', '[a-z-_]+');
                
                Route::post('{id}/form/{item}', 'UserController@postForm')->where('id', '[0-9]+')->where('item', '[a-z-_]+');
            });
        });

        Route::group(array('prefix' => 'api'), function()
        {
            Route::group(array('prefix' => '0.1'), function()
            {
                Route::get('{id}/news', 'AssociationAPIController@getNews')->where('id', '[0-9]+');
            });
        });
        Route::get('sitemap.xml', 'SitemapController@getSitemap');
        break;
    case 'association': // For association.vieassociative.fr/*
        Route::get('/', 'AssociationController@getIndex');
        Route::get('{id}-{text}', 'AssociationController@getProfile')->where('id', '[0-9]+')->where('text', '[a-z-0-9]+');
        Route::group(array('before'=>'auth'), function(){ // Loggin required
            Route::get('add', 'AssociationController@getAdd');
            Route::get('{id}/edit', 'AssociationController@getEdit')->where('id', '[0-9]+');
            Route::get('{id}/edit/general-informations', 'AssociationController@getEditGeneralInformations')->where('id', '[0-9]+');
            Route::get('{id}/edit/vieassociative-informations', 'AssociationController@getEditVieAssociativeInformations')->where('id', '[0-9]+');
            Route::get('{id}/edit/evenement', 'EvenementController@getEvenementAssociation')->where('id', '[0-9]+');
            Route::get('{id}/edit/evenement/{idEv}/edit', 'EvenementController@getEdit')->where('id', '[0-9]+')->where('idEv', '[0-9]+');
            Route::get('{id}/edit/file/{idGallery}{typeCrop}{action}', 'AssociationController@getUpload')->where('id', '[0-9]+')->where('idGallery', '[0-9]+')->where('typeCrop', '[\/a-z0-9]*')->where('action', '[-a-z0-9]*');
            Route::get('{id}/edit/file/crop/{typeCrop}{action}/{namePic}', 'AssociationController@getCrop')->where('id', '[0-9]+')->where('typeCrop', '[a-z0-9]+')->where('action', '[-a-z0-9]*')->where('namePic', '[a-zA-Z0-9_\.]+');
            Route::get('{id}/edit/news', 'AssociationNewsController@getListNews')->where('id', '[0-9]+');
            Route::get('{id}/edit/news/add', 'AssociationNewsController@getAddNews')->where('id', '[0-9]+');
            Route::get('{id}/edit/news/{idNews}/edit', 'AssociationNewsController@getEditNews')->where('id', '[0-9]+')->where('idNews', '[0-9]+');
            Route::get('{id}/edit/social', 'AssociationController@getEditSocial')->where('id', '[0-9]+');
            Route::get('{id}/edit/administrator', 'AssociationController@getEditAdministrator')->where('id', '[0-9]+');
            Route::get('{id}/discussion/{idDiscu}', 'DiscussionController@getConversation')->where('id', '[0-9]+')->where('idDiscu', '[0-9]+');
            Route::get('{id}/form/{origin}/{item}', 'AssociationFormController@getForm')->where('id', '[0-9]+')->where('origin', '[a-z-]+')->where('item', '[a-z-_]+');
            


            Route::options('/upload', 'FileUploadController@fileUpload');
            Route::post('/upload', 'FileUploadController@postFileUpload');
            Route::post('{id}/form/{origin}/{item}', 'AssociationFormController@postForm')->where('id', '[0-9]+')->where('origin', '[a-z-]+')->where('item', '[a-z-_]+');
            Route::post('discussion/add', 'DiscussionController@postAdd');
            Route::post('discussion/vote', 'DiscussionController@postVote');
            Route::post('discussion/validate', 'DiscussionController@postValidate');
            Route::post('add', 'AssociationController@postAdd');
            Route::post('{id}/edit/file/crop/{typeCrop}{action}/{namePic}', 'FileUploadController@postCrop')->where('id', '[0-9]+')->where('typeCrop', '[a-z0-9]+')->where('action', '[-a-z0-9]*')->where('namePic', '[a-zA-Z0-9_\.]+');
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