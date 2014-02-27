<?php

/**
 * These are quick methods for send mail
 *
 * @author  Mieulet Léo <l.mieulet@gmail.com>
 */
class EmailController extends BaseController
{
    /**
     *    Send a mail when an user register
     */
    static function register($name, $email)
    {
        // data for send the mail to the user
        $data = array('name' => $name, 'email' => $email);
        Mail::send('mail.register', $data, function ($message) use ($data) {
            $message->subject('Bienvenue sur VieAssociative!');
            $message->from('noreply@vieassociative.fr', 'Vie Associative');
            $message->to($data['email']);
        });
    }

    /**
     *    Send a mail when an user resets his password
     */
    static function resetPassword($email, $pass)
    {
        // data for send the mail to the user
        $data = array('email' => $email, 'pass' => $pass);
        Mail::send('mail.reset-password', $data, function ($message) use ($data) {
            $message->subject('VieAssociative Mot de passe perdu');
            $message->from('noreply@vieassociative.fr', 'Vie Associative');
            $message->to($data['email']);
        });
    }

}