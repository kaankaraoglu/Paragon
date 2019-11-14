<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class SpotifyAPIController extends Controller {

    public static function getUserPlaylists() {
        if(CommonFunctions::sessionIsValid()){
            $user = Session::get('user');
            $userID = $user->id;

            $offset = 0;
            $limit = 50;

            $result = array();
            $httpMethod = 'GET';
            $client = CommonFunctions::getHTTPClient();
            do {
                $endpoint = 'https://api.spotify.com/v1/users/' . $userID . '/playlists?limit=' . $limit . '&offset=' . $offset;
                $usersPlaylists = CommonFunctions::executeHTTPRequest($client, $httpMethod, $endpoint);
                $result = array_merge($result, $usersPlaylists['items']);
                $totalPlaylistCount = $usersPlaylists['total'];
                $receivedPlaylistCount = sizeof($result);
                $offset = $receivedPlaylistCount;
            } while ($totalPlaylistCount > $receivedPlaylistCount);

            return $result;
        } else {
            return redirect()->route('redirect-to-spotify');
        }
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
