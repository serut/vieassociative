<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function ($request) {

    if (isset($_COOKIE['vieasso_remember']) && !empty($_COOKIE['vieasso_remember']) && Auth::guest()) {
        $id = User::reconnecterDepuisToken($_COOKIE['vieasso_remember']);
        if ($id > 0) {
            Auth::loginUsingId($id);
            User::connect(Auth::user()->id);
        } else {
            setcookie('vieasso_remember', $_COOKIE['vieasso_remember'], time() - 10);
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        $statusCode = 204;
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, POST, OPTIONS',
            'Access-Control-Allow-Headers' => 'Origin, Content-Type, Accept, Authorization, X-Requested-With',
            'Access-Control-Allow-Credentials' => 'true'
        ];

        return Response::make(null, $statusCode, $headers);
    }
});


App::after(function ($request, $response) {
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
    $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Requested-With');
    $response->headers->set('Access-Control-Allow-Credentials', 'true');
    return $response;
});

Route::when('user/log', 'guest');
/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function () {
    if (Auth::guest()) {
        Session::put('url.intended', Request::url());
        return Redirect::to(URLSubdomain::to('www', '/user/log'));
    }
});
Route::filter('guest', function () {
    if (Auth::check()) {
        Session::put('url.intended', Request::url());
        return Redirect::to('/');
    }
});

Route::filter('assoc', function ($idAssoc) {
    if (Auth::guest() || User::isAdministrator($idAssoc)) {
        return App::abort(404, 'Unauthorized action.');
    }
});
/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/


/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function () {
    if (Session::token() != Input::get('_token')) {
        throw new Illuminate\Session\TokenMismatchException;
    }
});


/*
|--------------------------------------------------------------------------
| Language
|--------------------------------------------------------------------------
|
| Detect the browser language.
|


Route::filter('detectLang',  function($route, $request, $lang = 'auto')
{

    if($lang != "auto" && in_array($lang , Config::get('app.available_language')))
    {
        Config::set('app.locale', $lang);
    }else{
        $browser_lang = !empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? strtok(strip_tags($_SERVER['HTTP_ACCEPT_LANGUAGE']), ',') : '';
        $browser_lang = substr($browser_lang, 0,2);
        $userLang = (in_array($browser_lang, Config::get('app.available_language'))) ? $browser_lang : Config::get('app.locale');
        Config::set('app.locale', $userLang);
        App::setLocale($userLang);
    }
});
*/