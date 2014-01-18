<?php
class ContactController extends BaseController
{
	/**
	*	@important : Not used right now
	*/
	public function getIndex()
	{
		return View::make('contact.contact');
	}
	
	/**
	*	Non fonctionnel - code non testé
	*/
	public function postIndex()
	{
		if(validators_contact::validate(Input::get())){
			// Pas d'erreur, on ajoute ce que l'utilisateur nous a donné
			$data = array('nom' => Input::get('nom'),
					'email' => Input::get('email'),
					'text' => Input::get('text'));
			// VUE DU MAIL A FAIRE !! (contact.blade.php dans le dossier "emails")
			return Mail::send('emails.contact', $data, function($m)
			{
				$m->to('foo@example.com', 'God')->subject('Contacting you');
			});
		}
		return Response::json(array('status'=>'error','text'=>'Aucunes données n\'a été recu'));
	}

	public function postProposition(){
		// data for send the mail to the user
		$data=array('email'=>'contact@vieassociative.fr',
					'titre'=>Input::get('titre',''),
					'texte'=>Input::get('text','')
					);
		Mail::send('mail.proposition', $data, function ($message) use ($data) {
			$message->subject('VieAssociative Proposition '.$data['titre']);
			$message->from('noreply@vieassociative.fr', 'Vie Associative');
			$message->to($data['email']);
		});

        return Response::json(array('success'=>true,'redirect_url'=>URL::to('/')));
	}
}