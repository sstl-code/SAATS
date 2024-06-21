@extends('layouts.app')

@section('content')
@section('title', 'Register')
<style>
    .tooltip1 {
    position: absolute;
    display: inline-block;
    bottom: 5px;
    right: -23px;
}

.tooltip1 .tooltiptext {
  visibility: hidden;

  background-color: black;
  box-shadow: 1px 1px;
  border: 1px solid black;
  color:rgb(27, 27, 117);
  text-align: left;
  border-radius: 6px;
  padding: 10px;
  position: absolute;
  z-index: 1;
  bottom: 150%;
  left: 20%;
  margin-left: -180px;
}

.tooltip1 .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 20%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: white transparent transparent transparent;
}

.tooltip1:hover .tooltiptext {
  visibility: visible;
  background-color:white;
 white-space: pre;
}
</style>
<div class="total-login-page">
    <div class="full-page-back-img">
        <div class="row">
            <div class="col-md-6 d-none d-md-block d-lg-block">
            </div>
            <div class="col-md-6 p-0">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="register-form">
                            <div class="logo image1">
                                <img src="{{ url('/build/assets/img/SSTLLogo-white.png') }}">
                            </div>
                            <div class="register-form-input">
                                <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="register-form-input">
                                <label for="email">{{ __('Email Address') }}</label>
                                <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" onblur="checkDuplicate()">
                                {{-- @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror --}}
                            </div>
                            <div class="register-form-input">
                                <label for="mobile_number">{{ __('Phone') }}</label>
                                <input id="mobile_number" placeholder="Mobile No." type="text" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ old('mobile_number') }}" required autocomplete="mobile_number" autofocus required pattern="[0-9]{10}">
                                {{-- @error('mobile_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> --}}
                                <span id="mobile-number-error" style="color: red;"></span>
                                
                            </div>
                            <div class="register-form-input">
                                <label for="password">{{ __('Password') }}</label>
                                <div class="password-input">
                                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <span class='ab' onclick="password_show_hide();">
                                        <i class="fas fa-eye d-none eyeicon" id="show_eye"></i>
                                        <i class="fas fa-eye-slash eyeicon" id="hide_eye"></i>
                                    </span>
                                    <span class="invalid-feedback" role="alert" id="passwordError"></span>
                                    <?php
                            $policyName='';
                            foreach ($passworddata as $item){
                                $policyName=$policyName.$item->policy_Name." ".$item->policy_Value."\n";
                            }
                            if(!empty($policyName)){
                            ?>
                            
                                    <div class="tooltip1"><i class="fas fa-info-circle" style="color: #FFC850;
                                        font-size: 20px;
                                        margin-left: -18px;"></i>
                                        <span class="tooltiptext">{{ $policyName }}</span>
                                    </div>
                               <?php } ?>
                                </div>
                            </div>

                            <div class="register-form-input">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                <div class="password-input">
                                    <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                                    <span class='ab' id="passwordConfirmToggle" onclick="password_show_hide_new();">
                                        <i class="fas fa-eye d-none eyeicon" id="show_eye_new"></i>
                                        <i class="fas fa-eye-slash eyeicon" id="hide_eye_new"></i>
                                    </span>
                                    <span class="invalid-feedback" role="alert" id="passwordConfirmError"></span>
                                </div>
                            </div>

                            <div class="register-form-input">
                                <label for="user_address">{{ __('User Address') }}</label>
                                <input id="user_address" placeholder="Address" type="text" class="form-control @error('user_address') is-invalid @enderror" name="user_address" value="{{ old('user_address') }}" autocomplete="user_address">
                                @error('user_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- <div class="register-form-input"> --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="register-form-input">
                                        <label style="" for="gender">{{ __('Gender') }}</label>
                                        <select name="gender" id="gender" class="form-select">
                                            <option value="female">Female</option>
                                            <option value="male">Male</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex mt-4">
                                    <div class="register-form-input">
                                        <div class="">

                                            <input id="is_supervisor" type="checkbox" name="is_supervisor" value="1">
                                            <label for="is_supervisor" style="padding-left: 5px;" class="checkbox-label">{{ __('Supervisor') }}</label>
                                            @error('is_supervisor')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{-- </div> --}}



                            <div class="button-form-input" style="">
                                <button type="button" class="registercss" onclick="validateForm()">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            <p class="text-center" style="color:#FFC850; font-weight: 500;">Already have account? <a class="loginLink" href="{{ route('login') }}"> Click here to login</a></p>
                        </div>
                    </form>
                </div>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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

    function password_show_hide_new() {
        debugger;
        var x = document.getElementById("password-confirm");
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
 
 // add phone number validation
 document.addEventListener('DOMContentLoaded', function() {
    const mobileNumberInput = document.getElementById('mobile_number');
    const mobileNumberError = document.getElementById('mobile-number-error');

    mobileNumberInput.addEventListener('input', function() {
      if (!mobileNumberInput.checkValidity()) {
        mobileNumberError.textContent = 'Please enter a 10-digit phone number.';
      } else {
        mobileNumberError.textContent = '';
      }
    });
  });

  function checkDuplicate() {
    $("#email").removeClass("error");
    $("#email").parent().find("span").remove();
    var email = $('#email').val();
    var csrfToken = '{{ csrf_token() }}';
    var submitButton = $("#submit_button");
    $.ajax({
      method: "POST",
      url: "{{ url('checkexistingemail') }}",

      data: {
        '_token': csrfToken,
        'email': email
      },
      success: function(data) {
        if (data['emailcheck'] != null) {
          $("#email").focus();
          $("#email").addClass("error");
          $('#emaildupladd').empty();
          $("#email").after("<span id='emaildupladd' class='emailcolocss'>This email already exists</span>");
          submitButton.prop("disabled", true); // Disable the submit button
          return false;
        }
        //else {
        //     submitButton.prop("disabled", false); // Enable the submit button
        //  }
      }

    });
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
            //console.log(response);
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
                    //alert(passMinLen);
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