<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\Http\Controllers\Controller;

class SpotifyAuthController extends Controller {
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider()
    {
        return Socialite::driver('spotify')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('spotify')->user();
            $accessTokenResponseBody = $user->accessTokenResponseBody;
            $user->token;
        } catch (\Exception $e) {
            dd($e);
        }
        return redirect()->route('heim');
    }
}
