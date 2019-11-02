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
            <a href="{{ route('redirect-to-spotify') }}" class="spotify-button">Login with Spotify</a>
        </div>
    </div>
@endsection
