<?php

namespace Pubnub;

/**
 * PubNub 3.4 Real-time Push Cloud API
 * @package Pubnub
 */
class Pubnub {

    private $ORIGIN = 'IUNDERSTAND.pubnub.com';  // Change this to your custom origin, or IUNDERSTAND.pubnub.com
    private $PUBLISH_KEY = 'demo';
    private $SUBSCRIBE_KEY = 'demo';
    private $SECRET_KEY = false;
    private $CIPHER_KEY = '';
    private $SSL = false;
    private $SESSION_UUID = '';
    // New style response contains channel after timetoken
    // Old style response does not
	
	/**
	 * @var PubnubAES 
	 */
	public $AES;

    private $NEW_STYLE_RESPONSE = true;
    private $PEM_PATH = __DIR__;

    /**
     * Pubnub
     *
     * Init the Pubnub Client API
     *
     * @param string $publish_key required key to send messages.
     * @param string $subscribe_key required key to receive messages.
     * @param string $secret_key optional key to sign messages.
     * @param string $origin optional setting for cloud origin.
     * @param boolean $ssl required for 2048 bit encrypted messages.
     */
    public function __construct($publish_key = 'demo', $subscribe_key = 'demo', $secret_key = false, $cipher_key = false, $ssl = false, $origin = false, $pem_path = false) 
	{
		$this->AES = new PubnubAES();
		
        $this->SESSION_UUID = $this->uuid();

        $this->PUBLISH_KEY = $publish_key;
        $this->SUBSCRIBE_KEY = $subscribe_key;
        $this->SECRET_KEY = $secret_key;

        if (!$this->AES->isBlank($cipher_key)) {
            $this->CIPHER_KEY = $cipher_key;
        }

        $this->SSL = $ssl;

        if ($pem_path != false)
            $this->PEM_PATH = $pem_path;

        if ($origin)
            $this->ORIGIN = $origin;

        if ($this->ORIGIN == "PHP.pubnub.com") {
            trigger_error("Before running in production, please contact support@pubnub.com for your custom origin.\nPlease set the origin from PHP.pubnub.com to IUNDERSTAND.pubnub.com to remove this warning.\n", E_USER_NOTICE);
        }


        if ($ssl)
            $this->ORIGIN = 'https://' . $this->ORIGIN;
        else
            $this->ORIGIN = 'http://' . $this->ORIGIN;
    }

    /**
     * Publish
     *
     * Send a message to a channel.
     *
     * @param array $args with channel and message.
     * @return array success information.
     */
    function publish($args) {
        ## Fail if bad input.
        if (!(isset($args['channel']) && isset($args['message']))) {
            echo('Missing Channel or Message');
            return false;
        }

        ## Capture User Input
        $channel = $args['channel'];
        $message_org = $args['message'];

        $message = $this->sendMessage($message_org);


        ## Sign Message
        $signature = "0";
        if ($this->SECRET_KEY) {
            ## Generate String to Sign
            $string_to_sign = implode('/', array(
                $this->PUBLISH_KEY,
                $this->SUBSCRIBE_KEY,
                $this->SECRET_KEY,
                $channel,
                $message
            ));

            $signature = md5($string_to_sign);
        }

        ## Send Message
        $publishResponse = $this->_request(array(
            'publish',
            $this->PUBLISH_KEY,
            $this->SUBSCRIBE_KEY,
            $signature,
            $channel,
            '0',
            $message
        ));

        if ($publishResponse == null)
            return array(0, "Error during publish.");
        else
            return $publishResponse;
    }

    public function sendMessage($message_org) {
        if ($this->CIPHER_KEY != false) {
            $message = json_encode($this->AES->encrypt(json_encode($message_org), $this->CIPHER_KEY));
        } else {
            $message = json_encode($message_org);
        }
        return $message;
    }

    function here_now($args) {
        if (!($args['channel'])) {
            echo('Missing Channel');
            return false;
        }

        ## Capture User Input
        $channel = $args['channel'];

        $response = $this->_request(array(
                    'v2',
                    'presence',
                    'sub_key',
                    $this->SUBSCRIBE_KEY,
                    'channel',
                    $channel
        ));
		
		//TODO: <timeout> and <message too large> check
		if(!is_array($response)){
			$response = array(
				'uuids' => array(),
				'occupancy' => 0,
			);
		}
					
		return $response;
    }

