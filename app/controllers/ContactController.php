<?php

/**
 * Class ContactController
 */
class ContactController extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function postProposition()
    {
        // data for send the mail to the user
        $data = array('email' => 'contact@vieassociative.fr',
            'from' => Input::get('from', 'Auteur inconnu'),
            'titre' => Input::get('titre', 'Aucun titre'),
            'texte' => Input::get('text', 'Aucun message')
        );
        Mail::send('mail.proposition', $data, function ($message) use ($data) {
            $message->subject('proposition : ' . $data['titre']);
            $message->from('noreply@vieassociative.fr', 'Vie Associative');
            $message->to($data['email']);
        });

        return Response::json(array('success' => true, 'redirect_url' => URL::to('/')));
    }
}