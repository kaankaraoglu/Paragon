<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Opus 1')</title>

        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/spotify_favicon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/spotify_favicon.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/spotify_favicon.png') }}">
    </head>
    <body>
        <div id="app">
            <div class="top-border"></div>
            @yield('content')
        </div>
    </body>
</html>
