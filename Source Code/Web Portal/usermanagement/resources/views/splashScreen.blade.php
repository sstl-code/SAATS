@extends('layouts.app')

@section('content')
@section('title', 'User Management')
<body>

    <div class="total-login-page1">
        <div class="full-page-back-img">
          <img src="{{('/build/assets/img/splash.png')}}" style="z-index:2; position: relative;bottom: 140px;left: 418px;">
          <button type="button" onlick="javascript::location.href={{ url('/login') }}" class="login-button" style="z-index:2">
                                    Login
             </button>
        </div>
        <div class="splash-logo">
            <img src="{{url('/build/assets/img/splash-logo.png')}}">
        </div>
    </div>
    
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>
                <style>
                   .full-page-back-img img{
                    width: 100%;
                    max-width: 1510px;
                    height: 715px
                   }
                    </style>
@endsection