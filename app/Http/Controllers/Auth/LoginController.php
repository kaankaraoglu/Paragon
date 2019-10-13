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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/heim';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    // Redirect the user to the Spotify authentication page.
    public function redirectToSpotify() {
        $scopes = ['playlist-read-private', 'playlist-read-collaborative'];
        return Socialite::driver('spotify')->scopes($scopes)->redirect();
    }

    // Obtain the user information from Spotify.
    public function handleSpotifyCallback() {
        try {
            $user = Socialite::driver('spotify')->stateless()->user();
            //Auth::login($user, true);
            return view('dashboard')->with('user', $user);
        } catch (\Exception $e) {
            dd("Exception caught: " . $e);
        }
    }

    public function logout() {
        Auth::logout();
        Session::flush();
        return view('heim');
    }
}
