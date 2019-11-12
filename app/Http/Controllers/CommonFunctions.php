<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
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
            dd('Session is not valid.');
            return null;
        }
    }

    public static function executeHTTPRequest($client, $httpMethod, $endpoint) {
        if(self::sessionIsValid()) {
            $response = $client->request($httpMethod, $endpoint);
            $jsonResponse = json_decode($response->getBody()->getContents(), true);
            return $jsonResponse;
        } else {
            dd('Session is not valid.');
        }
    }

    public static function sessionIsValid() {
        $sessionLoginTime = Session::get('loginTime');
        return Session::has('loginTime') && $sessionLoginTime->addHour()->gt(Carbon::now('Europe/Stockholm')) ? true : false;
    }
}
