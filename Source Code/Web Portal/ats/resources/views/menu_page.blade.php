<html>
    <head>
        <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <title>@yield('title','SATS')</title>
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    
   
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=3.1.0') }}">
   

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
    </head>
    <body style="background-color: rgb(17, 17, 56)"></body>
    <nav class="navbar"style="background-color: #202C55;">
    <img src="{{ asset('assets/images/SSTLLogo-white.png') }}"style="position: relative;left: 7px;top: 5px;max-width: 10%;" alt="">

        <div class="container-fluid " >
            <div class="fa-solid fa-bars" style="color: white" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                aria-controls="offcanvasExample">

        </div>
            {{-- <div class="hamburger">
        <i class="fa-solid fa-bars"></i>
      </div> --}}
            <div class="offcanvas offcanvas-start w-21"style="max-width:320px" tabindex="-1" id="offcanvasExample"
                aria-labelledby="offcanvasExampleLabel">
                
                    <div class="offcanvas-header" style="height: 88px;">
                    {{-- <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5> --}}
                   <span class="user_img"></span> <span style="color:white">Hi, {{Auth::user()->name}}</span>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button> --}}
                    <i class="fa-solid fa-arrow-right fa-rotate-180"id="ham-menu" type="button" data-bs-dismiss="offcanvas" aria-label="Close" style="color: white;font-size: small;position: relative;left:57px;"></i>
                    <div class="" style="color: white" data-bs-dismiss="offcanvas" role="button"
                        aria-label="Close">
                    </div>
                </div>
                
       


                <div class="offcanvas-body mt-3" style="padding:0px">
                    <ul class="list_content" style="list-style-type:none;">
                        <a class="sidemenu" href="<?php echo url('/menu_page');?>"><li class="my-3 hoverHead"><i class="fa-solid fa-home"></i> Home</li></a>

                        <a class="sidemenu" href="<?php echo url('/pendingApproval');?>"><li class="my-3 hoverHead"><i class="fa-solid fa-file-circle-plus"></i> Pending Approval</li></a>

                        <a class="sidemenu" href="<?php echo url('/Technician_site_Worklist_view');?>"><li class="my-3 hoverHead"><i class="fa-solid fa-user-tag"></i>Technician to Site Tagging Status</li></a>

                        <a class="sidemenu" href="<?php echo url('/Operator_Site_Asset_view');?>"><li class="my-3 hoverHead"><i class="fa-solid fa-arrows-down-to-people"></i> Operator Site View</li></a>

                        <a class="sidemenu" href="<?php echo url('/Operator_to_technician');?>"><li class="my-3 hoverHead"><i class="fa-solid fa-user-tag"></i>Technician Supervisor Mapping</li></a>
                        {{-- <li class="my-3 hoverHead"><a class="sidemenu" href="<?php echo url('/Technician_site_Mapping');?>"><i
                                    class="fa-solid fa-location-dot mx-2"></i>Technician Site Mapping</a></li> --}}

                        <a class="sidemenu" href="<?php echo url('/location_view');?>"><li class="my-3 hoverHead"><i class="fa-solid fa-location-dot"></i> Site Asset View</li></a>

                        <a class="sidemenu" href="<?php echo url('/AssetHistory');?>"><li class="my-3 hoverHead"><i class="fa-solid fa-scroll"></i> Asset History</li></a>

                        {{-- <li class="my-3 hoverHead"><a class="sidemenu" href="<?php echo url('/asset_view');?>"><i
                                    class="fa-solid fa-location-dot mx-2"></i> Asset Management</a></li> --}}

                        <a class="sidemenu" href="<?php echo url('/Configuration_management');?>"><li class="my-3 hoverHead"><i class="fa-solid fa-pen"></i> Configuration Management</li></a>

                        <a class="sidemenu" href="<?php echo url('/batch_upload');?>"><li class="my-3 hoverHead"><i class="fa-solid fa-calendar"></i> Batch Process</li></a>

                        <a class="sidemenu" href="<?php echo url('/systemlog');?>"><li class="my-3 hoverHead"><i class="fa-solid fa-history"></i> Audit Trail</li></a>
                       <a class="sidemenu" href="<?php echo url('/report');?>"><li class="my-3 hoverHead"><i class="fa-solid fa-file"></i> Report </li></a>
                       
                        <a class="sidemenu" href="<?php echo url('/logout');?>"><li class="my-3 hoverHead"><i class="fa-solid fa-right-to-bracket fa-rotate-180"></i> Log Out</li></a>
                     
                    </ul>
                            {{-- <ul>
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Another action</a></li>
                          <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul> --}}
                           <br /><br /><br />
                  <div class="row col-12">
                    <div style="margin-left:8px;font-size:11px;" class="col-5" >
                        <strong>Web Version:</strong><br /> {{$common_data['Web_Version']}}
                    </div>
                    <div style="text-align:right;font-size:11px;" class="col-5">
                        <strong>Released on: </strong><br />{{$common_data['Released_Date']}}
                    </div>
                </div>
                        </div>
                    </div>
                    {{-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form> --}}
                    
                    <!-- <span class="emailshow" style="color: white"></span> -->
                    <span class="emailshow" style="color: white;bottom: 15px;"><p><span>{{ Auth::user()->name}},&nbsp;{{ session('login_time') }}</span></p></span>

        
                </div>
            </nav>
        </header>
        <style>
                  .full-page-back-img img{
                width: 100%;
                max-width: 1510px;
               
               }
               .splash-logo{
              margin-top: -250px;
              
               }
               .splash-logo img{
                  height: 120px;
                 margin-left: 250px;
               }
               .login-container{
                background-image: url("{{url('/assets/images/menupage.jpg')}}");
                background-size: 100% 100%;
                /* background-position: right 10px  center;  */
                background-repeat: no-repeat;
                /* padding-left: 18px; */
               }
               @media only screen and (max-width: 550px){
                .login-container{
                    width: auto !important;
                }
               }
                
               
            </style>
        <div class="login-container">
            
       <!--   <div class="menupagelogo">
              <div class="menu-page-logo py-5">
                 <img src="{{ asset('assets/images/Miniature Primary Dark Skin @Large.png') }}" alt="" style="left: 268px;position: relative;"> 
              </div>
          
              <div class="caption">
              <figcaption style="position: relative;left: 145px;"> Welcome to Asset Tagging 
                and Tracking System </figcaption>
              </div>
          </div>
          <div class="total-login-page1">-->
                <!-- <div class="full-page-back-img">
                <img src="{{ url('assets/images/splash.png')}}">
                </div>
                <div class="splash-logo">
                    <img src="{{ url('assets/images/splash-logo.png') }}">
                </div> -->
            <!--</div>-->
        </div>
        <script src="{{ asset('assets/js/bundle.js?ver=3.1.0') }}"></script>
    <script src="{{asset('assets/js/editors.js?ver=3.1.0')}}"></script>
    <script src="{{asset('assets/js/scripts.js?ver=3.1.0')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    


</body>
</html>