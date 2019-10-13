<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class APIRequestController extends Controller {
    
    public static function getUserPlaylists($user) {
        $userID = $user->id;
        $endpoint = 'https://api.spotify.com/v1/users/' . $userID . '/playlists?limit=50&offset=5';
        $access_token = $user->accessTokenResponseBody['access_token'];

        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' .  $access_token
        ];

        try {
            $client = new Client(['headers' => $headers]);
        } catch (GuzzleException $e){
            dd($e);
        }

        $response = $client->request('GET', $endpoint);
        $jsonResponse = json_decode($response->getBody()->getContents(), true);
        $playlists = $jsonResponse['items'];
        return $playlists;
    }

    private function encodeURIComponent($str) {
        $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
        return strtr(rawurlencode($str), $revert);
    }
}
