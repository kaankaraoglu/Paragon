<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('heim');
})->name('heim');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Authentication
Route::get('login/spotify', 'Auth\LoginController@redirectToSpotify')->name('redirect-to-spotify');
Route::get('login/spotify/callback', 'Auth\LoginController@handleSpotifyCallback');
Route::get('/', 'Auth\LoginController@logout')->name('logout-from-spotify');

// API requests
// Route::get('/{user}', 'APIRequestController@getUserPlaylists')->name('get-user-playlists');
