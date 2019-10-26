@extends('header')
@section('content')
     <div class="dashboard-page">
         <div class="container-fluid">

             <dashboard-top-bar
                avatar="{{ $user->avatar }}"
                profile-link="{{ $user->user['external_urls']['spotify'] }}"
                user-id="{{ $user->id }}">
             </dashboard-top-bar>

             <div class="row content">
                 <div class="tab-content" id="pills-tabContent">
                     <div class="tab-pane fade show active" id="pills-stats" role="tabpanel" aria-labelledby="pills-stats-tab">
                         <div class="card-columns">
                             @php($playlists = APIRequestController::getUserPlaylists($user))
                             <div class="card stats-card">
                                 @php($playlistCount = count($playlists['items']))
                                 <span class="stat-heading">{{ $playlistCount }}</span>
                                 <div class="card-body">
                                     <h5 class="card-title">No. of playlists</h5>
                                     <p class="card-text">Total number of playlists including public, private and collaborative.</p>
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
                             @foreach($playlists['items'] as $playlist)
                                 @if(isset($playlist['public']) && $playlist['public'] == true)
                                     <div class="card playlist-card">
                                         @if(isset($playlist['images'][0]['url']))
                                             <img class="card-img-top" src="{{ $playlist['images'][0]['url'] }}" alt="playlist-cover">
                                         @else
                                             <div style="font-size: 50px;">X</div>
                                         @endif
                                         <div class="card-body">
                                             <a class="card-title" href="{{ $playlist['external_urls']['spotify'] }}" target="_blank">{{ $playlist['name'] }}</a>
                                             @php($averageDanceability = APIRequestController::getAverageDanceabilityOfPlaylist($user, $playlist))
                                             <p class="card-text">
                                                 Created by: {{ $playlist['owner']['display_name'] }}<br>
                                                 Average BPM: TBD
                                                 Average Danceability: {{ $averageDanceability }} out of 1.00
                                             </p>
                                             <!-- <p class="card-text">
                                                 This is a wider card with supporting text below as a natural lead-in to additional content.
                                                 This content is a little bit longer.
                                             </p> -->
                                         </div>
                                     </div>
                                 @endif
                             @endforeach
                         </div>
                     </div>
                     <div class="tab-pane fade" id="pills-private-playlists" role="tabpanel" aria-labelledby="pills-private-playlists-tab">
                         <div class="card-columns">
                             @foreach($playlists['items'] as $playlist)
                                 @if(isset($playlist['public']) && $playlist['public'] == false)
                                     <div class="card playlist-card">
                                         @if(isset($playlist['images'][0]['url']))
                                             <img class="card-img-top" src="{{ $playlist['images'][0]['url'] }}" alt="playlist-cover">
                                         @else
                                             <div style="font-size: 50px;">X</div>
                                         @endif
                                         <div class="card-body">
                                             <a class="card-title" href="{{ $playlist['external_urls']['spotify'] }}" target="_blank">{{ $playlist['name'] }}</a>
                                             <p class="card-text">
                                                 Created by: {{ $playlist['owner']['display_name'] }}<br>
                                                 Average BPM: TBD
                                             </p>
                                             <!-- <p class="card-text">
                                                 This is a wider card with supporting text below as a natural lead-in to additional content.
                                                 This content is a little bit longer.
                                             </p> -->
                                         </div>
                                     </div>
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
