<?php
class validators_editUser extends BaseValidator
{
    public function email(){

        Validator::extend('existing_mail', function($attribute, $value, $parameters)
        {
            return ! User::isTakenMail(Input::get('mail'));
        });

        $rules = array(
            'email' => 'required|existing_mail:no|email',
        );
        return $this->test($rules);
    }
}
