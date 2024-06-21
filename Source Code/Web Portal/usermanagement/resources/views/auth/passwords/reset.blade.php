@extends('layouts.app')

@section('content')
@section('title', 'Reset Password')
<div class="total-login-page">
    <div class="full-page-back-img">
        <div class="row">
            <div class="col-md-6 d-none d-md-block d-lg-block">

            </div>

            <div class="col-md-6 my-4">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="login-form">
                        <div class="logo">
                            <img src="{{url('/build/assets/img/SSTLLogo-white.png')}}">
                        </div>
                        <div class="reset-heading">
                            <span>{{$email}}</span>
                            <h3>Reset Password</h3>

                        </div>

                        <div class="login-form-input">
                            <label>New Password</label>
                            <div class="password-input">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="New Password" name="password" required autocomplete="new-password">
                                <span class='ab' onclick="password_show_hide_new();">
                                    <i class="fas fa-eye d-none eyeicon" id="show_eye_new"></i>
                                    <i class="fas fa-eye-slash eyeicon" id="hide_eye_new"></i>
                                </span>
                                <span class="invalid-feedback" role="alert" id="passwordError"></span>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="login-form-input">
                            <label>Confirm Password</label>
                            <div class="password-input">
                                <input id="password-confirm" type="password" placeholder="Confirm Your Password" name="password_confirmation" required autocomplete="new-password">
                                <span class='ab' onclick="password_show_hide();">
                                    <i class="fas fa-eye d-none eyeicon" id="show_eye"></i>
                                    <i class="fas fa-eye-slash eyeicon" id="hide_eye"></i>
                                </span>
                                {{-- <button><img src="{{url('/build/assets/img/seen-off.svg')}}"></button> --}}
                            </div>
                            {{-- <a href="#">Forgot Your Password?</a> --}}
                        </div>

                        <button type="submit" class="login-button" onclick="validateForm()">
                            {{ __('Reset Password') }}
                        </button>

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
        background-size: cover;
       
        /* background-position: center; */
    }
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
    function password_show_hide() {
        debugger;
        var x = document.getElementById("password-confirm");
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

    function password_show_hide_new() {
        debugger;
        var x = document.getElementById("password");
        var show_eye = document.getElementById("show_eye_new");
        var hide_eye = document.getElementById("hide_eye_new");
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

    function validateForm() {
    // Trigger validation on password input change
    validatePassword();

    // You can add more form field validations here...

    // If all validations pass, submit the form
    if ($('.is-invalid').length === 0) {
        $('form').submit();
    }
}

function validatePassword() {
    // Get the password value
    var password = $('#password').val();
    $.ajax({
        type: "GET",
        url: "{{url('getallPolycies')}}", // Adjust the URL based on your route
        success: function(response) {
                    passMaxLen=0;
                    passMinLen=0;
                    minNumSpclChar=0;
                    minNumDigit=0;
                    minNumLowAlpha=0;
                    minNumCapAlpha=0
            $.each(response, function(key, val) {
                //alert(val.policy_Name);
                //alert(val.policy_Value);
                if(val.policy_Value){

                    switch(val.policy_Name){
                    case "Min length of Password":
                    passMinLen=val.policy_Value;
                    break;
                    case "Max Length of Password":
                    passMaxLen =val.policy_Value;
                    break;
                    case "Min Number of Special characters":
                    minNumSpclChar=val.policy_Value;
                    break;
                    case "Min Number of digits":
                    minNumDigit=val.policy_Value;
                    break;
                    case "Min Number of lowercase alphabet":
                    minNumLowAlpha=val.policy_Value;
                    break;
                    case "Min Number of uppercase alphabet":
                    minNumCapAlpha=val.policy_Value;
                    break;
                }
            }
                 //console.log(key + ": " + val);
            });
    // Validate the length
    if (password.length < passMinLen && passMinLen>0) {
        // Password length does not meet the requirements
        // Display an error message
        $('#password').addClass('is-invalid');
        $('#passwordError').html('Password must be minimum '+passMinLen+' characters.');
    } else {
        // If password length is valid, remove any previous validation messages
        $('#password').removeClass('is-invalid');
    }
    if (password.length > passMaxLen && passMaxLen>0) {
        // Password length does not meet the requirements
        // Display an error message
        $('#password').addClass('is-invalid');
        $('#passwordError').html('Password must be maximum '+passMaxLen+' characters.');
    }

    // Validate the minimum number of special characters
    var specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/g;
    var specialCharCount = (password.match(specialCharRegex) || []).length;

    if (specialCharCount < minNumSpclChar) {
        // Password does not contain the minimum number of special characters
        // Display an error message
        $('#password').addClass('is-invalid');
        $('#passwordError').html('Password must contain at least '+minNumSpclChar+' special character.');
    }

    // // Validate the minimum number of digits
    var digitRegex = /\d/g;
    var digitCount = (password.match(digitRegex) || []).length;

    if (digitCount < minNumDigit) {
        // Password does not contain the minimum number of digits
        // Display an error message
        $('#password').addClass('is-invalid');
        $('#passwordError').html('Password must contain at least '+minNumDigit+' digit.');
    }

    // // Validate the minimum number of lowercase alphabets
    var lowercaseRegex = /[a-z]/g;
    var lowercaseCount = (password.match(lowercaseRegex) || []).length;

    if (lowercaseCount < minNumLowAlpha) {
        // Password does not contain the minimum number of lowercase alphabets
        // Display an error message
        $('#password').addClass('is-invalid');
        $('#passwordError').html('Password must contain at least '+minNumLowAlpha+' lowercase alphabet.');
    }

    // // Validate the minimum number of uppercase alphabets
    var uppercaseRegex = /[A-Z]/g;
    var uppercaseCount = (password.match(uppercaseRegex) || []).length;

    if (uppercaseCount < minNumCapAlpha) {
        // Password does not contain the minimum number of uppercase alphabets
        // Display an error message
        $('#password').addClass('is-invalid');
        $('#passwordError').html('Password must contain at least '+minNumCapAlpha+' uppercase alphabet.');
    }
}
        });
}

// Trigger validation on password input change
$('#password').on('input', function () {
    validatePassword();
});

</script>
@endsection