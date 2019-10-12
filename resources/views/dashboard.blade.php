@extends('header')
@section('content')
    <div class="dashboard-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4 drawer">
                    <h1 class="heading">Dashboard</h1>
                    <h4 class="login-status">Status: Logged In &#129304;</h4>
                    <h2 class="user-info-heading">User Information</h2>
                    <p>Username: {{ $user->id }}</p>
                    <p>Profile: <a href="{{ $user->user['external_urls']['spotify'] }}">{{ $user->user['external_urls']['spotify'] }}</a></p>
                    <p>Playlists: 123</p>
                    <br><br><br><br><br><br>
                    <br><br><br><br><br><br>
                    <br><br><br><br><br><br>
                    <a href="{{ route('logout-from-spotify') }}" class="spotify-button">Logout</a>
                </div>
                <div class="col-sm-8 content">
                    <div class="row content-row">
                        <div class="card col-sm">
                            <div class="card-data">50</div>
                            <div class="card-body">
                                <h5 class="card-title">Average playlist duration in minutes</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                            </div>
                        </div>

                        <div class="card col-sm">
                            <div class="card-data">50</div>
                            <div class="card-body">
                                <h5 class="card-title">Average playlist duration in minutes</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                            </div>
                        </div>

                        <div class="card col-sm">
                            <div class="card-data">50</div>
                            <div class="card-body">
                                <h5 class="card-title">Average playlist duration in minutes</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                            </div>
                        </div>

                        <div class="card col-sm">
                            <div class="card-data">50</div>
                            <div class="card-body">
                                <h5 class="card-title">Average playlist duration in minutes</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="row content-row">
                        <div class="card col-sm">
                            <div class="card-data">50</div>
                            <div class="card-body">
                                <h5 class="card-title">Average playlist duration in minutes</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                            </div>
                        </div>
                        <div class="card col-sm">
                            <div class="card-data">50</div>
                            <div class="card-body">
                                <h5 class="card-title">Average playlist duration in minutes</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                            </div>
                        </div>
                        <div class="card col-sm">
                            <div class="card-data">50</div>
                            <div class="card-body">
                                <h5 class="card-title">Average playlist duration in minutes</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                            </div>
                        </div>
                        <div class="card col-sm">
                            <div class="card-data">50</div>
                            <div class="card-body">
                                <h5 class="card-title">Average playlist duration in minutes</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                            </div>
                        </div>
                        <div class="card col-sm">
                            <div class="card-data">50</div>
                            <div class="card-body">
                                <h5 class="card-title">Average playlist duration in minutes</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
