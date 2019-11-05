@extends('header')
@section('content')
    <div class="heim-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col kaan-col">
                    {{--<img class="kaan-avatar" alt="Kaan Karaoglu" src="{{ asset('assets/kaan-avatar.png') }}">
                    <h1 class="title">Kaan Karaoglu</h1>
                    <p class="description">Personal website</p>--}}
                    <kaan-karaoglu class="kaan-karaoglu"></kaan-karaoglu>
                </div>
                <div class="col paragon-col">
                    <img class="paragon-logo" alt="paragon-logo" src="{{ asset('assets/paragon-logo.png') }}">
                    <p class="title">Paragon</p>
                    <p class="description">
                        Paragon started off as a side-project to learn Spotify API, Vue.js and Laravel.
                        It shows average audio features for each of the user's playlists such as BPM, danceability, instrumentalness, energy etc.
                        accompanied by overall stats.
                    </p>
                    <a href="{{ route('redirect-to-spotify') }}" class="spotify-button">Login with Spotify</a>
                </div>
            </div>
        </div>
    </div>
@endsection