    /**
     * Subscribe
     *
     * This is BLOCKING.
     * Listen for a message on a channel.
     *
     * @param array $args with channel and message.
     * @return mixed false on fail, array on success.
     */
    function subscribe($args, $presence = false) {
        ## Capture User Input
        $channel = $args['channel'];
        $callback = $args['callback'];
        $timetoken = isset($args['timetoken']) ? $args['timetoken'] : '0';

        ## Fail if missing channel
        if (!$channel) {
            echo("Missing Channel.\n");
            return false;
        }

        ## Fail if missing callback
        if (!$callback) {
            echo("Missing Callback.\n");
            return false;
        }

        if ($presence == true) {
            $mode = "presence";
        }
        else
            $mode = "default";


        while (1) {

            try {
                ## Wait for Message
                $response = $this->_request(array(
                    'subscribe',
                    $this->SUBSCRIBE_KEY,
                    $channel,
                    '0',
                    $timetoken
                ));

                if ($response == "_PUBNUB_TIMEOUT") {
                    continue;
                } elseif ($response == "_PUBNUB_MESSAGE_TOO_LARGE") {
                    $timetoken = $this->throwAndResetTimetoken($callback, "Message Too Large");
                    continue;
                } elseif ($response == null || $timetoken == null) {
                    $timetoken = $this->throwAndResetTimetoken($callback, "Bad server response.");
                    continue;
                }
                var_dump($response);
                $messages = $response[0];
                $timetoken = $response[1];

                // determine the channel

                if ((count($response) == 3)) {
                    $derivedChannel = explode(",", $response[2]);
                } else {
                    $channel_array = array();
                    for ($a = 0; $a < sizeof($messages); $a++) {
                        array_push($channel_array, $channel);
                    }
                    $derivedChannel = $channel_array;
                }


                if (!count($messages)) {
                    continue;
                }

                $receivedMessages = $this->decodeAndDecrypt($messages, $mode);


                $returnArray = $this->NEW_STYLE_RESPONSE ? array($receivedMessages, $derivedChannel, $timetoken) : array($receivedMessages, $timetoken);

                # Call once for each message for each channel

                $exit_now = false;
                for ($i = 0; $i < sizeof($receivedMessages); $i++) {

                    $cbReturn = $callback(array("message" => $returnArray[0][$i], "channel" => $returnArray[1][$i], "timetoken" => $returnArray[2]));

                    if ($cbReturn == false) {
                        $exit_now = true;
                    }
                }

                if ($exit_now) {
                    return;
                }
            } catch (Exception $error) {
                $this->handleError($error, $args);
                $timetoken = $this->throwAndResetTimetoken($callback, "Unknown error.");
                continue;
            }
        }
    }

    public function throwAndResetTimetoken($callback, $errorMessage) {
        $callback(array(0, $errorMessage));
        $timetoken = "0";
        return $timetoken;
    }

    public function decodeAndDecrypt($messages, $mode = "default") {
        $receivedMessages = array();

        if ($mode == "presence") {
            return $messages;
        } elseif ($mode == "default" && is_array($messages)) {
            $messageArray = $messages;
            $receivedMessages = $this->decodeDecryptLoop($messageArray);
        } elseif ($mode == "detailedHistory" && is_array($messages)) {
			$decodedMessages = $this->decodeDecryptLoop($messages);
			$receivedMessages = array($decodedMessages[0], $messages[1], $messages[2]);
        }

        return $receivedMessages;
    }

    public function decodeDecryptLoop($messageArray) {
        $receivedMessages = array();
        foreach ($messageArray as $message) {

            if ($this->CIPHER_KEY) {
                $decryptedMessage = $this->AES->decrypt($message, $this->CIPHER_KEY);
                $message = json_decode($decryptedMessage, true);
            }

            array_push($receivedMessages, $message);
        }
        return $receivedMessages;
    }

    public function handleError($error, $args) {
        $errorMsg = 'Error on line ' . $error->getLine() . ' in ' . $error->getFile() . $error->getMessage();
        trigger_error($errorMsg, E_COMPILE_WARNING);


        sleep(1);
    }

    /**
     * Presence
     *
     * This is BLOCKING.
     * Listen for a message on a channel.
     *
     * @param array $args with channel and message.
     * @return mixed false on fail, array on success.
     */
    function presence($args) {
        ## Capture User Input
        $args['channel'] = ($args['channel'] . "-pnpres");
        $this->subscribe($args, true);
    }

