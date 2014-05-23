<?php

use Bono\Helper\URL;
use Bono\App;

$app  = App::getInstance();
$meta = $app->config('meta');

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', $meta['title'])</title>

    <meta name="description" content="{{ $meta['description'] }}" />
    <meta name="author" content="{{ $meta['author'] }}" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />

    <link type="image/x-icon" href="{{ URL::base('img/favicon.ico') }}" rel="Shortcut icon" />

    <link rel="stylesheet" href="{{ URL::base('css/naked.css') }}">
    <link rel="stylesheet" href="{{ URL::base('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ URL::base('js/highlight/styles/github.css') }}">
    <link rel="stylesheet" href="{{ URL::base('css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::base('css/loadie.css') }}">

    @yield('styler')
</head>

<body>
    @include('components.navbar')

    <div class="le-content">
        {{ f('notification.show') }}
        @yield('content')
    </div>

    <script type="text/javascript" charset="utf-8" src="{{ URL::base('js/vendor/jquery.js') }}"></script>
    <script type="text/javascript" charset="utf-8" src="{{ URL::base('js/vendor/underscore.js') }}"></script>
    <script type="text/javascript" charset="utf-8" src="{{ URL::base('js/vendor/moment.js') }}"></script>
    <script type="text/javascript" charset="utf-8" src="{{ URL::base('js/vendor/jquery.loadie.js') }}"></script>
    <script type="text/javascript" charset="utf-8" src="{{ URL::base('js/global.js') }}"></script>
    <script type="text/javascript" charset="utf-8" src="{{ URL::base('js/main.js') }}"></script>
    <script type="text/javascript" charset="utf-8">
    (function(){
        var URL_SITE = window.URL_SITE = '{{ URL::site() }}',
            URL_BASE = window.URL_BASE = '{{ URL::base() }}';}
    )();
    </script>

    @yield('injector')
</body>
</html>
