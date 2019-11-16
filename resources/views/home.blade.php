@extends('header')
@section('content')
    <home
        login-route="{{ route('redirect-to-spotify') }}"
        opus-logo="{{ asset('assets/opus-1-logo.png') }}">
    </home>
@endsection
