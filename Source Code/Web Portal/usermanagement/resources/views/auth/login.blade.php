@extends('layouts.app')

@section('content')
@section('title', 'Log in')
<div class="total-login-page">
    <div class="full-page-back-img">
        <div class="row">
            <div class="col-md-6 d-none d-md-block d-lg-block">

            </div>

            <div class="col-md-6 p-0">
                <form method="POST" action="{{ url('userLogin') }}" style="min-height: 400px;">
                    @csrf
                    <div class="login-form">
                        <div class="logo">
                            <img src="{{url('/build/assets/img/SSTLLogo-white.png')}}">
                        </div>
                        <div class="login-form-input">
                            <label for="email" class=" col-form-label ">{{ __('Email Address') }}</label>

                            <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" style=" margin-bottom: 0px;">{{ $error }}</div>
                            @endforeach
                        </div>

                        <div class="login-form-input">
                            <label for="password" class=" col-form-label">{{ __('Password') }}</label>
                            <div class="password-input">
                                <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <span class='ab' onclick="password_show_hide();">
                                    <i class="fas fa-eye d-none eyeicon" id="show_eye"></i>
                                    <i class="fas fa-eye-slash eyeicon" id="hide_eye"></i>
                                </span>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                {{-- <button><img src="{{url('/build/assets/img/seen-off.svg')}}"></button> --}}
                            </div>
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>

                        <div class="remembercheckbox">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        <button type="submit" class="login-button">
                            {{ __('Login') }}
                        </button>
                        <p class="text-center" style="color:#FFC850;">Don't have an account? <a class="loginLink" href="{{ route('register') }}"> Click here to register</a></p>
                        <div class="text-white" style="text-align: center">
                            <small>&copy; S-Square Spenta Technologies LLP</small>

                        </div>
                        <div class="text-white row m-2">
                            <span style="text-align: left" class="col-5">
                                <small>Web Version:{{env('App_Version')}}</small>
                            </span>
                            <span style="text-align: right" class="col-7">
                                <small>Released on:{{env('Released_on')}}</small>
                            </span>
                        </div>
                    </div>


                </form>

            </div>
        </div>
    </div>
</div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<style>
    body {
        background-image: url("{{url('/build/assets/img/loginbackground.png')}}");
        background-repeat: no-repeat;
        background-size: 100% 100%;
        /* height: 100vh; */
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