<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class APIRequestController extends Controller {

    public static function getUserPlaylists() {
        $user = Session::get('user');
        $userID = $user->id;
        $client = CommonFunctions::getHTTPClient();
        $httpMethod = 'GET';
        $endpoint = 'https://api.spotify.com/v1/users/' . $userID . '/playlists?limit=50&offset=5';
        $usersAllPlaylists = CommonFunctions::executeHTTPRequest($client, $httpMethod, $endpoint);

        return $usersAllPlaylists;
    }

    public static function getTracksInAPlaylist($playlist) {
        $playlistId = $playlist['id'];
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

    public static function getAverageFeatureOfPlaylist($playlist, $featureArray) {
        $sumOfFeature = 0;
        $result = array();
        $trackIdArray = array();
        $tracks = APIRequestController::getTracksInAPlaylist($playlist);
        $trackCount = $tracks['total'];

        foreach ($tracks['items'] as $track){
            array_push($trackIdArray, $track['track']['id']);
        }

        $trackIds= implode(',', $trackIdArray);
        $trackFeatures = APIRequestController::getTrackFeatures($trackIds);

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
}
