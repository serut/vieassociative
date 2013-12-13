<?php

App::singleton('Pubnub', function()
{
    if (!class_exists('Pubnub', false))
    {
        // Load the HTML Purifier auto loader
        require base_path() . '/vendor/pubnub/pubnub/lib/autoloader.php';
    }
    // Return the Pubnub instance
    $pubnub = new \Pubnub\Pubnub(
        Config::get('pubnub.publish'),
        Config::get('pubnub.subscribe'),  ## SUBSCRIBE_KEY
        Config::get('pubnub.secret'),  ## SECRET_KEY
        Config::get('pubnub.ssl')    ## SSL_ON?
    );
    $info = $pubnub->publish(array(
        'channel' => 'my_channel', ## REQUIRED Channel to Send
        'message' => 'Hey World!'   ## REQUIRED Message String/Array
    ));
    print_r($info);
    echo("Requesting History...\n");
    $messages = $pubnub->history(array(
        'channel' => 'my_channel', ## REQUIRED Channel to Send
        'limit'   => 10            ## OPTIONAL Limit Number of Messages
    ));
    print_r($messages);
});