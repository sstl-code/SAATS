@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}">
    

    <!-- {{-- <title>LOGIN</title> --}} -->
<!-- {{-- </head> --}} -->
</head>
<body>
<div class="login-container">
    <div class="forgot-nav">
        <nav class="forget_nav">
            <span class="forget_span mb-2">Forget Password</span>
        </nav>
        
        <form action="#" id="forgot_password">
                

                <div class=" forgot-page_centre mt-4">
                    <div class="row login-page">
                            <div class="col-md-6" >
                            <img src="{{ asset('assets/images/logo10.svg') }}" alt=""> 
                            </div>
                            {{-- <img style="float:right" src="{{ asset('assets/images/logo10.svg') }}" alt="">  --}}
                            <div class="col-md-6" style="border:2px solid lightgrey;">
                                <p class="" style="color:#202C55; font-size:26px;">Client Logo</p>
                            </div>     
                            
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        
                                <div class="col-12 forgot-page mt-4">
                                        <label for="email" class="userid-forgot"  >User ID</label>
                                        <input class="form-control @error('email') is-invalid @enderror passwordfields" type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your Email ID">
                                   <!--value="<?php //echo session('email');?>"-->
                                        <div class="login_btn">
                                            <button  class="otpbutton" type="button" id="user_id">Get OTP</button>
                                        </div>
                                    
                                </div>
                                <div class=" col-12 forgot-page" id="stepverify">
                                    <label class="otp-forgot" for="User">OTP</label>
                                    <input class="passwordfields" id="txtOtp" type="text" placeholder="Enter Your OTP"  onfocus="this.placeholder=''" 
                                    onblur="this.placeholder='Enter Your OTP' " disabled>
                               
                                    <div class="login_btn">
                                        <button  class="button2" id="VerifyOTPBtn" type="button" disabled>Verify OTP</button>
                                    </div>
                                
                                </div>
                                <div>
                                    <button  id="submit-button"class="submit-and-cancel btn-lg" type="button" disabled>Submit</button>
                                    <button type="button" id="CancelBtn" class="submit-and-cancel btn-lg" >Cancel</button>
                                </div>
                            <!-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> -->

                            <div class="col-md-6">
                                <!-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> -->

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        

                        <!-- <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div> -->
                    </form>
                </div>
            
        
    
        </form>
            
    </div>
    
</div>
</body>
</html>
@endsection
