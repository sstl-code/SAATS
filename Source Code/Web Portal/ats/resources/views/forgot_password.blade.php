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
    <link rel="stylesheet" href="{{asset('assets/assets/css/responsive.css')}}">

    <title>Forgot Password</title>
    <style>
        .login-container {
          margin: 0 auto;
          height: 460px;
          width: 763px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            background-color: white;
            margin-top: 90px;
            position: relative;
            
        }
         body{
              background-color: #DEEBF6;
             }       
          </style>
        </head>

        <body>
            <div class="login-container">
                
                
              <!-- Forgot Password-->
              <div class="forgot-nav">
              <nav class="forgot"style="height: 48px;text-align: center;background-color: #303D8B;font-size:  2.5rem;color: white;">
                <span class="forgot mb-2" style="font-size: 1.5rem;font-weight:500;position: relative;top: -15px;">Forgot Password</span></nav>
              </div>
                        <form action="#" id="forgot_password">
                                <div class="forgot-page mt-2">
                                        <label class="userid-forgot" for="User" >User ID</label>
                                        <input class="passwordfields" type="text" id="username_id" placeholder="ENTER YOUR EMAIL ID"  onfocus="this.placeholder=''" 
                                        onblur="this.placeholder='ENTER YOUR EMAIL ID' ">
                                   <!--value="<?php //echo session('email');?>"-->
                                        <div class="login_btn">
                                            <button  class="otpbutton" type="button" id="user_id">Get OTP</button>
                                        </div>
                                    
                                </div>

                                <div class="forgot-page" id="stepverify">
                                    <label class="userid-forgot" for="User">OTP</label>
                                    <input class="passwordfields" id="txtOtp" type="text" placeholder="ENTER YOUR OTP"  onfocus="this.placeholder=''" 
                                    onblur="this.placeholder='ENTER YOUR OTP' " disabled>
                               
                                    <div class="login_btn">
                                        <button  class="button2" id="VerifyOTPBtn" type="button" disabled>Verify OTP</button>
                                    </div>
                                
                                </div>

                                <div class="forgot-page">
                                    <label class="userid-forgot" for="User">New Password</label>
                                    <input class="passwordfields" id="newpassword" type="password" placeholder=" " disabled>
                                    <span class='forget-password-ab'  onclick="password_show_hide();" id="newpassworddiv">
                                        <i class="fas fa-eye d-none" id="show_eye-forgot"></i>
                                        <i class="fas fa-eye-slash" id="hide_eye-forgot"></i>
                                    </span>
                                </div>

                                <div class="forgot-page" >
                                    <label class="userid-forgot" for="User">Confirm Password</label>
                                    <input class="passwordfields" id="confirmpassword" type="password" placeholder=" " disabled>
                                    <span class='forget-password-ab'  onclick="confirmpassword_show_hide();" id="confirmpassworddiv">
                                        <i class="fas fa-eye d-none" id="show_eye-confirmfogot"></i>
                                        <i class="fas fa-eye-slash" id="hide_eye-confirmforgot"></i>
                                    </span>
                                </div>

                           
                       

                            <div>
                                <button  id="submit-button"class="submit-and-cancel btn-lg" type="button" disabled>Submit</button>
                                <button type="button" id="CancelBtn" class="submit-and-cancel btn-lg" >Cancel</button>
                            </div>

                        </form>
            </div>
             
         </div>
          

       





       



























