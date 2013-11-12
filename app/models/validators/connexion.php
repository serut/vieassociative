<?php
class validators_connexion extends BaseValidator
{
	public function login($nbrConnexTentative){
        // Add specific rule for the validation of data
        $rules = array(
            'password' => 'required|min:6|max:30',
            'username' => 'required|min:4|connexion'
        );

        Validator::extend('connexion', function($attribute, $value, $parameters)
        {
            $credentialsWithUsername = array('username' => Input::get('username'),
                                        'password' => Input::get('password'));
            $credentialsWithMail = array('email' => Input::get('username'), 
                                    'password' => Input::get('password'));
            return Auth::attempt($credentialsWithUsername) || Auth::attempt($credentialsWithMail);
        });

        return $this->test($rules);
	}


	public function register(){
        Validator::extend('existing_nick', function($attribute, $value, $parameters)
        {
            return ! User::isTakenUsername(Input::get('pseudo'));
        });
        Validator::extend('existing_mail', function($attribute, $value, $parameters)
        {
            return ! User::isTakenMail(Input::get('mail'));
        });

        $rules = array(
            'pseudo' => 'required|existing_nick:no|min:4|max:15',
            'mail' => 'required|existing_mail:no|email',
            'password' => 'required|min:6|max:30',
        );

        return $this->test($rules);
        /*
    
            $fail = $v->failed();
            if(isset($fail['pseudo'])){
                $message['error'] .= Lang::get('membre/form_connexion.user_already_exist');
            }
            if(isset($fail['mail'])){
                $message['error'] .= Lang::get('membre/form_connexion.mail_already_exist');
            }

        */
	}
}
