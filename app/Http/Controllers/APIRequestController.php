<?php

namespace App\Http\Controllers;

class APIRequestController extends Controller {

    public static function getUserPlaylists($user) {
        $userID = $user->id;
        $client = CommonFunctions::getHTTPClient($user);
        $httpMethod = 'GET';
        $endpoint = 'https://api.spotify.com/v1/users/' . $userID . '/playlists?limit=50&offset=5';
        $usersAllPlaylists = CommonFunctions::executeHTTPRequest($client, $httpMethod, $endpoint);

        return $usersAllPlaylists;
    }

    public static function getTracksInAPlaylist($user, $playlist) {
        $playlistId = $playlist['id'];
        $client = CommonFunctions::getHTTPClient($user);
        $httpMethod = 'GET';
        $endpoint = 'https://api.spotify.com/v1/playlists/' . $playlistId . '/tracks';
        $tracks = CommonFunctions::executeHTTPRequest($client, $httpMethod, $endpoint);

        return $tracks;
    }

    public static function getTrackFeatures($user, $trackId) {
        //$trackId = $track['track']['id'];
        $client = CommonFunctions::getHTTPClient($user);
        $httpMethod = 'GET';
        $endpoint = 'https://api.spotify.com/v1/audio-features/?ids=' . $trackId;
        $trackFeatures = CommonFunctions::executeHTTPRequest($client, $httpMethod, $endpoint);

        return $trackFeatures;
    }

    public static function getAverageFeatureOfPlaylist($user, $playlist, $featureArray) {
        $sumOfFeature = 0;
        $result = array();
        $trackIdArray = array();
        $tracks = APIRequestController::getTracksInAPlaylist($user, $playlist);
        $trackCount = $tracks['total'];

        foreach ($tracks['items'] as $track){
            array_push($trackIdArray, $track['track']['id']);
        }

        $trackIds= implode(',', $trackIdArray);
        $trackFeatures = APIRequestController::getTrackFeatures($user, $trackIds);

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
