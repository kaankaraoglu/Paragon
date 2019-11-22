<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\CommonFunctions;
use Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public static function redirectToSpotify() {
        CommonFunctions::flushSession();
        $scopes = [
            'user-top-read',
            'playlist-read-private',
            'playlist-read-collaborative',
            'playlist-modify-public',
            'playlist-modify-private'
        ];

        return Socialite::driver('spotify')
            ->with(['show_dialog' => 'true'])
            ->scopes($scopes)
            ->redirect();
    }

    public function handleSpotifyCallback() {
        CommonFunctions::flushSession();
        $user = Socialite::driver('spotify')->stateless()->user();

        if (!Session::has('user') && !Session::has('loginTime')){
            date_default_timezone_set('Europe/Stockholm');
            Session::put('loginTime', date('Y-m-d H:i:s'));
            Session::put('user', $user);
        }

        return redirect()->route('dashboard');
    }

    public function logout() {
        CommonFunctions::flushSession();
        return redirect('/');
    }
}
