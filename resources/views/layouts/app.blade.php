<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BLOG') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{--    custom--}}
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/animate.css')}}">

{{--    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">--}}
{{----}}
{{--    <link rel="stylesheet" href="{{asset('assets/css/aos.css')}}">--}}
{{----}}
    <link rel="stylesheet" href="{{asset('assets/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/jquery.timepicker.css')}}">


    <link rel="stylesheet" href="{{asset('assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        #top-alert {
            position: fixed;
            top: 0;
            z-index: 99999;
            width: 100%;
        }
    </style>
    @yield('style')


</head>
<body>
<div id="app">
    {{--        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">--}}
    {{--            <div class="container">--}}
    {{--                <a class="navbar-brand" href="{{ url('/') }}">--}}
    {{--                    {{ config('app.name', 'Laravel') }}--}}
    {{--                </a>--}}
    {{--                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
    {{--                    <span class="navbar-toggler-icon"></span>--}}
    {{--                </button>--}}

    {{--                <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
    {{--                    <!-- Left Side Of Navbar -->--}}
    {{--                    <ul class="navbar-nav me-auto">--}}

    {{--                    </ul>--}}

    {{--                    <!-- Right Side Of Navbar -->--}}
    {{--                    <ul class="navbar-nav ms-auto">--}}
    {{--                        <!-- Authentication Links -->--}}
    {{--                        @guest--}}
    {{--                            @if (Route::has('login'))--}}
    {{--                                <li class="nav-item">--}}
    {{--                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
    {{--                                </li>--}}
    {{--                            @endif--}}

    {{--                            @if (Route::has('register'))--}}
    {{--                                <li class="nav-item">--}}
    {{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
    {{--                                </li>--}}
    {{--                            @endif--}}
    {{--                        @else--}}
    {{--                            <li class="nav-item dropdown">--}}
    {{--                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
    {{--                                    {{ Auth::user()->name }}--}}
    {{--                                </a>--}}

    {{--                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">--}}
    {{--                                    <a class="dropdown-item" href="{{ route('logout') }}"--}}
    {{--                                       onclick="event.preventDefault();--}}
    {{--                                                     document.getElementById('logout-form').submit();">--}}
    {{--                                        {{ __('Logout') }}--}}
    {{--                                    </a>--}}

    {{--                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
    {{--                                        @csrf--}}
    {{--                                    </form>--}}
    {{--                                </div>--}}
    {{--                            </li>--}}
    {{--                        @endguest--}}
    {{--                    </ul>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </nav>--}}

    <main class="py-4">
        <div class="card-body">
            <div id="colorlib-page">
                @if(!Request::is('login','register'))
                    @include('layouts.aside')
                @endif
                @yield('content')
            </div>
        </div>

    </main>
</div>


<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-migrate-3.0.1.min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.easing.1.3.js')}}"></script>
<script src="{{asset('assets/js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.stellar.min.js')}}"></script>
<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('assets/js/aos.js')}}"></script>
<script src="{{asset('assets/js/jquery.animateNumber.min.js')}}"></script>
<script src="{{asset('assets/js/scrollax.min.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="{{asset('assets/js/google-map.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
@include('sweetalert::alert')
@yield('script')
</body>

</html>
