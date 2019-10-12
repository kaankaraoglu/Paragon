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

Route::get('/', function () { return view('heim'); }) -> name('heim');

//Route::get('/login', 'loginController@login')->name('redirect-to-spotify');

Route::get('/spotify_login', 'Auth\SpotifyAuthController@redirectToProvider')->name('redirect-to-spotify');
Route::get('/spotify_callback', 'Auth\SpotifyAuthController@handleProviderCallback');
