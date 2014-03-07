<?php

/**
 * |--------------------------------------------------------------------------
 * | Application Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register all of the routes for an application.
 * | It's a breeze. Simply tell Laravel the URIs it should respond to
 * | and give it the Closure to execute when that URI is requested.
 * |
 */
$server = explode('.', Request::server('HTTP_HOST')); // routing according to subdomain

Route::pattern('id_assoc', '[0-9]+');
switch ($server['0']) {
    case 'www': // For www.vieassociative.fr/*

        Route::get('/', 'InfoController@getIndex');
        Route::get('/info/condition', 'InfoController@getCondition');
        Route::get('/notifications', 'NotificationController@getIndex');
        Route::post('/proposition', 'ContactController@postProposition');
        //www.vieassociative.fr/user/*
        Route::group(array('prefix' => 'user'), function () {
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
            Route::group(array('before' => 'auth'), function () {
                Route::get('logout', 'LoginController@getLogout');
                Route::get('{id_assoc}/edit', 'UserController@getEdit');
                Route::get('{id_assoc}/form/{item}', 'UserController@getForm')->where('item', '[a-z-_]+');

                Route::post('{id_assoc}/form/{item}', 'UserController@postForm')->where('item', '[a-z-_]+');
            });
        });

        Route::group(array('prefix' => 'api'), function () {
            Route::group(array('prefix' => '0.1'), function () {
                Route::group(array('prefix' => 'association'), function () {
                    Route::get('{id_assoc}/news', 'AssociationAPIController@getNews');
                });
            });
        });
        Route::get('sitemap.xml', 'SitemapController@getSitemap');
        break;
    case 'association': // For association.vieassociative.fr/*
        Route::get('/', 'AssociationController@getSearchIngine');
        Route::get('{id_assoc}-{text}', 'AssociationController@getIndexAssociation')->where('text', '[a-z-0-9]+');
        Route::group(array('before' => 'auth'), function () { // Loggin required
            Route::get('add', 'AssociationController@getAdd');
            Route::get('{id_assoc}/edit', 'AssociationController@getEdit');
            Route::get('{id_assoc}/edit/general-informations', 'AssociationController@getEditGeneralInformations');
            Route::get('{id_assoc}/edit/vieassociative-informations', 'AssociationController@getEditVieAssociativeInformations');
            Route::get('{id_assoc}/edit/evenement', 'EvenementController@getEvenementAssociation');
            Route::get('{id_assoc}/edit/evenement/{idEv}/edit', 'EvenementController@getEdit')->where('idEv', '[0-9]+');
            Route::get('{id_assoc}/edit/file/{idGallery}{typeCrop}{action}', 'AssociationController@getUpload')->where('idGallery', '[0-9]+')->where('typeCrop', '[\/a-z0-9]*')->where('action', '[-a-z0-9]*');
            Route::get('{id_assoc}/edit/file/crop/{typeCrop}{action}/{namePic}', 'AssociationController@getCrop')->where('typeCrop', '[a-z0-9]+')->where('action', '[-a-z0-9]*')->where('namePic', '[a-zA-Z0-9_\.]+');
            Route::get('{id_assoc}/edit/newsfeed/{idNewsFeed}', 'AssociationNewsController@getListNews')->where('idNewsFeed', '[0-9]+');
            Route::get('{id_assoc}/edit/newsfeed/{idNewsFeed}/add', 'AssociationNewsController@getAddNews');
            Route::get('{id_assoc}/edit/newsfeed/{idNewsFeed}/news/{idNews}/edit', 'AssociationNewsController@getEditNews')->where('idNewsFeed', '[0-9]+')->where('idNews', '[0-9]+');
            Route::get('{id_assoc}/edit/social', 'AssociationController@getEditSocial');
            Route::get('{id_assoc}/edit/administrator', 'AssociationController@getEditAdministrator');
            Route::get('{id_assoc}/discussion/{idDiscu}', 'DiscussionController@getConversation')->where('idDiscu', '[0-9]+');
            Route::get('{id_assoc}/form/{origin}/{item}', 'AssociationFormController@getForm')->where('origin', '[a-z-]+')->where('item', '[a-z-_]+');


            Route::options('/upload', 'FileUploadController@fileUpload');
            Route::post('/upload', 'FileUploadController@postFileUpload');
            Route::post('{id_assoc}/form/{origin}/{item}', 'AssociationFormController@postForm')->where('origin', '[a-z-]+')->where('item', '[a-z-_]+');
            Route::post('discussion/add', 'DiscussionController@postAdd');
            Route::post('discussion/vote', 'DiscussionController@postVote');
            Route::post('discussion/validate', 'DiscussionController@postValidate');
            Route::post('add', 'AssociationController@postAdd');
            Route::post('{id_assoc}/edit/file/crop/{typeCrop}{action}/{namePic}', 'FileUploadController@postCrop')->where('typeCrop', '[a-z0-9]+')->where('action', '[-a-z0-9]*')->where('namePic', '[a-zA-Z0-9_\.]+');
        });
        break;
    case 'alive':
        Route::get('/alive', function () {
            try {
                $abusePingdom = fopen('http://www.vieassociative.fr', 'r');
                fclose($abusePingdom);
                $abusePingdom = fopen('http://faitesdelamusique.vieassociative.fr', 'r');
                fclose($abusePingdom);
                $abusePingdom = fopen('http://association.vieassociative.fr', 'r');
                fclose($abusePingdom);
                $abusePingdom = fopen('http://doc.vieassociative.fr', 'r');
                fclose($abusePingdom);
            } catch (Exception $e) {
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