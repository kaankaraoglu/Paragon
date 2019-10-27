@extends('header')
@section('content')
    <div class="heim-page">
        <div class="container">
            <img class="paragon-logo" alt="paragon-logo" src="{{ asset('assets/paragon-logo.png') }}">
            <h1 class="title">Paragon</h1>
            <p class="description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <div class="row made-with">
                <span>
                    Made with <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank">&#10084;&#65039;</a><br>
                    Using
                    <a href="https://laravel.com/" target="_blank">
                        <img class="laravel-logo" alt="laravel-logo" src="{{ asset('assets/laravel-logo.png') }}">
                    </a>
                    and
                    <a href="https://vuejs.org/" target="_blank">
                        <img class="vue-logo" alt="vue-logo" src="{{ asset('assets/vue-logo.png') }}">
                    </a>
                </span>
            </div>
            <a href="{{ route('redirect-to-spotify') }}" class="spotify-button">Login with Spotify</a>
        </div>
    </div>
@endsection
