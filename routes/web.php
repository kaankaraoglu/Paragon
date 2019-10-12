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

Route::get('/', function () { return view('heim'); })->name('heim');
Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

Route::get('/spotify_login', 'Auth\LoginController@redirectToSpotify')->name('redirect-to-spotify');
Route::get('/spotify_callback', 'Auth\LoginController@handleSpotifyCallback');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout-from-spotify');

//Route::get('/logout', 'Auth\LoginController@logout')
