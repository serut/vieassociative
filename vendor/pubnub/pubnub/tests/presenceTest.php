<?php
require_once(__DIR__.'/../lib/autoloader.php');

$pubnub = new \Pubnub\Pubnub( 'demo', 'demo', false , false, false, 'IUNDERSTAND.pubnub.com');
$pubnub->presence(array(
    'channel'  => 'testChannel',
    'callback' => function($message) {
		$filePath = sys_get_temp_dir() . '/presenceOut.txt';
        $fp = fopen($filePath, 'w');
        fwrite($fp, serialize($message));
        fclose($fp);
        exit;
    }
));

