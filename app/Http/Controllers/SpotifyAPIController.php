<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class SpotifyAPIController extends Controller {

    public static function getUserPlaylists() {
        if (Session::has('user')){
            $user = Session::get('user');
        } else {
            redirect()->route('redirect-to-spotify');
        }

        $userID = $user->id;
        $client = CommonFunctions::getHTTPClient();
        $httpMethod = 'GET';
        $endpoint = 'https://api.spotify.com/v1/users/' . $userID . '/playlists?limit=50&offset=5';
        $usersAllPlaylists = CommonFunctions::executeHTTPRequest($client, $httpMethod, $endpoint);
        return $usersAllPlaylists;
    }


    public static function getTracksInAPlaylist($playlistId) {
        $client = CommonFunctions::getHTTPClient();
        $httpMethod = 'GET';
        $endpoint = 'https://api.spotify.com/v1/playlists/' . $playlistId . '/tracks';
        $tracks = CommonFunctions::executeHTTPRequest($client, $httpMethod, $endpoint);

        return $tracks;
    }

    public static function getTrackFeatures($trackId) {
        $client = CommonFunctions::getHTTPClient();
        $httpMethod = 'GET';
        $endpoint = 'https://api.spotify.com/v1/audio-features/?ids=' . $trackId;
        $trackFeatures = CommonFunctions::executeHTTPRequest($client, $httpMethod, $endpoint);
        return $trackFeatures;
    }

    public static function getAverageFeatureOfPlaylist() {
        $playlistId = Request::get('playlist_id');
        $featureString = Request::get('features');
        $featureString = str_replace(['[', '"', ']'],'',$featureString);
        $featureArray = explode(',', $featureString);

        $sumOfFeature = 0;
        $result = array();
        $trackIdArray = array();
        $tracks = SpotifyAPIController::getTracksInAPlaylist($playlistId);
        $trackCount = $tracks['total'];

        foreach ($tracks['items'] as $track){
            array_push($trackIdArray, $track['track']['id']);
        }

        $trackIds= implode(',', $trackIdArray);
        $trackFeatures = SpotifyAPIController::getTrackFeatures($trackIds);

        foreach ($featureArray as $feature) {
            foreach ($trackFeatures['audio_features'] as $trackWithFeatures) {
                $sumOfFeature += $trackWithFeatures[$feature];
            }

            if ($sumOfFeature !== 0){
                $averageFeature = $sumOfFeature / $trackCount;
                $result[$feature] = round($averageFeature, 2);
            }
            $sumOfFeature = 0;
        }

        return $result;
    }

    public static function getUserTopArtists() {
        $client = CommonFunctions::getHTTPClient();
        $httpMethod = 'GET';
        $endpoint = 'https://api.spotify.com/v1/me/top/artists?time_range=medium_term&limit=10&offset=5';
        $usersTopArtists = CommonFunctions::executeHTTPRequest($client, $httpMethod, $endpoint);
        return $usersTopArtists;
    }

    public static function getUserTopTracks() {
        $client = CommonFunctions::getHTTPClient();
        $httpMethod = 'GET';
        $endpoint = 'https://api.spotify.com/v1/me/top/tracks?time_range=medium_term&limit=10&offset=5';
        $usersTopTracks = CommonFunctions::executeHTTPRequest($client, $httpMethod, $endpoint);
        return $usersTopTracks;
    }
}
