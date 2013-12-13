<?php
require_once(__DIR__.'/../lib/autoloader.php');

// TODO: Add SSL version of these tests
## ---------------------------------------------------------------------------
## USAGE:
## ---------------------------------------------------------------------------
#
# php ./pubnubPlaintextTests.php
# php ./pubnubPlaintextTests.php [PUB-KEY] [SUB-KEY] [SECRET-KEY] [CIPHER-KEY] [USE SSL]
#


## Capture Publish and Subscribe Keys from Command Line
$publish_key   = isset($argv[1]) ? $argv[1] : 'demo';
$subscribe_key = isset($argv[2]) ? $argv[2] : 'demo';
$secret_key    = isset($argv[3]) ? $argv[3] : false;
$cipher_key	   = isset($argv[4]) ? $argv[4] : false;
$ssl_on        = false;

## ---------------------------------------------------------------------------
## Create Pubnub Object
## ---------------------------------------------------------------------------
$pubnub = new \Pubnub\Pubnub($publish_key, $subscribe_key, $secret_key, $cipher_key, $ssl_on, 'IUNDERSTAND.pubnub.com');

## ---------------------------------------------------------------------------
## Define Messaging Channel
## ---------------------------------------------------------------------------
$channel = "a";

## ---------------------------------------------------------------------------
## Publish Example
## ---------------------------------------------------------------------------
echo "Running publish\r\n";

while (1) {

$t = time() . "";
$m = array("serial" => $t, "message" => "Hello from PHP! " . $t);

$publish_success = $pubnub->publish(array(
    'channel' => $channel,
    'message' => $m));

echo($t . " " .  $publish_success[0] . " " . $publish_success[1]);
echo "\r\n";
sleep(1);
}

?>

