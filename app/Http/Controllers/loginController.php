<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class loginController extends Controller {
    public function login() {
        $auth_endpoint = 'https://accounts.spotify.com/authorize';
        $client_id = '2453b08fbb1c4effa66564624938a3c7';
        $redirect_uri = 'http://localhost:8000/callback';
        //$scopes = 'user-read-private user-read-email';
        $scopes = 'user-read-private';

        $client = new Client();

        $request_uri =
            $auth_endpoint
            . '?response_type=code'
            . '&client_id=' . $client_id
            . ($scopes ? '&scope=' . loginController::encodeURIComponent($scopes) : '')
            . '&redirect_uri=' . loginController::encodeURIComponent($redirect_uri);

        try {
            $response = $client->request('GET', $request_uri);
        } catch (GuzzleException $e) {
            dd($e);
        }
    }

    private function encodeURIComponent($str) {
        $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
        return strtr(rawurlencode($str), $revert);
    }
}
