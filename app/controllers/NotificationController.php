<?php

class NotificationController  extends BaseController {
	// This bullshit is not working
    public function getIndex() {
    	$pubnub = App::make('Pubnub');
		
		/*
        $info = $pubnub->publish(array(
		    'channel' => 'hello_world', ## REQUIRED Channel to Send
		    'message' => 'Hey World!'   ## REQUIRED Message String/Array
		));
		print_r($info);
		$pubnub->subscribe(array(
		    'channel'  => 'hello_world',        ## REQUIRED Channel to Listen
		    'callback' => function($message) {  ## REQUIRED Callback With Response
		        var_dump($message);  ## Print Message
		        return true;         ## Keep listening (return false to stop)
		    }
		));
		*/
/*
		$messages = $pubnub->history(array(
		    'channel' => 'hello_world',  ## REQUIRED Channel to Send
		    'limit'   => 100             ## OPTIONAL Limit Number of Messages
		));
		print_r($messages);             ## Prints array of messages.
		$pubnub->subscribe(array(
		    'channel'  => 'hello_world',        ## REQUIRED Channel to Listen
		    'callback' => create_function(      ## REQUIRED PHP 5.2.0 Method
		        '$message',
		        'var_dump($message); return true;'
		    )
		));

		$pubnub->subscribe(array(
		    'channel'  => 'hello_world',        ## REQUIRED Channel to Listen
		    'callback' => function($message) {  ## REQUIRED Callback With Response
		        var_dump($message);  ## Print Message
		        return true;         ## Keep listening (return false to stop)
		    }
		));

        return View::make('association.add');
*/
    }
}