<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Session;

class CommonFunctions extends Controller {
    public $client = null;

    public static function getHTTPClient() {
        if (self::sessionIsValid()){
            $user = Session::get('user');
            global $client;
            if ($client === null) {
                $access_token = $user->token;

                $headers = [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token
                ];

                $client = new Client(['headers' => $headers]);
            }
            return $client;
        } else {
            return redirect()->route('redirect-to-spotify');
        }
    }

    public static function executeHTTPRequest($client, $httpMethod, $endpoint) {
        if (!self::sessionIsValid()) {
            return redirect()->route('redirect-to-spotify');
        }

        try {
            $response = $client->request($httpMethod, $endpoint);
            $jsonResponse = json_decode($response->getBody()->getContents(), true);
            return $jsonResponse;
        } catch (ClientException $e) {
            // Handle 429 Too many requests
            if ($e->getCode() == 429) {
                $retryAfter = $e->getResponse()->getHeader('Retry-After')[0];
                sleep(intval($retryAfter));
                return self::executeHTTPRequest($client, $httpMethod, $endpoint);
            }
            dd($e);
        }
    }

    public static function sessionIsValid() {
        date_default_timezone_set('Europe/Stockholm');
        $sessionLoginTime = Session::get('loginTime');
        $tokenExpirationTime = date('Y-m-d H:i:s', strtotime('+1 hour', strtotime($sessionLoginTime)));
        return Session::has('loginTime') && ($tokenExpirationTime > date('Y-m-d H:i:s')) ? true : false;
    }

    public static function flushSession(){
        Session::flush();
        Session::save();
    }
}
