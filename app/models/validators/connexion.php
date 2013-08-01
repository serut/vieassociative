<?php
class validators_connexion extends BaseValidator
{
	public function login($nbrConnexTentative){
        $inputsRequired = array('username','password');

        // Looks if every inputs required are present
        try{
            $arrayElements = $this->need($inputsRequired);
            extract($arrayElements);
        }catch (Exception $e) {
            return $this->getMessageMissingInput();
        }

        // Add specific rule for the validation of data
        $rules = array(
            'username' => 'required|min:4',
            'password' => 'required|min:6|max:30'
        );

        //Try to validate with rules if everything is correct
        $v = Validator::make(Input::get(), $rules);
        if(! $v->fails()){
            $credentialsWithUsername = array('username' => $username,
                                            'password' => $password);
            $credentialsWithMail = array('email' => $username, 
                                        'password' => $password);
            if (Auth::attempt($credentialsWithUsername) || Auth::attempt($credentialsWithMail)){
                $message = array('success'=>'true');
            }else{
                $message = array('error'=>Lang::get('membre/form_connexion.login_not_correct'));
            }
        }else{
            $message = array('error'=>Lang::get('core/form.form_uncomplete'));
        }
        return $message;
	}


	public function register(){
        $inputsRequired = array('pseudo','mail','password');
        // Looks if every inputs required are present
        try{
            $arrayElements = $this->need($inputsRequired);
            extract($arrayElements);
        }catch (Exception $e) {
            return $this->getMessageMissingInput();
        }
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

             //user_already_exist
        $v = Validator::make(Input::get(), $rules);
        if(! $v->fails()){
            $message = array('success'=>'true');
        }else{
            $message = array('error'=>'');
            $fail = $v->failed();
            if(isset($fail['pseudo'])){
                $message['error'] .= Lang::get('membre/form_connexion.user_already_exist');
            }
            if(isset($fail['mail'])){
                $message['error'] .= Lang::get('membre/form_connexion.mail_already_exist');
            }

        }
        return $message;
	}
}
