<?php

App::singleton('Pubnub', function()
{
    if (!class_exists('Pubnub', false))
    {
        // Load the HTML Purifier auto loader
        require base_path() . '/vendor/camcima/pubnub-php-api/3.3/Pubnub.php';
    }
    
    // Return the Pubnub instance
    return new Pubnub(
        Config::get('pubnub.publish'),
        Config::get('pubnub.subscribe'),  ## SUBSCRIBE_KEY
        Config::get('pubnub.secret'),  ## SECRET_KEY
        Config::get('pubnub.ssl')    ## SSL_ON?
    );
});