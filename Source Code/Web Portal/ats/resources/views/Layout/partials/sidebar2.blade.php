<style>
    li.my-3.hoverHead:hover a{
     color: #fff;
    }
  
  </style>
  <body>
<header>
  <div id="preloader">
    <div id="status">&nbsp;</div>
  </div>


  <div id="loader" class="lds-dual-ring hidden overlay"></div>

    <nav class="navbar"style="background-color: #202C55;">
      <img src="{{ asset('assets/images/SSTLLogo-white.png') }}"style="position: relative;left: 7px;top: 5px;max-width: 10%;" alt="">
        <div class="container-fluid">
            <div class="fa-solid fa-bars" style="color: white" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                aria-controls="offcanvasExample">

        </div>
            {{-- <div class="hamburger">
        <i class="fa-solid fa-bars"></i>
      </div> --}}
            <div class="offcanvas offcanvas-start w-30" style="max-width:320px" tabindex="-1" id="offcanvasExample"
                aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header" style="height: 88px;">
                    {{-- <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5> --}}
                   <span class="user_img"></span> @if (Auth::check())<span style="color:white">Hi, {{Auth::user()->name}}</span>@endif
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button> --}}
                    <i class="fa-solid fa-arrow-right fa-rotate-180"id="ham-menu" type="button" data-bs-dismiss="offcanvas" aria-label="Close" style="color: white;font-size: small;position: relative;left:57px;"></i>
                    <div class="" style="color: white" data-bs-dismiss="offcanvas" role="button"
                        aria-label="Close">
                    </div>

                </div>
                {{-- <div class="offcanvas-body mt-3" style="padding:0px">
                    <ul style="list-style-type:none;">

                        <li class="my-3 hoverHead"><a class="sidemenu" href="<?php echo url('/pendingApproval');?>"><img src="assets/images/Group 7356.png"> Pending Approval</a></li>

                        <li class="my-3 hoverHead"><a class="sidemenu" href="<?php echo url('/Technician_site_Worklist_view');?>"><img src="assets/images/to-do-list.png">Technician to Site Tagging Status</a></li>

                        <li class="my-3 hoverHead"><a class="sidemenu" href="<?php echo url('/Operator_Site_Asset_view');?>"><img src="assets/images/worker.png"> Operator Site View</a></li>

                        {{-- <li class="my-3 hoverHead"><a class="sidemenu" href="<?php echo url('/Technician_site_Mapping');?>"><i
                                    class="fa-solid fa-location-dot mx-2"></i>Technician Site Mapping</a></li> --}}
{{-- 
                        <li class="my-3 hoverHead"><a class="sidemenu" href="<?php echo url('/location_view');?>"><img src="assets/images/Icon material-location-on.png"> Site Asset View</a></li>

                        <li class="my-3 hoverHead"><a class="sidemenu" href="<?php echo url('/AssetHistory');?>"><img src="assets/images/Icon awesome-scroll.png"> Asset History</a></li> --}}

                        {{-- <li class="my-3 hoverHead"><a class="sidemenu" href="<?php echo url('/asset_view');?>"><i
                                    class="fa-solid fa-location-dot mx-2"></i> Asset Management</a></li> --}}

                        {{-- <li class="my-3 hoverHead"><a class="sidemenu" href="<?php echo url('/Configuration_management');?>"><img src="assets/images/Icon material-mode-edit.png"> Configuration Management</a></li>

                        
                        <li class="my-3 hoverHead"><a class="sidemenu" href="<?php echo url('/menu_page');?>"><img src="assets/images/Icon awesome-wpforms.png"> Report</a></li>

                        <li class="my-3 hoverHead"><a class="sidemenu" href="<?php echo url('/change_password');?>"><img src="assets/images/padlock.png" >Change Password</a></li>

                        <li class="my-3 hoverHead"><a class="sidemenu" href="<?php echo url('/menu_page');?>"><img src="assets/images/Icon open-account-logout.png"> Log Out</a></li>
                    </ul> --}} 


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
    
                            <a class="sidemenu" href="<?php echo url('/batch_upload');?>">
                            <li class="my-3 hoverHead"><i class="fa-solid fa-calendar"></i> Batch Process</li></a>
                            <a class="sidemenu" href="<?php echo url('/systemlog');?>"><li class="my-3 hoverHead"><i class="fa-solid fa-history"></i> Audit Trail</li></a>

                           <a class="sidemenu" href="<?php echo url('/report');?>"><li class="my-3 hoverHead"><i class="fa-solid fa-file"></i> Report </li></a>
                            {{-- <a class="sidemenu" href="<?php echo url('/report_View');?>"><li class="my-3 hoverHead"><i class="fa-regular fa-pen-to-square"></i> Report</li></a> --}}
                            {{-- <a class="sidemenu" href="<?php echo url('/change_password')?>"><li class="my-3 hoverHead"><i class="fa-solid fa-unlock-keyhole"></i> Change Password</li></a> --}}
                         <!--   <a class="sidemenu" href="#" onclick="javascript:loginusingToken()"><li class="my-3 hoverHead"><i class="fa-solid fa-user"></i> User Mangement</li></a>-->
                            <a class="sidemenu" href="<?php echo url('/logout');?>">
                            <li class="my-3 hoverHead"><i class="fa-solid fa-right-to-bracket fa-rotate-180"></i> Log Out</li></a>
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
      {{-- <?php $routename =  Request::url();
      
       //if($routename !='http://3.111.113.246/umprojnew/public/index.php/AssetHistory'){?>
        <div id="search-bar">
            <input id="search-input" placeholder="Search">

            <div id="search-icon" class="fas fa-search"></div>

        </div>
              
       ?> --}}
            
            

          @if (Auth::check())  <span class="emailshow" style="color: white;bottom: 15px;"><?php echo session('email');?> <p><span>{{ Auth::user()->name}},&nbsp;{{ session('login_time') }}</span></p></span>@endif
          
        </div>
    </nav>
</header>

<script>


//Maruf al Bashir Rez













    // var dt = new Date();
    // document.getElementById("datetime").innerHTML = dt.toLocaleString();
    // var today = new Date();
    function formatDate(date) {
  // Get the day suffix (e.g., "st", "nd", "rd", "th")
  var day = date.getDate();
  var daySuffix;
  if (day === 1 || day === 21 || day === 31) {
    daySuffix = "st";
  } else if (day === 2 || day === 22) {
    daySuffix = "nd";
  } else if (day === 3 || day === 23) {
    daySuffix = "rd";
  } else {
    daySuffix = "th";
  }

  // Get the month name
  var monthNames = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];
  var month = date.getMonth();
  var monthName = monthNames[month];

  // Get the year, hours, minutes, and seconds
  var year = date.getFullYear();
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var seconds = date.getSeconds();

  // Format the date and time string
  var formattedDate = day + daySuffix + " " + monthName + ", " + year;
  var formattedTime = hours + ":" + minutes + ":" + seconds;

  // Return the formatted date and time
  return formattedDate + " " + formattedTime;
}

// Get the current date and time
var currentDate = new Date();
//var formattedDateTime = formatDate(currentDate);

// Set the text content of the <span> element
//document.getElementById("formattedDateTime").textContent = formattedDateTime;
</script>