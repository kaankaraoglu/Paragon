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

    public static function getAverageDanceabilityOfPlaylist($user, $playlist) {
        $tracks = APIRequestController::getTracksInAPlaylist($user, $playlist);
        $trackCount = $tracks['total'];
        $trackIdArray = array();
        $danceability = 0;

        foreach ($tracks['items'] as $track){
            array_push($trackIdArray, $track['track']['id']);
        }

        $trackIds= implode(',', $trackIdArray);
        $trackFeatures = APIRequestController::getTrackFeatures($user, $trackIds);

        foreach ($trackFeatures['audio_features'] as $features) {
            $danceability += $features['danceability'];
        }

        if ($danceability !== 0){
            $averageDanceability = $danceability / $trackCount;
            return round($averageDanceability, 2) . ' out of 1.00';
        } else {
            return 'Not available.';
        }
    }
}
