@extends('header')
@section('content')
    <div class="dashboard-page row">
        <drawer class="col-2"
            :user="{{ json_encode($user) }}"
            empty-avatar="{{ asset('assets/spotify-logo.png') }}"
            logout-route="{{ route('logout') }}"
            follower-count="{{ $followerCount }}"
            playlist-count="{{ $playlistCount }}"
            :fav-artists="{{ json_encode($favArtists) }}"
            :fav-tracks="{{ json_encode($favTracks) }}">
        </drawer>
        <div class="col-10 content">
            <dashboard-top-bar></dashboard-top-bar>
            <div class="tab-content playlists-container" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-public-playlists" role="tabpanel" aria-labelledby="pills-public-playlists-tab">
                    <div class="card-columns">
                        @foreach($playlists as $playlist)
                            @if(isset($playlist['public']) && $playlist['public'] == true)
                                <playlist-card :playlist="{{ json_encode($playlist) }}"></playlist-card>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-private-playlists" role="tabpanel" aria-labelledby="pills-private-playlists-tab">
                    <div class="card-columns">
                        @foreach($playlists as $playlist)
                            @if(isset($playlist['public']) && $playlist['public'] == false)
                                <playlist-card :playlist="{{ json_encode($playlist) }}"></playlist-card>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-generate" role="tabpanel" aria-labelledby="pills-generate-tab">
                    <playlist-generator></playlist-generator>
                </div>
            </div>
        </div>
    </div>
@endsection
