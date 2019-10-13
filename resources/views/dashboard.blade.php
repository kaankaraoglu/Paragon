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
                    <p class="user-details">
                        <strong>Username:</strong>
                        <span class="user-detail-value">{{ $user->id }}</span>
                    </p>
                    <p class="user-details">
                        <strong>Profile:</strong>
                        <a class="info-link user-detail-value" href="{{ $user->user['external_urls']['spotify'] }}" target="_blank">
                            {{ $user->user['external_urls']['spotify'] }}
                        </a>
                    </p>
                    @php($playlistCount = count($playlists))
                    <p class="user-details">
                        <strong>Total number of playlists:</strong>
                        <span class="user-detail-value">{{ $playlistCount }}</span>
                    </p>
                    <a href="{{ route('logout-from-spotify') }}" class="spotify-button">Logout</a>
                </div>
                <div class="col-sm-8 content">
                    <ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-stats-tab" data-toggle="pill" href="#pills-stats" role="tab" aria-controls="pills-stats" aria-selected="true">Stats</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Generate</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-public-playlists-tab" data-toggle="pill" href="#pills-public-playlists" role="tab" aria-controls="pills-public-playlists" aria-selected="false">Public Playlists</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-private-playlists-tab" data-toggle="pill" href="#pills-private-playlists" role="tab" aria-controls="pills-private-playlists" aria-selected="false">Private Playlists</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-stats" role="tabpanel" aria-labelledby="pills-stats-tab">
                            <div class="card-columns">
                                <div class="card stats-card">
                                    <span class="stat-heading">50</span>
                                    <div class="card-body">
                                        <h5 class="card-title">Card title that wraps to a new line</h5>
                                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    </div>
                                </div>
                                <div class="card stats-card">
                                    <span class="stat-heading">50</span>
                                    <div class="card-body">
                                        <h5 class="card-title">Card title that wraps to a new line</h5>
                                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    </div>
                                </div>
                                <div class="card stats-card">
                                    <span class="stat-heading">50</span>
                                    <div class="card-body">
                                        <h5 class="card-title">Card title that wraps to a new line</h5>
                                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    </div>
                                </div>
                                <div class="card stats-card">
                                    <span class="stat-heading">50</span>
                                    <div class="card-body">
                                        <h5 class="card-title">Card title that wraps to a new line</h5>
                                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    </div>
                                </div>
                                <div class="card stats-card">
                                    <span class="stat-heading">50</span>
                                    <div class="card-body">
                                        <h5 class="card-title">Card title that wraps to a new line</h5>
                                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-public-playlists" role="tabpanel" aria-labelledby="pills-public-playlists-tab">
                            <div class="card-columns">
                                @foreach($playlists as $playlist)
                                @if(isset($playlist['public']) && $playlist['public'] == true)
                                <div class="card playlist-card">
                                    @if(isset($playlist['images'][0]['url']))
                                    <img class="card-img-top" src="{{ $playlist['images'][0]['url'] }}" alt="playlist-cover">
                                    @else
                                    <div style="font-size: 50px;">X</div>
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $playlist['name'] }}</h5>
                                        <p class="card-text">
                                            Created by: {{ $playlist['owner']['display_name']}}<br>
                                            Average BPM: 150
                                        </p>
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-private-playlists" role="tabpanel" aria-labelledby="pills-private-playlists-tab">
                            <div class="card-columns">
                                @foreach($playlists as $playlist)
                                    @if(isset($playlist['public']) && $playlist['public'] == false)
                                        <div class="card">
                                            @if(isset($playlist['images'][0]['url']))
                                                <img class="card-img-top" src="{{ $playlist['images'][0]['url'] }}" alt="playlist-cover">
                                            @else
                                                <div style="font-size: 50px;">X</div>
                                            @endif
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $playlist['name'] }}</h5>
                                                <p class="card-text">
                                                    Created by: {{ $playlist['owner']['display_name']}}<br>
                                                    Average BPM: 150
                                                </p>
                                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
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
