<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    public static function heim(){
        return view('heim');
    }

    public static function dashboard(){
        if (CommonFunctions::sessionIsValid()){
            // User information
            $user = Session::get('user');
            $followerCount = $user->user['followers']['total'];

            // Playlists
            $playlists = SpotifyAPIController::getUserPlaylists();
            $playlistCount = count($playlists);

            // Favourite artists
            $shortTermFavArtist = SpotifyAPIController::getUserTopArtists(1, 'short_term');
            $mediumTermFavArtist = SpotifyAPIController::getUserTopArtists(1, 'medium_term');
            $longTermFavArtist = SpotifyAPIController::getUserTopArtists(1, 'long_term');

            // Favourite tracks
            $shortTermFavTrack = SpotifyAPIController::getUserTopTracks(1, 'short_term');
            $mediumTermFavTrack = SpotifyAPIController::getUserTopTracks(1, 'medium_term');
            $longTermFavTrack = SpotifyAPIController::getUserTopTracks(1, 'long_term');

            return view('dashboard', [
                'user' => $user,
                'playlists' => $playlists,
                'playlistCount' => $playlistCount,
                'followerCount' => $followerCount,
                'shortTermFavArtist' => $shortTermFavArtist,
                'mediumTermFavArtist' => $mediumTermFavArtist,
                'longTermFavArtist' => $longTermFavArtist,
                'shortTermFavTrack' => $shortTermFavTrack,
                'mediumTermFavTrack' => $mediumTermFavTrack,
                'longTermFavTrack' => $longTermFavTrack
            ]);
        } else {
            CommonFunctions::flushSession();
            return redirect()->route('redirect-to-spotify');
        }
    }
}
