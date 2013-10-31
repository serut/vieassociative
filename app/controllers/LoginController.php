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