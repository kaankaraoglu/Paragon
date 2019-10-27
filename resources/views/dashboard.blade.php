@extends('header')
@section('content')
    @php($user = Session::get('user'))
    @php($wantedFeatures = [
        'tempo',
        'danceability',
        'energy',
        'acousticness',
        'instrumentalness',
        'liveness',
        'loudness',
        'mode',
        'speechiness',
        'valence'
    ])
    <div class="dashboard-page">
        <div class="container-fluid">

            <dashboard-top-bar :user="{{ json_encode($user) }}"></dashboard-top-bar>

            <div class="row content">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-stats" role="tabpanel" aria-labelledby="pills-stats-tab">
                        <div class="card-columns">
                            @php($playlists = APIRequestController::getUserPlaylists($user))
                            @php($playlistCount = count($playlists['items']))

                            <stat-card
                                card-data="{{ $playlistCount }}"
                                card-title="No. of playlists"
                                card-text="Total number of playlists including public, private and collaborative.">
                            </stat-card>

                            @for ($i = 0; $i < 15; $i++)
                                <stat-card
                                    card-data="50"
                                    card-title="Card title that wraps to a new line"
                                    card-text="This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.">
                                </stat-card>
                            @endfor
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-public-playlists" role="tabpanel" aria-labelledby="pills-public-playlists-tab">
                        <div class="card-columns">
                            @foreach($playlists['items'] as $playlist)
                                @php($features = APIRequestController::getAverageFeatureOfPlaylist($user, $playlist, $wantedFeatures))
                                @if(isset($playlist['public']) && $playlist['public'] == true)
                                    <playlist-card
                                        card-text=""
                                        :user="{{  json_encode($user) }}"
                                        :playlist="{{ json_encode($playlist) }}"
                                        :features="{{ json_encode($features) }}">
                                    </playlist-card>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-private-playlists" role="tabpanel" aria-labelledby="pills-private-playlists-tab">
                        <div class="card-columns">
                            @foreach($playlists['items'] as $playlist)
                                @if(isset($playlist['public']) && $playlist['public'] == false)
                                    <playlist-card
                                        card-text=""
                                        :user="{{  json_encode($user) }}"
                                        :playlist="{{ json_encode($playlist) }}"
                                        :features="{{ json_encode($features) }}">
                                    </playlist-card>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
                </div>
            </div>
            <a href="{{ route('logout-from-spotify') }}" class="spotify-button">Logout</a>
        </div>
    </div>
@endsection