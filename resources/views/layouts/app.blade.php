<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ url('css/bootstrap.min.cssfont-awesome.min.csselegant-icons.cssnice-select.cssjquery-ui.min.cssowl.carousel.min.cssslicknav.min.cssstyle.css.pagespeed.cc.4YNTZ7I7f2.css') }}" type="text/css" />

</head>
<body>

@include('layouts.header')


@yield('content')


@include('layouts.footer')

<script src="{{ url('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ url('js/bootstrap.min.js.jquery.nice-select.min.js.pagespeed.jc.08NHUfMhux.js')}}"></script>
<script src="{{ url('js/jquery-ui.min.js')}}"></script>
<script src="{{ url('js/jquery.slicknav.js')}}"></script>
<script src="{{ url('js/mixitup.min.js')}}"></script>
<script src="{{ url('js/owl.carousel.min.js')}}"></script>
<script src="{{ url('js/main.js')}}"></script>
</body>
</html>
