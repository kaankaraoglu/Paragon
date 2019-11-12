<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
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
        Session::forget('loginTime');
        $scopes = ['playlist-read-private', 'playlist-read-collaborative', 'user-top-read'];

        return Socialite::driver('spotify')
            ->with(['show_dialog' => 'true'])
            ->scopes($scopes)
            ->redirect();
    }

    public function handleSpotifyCallback() {
        Session::flush();
        Session::save();
        $user = Socialite::driver('spotify')->stateless()->user();

        if (!Session::has('user') && !Session::has('loginTime')){
            Session::put('user', $user);
            Session::put('loginTime', Carbon::now('Europe/Stockholm'));
        }

        return redirect()->route('dashboard');
    }

    public function logout() {
        Session::flush();
        Session::save();
        return redirect('/');
    }
}
