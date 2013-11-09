<?php

class LoginController extends BaseController
{
    public function getConnexion()
    {
        $connexTentative= TentativeConnexion::get(IP);
        return View::make('connexion.connexion')->with('connexTentative',$connexTentative);
    }
    
    public function postLogin(){
        $nbrConnexTentative= TentativeConnexion::get(IP);
        if($nbrConnexTentative < 10){
            $v = new validators_connexion;
            $result = $v->login($nbrConnexTentative);
            if(isset($result['success'])){
                User::connexion(Auth::user()->id);
                $result['redirect_url'] = URL::to('/');
            }else{
                TentativeConnexion::add(IP);
                $result['error'] = Lang::get('membre/form_connexion.login_not_correct');
            }
        }
        else
            $result = array('error'=>Lang::get('membre.form_connexion.too_meny_try'));
        return Response::json($result);
    }

    public function postRegister(){
        $v = new validators_connexion;
        $result = $v->register();
        if(isset($result['success'])){
            $user = new User;
            $user->email = Input::get('mail');
            $user->username = Input::get('pseudo');
            $user->password = Hash::make(Input::get('password'));
            $user->save();
            Auth::loginUsingId($user->id);
            User::connexion($user->id);
            $result['redirect_url'] = URL::to('/');
            EmailController::register($user->username,$user->email);
        }else{
            $result['error']=Lang::get('core/form.form_uncomplete');
        }
        return Response::json($result);

    }
    public function disconnect(){
        Session::put('associationEnManagement',null);
        Session::put('associationEnManagementNom',null);
        Session::put('myassocs',array());
        Session::put('idUser',null);
        Session::put('level',null);
        Session::put('name',null);
        if(App::environment() == 'local')
            $domain = "vieassoc.lo";
        else
            $domain = "vieassociative.fr";
        setcookie('vieasso_remember', $_COOKIE['vieasso_remember'], time()-10, '/',$domain);
    }
    
    
    public function getPerteMotDePasse(){
        return View::make('connexion.perte-mot-de-passe');
    }
    public function getLogout(){
    	Auth::logout();
        $this->disconnect();
        return Redirect::to('/user/log');
    }
    public function getFacebook() {
        // get data from input
        $code = Input::get('code');
        // get fb service
        $fb = OAuth::consumer('Facebook');
        // if code is provided get user data and sign in
        if (!empty($code)){
            // This was a callback request from google, get the token
            $token = $fb->requestAccessToken($code);
            // Send a request with it
            $result = json_decode( $fb->request( '/me' ), true );
            $message = 'Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
            echo $message. "<br/>";
            //Var_dump
            //display whole array().
            dd($result);
        }else {
            // we ask permission
            $url = $fb->getAuthorizationUri();
            return Response::make()->header( 'Location', (string)$url );
        }
    }

