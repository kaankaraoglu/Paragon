@extends('header')
@section('content')
    <div class="heim-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col opus-1-col">
                    <img class="opus-1-logo" alt="opus-1-logo" src="{{ asset('assets/opus-1-logo.png') }}">
                    <p class="title">Opus 1</p>
                    <p class="description">
                        Opus 1 is a tool that displays interesting information about Spotify playlists, such as average audio features and statistics.
                        It also generates playlists based on audio features such as BPM, danceability, instrumentalness, energy et cetera.
                        Powered by Spotify API, Laravel and Vue. Enjoy!
                    </p>
                    <a href="{{ route('redirect-to-spotify') }}" class="spotify-button">Login with Spotify</a>
                </div>
            </div>
        </div>
    </div>
@endsection
