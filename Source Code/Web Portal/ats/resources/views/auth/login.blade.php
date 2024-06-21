@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>

<body>
    <style>
        .ab{
            position: absolute;
            top: 28%;
            right: 5%;
            background-color: transparent;
            border: none;
            }
        body {
            background: #ececec;
        }

        .login_div {
            width: 750px;
            min-height: 500px;
            margin: 5% auto;
        }

        .login_content {
            width: 440px;
        }

        .sst_img {
            width: 220px;
        }

        .logo_text {
            /* text-align: end; */

            color: #202C55;
            font-size: 26px;
        }

        .text-div {
            border: 2px solid lightgrey;
            width: 200px;
            float: right;
        }

        .toggle-password {
            float: right;
            cursor: pointer;
            margin-right: 10px;
            margin-top: -25px;
        }

        .input-wrapper {
            position: relative;
        }

        input {

            position: relative;

            /* margin: 10px; */
            line-height: 6ex;
        }

        .form-label {
            position: absolute;
            top: -2ex;
            z-index: 1;
            left: 2em;
            background-color: white;
            padding: 0 5px;
        }

        .border-input {
            border: 4px solid #303D8B;
            border-radius: 0px;
        }

        .form_div {
            margin-top: 100px;
        }

        @media only screen and (max-width: 920px) and (min-width: 768px) {
            .login_div {
                width: 700px;
            }
        }

        @media only screen and (max-width: 768px) and (min-width: 500px) {
            .login_div {
                width: 480px;
            }
        }

        @media only screen and (max-width: 499px) {
            .login_div {
                width: 370px;
            }

            .login_content {
                width: 354px;
            }

            .text-div {

                width: 168px;

            }

            .sst_img {
                width: 168px;
            }
        }

        .login-btn {


            font-size: 25px;

            padding: 0 23px;
            background-color: #303D8B;
            color: white;
            border-radius: 9.5px;
        }
        small{
            font-size: 12px
        }
    </style>
    <div class="container">
        <div class="card login_div">
            <div class="login_content mx-auto">
                <div class="row my-5">
                    <div class="col-6">
                        <img class="sst_img" src="{{ $common_data['SSTL_Logo'] }}" alt="">
                    </div>
                    <div class="col-6">
                        {{-- <div class="text-div">
                            <p class="logo_text ">Client Logo</p>
                        </div> --}}
                        
                        <img class="" src="{{  $common_data['Client_Logo'] }}" alt="" width="160">

                    </div>


                </div>
                <form method="POST" action="{{ url('Weblogin') }}">
                        @csrf
                        @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                                @endforeach
                    <div class="input-wrapper my-4">
                        <label for="email" class="form-label ">{{ __('User ID') }}</label>
                        <input type="email" name="email" class="form-control border-input @error('email') is-invalid @enderror username" id="email" placeholder="Enter your Email ID" value="{{ old('email') }}" required  onfocus="this.placeholder=''" onblur="this.placeholder='Enter your Email ID " autocomplete="email">
                    </div>
                    <div class="input-wrapper my-4">
                        <label for="password" class="form-label ">{{ __('Password') }}</label>
                        <div style="position: relative;">
                        <input type="password" name="password" class="form-control border-input @error('password') is-invalid @enderror username" id="password" placeholder="Enter your Password"required autocomplete="current-password" onfocus="this.placeholder=''" onblur="this.placeholder='Enter your password' ">
                        <span class='ab'  onclick="password_show_hide();">
                                    <i class="fas fa-eye d-none eyeicon" id="show_eye"></i>
                                    <i class="fas fa-eye-slash eyeicon" id="hide_eye"></i>
                                </span>
                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                    </div>
                    <div class="form-check my-4">
                        <input class="form-check-input" type="checkbox" value="" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                        </label>
                    </div>
                    <div class="button-div my-4">
                        <button type="submit" class="btn btn-primary login-btn d-block mx-auto" >{{ __('Login') }}</button>
                    </div>

                </form>
                <br>

                <div style="text-align: center">
                    <small>&copy; S-Square Spenta Technologies LLP</small>
                    
                </div>
                <div class="row my-2" >
                    <span style="text-align: left" class="col-5">
                        <small>Web Version: {{$common_data['Web_Version']}}</small>
                    </span>
                    <span style="text-align: right" class="col-7">
                        <small>Released on: {{$common_data['Released_Date']}}</small>
                    </span>
                </div>
            </div>

        </div>
    </div>
    <script>
     function isValidEmail(email) {
      // Use a regular expression to check if the email format is valid
      var emailRegex = /\S+@\S+\.\S+/;
      return emailRegex.test(email);
    }
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>  

</body>

</html>
@endsection
