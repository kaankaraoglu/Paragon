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
Route::get('/',                         'PagesController@heim')->name('heim');
Route::get('dashboard',                 'PagesController@dashboard')->name('dashboard');

// Login and logout
Route::get('login/spotify',             'Auth\LoginController@redirectToSpotify')->name('redirect-to-spotify');
Route::get('login/spotify/callback',    'Auth\LoginController@handleSpotifyCallback');
Route::get('logout',                    'Auth\LoginController@logout')->name('logout');

// API requests
// Route::get('/{user}', 'APIRequestController@getUserPlaylists')->name('get-user-playlists');
