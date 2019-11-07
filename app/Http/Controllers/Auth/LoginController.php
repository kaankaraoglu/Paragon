<?php

namespace App\Http\Controllers\Auth;

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

    public function redirectToSpotify() {
        $scopes = ['playlist-read-private', 'playlist-read-collaborative', 'user-top-read'];

        Session::flush();
        return Socialite::driver('spotify')
            ->with(['show_dialog' => 'true'])
            ->scopes($scopes)
            ->redirect();
    }

    public function handleSpotifyCallback() {
        $user = Socialite::driver('spotify')->stateless()->user();
        Session::put('user', $user);
        return redirect()->route('dashboard');
    }

    public function logout() {
        Session::flush();
        return redirect('/');
    }
}
