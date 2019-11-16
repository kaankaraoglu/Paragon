<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    public static function home(){
        return view('home');
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
            $favArtists = [];
            $shortTermFavArtist = SpotifyAPIController::getUserTopArtists(1, 'short_term');
            $mediumTermFavArtist = SpotifyAPIController::getUserTopArtists(1, 'medium_term');
            $longTermFavArtist = SpotifyAPIController::getUserTopArtists(1, 'long_term');
            $favArtists['short_term'] = $shortTermFavArtist;
            $favArtists['medium_term'] = $mediumTermFavArtist;
            $favArtists['long_term'] = $longTermFavArtist;

            // Favourite tracks
            $favTracks = [];
            $shortTermFavTrack = SpotifyAPIController::getUserTopTracks(1, 'short_term');
            $mediumTermFavTrack = SpotifyAPIController::getUserTopTracks(1, 'medium_term');
            $longTermFavTrack = SpotifyAPIController::getUserTopTracks(1, 'long_term');
            $favTracks['short_term'] = $shortTermFavTrack;
            $favTracks['medium_term'] = $mediumTermFavTrack;
            $favTracks['long_term'] = $longTermFavTrack;

            return view('dashboard', [
                'user' => $user,
                'playlists' => $playlists,
                'playlistCount' => $playlistCount,
                'followerCount' => $followerCount,
                'favArtists' => $favArtists,
                'favTracks' => $favTracks
            ]);
        } else {
            CommonFunctions::flushSession();
            return redirect()->route('redirect-to-spotify');
        }
    }
}
