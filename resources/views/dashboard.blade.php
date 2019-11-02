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
            <div class="row">
                <div class="col-3">
                    <dashboard-side-bar :user="{{ json_encode($user) }}"></dashboard-side-bar>
                </div>
                <div class="col-9">
                    <div class="row content">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-stats" role="tabpanel" aria-labelledby="pills-stats-tab">
                                <div class="card-columns">
                                    @php($playlists = APIRequestController::getUserPlaylists())
                                    @php($playlistCount = count($playlists['items']))

                                    <stat-card
                                        card-data="{{ $playlistCount }}"
                                        card-title="No. of playlists"
                                        card-text="Total number of playlists including public, private and collaborative.">
                                    </stat-card>

                                    <stat-card
                                        card-data="50"
                                        card-title="Card title that wraps to a new line"
                                        card-text="This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.">
                                    </stat-card>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-public-playlists" role="tabpanel" aria-labelledby="pills-public-playlists-tab">
                                <div class="card-columns">
                                    @foreach($playlists['items'] as $playlist)
                                        @if(isset($playlist['public']) && $playlist['public'] == true)
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-private-playlists" role="tabpanel" aria-labelledby="pills-private-playlists-tab">
                                <div class="card-columns">
                                    @foreach($playlists['items'] as $playlist)
                                        @if(isset($playlist['public']) && $playlist['public'] == false)
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
