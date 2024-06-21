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
    <link rel="stylesheet" href="{{asset('assets/assets/css//responsive.css')}}">
    

    <!-- {{-- <title>LOGIN</title> --}} -->
{{-- </head> --}}
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
             {{-- <h2 class="text-center">Login</h2> --}}
            <div class="loginweb">
                <div class="row login-page py-5">
                    <div class="col-6">
                    {{-- <img src="{{ asset('assets/images/logo10.svg') }}" alt="">  --}}
                    </div>
                    {{-- <img style="float:right" src="{{ asset('assets/images/logo10.svg') }}" alt="">  --}}
                    <div class="col-6" style="border:2px solid lightgrey;">
                        <p class="" style="color:#202C55; font-size:26px;">Client Logo</p>
                    </div>     
                    
                </div>
                    <form action="{{url('Weblogin')}}" method="POST" id="loginForm">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="login-page mt-4">
                                <label class="userid" for="User" >User ID</label>
                                <input class="username" name="email" type="text" id="username" placeholder="ENTER YOUR EMAIL ID" onfocus="this.placeholder=''" 
                                onblur="this.placeholder='ENTER YOUR EMAIL ID' " autocomplete="off">
                            </div>

                            <div class="login-page">
                                <label class="userid" for="User">Password</label>
                                <input class="username" name="password" type="password" placeholder=" ******** "  onfocus="this.placeholder=''" 
                                onblur="this.placeholder='******' " id="password">
                                {{-- onblur="this.placeholder='******' " id="password"pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required> --}}
                                <span class='ab'  onclick="password_show_hide();">
                                    <i class="fas fa-eye d-none" id="show_eye"></i>
                                    <i class="fas fa-eye-slash" id="hide_eye"></i>
                                </span>
                                
                                

                                 <div class="forgot">
                                 {{-- <a href="<?php echo url('/forgot_password') ?>" id="forgot-link" style=" position: relative;left: 326px;bottom: 30px;">Forgot Password</a> --}}
                                 </div>
                            </div>
                            <div class="login-page">
                                <div class="login_btn">
                                <button  class="buttonlogin" type="submit" id="loginButton">Login</button>
                            </div>
                            </div>
                                           {{-- @if ($errors->any())
                                                <div class="alert alert-danger" style="position: relative;width: 329px;height: 60px;bottom: 312px;left: 217px;color: #cc0000;background-color: #ffffff;border-color: #ffffff;font-weight:500">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                            @endif --}}
                    </form>
                </div>
            </div>
<p class="copyright">&copy;Truebyl</p>
<script>
             $(document).ready(function() {
    // Handle form submission
    // alert('sd');
    $("#loginForm").submit(function(event) {
      event.preventDefault(); // Prevent the form from submitting
      
      // Get the values from the username and password fields
      var username = $("#username").val();
      var password = $("#password").val();
      //alert(username);
      // Check if the fields are blank
      if (username.trim() === "" && password.trim() === "") {
        // Display toastr message
        toastr.error("Username and Password cannot be blank.");
      } 
      else if(username.trim() === "") {
        toastr.error("Username cannot be blank.");
      }
      else if(password.trim() === "") {
        toastr.error("Password cannot be blank.");
      }
      else if (!isValidEmail(username)) {
        // Display toastr message for invalid email
        toastr.error("Please enter a valid email address.");
        return;
      }else {
        // Perform your login logic here
        // ...
        var csrfToken = '{{ csrf_token() }}';
    $.ajax({

      type: 'POST',
      
      //url: '/Weblogin', // Replace with your Laravel login route URL
      url:"{{url('Weblogin')}}",
      data: {
        email: username,
        password: password,
        _token: csrfToken, 
      },
      success: function(response) {
        //alert(response);
        // Handle the response from the server
        if (response.success) {
          // Redirect to the dashboard or desired page
          window.location.href = "{{url('menu_page')}}";
        } else {
          // Show Toastr error message
          toastr.error('Invalid Username or Password');
        }
      },
      error: function(xhr, textStatus, errorThrown) {
        // Show Toastr error message
        toastr.error('Invalid Username or Password');
      }
    });
    

      }
    });
    function isValidEmail(email) {
      // Use a regular expression to check if the email format is valid
      var emailRegex = /\S+@\S+\.\S+/;
      return emailRegex.test(email);
    }
  });
         </script>
            <!--Password toggle -->
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
             


   
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>  




</body>
</html>
