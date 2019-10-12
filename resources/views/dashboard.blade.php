@extends('header')
@section('content')
    <div class="dashboard-page">
        <h1 class="dashboard-heading">Dashboard</h1>
        <h4 class="description" style="text-align: center;">You are logged in!</h4>
        <a href="{{ route('logout-from-spotify') }}" class="spotify-button">Logout</a>
    </div>
@endsection
