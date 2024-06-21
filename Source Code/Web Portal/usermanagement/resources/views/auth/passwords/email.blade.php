@extends('layouts.app')

@section('content')
@section('title', 'Reset Password')

<div class="navbar navbar-expand-md navbar-light">
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

<div class="total-login-page">
    <div class="full-page-back-img">
        <div class="row">
            <div class="col-md-6 d-none d-md-block d-lg-block">

            </div>

            <div class="col-md-6">
                
                <form method="POST" action="{{ route('password.email') }}">
        @csrf
                    <div class="login-form">
                        <div class="logo">
                            <img src="{{url('/build/assets/img/SSTLLogo-white.png')}}">
                        </div>
                        
                        <div class=" login-form-input">

                            
                                <label for="email" class=" col-form-label ">{{ __('Email Address') }}</label>

                                <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif  
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                       

                       
                        <div class="row mb-0">
                            <div class="" style="">
                                <button type="submit" class="emailsend-button">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
<style>
    body {
        background-image: url("{{url('/build/assets/img/loginbackground.png')}}");
        background-repeat: no-repeat;
        background-size: cover;
        /* background-position: center; */
    }
</style>
<script>
            function password_show_hide() {
                        debugger;
                    var x = document.getElementById("password");
                    var show_eye = document.getElementById("show_eye");
                    var hide_eye = document.getElementById("hide_eye");
                    show_eye.classList.remove("d-none");
                    if (x.type === "password") {
                    x.type = "text";
                    show_eye.style.display = "block";
                    hide_eye.style.display = "none";
    
                } else {
                x.type = "password";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
              }
            }
</script>
@endsection
