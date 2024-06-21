<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{url('/build/assets/img/favicon.png" rel="icon')}}">
    <link href="{{url('/build/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="{{url('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet')}}">

    <!-- Vendor CSS Files -->
    <link href="{{url('/build/assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{url('/build/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('/build/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{url('/build/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{url('/build/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{url('/build/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
    <link href="{{url('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css')}}">
    <link href="{{url('/build/assets/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}

        <main class="">
            @yield('content')
        </main>
    </div>

    
<!-- Vendor JS Files -->
<script src="{{url('/build/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
<script src="{{url('/build/assets/vendor/aos/aos.js')}}"></script>
<script src="{{url('/build/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('/build/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
<script src="{{url('/build/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
<script src="{{url('/build/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{url('/build/assets/vendor/typed.js/typed.min.js')}}"></script>
<script src="{{url('/build/assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
<script src="{{url('/build/assets/vendor/php-email-form/validate.js')}}"></script>

<!-- Template Main JS File -->
<script src="{{url('/build/assets/js/main.js')}}"></script>
<script src="{{url('https://code.jquery.com/jquery-3.5.1.js')}}"></script>
</body>
</html>
