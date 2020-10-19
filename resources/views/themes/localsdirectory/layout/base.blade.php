<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Yoga Studio Template">
    <meta name="keywords" content="Yoga, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')
    @if(Route::current()->uri == "/")
        <title>Better Reviews</title>
    @else
        <title>@yield ('page_name') | Better Reviews</title>
    @endif
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ parse_url(asset('css/bootstrap.min.css'), PHP_URL_PATH) }}" type="text/css">
    <!-- PLugins -->
    <link rel="stylesheet" href="{{ parse_url(asset('css/font-awesome.min.css'), PHP_URL_PATH) }}" type="text/css">
    <link rel="stylesheet" href="{{ parse_url(asset('css/flaticon.css'), PHP_URL_PATH) }}" type="text/css">
    <link rel="stylesheet" href="{{ parse_url(asset('css/nice-select.css'), PHP_URL_PATH) }}" type="text/css">
    <link rel="stylesheet" href="{{ parse_url(asset('css/owl.carousel.min.css'), PHP_URL_PATH) }}" type="text/css">
    <link rel="stylesheet" href="{{ parse_url(asset('css/magnific-popup.css'), PHP_URL_PATH) }}" type="text/css">
    <link rel="stylesheet" href="{{ parse_url(asset('css/slicknav.min.css'), PHP_URL_PATH) }}" type="text/css">
    <!-- Custom -->
    <link rel="stylesheet" href="{{ parse_url(asset('css/app.css'), PHP_URL_PATH) }}" type="text/css">
    @yield ('styles')
</head>

<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Header Section Begin -->
@include ('themes.localsdirectory.layout.header.base')
<!-- Header End -->
@include ('themes.localsdirectory.layout.section.error.base')
@include ('themes.localsdirectory.layout.section.message.base')
@yield('content')
<!-- Footer Section Begin -->
@include ('themes.localsdirectory.layout.footer.base')
<!-- Footer Section End -->

<!-- Js Plugins -->
<script src="{{ parse_url(asset('js/jquery-3.3.1.min.js'), PHP_URL_PATH) }}"></script>
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
<script src="{{ parse_url(asset('js/bootstrap.min.js'), PHP_URL_PATH) }}"></script>
<!-- Plugins -->
<script src="{{ parse_url(asset('js/jquery.magnific-popup.min.js'), PHP_URL_PATH) }}"></script>
<script src="{{ parse_url(asset('js/jquery.slicknav.js'), PHP_URL_PATH) }}"></script>
<script src="{{ parse_url(asset('js/owl.carousel.min.js'), PHP_URL_PATH) }}"></script>
<script src="{{ parse_url(asset('js/jquery.nice-select.min.js'), PHP_URL_PATH) }}"></script>
<script src="{{ parse_url(asset('js/mixitup.min.js'), PHP_URL_PATH) }}"></script>
<!-- Custom -->
<script src="{{ parse_url(asset('js/main.js'), PHP_URL_PATH) }}"></script>
@yield ('scripts')
</body>
</html>
