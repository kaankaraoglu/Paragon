@extends('header')
@section('content')

    @php($user = Session::get('user'))
    @php($playlists = SpotifyAPIController::getUserPlaylists())
    @php($playlistCount = count($playlists))

    <div class="dashboard-page container-fluid row">
        <drawer class="col-sm-2"
            :user="{{ json_encode($user) }}"
            empty-avatar="{{ asset('assets/spotify-logo.png') }}"
            logout-route="{{ route('logout') }}">
        </drawer>
        <div class="col-sm-10">
            <div class="row content">
                <dashboard-top-bar></dashboard-top-bar>
                <div class="tab-content playlists-container" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-stats" role="tabpanel" aria-labelledby="pills-stats-tab">
                        <div class="card-columns">
                            <stat-card
                                card-data="{{ $playlistCount }}"
                                card-title="No. of playlists"
                                card-text="Total number of playlists including public, private and collaborative.">
                            </stat-card>

                            <stat-card
                                card-data="5000"
                                card-title="total minutes of songs"
                                card-text="This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.">
                            </stat-card>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-public-playlists" role="tabpanel" aria-labelledby="pills-public-playlists-tab">
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
    </div>
@endsection
