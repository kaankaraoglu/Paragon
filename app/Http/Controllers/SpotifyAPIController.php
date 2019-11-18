<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class SpotifyAPIController extends Controller {

    public static function getUserPlaylists() {
        if(CommonFunctions::sessionIsValid()){
            $offset = 0;
            $limit = 50;

            $result = array();
            $httpMethod = 'GET';
            $client = CommonFunctions::getHTTPClient();

            do {
                $endpoint = 'https://api.spotify.com/v1/me/playlists?limit=' . $limit . '&offset=' . $offset;
                $usersPlaylists = CommonFunctions::executeHTTPRequest($client, $httpMethod, $endpoint);

                foreach ($usersPlaylists['items'] as $index => $playlist) {
                    if ($playlist['tracks']['total'] === 0) {
                        unset($usersPlaylists['items'][$index]);
                    }
                }

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
        if(CommonFunctions::sessionIsValid()) {
            $client = CommonFunctions::getHTTPClient();
            $httpMethod = 'GET';
            $endpoint = 'https://api.spotify.com/v1/playlists/' . $playlistId . '/tracks';
            $tracks = CommonFunctions::executeHTTPRequest($client, $httpMethod, $endpoint);
            return $tracks;
        } else {
            return redirect()->route('redirect-to-spotify');
        }
    }

    public static function getTrackFeatures($trackId) {
        if(CommonFunctions::sessionIsValid()) {
            $client = CommonFunctions::getHTTPClient();
            $httpMethod = 'GET';
            $endpoint = 'https://api.spotify.com/v1/audio-features/?ids=' . $trackId;
            $trackFeatures = CommonFunctions::executeHTTPRequest($client, $httpMethod, $endpoint);
            return $trackFeatures;
        } else {
            return redirect()->route('redirect-to-spotify');
        }
    }

    public static function getAverageFeatureOfPlaylist() {
        if(CommonFunctions::sessionIsValid()) {
            $playlistId = Request::get('playlist_id');

            if (Request::get('features') === 'all') {
                $featureString = 'tempo, danceability, energy, acousticness, instrumentalness, liveness, loudness, mode, speechiness, valence';
            } else {
                $featureString = Request::get('features');
            }

            $featureString = str_replace(['[', '"', ']', ' '], '', $featureString);
            $featureArray = explode(',', $featureString);

            $sumOfFeature = 0;
            $result = array();
            $trackIdArray = array();
            $tracks = SpotifyAPIController::getTracksInAPlaylist($playlistId);
            $trackCount = $tracks['total'];

            foreach ($tracks['items'] as $track) {
                array_push($trackIdArray, $track['track']['id']);
            }

            $trackIds = implode(',', $trackIdArray);
            $trackFeatures = SpotifyAPIController::getTrackFeatures($trackIds);

            foreach ($featureArray as $feature) {
                foreach ($trackFeatures['audio_features'] as $trackWithFeatures) {
                    $sumOfFeature += $trackWithFeatures[$feature];
                }

                if ($sumOfFeature !== 0) {
                    $averageFeature = $sumOfFeature / $trackCount;
                    $result[$feature] = round($averageFeature, 2);
                }
                $sumOfFeature = 0;
            }
            return $result;
        } else {
            return redirect()->route('redirect-to-spotify');
        }
    }

    public static function getUserTopArtists($limit, $timeRange) {
        if (CommonFunctions::sessionIsValid()) {
            $client = CommonFunctions::getHTTPClient();
            $httpMethod = 'GET';
            $endpoint = 'https://api.spotify.com/v1/me/top/artists?time_range=' . $timeRange . '&limit=' . $limit . '&offset=0';
            $usersTopArtists = CommonFunctions::executeHTTPRequest($client, $httpMethod, $endpoint);
            return $usersTopArtists;
        } else {
            return redirect()->route('redirect-to-spotify');
        }
    }

    public static function getUserTopTracks($limit, $timeRange) {
        if (CommonFunctions::sessionIsValid()) {
            $client = CommonFunctions::getHTTPClient();
            $httpMethod = 'GET';
            $endpoint = 'https://api.spotify.com/v1/me/top/tracks?time_range=' . $timeRange . '&limit=' . $limit . '&offset=0';
            $usersTopTracks = CommonFunctions::executeHTTPRequest($client, $httpMethod, $endpoint);
            return $usersTopTracks;
        } else {
            return redirect()->route('redirect-to-spotify');
        }
    }

    public static function getAllGenres() {
        if (CommonFunctions::sessionIsValid()) {
            $client = CommonFunctions::getHTTPClient();
            $httpMethod = 'GET';
            $endpoint = 'https://api.spotify.com/v1/recommendations/available-genre-seeds';
            $allGenres = CommonFunctions::executeHTTPRequest($client, $httpMethod, $endpoint);
            return $allGenres;
        } else {
            return redirect()->route('redirect-to-spotify');
        }
    }

    public static function generatePlaylist() {
        if (CommonFunctions::sessionIsValid()) {
            $arr = [];

            if (Request::input('inputState.tempoState')){
                array_push($arr, 'target_tempo=' . Request::input('formData.tempoValue'));
            }

            if (Request::input('inputState.danceabilityState')){
                array_push($arr, 'target_danceability=' . Request::input('formData.danceabilityValue'));
            }

            if (Request::input('inputState.energyState')){
                array_push($arr, 'target_energy=' . Request::input('formData.energyValue'));
            }

            if (Request::input('inputState.acousticnessState')){
                array_push($arr, 'target_acousticness=' . Request::input('formData.acousticnessValue'));
            }

            if (Request::input('inputState.instrumentalnessState')){
                array_push($arr, 'target_instrumentalness=' . Request::input('formData.instrumentalnessValue'));
            }

            if (Request::input('inputState.livenessState')){
                array_push($arr, 'target_liveness=' . Request::input('formData.livenessValue'));
            }

            if (Request::input('inputState.loudnessState')){
                array_push($arr, 'target_loudness=' . Request::input('formData.loudnessValue'));
            }

            if (Request::input('inputState.keyState')){
                array_push($arr, 'target_key=' . Request::input('formData.keyValue'));
            }

            if (Request::input('inputState.modeState')){
                array_push($arr, 'target_mode=' . Request::input('formData.modeValue'));
            }

            if (Request::input('inputState.popularityState')){
                array_push($arr, 'target_popularity=' . Request::input('formData.popularityValue'));
            }

            if (Request::input('inputState.speechinessState')){
                array_push($arr, 'target_speechiness=' . Request::input('formData.speechinessValue'));
            }

            if (Request::input('inputState.valenceState')){
                array_push($arr, 'target_valence=' . Request::input('formData.valenceValue'));
            }

            $query = implode('&', $arr);
            $client = CommonFunctions::getHTTPClient();
            $httpMethod = 'GET';
            //$endpoint = 'https://api.spotify.com/v1/me/top/tracks?time_range=' . $timeRange . '&limit=' . $limit . '&offset=0';
            $usersTopTracks = CommonFunctions::executeHTTPRequest($client, $httpMethod, $endpoint);
            return $usersTopTracks;
        } else {
            return redirect()->route('redirect-to-spotify');
        }
    }
}
