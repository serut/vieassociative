<?php

class validators_contact
{
    static function validate($input)
    {
        $rules = array(
            'nom' => 'required|alpha_num',
            'email' => 'required|email',
            'text' => 'required|min:10',
        );
        $v = Validator::make($input, $rules);
        return !$v->fails();
    }
}