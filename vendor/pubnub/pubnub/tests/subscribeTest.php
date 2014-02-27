<?php
require_once(__DIR__.'/../lib/autoloader.php');

//php subscribeTest.php --ssl
$options = getopt('',array('ssl'));

$ssl = isset($options['ssl']);

$pubnub = new \Pubnub\Pubnub( 'demo', 'demo', false , false, $ssl, 'IUNDERSTAND.pubnub.com');
$pubnub->subscribe(array(
    'channel'  => 'testChannel',
    'callback' => function($message) {
		$filePath = sys_get_temp_dir() . '/subscribeOut.txt';
		
        $fp = fopen($filePath, 'w');
        fwrite($fp, serialize($message));
        fclose($fp);
        exit;
    }
));