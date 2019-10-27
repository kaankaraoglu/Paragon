<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
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
        $scopes = ['playlist-read-private', 'playlist-read-collaborative'];
        return Socialite::driver('spotify')
            ->with(['show_dialog' => 'true'])
            ->scopes($scopes)
            ->redirect();
    }

    public function handleSpotifyCallback(Request $request) {
        $user = Socialite::driver('spotify')
            ->stateless()
            ->user();

        Session::put('user', $user);
        Session::save();

        return redirect()->route('dashboard');
    }

    public function logout() {
        Auth::logout();
        Session::flush();
        return view('heim');
    }
}
