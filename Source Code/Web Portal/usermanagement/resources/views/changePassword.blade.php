@extends('layouts.masterLayout')

@section('content')
@section('title', 'Change Password')
<style>
    .form-control.is-invalid, .was-validated .form-control:invalid {
        background-image:none !important;
    }
    .know-more-icon {
    position: absolute; 
    top: 57%; 
    transform: translate(-50%,-50%); 
    right: 8%;
}
@media (max-width: 768px) {
        .know-more-icon {
            
            bottom: 38%; /* Adjust the bottom distance as needed */
            transform: translate(-50%,-50%);
            right: 2%;
        }
    }

.tooltip1 {
    position: absolute;
    display: inline-block;
    bottom: 5px;
    right: -34px;
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
  margin-left: -60px;
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
<main>
    <div class="container mt-5 total-login-page">
        <div class="row justify-content-center">
            <div class="col-md-6 my-4">
                <div class="card" style="background-color: #303D8B">
                    <div class="card-body ">
                        <h2 class="card-title text-center mb-4 text-white">Change Password</h2>
                        @if(session('success'))
                            <div class="alert alert-success" id="passwordmessage">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger" id="passwordmessage">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{url('changepassword')}}" method="POST">
                            @csrf
                            <div class="mb-3 register-form-input">
                                <label for="old-password" class="form-label text-white">Old Password</label>
                                <div class="password-input">
                                <input type="password" placeholder="Old Password" class="form-control" id="old-password" name="oldpassword" required>
                                <span class='ab'  onclick="password_show_hide();">
                                    <i class="fas fa-eye d-none eyeicon" id="show_eye"></i>
                                    <i class="fas fa-eye-slash eyeicon" id="hide_eye"></i>
                                </span>
                                </div>
                            </div>
                            <div class=" register-form-input">
                                <label for="new-password" class="form-label text-white">New Password</label>
                                <div class="password-input">
                                <input type="password" placeholder="New Password" class="form-control" id="password" name="password" required>
                                <span class='ab'  onclick="password_show_hide_new();">
                                    <i class="fas fa-eye d-none eyeicon" id="show_eye_new"></i>
                                    <i class="fas fa-eye-slash eyeicon" id="hide_eye_new"></i>
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
                            <div class="mb-3 register-form-input">
                                <label for="confirm-new-password" class="form-label text-white" style="margin-top: 15px;">Confirm New Password</label>
                                <div class="password-input">
                                <input type="password" placeholder="Confirm New Password" class="form-control" id="confirm-new-password" name="confirm_password" required>
                                <span class='ab'  onclick="password_show_hide_conf();">
                                    <i class="fas fa-eye d-none eyeicon" id="show_eye_conf"></i>
                                    <i class="fas fa-eye-slash eyeicon" id="hide_eye_conf"></i>
                                </span>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" style="border-radius: 0; background-color: #FFC850; color:#0C1F6" class="registercss" onclick="validateForm()">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
setTimeout(() => {
      $('#passwordmessage').remove();
     }, 3000);

     function password_show_hide() {
                        debugger;
                    var x = document.getElementById("old-password");
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
            function password_show_hide_conf() {
                        debugger;
                    var x = document.getElementById("confirm-new-password");
                    var show_eye = document.getElementById("show_eye_conf");
                    var hide_eye = document.getElementById("hide_eye_conf");
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
 // Initialize Bootstrap Tooltip
//  $(document).ready(function () {
//         $('[data-toggle="tooltip"]').tooltip({
//             html: true,
//             template: '<div class="tooltip" role="tooltip"><div class="tooltip-inner" style="white-space: pre-line;"></div></div>',
//         });
//     });
    $(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip({
        html: true,
        template: '<div class="tooltip" role="tooltip"><div class="tooltip-inner" "></div></div>',
        title: function () {
            // Retrieve the content from hidden spans
            var content = '';
            $(this).nextAll('.hidden-tooltip').each(function () {
                content += $(this).data('title');
            });
            return content;
        },
    });
    });

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
