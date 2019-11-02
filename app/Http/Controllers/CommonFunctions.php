<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class CommonFunctions extends Controller {
    public $client = null;

    public static function getHTTPClient() {
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
    }

    public static function executeHTTPRequest($client, $httpMethod, $endpoint) {
        $response = $client->request($httpMethod, $endpoint);
        $jsonResponse = json_decode($response->getBody()->getContents(), true);
        return $jsonResponse;
    }

    private function encodeURIComponent($str) {
        $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
        return strtr(rawurlencode($str), $revert);
    }
}
