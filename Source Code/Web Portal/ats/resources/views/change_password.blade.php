<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Forgot Password</title>
</head>
<body>
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
    
        <title>Change Password</title>
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
                    
                    
                  <!-- Confirm Password-->
                  <div class="forgot-nav">
                    <nav class="forgot"style="height: 48px;text-align: center;background-color: #303D8B;font-size:  2.5rem;color: white;">
                    <span class="forgot mb-2" style="font-size: 1.5rem;font-weight:500;position: relative;top: -15px;">Change Password</span></nav>
                  </div>
                            <form>
                                    <div class="Confirm-page mt-4">
                                            <label class="userid-forgot" for="User">User ID</label>
                                            <input class="passwordfields" id="change_user" type="text" value="<?php echo session('email');?>"placeholder="ENTER YOUR EMAIL ID">                        
                                    </div>
    
                                    <div class="Confirm-page mt-2">
                                        <label class="userid-forgot" for="User">Old Password</label>
                                        <input class="passwordfields" id="change_old_pass" type="text" placeholder=" ">
                                        <span class='forget-password-ab'  onclick="password_show_hide();" id="changeoldpassworddiv">
                                            <i class="fas fa-eye d-none" id="show_eye-forgot"></i>
                                            <i class="fas fa-eye-slash" id="hide_eye-forgot"></i>
                                        </span>
                                    </div>
    
                                    <div class="Confirm-page mt-2">
                                        <label class="userid-forgot" for="User">New Password</label>
                                        <input class="passwordfields" id="change_new_pass" type="password" placeholder=" ">
                                        <span class='forget-password-ab'  onclick="confirmpassword_show_hide();" id="changenewpassworddiv">
                                            <i class="fas fa-eye d-none" id="show_eye-changepass"></i>
                                            <i class="fas fa-eye-slash" id="hide_eye-changepass"></i>
                                        </span>
                                    </div>
    
                                    <div class="Confirm-page mt-2">
                                        <label class="userid-forgot" for="User">Confirm Password</label>
                                        <input class="passwordfields" id="change_cnfrm" type="password" placeholder=" ">
                                        <span class='forget-password-ab'  onclick="confirmpassword_show_hide();" id="cnfrmchangepassworddiv">
                                            <i class="fas fa-eye d-none" id="show_eye-changepass"></i>
                                            <i class="fas fa-eye-slash" id="hide_eye-changepass"></i>
                                        </span>
                                    </div>
                                </form>
                            
                        <div>
                            <button type="button" class="submit-and-cancel btn-lg" id="change_submit">Submit</button>
                            <button type="button" class="submit-and-cancel btn-lg" id="change_cancel">Cancel</button>
                        </div>
                   
                 
             </div>





    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    
    <script>
        $( document ).ready(function() {
        $("#change_cancel").click(function(){
                debugger;
                window.location.href='/umprojnew/public/index.php/menu_page';
            });
        });
        
        $("#change_submit").click(function(e){
            event.preventDefault(); 
            var oldpassword = $("#change_old_pass").val().trim();
            var newpassword = $("#change_new_pass").val().trim();
            var confirmpassword = $("#change_cnfrm").val().trim();
      // Check if the fields are blank
      if((oldpassword == "" && newpassword == "" && confirmpassword == "")) {
        toastr.error("Old Password connot be null");
        toastr.error("New Password connot be null");
        toastr.error("Confirm Password connot be null");
      }
      });
        

    $("#newpassworddiv").hide();
    $("#confirmpassworddiv").hide();
    



        </script>

</body>
</html>