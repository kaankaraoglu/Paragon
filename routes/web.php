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

// Pages
Route::get('/',                         'PagesController@home')->name('home');
Route::get('dashboard',                 'PagesController@dashboard')->name('dashboard');

// Login and logout
Route::get('login/spotify',             'Auth\LoginController@redirectToSpotify')->name('redirect-to-spotify');
Route::get('login/spotify/callback',    'Auth\LoginController@handleSpotifyCallback');
Route::get('logout',                    'Auth\LoginController@logout')->name('logout');

// API requests
Route::post('api/get-user-playlist',        'SpotifyAPIController@getUserPlaylists');
Route::post('api/get-audio-features',       'SpotifyAPIController@getAverageFeatureOfPlaylist');
Route::post('api/get-user-top-artists',     'SpotifyAPIController@getUserTopArtists');
Route::post('api/get-user-top-tracks',      'SpotifyAPIController@getUserTopTracks');
