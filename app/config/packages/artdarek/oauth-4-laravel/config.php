<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | oAuth Config
    |--------------------------------------------------------------------------
    */

    /**
     * Storage
     */
    'storage' => 'Session',

    /**
     * Consumers
     */
    'consumers' => array(
        'Facebook' => array(
            'client_id' => '377363965666139',
            'client_secret' => getenv('VA_FB_SECRET'),
            'scope' => array('email'),
        ),
        'Microsoft' => array(
            'client_id' => '00000000440D680E',
            'client_secret' => getenv('VA_LIVE_SECRET'),
            'scope' => array('wl.basic', 'wl.emails'),
        ),
        'Google' => array(
            'client_id' => '224750654050.apps.googleusercontent.com',
            'client_secret' => getenv('VA_GOOGLE_SECRET'),
            'scope' => array('userinfo_email', 'userinfo_profile'),
        ),
    )

);