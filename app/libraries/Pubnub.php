<?php

App::singleton('Pubnub', function()
{
    if (!class_exists('Pubnub', false))
    {
        // Load the HTML Purifier auto loader
        require base_path() . '/vendor/pubnub/pubnub/lib/Pubnub/Pubnub.php';
    }
    // Return the Pubnub instance
    $pubnub = new pubnub\Pubnub(
        Config::get('pubnub.publish'),
        Config::get('pubnub.subscribe'),  ## SUBSCRIBE_KEY
        Config::get('pubnub.secret'),  ## SECRET_KEY
        false    ## SSL_ON?
    );
    $info = $pubnub->publish(array(
        'channel' => 'hello_world', ## REQUIRED Channel to Send
        'message' => 'Hey World!'   ## REQUIRED Message String/Array
    ));
    print_r($info);
    $pubnub->subscribe(array(
        'channel'  => 'hello_world',        ## REQUIRED Channel to Listen
        'callback' => function($message) {  ## REQUIRED Callback With Response
            var_dump($message);  ## Print Message
            return false;         ## Keep listening (return false to stop)
        }
    ));
});