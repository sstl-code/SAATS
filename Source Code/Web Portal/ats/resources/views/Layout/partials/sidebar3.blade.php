<style>
    li.my-3.hoverHead:hover a{
     color: #fff;
    }
    .clear-input-container {
  position: relative;
  display: inline-block;
}
#search-input {
    line-height: 1rem;
    width: 20rem;
    padding: 0 2rem;
    font-size: 1.2rem;
    position: relative;
    bottom: 15px;
    height: 33px;
    background-image: url("{{url('/assets/images/search-icon.png')}}");
    background-size: 20px;
    background-position: right 10px center;
    background-repeat: no-repeat;
    padding-left: 18px;
}

.clear-input-button {
	position: absolute;
	right: 21px;
	top: 0px;
	bottom: 0;
	justify-content: center;
	align-items: center;
	width: 13px;
	height: 26px;
	appearance: none;
	border: none;
	border-radius: 50%;
	background: transparent;
	margin: 0;
	padding: 2px;
	/* color: white; */
	font-size: 13px;
	cursor: pointer;
	/* display: none; */
	font-size: inherit;
}


.clear-input--touched:focus + .clear-input-button,
.clear-input--touched:hover + .clear-input-button,
.clear-input--touched + .clear-input-button:hover {
  display: inline-flex;
}
input,
input::placeholder {
    font: 1rem/3 sans-serif;
}
.emailshow{
	bottom: 15px;
}
@media only screen and (max-width: 499px){
	#search-bar{
		position: static;
	}
	.emailshow {
		position: relative;
		/* left: 99px; */
		margin-left: auto;
		bottom: 0;
		font-size: 13px;
	}
	#search-input{
		width: 16rem;
		bottom: 0;
	}
}
@media only screen and (max-width: 550px){
	#search-input{
		width: 18rem;
		bottom: 0;
	}
	#search-bar{
		position: static;
	}
	.emailshow {
		position: relative;
		/* left: 99px; */
		margin-left: auto;
		bottom: 0;
		font-size: 13px;
	}
}
@media only screen and (max-width: 767px)and (min-width: 550px){

	#search-input{
		width: 18rem;
		bottom: 0;
	}
	#search-bar{
		position: static;
	}
	.emailshow {
		position: relative;
		/* left: 99px; */
		margin-left: auto;
		bottom: 0;
		font-size: 13px;
	}
}
/* @media only screen and (max-width: 670px) and (min-width:614px){

	#search-input {
		width: 21rem;
		bottom: 0;
		left: 50px;
	}
} */
@media only screen and (max-width: 940px) and (min-width:768px){
	#search-bar{
		position: relative;
	}
	.emailshow {
		
		font-size: 13px;
	}
}
  
  </style>
<header>

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
            <div class="offcanvas offcanvas-start " style="max-width: 320px" tabindex="-1" id="offcanvasExample"
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
    
                          <a class="sidemenu" href="<?php echo url('/batch_upload');?>"><li class="my-3 hoverHead"><i class="fa-solid fa-calendar"></i> Batch Process</li></a>
                          <a class="sidemenu" href="<?php echo url('/systemlog');?>"><li class="my-3 hoverHead"><i class="fa-solid fa-history"></i> Audit Trail</li></a>
                          
                         <a class="sidemenu" href="<?php echo url('/report');?>"><li class="my-3 hoverHead"><i class="fa-solid fa-file"></i> Report </li></a>
                          {{-- <a class="sidemenu" href="<?php echo url('/report_View');?>"><li class="my-3 hoverHead"><i class="fa-regular fa-pen-to-square"></i> Report</li></a> --}}
    
                          {{-- <a class="sidemenu" href="<?php echo url('/change_password');?>"><li class="my-3 hoverHead"><i class="fa-solid fa-unlock-keyhole"></i> Change Password</li></a> --}}
                        <!--  <a class="sidemenu" href="#"  onclick="javascript:loginusingToken();"><li class="my-3 hoverHead"><i class="fa-solid fa-right-to-bracket fa-rotate-180"></i> User Mangement</li></a>-->
               
                          <a class="sidemenu" href="<?php echo url('/logout');?>"><li class="my-3 hoverHead"><i class="fa-solid fa-right-to-bracket fa-rotate-180"></i> Log Out</li></a>

                        </ul>
                        <br /><br /><br />
                  <div class="row col-12">
                    <div style="margin-left:8px;font-size:11px;" class="col-5" >
                        <strong>Web Version:</strong><br /> {{$common_data['Web_Version']}}
                    </div>
                    <div style="text-align:right;font-size:11px;" class="col-5">
                        <strong>Released on: </strong><br />{{$common_data['Released_Date']}}
                    </div>
                </div>
                    {{-- <ul>
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul> --}}

                </div>
            </div>
            {{-- <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> --}}
      <?php $routename =  Request::url();
      
       //if($routename !='http://3.111.113.246/umprojnew/public/index.php/AssetHistory'){?>
        <div id="search-bar" class="clear-input-container">
            <input id="search-input" class="clear-input" placeholder="Search with User Id or User Name">

            <!-- <div id="search-icon" class=""></div> -->
            {{-- <button class="  " aria-label="Clear input" title="Clear input">x</button> --}}
            <!-- <i class="clear-input-button fa fa-search" aria-hidden="true"></i> -->

        </div>
              
        <span class="emailshow" style="color: white;"><?php echo session('email');?> <p><span>{{ Auth::user()->name}},&nbsp;{{ session('login_time') }}</span></p></span>
          
        </div>
    </nav>
</header>
<script>
    const input = document.querySelector(".clear-input")
const clearButton = document.querySelector(".clear-input-button")


const handleInputChange = (e) => {
  if (e.target.value && !input.classList.contains("clear-input--touched")) {
    input.classList.add("clear-input--touched")
  } else if (!e.target.value && input.classList.contains("clear-input--touched")) {
    input.classList.remove("clear-input--touched")
  }
}

const handleButtonClick = (e) => {
  input.value = ''
  input.focus()
  input.classList.remove("clear-input--touched")
  window.location.reload();
}

clearButton.addEventListener("click", handleButtonClick)
input.addEventListener("input", handleInputChange)
</script>
<script>
  const searchInput = document.getElementById('search-input');

  searchInput.addEventListener('input', function() {
      if (this.value.trim() === '') {
          this.style.backgroundImage = 'url("{{url('/assets/images/search-icon.png')}}")';
      } else {
          this.style.backgroundImage = 'none';
      }
  });
    // var dt = new Date();
    // document.getElementById("datetime").innerHTML = dt.toLocaleString();
    // var today = new Date();
</script>