{{-- </head>
<body>
<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-7">
           <div class="card px-5 py-5" id="forgotpassword"
                 style="margin-top: 40px; box-shadow: 0 4px 8px 4px rgba(155, 153, 153, 0.5), 
                        0 6px 12px 0 rgba(0, 0, 0, 0.10);
                        border:1px solid lightgrey">
                        <nav class="forgot"style="margin-top:-49px; margin-left: -48px; margin-right: -48px;height: 48px;text-align: center;background-color: #1934b9;font-size:  2.5rem;color: white;">
                        <span class="forgot mb-2" style="font-size: 1.5rem;font-weight:500;position: relative;top: -15px;">Forgot Password</span></nav>
                    <div class="mt-3 text-center">
            </div>
                  <!--User id input-->
                  <div class="form-data mt-5" v-if="!submitted">
                        <form action="forgot password">
                            <div class="forms-inputs mt-4 mb-4 " style="padding-left:35px;top: -55px; ">
                                <span style="font-size: 10px;color: blue;">User ID</span>

                                <input autocomplete="off" placeholder="ENTER YOUR EMAIL ID"
                                    style="width: 450px;padding-left:20px;height: 40px;border: 2px solid #395bd1;" type="text" v-model="email"
                                    v-bind:class="{'form-control':true, 'is-invalid' : !validEmail(email) && emailBlured}"
                                    v-on:blur="emailBlured = true">
                              
                            </div>
                            <button type="button" class="otpbutton"  style="width:121px; float:right;margin: -75px; margin-right: 52px; background-color: #202C55;color: white;text-align: center;"> GET OTP </button>

                            <!--OTP verify-->
                            <div class="forms-inputs mt-4 mb-4 " style="padding-left:35px;top: -30px;">
                                <span style="font-size: 10px;color: blue;">OTP</span>

                                <input autocomplete="off" placeholder=" "
                                    style="width: 450px;padding-left:20px;height: 40px;border: 2px solid #395bd1;" type="text" v-model="email"
                                    v-bind:class="{'form-control':true, 'is-invalid' : !validEmail(email) && emailBlured}"
                                    v-on:blur="emailBlured = true">
                               
                            </div>
                            <button type="button" class="otpbutton"  style="width:121px; float:right;margin: -75px; margin-right: 52px;position:relative;top:25px;background-color: #202C55;color: white;text-align: center;"> Verify OTP </button>
                           
                           <!--New password-->
                            <div class="forms-inputs mt-4 mb-4 " style="padding-left:35px;top: -3px;">
                                <span style="font-size: 10px;color: blue;">New Password</span>

                                <input autocomplete="off" placeholder=" "
                                    style="width: 450px;padding-left:20px;height: 40px;border: 2px solid #395bd1;" type="text" v-model="email"
                                    v-bind:class="{'form-control':true, 'is-invalid' : !validEmail(email) && emailBlured}"
                                    v-on:blur="emailBlured = true">
                            </div>

                            <!--Conformation page-->
                            <div class="forms-inputs mt-4 mb-4 " style="padding-left:35px;top:-3px;">
                                <span style="font-size: 10px;color: blue;">Confirm Password</span>

                                <input autocomplete="off" placeholder=" "
                                    style="width: 450px;padding-left:20px;height: 40px;border: 2px solid #395bd1;" type="text" v-model="email"
                                    v-bind:class="{'form-control':true, 'is-invalid' : !validEmail(email) && emailBlured}"
                                    v-on:blur="emailBlured = true">
                             </div>
                            <!--Buttons for  submit and cancel-->

                            <button type="button" class="submitbutton" style="margin-left: 137px;background-color: #202C55;color: white;text-align: center;width: 119px;">Submit</button>
                            <button type="button" class="cancelbutton" style="background-color: #202C55;color: white;text-align: center;width: 119px;" >Cancel</button>

                        </form>
                    </div>
        </div>


    </div>
</div> --}}

   
 

 














<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>  


<script>

$( document ).ready(function() {
    $("#newpassworddiv").hide();
    $("#confirmpassworddiv").hide();
    
});



    $("#user_id").click(function(){
        // debugger;
     
      event.preventDefault(); // Prevent the form from submitting
      
      // Get the values from the username and password fields
      var userid = $("#username_id").val();
      var password = $("#password").val();
      //alert(username);
      // Check if the fields are blank
      if(userid.trim() === "") {
        
        toastr.error("User ID cannot be blank.");
}else{
        $("#txtOtp").removeAttr('disabled');
      $("#VerifyOTPBtn").removeAttr('disabled');
      }
    });

    $("#submit-button").click(function(){
    var newpass = $("#password").val();
      var cnfrmpass = $("#confirmpassword").val();

      if (newpass != cnfrmpass) {
        // Display toastr message
        toastr.error("New Password and Confirm Password are not equal");
      } 
    });

    $("#VerifyOTPBtn").click(function(){
        debugger;
        $("#newpassworddiv").show();
        $("#confirmpassworddiv").show();
      $("#newpassword").removeAttr('disabled');
      $("#confirmpassword").removeAttr('disabled');
      $("#submit-button").removeAttr('disabled');
      
    });

   
    $("#CancelBtn").click(function(){
        debugger;
        window.location.href='/umprojnew/public/index.php/login';
    });
    


    function password_show_hide() {
                        debugger;
                    var x = document.getElementById("newpassword");
                    var show_eye = document.getElementById("show_eye-forgot");
                    var hide_eye = document.getElementById("hide_eye-forgot");
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


            function confirmpassword_show_hide() {
                        debugger;
                    var x = document.getElementById("confirmpassword");
                    var show_eye = document.getElementById("show_eye-confirmfogot");
                    var hide_eye = document.getElementById("hide_eye-confirmforgot");
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


</body>
</html>