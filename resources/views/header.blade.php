<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>@yield('title', 'Paragon')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet" >
    </head>
    <body>
        <div id="app">
            @yield('content')
        </div>
    </body>
</html>
