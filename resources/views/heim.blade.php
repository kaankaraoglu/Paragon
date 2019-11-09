@extends('header')
@section('content')
    <div class="heim-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col paragon-col">
                    <img class="paragon-logo" alt="paragon-logo" src="{{ asset('assets/paragon-logo.png') }}">
                    <p class="title">Paragon</p>
                    <p class="description">
                        Paragon is a tool you can use to display average audio features for your playlists, overall stats.
                        You can also generate playlists based on audio features such as BPM, danceability, instrumentalness, energy and more.
                        Developed using Spotify API, Laravel and Vue.
                    </p>
                    <a href="{{ route('redirect-to-spotify') }}" class="spotify-button">Login with Spotify</a>
                </div>
            </div>
        </div>
    </div>
@endsection
