@extends('layouts.app')

@section('content')
@section('title', 'User Management')

<head>
    <!-- Your head content here -->
    <style>
        body {
            overflow: hidden;
            background-image: url("{{url('/build/assets/img/testlogo.jpg')}}");
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
        }

        body {
            background-size: 100% 100%;
        }
        .bottom-right-image {
            position: fixed;
            bottom: 30px;
            right: 0;
            max-width: 100%; /* Ensure the image doesn't exceed the viewport width */
            max-height: 100%; /* Ensure the image doesn't exceed the viewport height */
        }
    </style>
</head>

<body style="overflow: hidden;">
    <div class="navbar navbar-expand-md fixed-top navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/"></a>

            <div class="ml-auto">
                @if (Route::has('login'))
                <div class="top-left-links">
                    @auth
                    <button class="btn" style="background:#FFC850; border-radius: 0; margin-right: 5px;" onclick="window.location.href='{{ route('dashboard') }}';">Dashboard</button>
                    @else
                    <button class="btn" style="background:#FFC850; border-radius: 0; margin-right: 5px;" onclick="window.location.href='{{ route('login') }}';">Log in</button>

                    @if (Route::has('register'))
                    <button class="btn" style="background:#FFC850; border-radius: 0;" onclick="window.location.href='{{ route('register') }}';">Register</button>
                    @endif
                    @endauth
                </div>
                @endif
            </div>
        </div>
    </div>
    <div>
        <img class="bottom-right-image" src="{{ url('/build/assets/img/clientLogo.jpeg') }}" alt="Client Logo">
    </div>
    <div class="copyright row fixed-bottom text-center">
        <div class="col-md-12">
            <small>&copy; S-Square Spenta Technologies LLP | Web Version:{{env('App_Version')}} | Released on:{{env('Released_on')}}</small>
        </div>
    </div>
    </div>





    <style>
        .full-page-back-img img {
            width: 100%;
            max-width: 100%;
            height: auto;
        }

        .login-button {
            position: absolute;
            bottom: 10px;
            right: 10px;
            margin-right: 20px;
            /* Added margin-right */
            z-index: 2;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        /* Add media queries for responsiveness */
        @media screen and (max-width: 768px) {
            .login-button {
                position: relative;
                width: 100%;
                bottom: 0;
                right: 0;
                text-align: center;
                margin-top: 10px;
            }
        }
    </style>
</body>