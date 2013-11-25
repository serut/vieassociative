<?php
class EmailController extends BaseController
{
	static function register($name,$email)
	{
		// data for send the mail to the user
		$data=array('name'=>$name,'email'=>$email);
		Mail::send('mail.register', $data, function ($message) use ($data) {
			$message->subject('Bienvenue sur Vie Associative !');
			$message->from('noreply@vieassociative.fr', 'Vie Associative');
			$message->to($data['email']);
		});
	}
}