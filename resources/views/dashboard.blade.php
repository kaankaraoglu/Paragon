@extends('header')
@section('content')
    <div class="dashboard-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4 drawer">
                    <h1 class="heading">Dashboard</h1>
                    <h4 class="login-status">Status: Logged In &#129304;</h4>
                    <h2 class="user-info-heading">User Information</h2>
                    @php ($playlists = APIRequestController::getUserPlaylists($user))
                    <p>Username: {{ $user->id }}</p>
                    <p>Profile: <a class="info-link" href="{{ $user->user['external_urls']['spotify'] }}">{{ $user->user['external_urls']['spotify'] }}</a></p>
                    @php($playlistCount = count($playlists))
                    <p>No. of playlists: {{ $playlistCount }}</p>
                    <a href="{{ route('logout-from-spotify') }}" class="spotify-button">Logout</a>
                </div>
                <div class="col-sm-8 content">
                    <ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-stats-tab" data-toggle="pill" href="#pills-stats" role="tab" aria-controls="pills-stats" aria-selected="true">Stats</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-public-playlists-tab" data-toggle="pill" href="#pills-public-playlists" role="tab" aria-controls="pills-public-playlists" aria-selected="false">Public Playlists</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-private-playlists-tab" data-toggle="pill" href="#pills-private-playlists" role="tab" aria-controls="pills-private-playlists" aria-selected="false">Private Playlists</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-stats" role="tabpanel" aria-labelledby="pills-stats-tab">
                            <div class="row content-row">
                                <div class="card col-sm">
                                    <div class="card-data">40</div>
                                    <div class="card-body">
                                        <h5 class="card-title">Average playlist duration in minutes</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            
                                <div class="card col-sm">
                                    <div class="card-data">40</div>
                                    <div class="card-body">
                                        <h5 class="card-title">Average playlist duration in minutes</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            
                                <div class="card col-sm">
                                    <div class="card-data">40</div>
                                    <div class="card-body">
                                        <h5 class="card-title">Average playlist duration in minutes</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            
                                <div class="card col-sm">
                                    <div class="card-data">40</div>
                                    <div class="card-body">
                                        <h5 class="card-title">Average playlist duration in minutes</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-public-playlists" role="tabpanel" aria-labelledby="pills-public-playlists-tab">
                            <div class="row content-row">
                                @foreach($playlists as $playlist)
                                    @if(isset($playlist['public']) && $playlist['public'] == true)
                                        <div class="card">
                                            @if(isset($playlist['images'][0]['url']))
                                                <img src="{{ $playlist['images'][0]['url'] }}" class="card-img-top" alt="playlist-cover">
                                            @else
                                                <div style="font-size: 50px;">X</div>                                            
                                            @endif
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $playlist['name'] }}</h5>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            </div>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Average BPM:</li>
                                                <li class="list-group-item">Dapibus ac facilisis in</li>
                                                <li class="list-group-item">Vestibulum at eros</li>
                                            </ul>
                                            <div class="card-body">
                                                <a href="{{ $playlist['external_urls']['spotify'] }}" class="spotify-button" target="_blank">Play on Spotify</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-private-playlists" role="tabpanel" aria-labelledby="pills-private-playlists-tab">
                            <div class="row content-row">
                                @foreach($playlists as $playlist)
                                    @if(isset($playlist['public']) && $playlist['public'] == false)
                                        <div class="card">
                                            @if(isset($playlist['images'][0]['url']))
                                                <img src="{{ $playlist['images'][0]['url'] }}" class="card-img-top" alt="playlist-cover">
                                            @else
                                                <div style="font-size: 50px;">X</div>
                                            @endif
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $playlist['name'] }}</h5>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            </div>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Average BPM:</li>
                                                <li class="list-group-item">Dapibus ac facilisis in</li>
                                                <li class="list-group-item">Vestibulum at eros</li>
                                            </ul>
                                            <div class="card-body">
                                                <a href="{{ $playlist['external_urls']['spotify'] }}" class="spotify-button" target="_blank">Play on Spotify</a>
                                            </div>
                                        </div>
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
@endsection
