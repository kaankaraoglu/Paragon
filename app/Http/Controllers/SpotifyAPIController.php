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
}