    /**
     * Detailed History
     *
     * Load history from a channel.
     *
     * @param array $args with 'channel' and 'limit'.
     * @return mixed false on fail, array on success.
     */
    function detailedHistory($args) {
        ## Capture User Input
        ## Fail if bad input.
        if (!$args['channel']) {
            echo('Missing Channel');
            return false;
        }

        $channel = $args['channel'];
        $urlParams = "";
		
		$urlParamsKeys = array('count', 'start', 'end', 'reverse');
		$urlParamsArray = array();
		foreach($urlParamsKeys as $key){
			if(!isset($args[$key])) continue;
			$urlParamsArray[] = sprintf('%s=%s',$key,$args[$key]);
		}
		if(count($urlParamsArray)) {
			$urlParams = '?'.implode('&',$urlParamsArray);
		}

        $response = $this->_request(array(
            'v2',
            'history',
            "sub-key",
            $this->SUBSCRIBE_KEY,
            "channel",
            $channel,
		), $urlParams);
        

        $receivedMessages = $this->decodeAndDecrypt($response, "detailedHistory");
		
		//TODO: <timeout> and <message too large> check 
		if(!is_array($receivedMessages)) $receivedMessages = array();
		
		$result = array(
			'messages'	=> isset($receivedMessages[0]) ? $receivedMessages[0] : array(),
			'date_from'	=> isset($receivedMessages[1]) ? $receivedMessages[1] : 0,
			'date_to'	=> isset($receivedMessages[2]) ? $receivedMessages[2] : 0,
		);

        return $result;
    }

    /**
     * History
     *
     * Load history from a channel.
     *
     * @param array $args with 'channel' and 'limit'.
     * @return mixed false on fail, array on success.
     */
    function history($args) {
        ## Capture User Input
        $limit = +$args['limit'] ? +$args['limit'] : 10;
        $channel = $args['channel'];

        ## Fail if bad input.
        if (!$channel) {
            echo('Missing Channel');
            return false;
        }

        ## Get History
        $response = $this->_request(array(
            'history',
            $this->SUBSCRIBE_KEY,
            $channel,
            '0',
            $limit
        ));
        
		//TODO: <timeout> and <message too large> check 
		if(!is_array($response)) {
			$response = array(
				0 => array(),
			);
		}

		$messages = $response[0];

        $receivedMessages = $this->decodeAndDecrypt($response);

        return $receivedMessages;
    }

    /**
     * Time
     *
     * Timestamp from PubNub Cloud.
     *
     * @return int timestamp.
     */
    function time() {
        ## Get History
        $response = $this->_request(array(
            'time',
            '0'
        ));
		
		$result = (isset($response[0])) ? $response[0] : 0;
		if(is_string($result)){
			$result = intval(substr($result, 0, 10));
		}

        return $result;
    }

    /**
     * UUID
     *
     * UUID generator
     *
     * @return UUID
     */
    function uuid() {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    /**
     * Request URL
     *
     * @param array $request of url directories.
     * @return array from JSON response.
     */
    private function _request($request, $urlParams = false) {
        $request = array_map('\Pubnub\Pubnub::_encode', $request);

        array_unshift($request, $this->ORIGIN);

        if (($request[1] === 'presence') || ($request[1] === 'subscribe')) {
            array_push($request, '?uuid=' . $this->SESSION_UUID);
        }

        $urlString = implode('/', $request);

        if ($urlParams) {
            $urlString .= $urlParams;
        }

        $ch = curl_init();

        $pubnubHeaders = array("V: 3.4", "Accept: */*");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $pubnubHeaders);
        curl_setopt($ch, CURLOPT_USERAGENT, "PHP");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 310);

        curl_setopt($ch, CURLOPT_URL, $urlString);

        if ($this->SSL) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);


            $pemPathAndFilename = $this->PEM_PATH . "/pubnub.com.pem";
            if (file_exists($pemPathAndFilename))
                curl_setopt($ch, CURLOPT_CAINFO, $pemPathAndFilename);
            else {
                trigger_error("Can't find PEM file. Please set pem_path in initializer.");
                exit;
            }
        }


        $output = curl_exec($ch);
        $curlError = curl_errno($ch);
        $curlResponseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        $JSONdecodedResponse = json_decode($output, true, 512, JSON_BIGINT_AS_STRING);

        if ($JSONdecodedResponse != null) {
            return $JSONdecodedResponse;
		} elseif ($curlError == 28) {
            return "_PUBNUB_TIMEOUT";
		} elseif ($curlError == 60) {
            //SSL CERTIFICATE PROBLEM";
		} elseif ($curlResponseCode == 400 || $curlResponseCode == 404) {
            return "_PUBNUB_MESSAGE_TOO_LARGE";
		}
    }

    /**
     * Encode
     *
     * @param string $part of url directories.
     * @return string encoded string.
     */
    private static function _encode($part) {
        $pieces = array_map('\Pubnub\Pubnub::_encode_char', str_split($part));
        return implode('', $pieces);
    }

    /**
     * Encode Char
     *
     * @param string $char val.
     * @return string encoded char.
     */
    private static function _encode_char($char) {
        if (strpos($char,' ~`!@#$%^&*()+=[]\\{}|;\':",./<>?') === false)
            return $char;
        else
            return rawurlencode($char);
    }

}

?>