<?php
class EmailController extends BaseController
{
	static function register($name,$email)
	{
		// data for send the mail to the user
		$data=array('name'=>$name,'email'=>$email);
		Mail::send('mail.register', $data, function ($message) use ($data) {
			$message->subject('Bienvenue sur VieAssociative!');
			$message->from('noreply@vieassociative.fr', 'Vie Associative');
			$message->to($data['email']);
		});
	}

	static function resetPassword($email,$pass)
	{
		// data for send the mail to the user
		$data=array('email'=>$email,'pass',$pass);
		Mail::send('mail.reset-password', $data, function ($message) use ($data) {
			$message->subject('VieAssociative Mot de passe perdu');
			$message->from('noreply@vieassociative.fr', 'Vie Associative');
			$message->to($data['email']);
		});
	}

}