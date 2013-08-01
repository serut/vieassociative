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

App::before(function($request)
{

    $firstTime = Session::get('firstTime');
    if(empty($firstTime) && Auth::guest()){
        Session::put('firstTime',"Testé");
        if(isset($_COOKIE['vieasso_remember']) && !empty($_COOKIE['vieasso_remember'])){
            $id = User::reconnecterDepuisToken($_COOKIE['vieasso_remember']);
            if($id > 0){
                Auth::loginUsingId($id);
                User::connexion(Auth::user()->id);
            }
        }
    }
});


App::after(function($request, $response)
{
	//
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

Route::filter('auth', function()
{
	if (Auth::guest()){
        return Redirect::to(URLSubdomain::to('www','/user/log'));
    }
});
Route::filter('guest', function()
{
    if (Auth::check())
        return Redirect::to('/');
});

Route::filter('assoc', function()
{
    $listeAssoc = array();
    $myassocs = Session::get('myassocs');
    $idAssoc = Request::segment(2);

    //Get user's association from his session
        
    if(Session::get('level') == "user"){
        if(Session::has('myassocs') && ! empty($myassocs))
            foreach ($myassocs as $k => $v) {
                $listeAssoc[] = $v->id;
            }
        // Look if the user is not using a wrong association
        if (!in_array(Session::get('associationEnManagement'),$listeAssoc)){
            // Il se balade sur notre site sans en avoir le droit
            return '02 Action non autorisée : l\'association que vous avez tenté de modifier ne vous appartient pas'.Session::get('associationEnManagement');
        }
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

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});