<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class SpotifyAPIController extends Controller {

    public static function getUserPlaylistById($playlistId) {
        if($playlistId !== '' && $playlistId !== null){
            $httpMethod = 'GET';
            $client = CommonFunctions::getHTTPClient();
            $endpoint = 'https://api.spotify.com/v1/playlists/' . $playlistId;
            $userPlaylist = CommonFunctions::executeHTTPRequest($client, $httpMethod, $endpoint);
            return $userPlaylist;
        } else {
            return redirect()->route('redirect-to-spotify');
        }
    }

    public static function getUserPlaylists() {
        if(CommonFunctions::sessionIsValid()){
            $offset = 0;
            $result = array();
            $httpMethod = 'GET';
            $client = CommonFunctions::getHTTPClient();
            $endpoint = 'https://api.spotify.com/v1/me/playlists?limit=50&offset=' . $offset;

            do {
                $usersPlaylists = CommonFunctions::executeHTTPRequest($client, $httpMethod, $endpoint);

                // Remove empty playlists.
                foreach ($usersPlaylists['items'] as $index => $playlist) {
                    if ($playlist['tracks']['total'] === 0) {
                        unset($usersPlaylists['items'][$index]);
                    }
                }

                // Save.
                $result = array_merge($result, $usersPlaylists['items']);

                // Get next.
                $endpoint = $usersPlaylists['next'];

            } while ($endpoint !== null && $endpoint !== 'null');
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

    public static function generateTracks() {
        if (CommonFunctions::sessionIsValid()) {
            $features = [];
            if (Request::input('inputState.tempoState')){
                array_push($features, 'target_tempo=' . Request::input('formData.tempoValue'));
            }

            if (Request::input('inputState.danceabilityState')){
                array_push($features, 'target_danceability=' . Request::input('formData.danceabilityValue'));
            }

            if (Request::input('inputState.energyState')){
                array_push($features, 'target_energy=' . Request::input('formData.energyValue'));
            }

            if (Request::input('inputState.acousticnessState')){
                array_push($features, 'target_acousticness=' . Request::input('formData.acousticnessValue'));
            }

            if (Request::input('inputState.instrumentalnessState')){
                array_push($features, 'target_instrumentalness=' . Request::input('formData.instrumentalnessValue'));
            }

            if (Request::input('inputState.livenessState')){
                array_push($features, 'target_liveness=' . Request::input('formData.livenessValue'));
            }

            if (Request::input('inputState.loudnessState')){
                array_push($features, 'target_loudness=' . Request::input('formData.loudnessValue'));
            }

            if (Request::input('inputState.keyState')){
                array_push($features, 'target_key=' . Request::input('formData.keyValue'));
            }

            if (Request::input('inputState.modeState')){
                array_push($features, 'target_mode=' . Request::input('formData.modeValue'));
            }

            if (Request::input('inputState.popularityState')){
                array_push($features, 'target_popularity=' . Request::input('formData.popularityValue'));
            }

            if (Request::input('inputState.speechinessState')){
                array_push($features, 'target_speechiness=' . Request::input('formData.speechinessValue'));
            }

            if (Request::input('inputState.valenceState')){
                array_push($features, 'target_valence=' . Request::input('formData.valenceValue'));
            }

            $limit = Request::has('formData.playlistInfo.limit') ? Request::input('formData.playlistInfo.limit') : 50;
            $client = CommonFunctions::getHTTPClient();
            $seedFeatures = !empty($features) ? '&' . implode('&', $features) : '';
            $seedGenres = !empty(Request::input('genres')) ? '&seed_genres=' . implode('&', Request::input('genres')) : '';

            $httpMethod = 'GET';
            $endpoint = 'https://api.spotify.com/v1/recommendations?limit=' . $limit . $seedGenres . $seedFeatures;
            $recommendations = CommonFunctions::executeHTTPRequest($client, $httpMethod, $endpoint);

            // Get IDs of recommended tracks.
            $recommendedTrackURIs = [];
            foreach($recommendations as $recommendation){
                foreach ($recommendation as $track) {
                    if (isset($track['uri'])){
                        array_push($recommendedTrackURIs, $track['uri']);
                    }
                }
            }

            $name = Request::input('playlistInfo.name');
            $description = Request::input('playlistInfo.description');
            $public = Request::input('playlistInfo.publicity');

            // Create new playlist to add tracks into.
            $createdPlaylist = self::createPlaylist($name, $description, $public);
            if($createdPlaylist->getStatusCode() === 200 || $createdPlaylist->getStatusCode() === 201) {
                $createdPlaylistLocation = $createdPlaylist->getHeader('Location')[0];
            } else {
                dd('Couldn\'t create playlist');
            }

            self::addTracksToPlaylist($createdPlaylistLocation, $recommendedTrackURIs);

            // Return created playlists ID in order to show it on frontend.
            http_response_code(200);
            $createdPlaylist = json_decode($createdPlaylist->getBody()->getContents());
            return $createdPlaylist->id;
        } else {
            return redirect()->route('redirect-to-spotify');
        }
    }

    public static function createPlaylist($name, $description, $public) {
        $user = Session::get('user');
        $userId = $user->id;

        $playlistRequestBody = [
            'name' => strval($name),
            'description' => strval($description),
            'public' => strval($public)
        ];

        $createPlaylistEndpoint = 'https://api.spotify.com/v1/users/'. $userId .'/playlists';
        $client = CommonFunctions::getHTTPClient();
        $createdPlaylist = $client->request('POST', $createPlaylistEndpoint, ['json' => $playlistRequestBody]);
        return $createdPlaylist;
    }

    public static function addTracksToPlaylist($playlistLocation, $trackURIs) {
        $endpoint = $playlistLocation . '/tracks';
        $client = CommonFunctions::getHTTPClient();
        $client->request('POST', $endpoint, array('json' => $trackURIs));
    }
}
