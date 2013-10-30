<?php
class EmailController extends BaseController
{
	public function sendConfirmation($name,$email)
	{
		Mail::pretend();
		$user=array('name'=>$name,'email'=>$email);
		$data=array('name'=>$name,'email'=>$email);
		Mail::send('mail.register', $data, function($message) use ($user)
		{
		    $message->to($user['email'], $user['name'])->subject('Welcome!');
		});
	}
	public function sendNewsletter()
	{
		return View::make('mail.register')
			->with('mail','dupond@gshgdsjgf.fr');
	}
}