    public function getGoogle(){
        $code = Input::get('code');
        $googleService = OAuth::consumer('Google');
        if (!empty($code)){
            $token = $googleService->requestAccessToken($code);
            $result = json_decode($googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo'), true );
            $message = 'Your unique Google user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
            echo $message. "<br/>";
            dd($result);
        }else {
            $url = $googleService->getAuthorizationUri();
            return Response::make()->header( 'Location', (string)$url );
        }
    }

    public function getLive(){
        $code = Input::get('code');
        $microsoft = OAuth::consumer('Microsoft');
        if (!empty($code)){
            $token = $microsoft->requestAccessToken($code);
            $result = json_decode($microsoft->request('https://apis.live.net/v5.0/me?'), true );
            $message = 'Your unique Microsoft user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
            echo $message. "<br/>";
            dd($result);
        }else {
            $url = $microsoft->getAuthorizationUri();
            return Response::make()->header( 'Location', (string)$url );
        }
    }
    /*
        Facebook data : 
        Your unique facebook user id is: 1320685747 and your name is AndrÃ©a Buisset
        array(15) { ["id"]=> string(10) "1320685747" ["name"]=> string(15) "AndrÃ©a Buisset" ["first_name"]=> string(7) "AndrÃ©a" ["last_name"]=> string(7) "Buisset" ["link"]=> string(37) "https://www.facebook.com/AmbreAkasora" ["username"]=> string(12) "AmbreAkasora" ["quotes"]=> string(84) ""L'amour et la haine sont le recto et le verso d'un mÃªme sentiment" Mr Labourdette." ["education"]=> array(1) { [0]=> array(3) { ["school"]=> array(2) { ["id"]=> string(12) "197576131108" ["name"]=> string(34) "Grand Sud Formation TOURISM SCHOOL" } ["concentration"]=> array(1) { [0]=> array(2) { ["id"]=> string(15) "528018097281649" ["name"]=> string(30) "Animatrice Tourisme et Loisirs" } } ["type"]=> string(7) "College" } } ["gender"]=> string(6) "female" ["email"]=> string(25) "andrea.buisset@hotmail.fr" ["timezone"]=> int(1) ["locale"]=> string(5) "fr_FR" ["languages"]=> array(2) { [0]=> array(2) { ["id"]=> string(15) "103803232991647" ["name"]=> string(7) "English" } [1]=> array(2) { ["id"]=> string(15) "108224912538348" ["name"]=> string(6) "French" } } ["verified"]=> bool(true) ["updated_time"]=> string(24) "2013-10-18T06:07:44+0000" } 
    */
    /* ZEND
    public function getFacebook(){
        // include hybridauth lib
         $root =  dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))).DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'hybridauth';
         $config = $root.DIRECTORY_SEPARATOR.'config.php';
         include_once $root.DIRECTORY_SEPARATOR."Hybrid".DIRECTORY_SEPARATOR."Auth.php";
        try {
            $hybridauth = new \Hybrid_Auth($config);
            $adapter = $hybridauth->authenticate("facebook");
            $user_profile = $adapter->getUserProfile();
        } catch (Exception $e) {
            die("<b>got an error!</b> " . $e->getMessage());
        }
    }
    public function getGoogle(){
        // include hybridauth lib
         $root =  dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))).DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'hybridauth';
         $config = $root.DIRECTORY_SEPARATOR.'config.php';
         include_once $root.DIRECTORY_SEPARATOR."Hybrid".DIRECTORY_SEPARATOR."Auth.php";
        try {
            $hybridauth = new \Hybrid_Auth($config);
            $adapter = $hybridauth->authenticate("google");
            $user_profile = $adapter->getUserProfile();
        } catch (Exception $e) {
            die("<b>got an error!</b> " . $e->getMessage());
        }
    }
    public function getHotmail(){
        // include hybridauth lib
         $root =  dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))).DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'hybridauth';
         $config = $root.DIRECTORY_SEPARATOR.'config.php';
         include_once $root.DIRECTORY_SEPARATOR."Hybrid".DIRECTORY_SEPARATOR."Auth.php";
        try {
            $hybridauth = new \Hybrid_Auth($config);
            $adapter = $hybridauth->authenticate("Live");
            $user_profile = $adapter->getUserProfile();
        } catch (Exception $e) {
            die("<b>got an error!</b> " . $e->getMessage());
        }
    }

    public function getOrange(){
        // include hybridauth lib
         $root =  dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))).DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'hybridauth';
         $config = $root.DIRECTORY_SEPARATOR.'config.php';
         include_once $root.DIRECTORY_SEPARATOR."Hybrid".DIRECTORY_SEPARATOR."Auth.php";
        try {
            $hybridauth = new \Hybrid_Auth($config);
            $adapter = $hybridauth->authenticate( "OpenID", array( "openid_identifier" => "http://openid.orange.fr" ) ); 
            $user_data = $adapter->getUserProfile();
        } catch (Exception $e) {
            die("<b>got an error!</b> " . $e->getMessage());
        }
    }
    */
    
}