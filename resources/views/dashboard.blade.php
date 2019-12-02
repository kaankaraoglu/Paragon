@extends('header')
@section('content')
    <div class="dashboard-page row">
        <drawer class="col-2"
            :user="{{ json_encode($user) }}"
            empty-avatar="{{ asset('assets/spotify-logo.png') }}"
            logout-route="{{ route('logout') }}"
            home-route="{{ route('dashboard') }}"
            follower-count="{{ $followerCount }}"
            playlist-count="{{ $playlistCount }}"
            :fav-artists="{{ json_encode($favArtists) }}"
            :fav-tracks="{{ json_encode($favTracks) }}">
        </drawer>
        <div class="col-10 content">
            <div class="row dashboard-top-bar">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link rounded-pill active" id="pills-public-playlists-tab" data-toggle="pill" href="#pills-public-playlists" role="tab" aria-controls="pills-public-playlists" aria-selected="true">Public Playlists</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded-pill" id="pills-private-playlists-tab" data-toggle="pill" href="#pills-private-playlists" role="tab" aria-controls="pills-private-playlists" aria-selected="false">Private Playlists</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded-pill" id="pills-generate-tab" data-toggle="pill" href="#pills-generate" role="tab" aria-controls="pills-generate" aria-selected="false">Generate!</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content playlists-container" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-public-playlists" role="tabpanel" aria-labelledby="pills-public-playlists-tab">
                    <playlist-card-masonary :playlists="{{ json_encode($playlists) }}" :public="true"></playlist-card-masonary>
                </div>
                <div class="tab-pane fade" id="pills-private-playlists" role="tabpanel" aria-labelledby="pills-private-playlists-tab">
                    <playlist-card-masonary :playlists="{{ json_encode($playlists) }}" :public="false"></playlist-card-masonary>
                </div>
                <div class="tab-pane fade" id="pills-generate" role="tabpanel" aria-labelledby="pills-generate-tab">
                    <playlist-generator></playlist-generator>
                </div>
            </div>
        </div>
    </div>
@endsection
