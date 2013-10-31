<?php
class EmailController extends BaseController
{
	public function sendConfirmation($name,$email)
	{
		$user=array('name'=>$name,'email'=>$email);
		$data=array('name'=>$name);
		Mail::send('mail.register', $data, function ($message) use ($user) {
			$message->subject('Welcome!');
			$message->from('noreply@vieassociative.fr', 'Vie Associative');
			$message->to($user['email']);
		});
	}
	public function sendNewsletter()
	{
		return View::make('mail.register')
			->with('mail','dupond@gshgdsjgf.fr');
	}
}