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

            $user = Session::get('user');
            $playlists = SpotifyAPIController::getUserPlaylists();
            $playlistCount = count($playlists);
            $followerCount = $user->user['followers']['total'];
            $shortTermFavArtist = SpotifyAPIController::getUserTopArtists(1, 'short_term');
            $mediumTermFavArtist = SpotifyAPIController::getUserTopArtists(1, 'medium_term');
            $longTermFavArtist = SpotifyAPIController::getUserTopArtists(1, 'long_term');
            $playlists = SpotifyAPIController::getUserPlaylists();

            return view('dashboard', [
                'user' => $user,
                'playlists' => $playlists,
                'playlistCount' => $playlistCount,
                'followerCount' => $followerCount,
                'shortTermFavArtist' => $shortTermFavArtist,
                'mediumTermFavArtist' => $mediumTermFavArtist,
                'longTermFavArtist' => $longTermFavArtist
            ]);
        } else {
            CommonFunctions::flushSession();
            return redirect()->route('redirect-to-spotify');
        }
    }
}
