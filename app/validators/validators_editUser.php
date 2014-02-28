<?php

/** @noinspection PhpMissingDocCommentInspection */

/**
 * Class validators_editUser
 */
class validators_editUser extends BaseValidator
{
    /** @noinspection PhpMissingDocCommentInspection */
    /**
     * @return array
     */
    public function email()
    {

        Validator::extend('existing_mail', function ($attribute, $value, $parameters) {
            return !User::isTakenMail(Input::get('mail'));
        });

        $rules = array(
            'email' => 'required|existing_mail:no|email',
        );
        return $this->test($rules);
    }
}
