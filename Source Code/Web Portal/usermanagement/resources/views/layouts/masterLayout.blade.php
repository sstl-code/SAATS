<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title')</title>
  {{-- <title>User Management</title> --}}
  <meta content="" name="description">
  <meta content="" name="keywords">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicons -->
  <link href="{{url('/build/assets/img/favicon.png')}}" rel="icon">
  <link href="{{url('/build/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link
    href="{{url('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i')}}"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{url('/build/assets/vendor/aos/aos.css" rel="stylesheet')}}">
  <link href="{{url('/build/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{url('/build/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{url('/build/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{url('/build/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{url('/build/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link href="{{url('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css')}}">
  <link href="{{url('https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css')}}">
  <link href="{{url('/build/assets/css/style.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css')}}">
</head>

<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="d-flex flex-column">

      <div class="profile">
        <img src="{{url('/build/assets/img/SSTLLogo-white.png')}}" alt="" class="img-fluid ">
      </div>

      <nav id="navbar" class="nav-menu navbar">
        <ul>
          <li><a href="<?php echo url('/dashboard');?>" class="nav-link scrollto {{ (request()->route()->uri=='dashboard') ? 'active' : '' }}"><i class="bx bx-book-content"></i>
              <span>Dashboard</span></a></li>
          <li><a href="<?php echo url('/userManagement');?>" class="nav-link scrollto {{ (request()->route()->uri=='userManagement') ? 'active' : '' }} "><i class="bx bx-home"></i> <span>User Management</span></a>
          </li>
          <li><a href="<?php echo url('/module');?>" class="nav-link scrollto {{ (request()->route()->uri=='module') ? 'active' : '' }} "><i class="bx bx-user"></i> <span>Module
                Management</span></a></li>
          <li><a href="<?php echo url ('/roleManagement');?>" class="nav-link scrollto {{ (request()->route()->uri=='roleManagement') ? 'active' : '' }}"><i class="bx bx-file-blank"></i> <span>Role
                Management</span></a></li>
          <li><a href="<?php echo url('/userRoleMapp');?>" class="nav-link scrollto {{ request()->route()->uri=='userRoleMapp' ? 'active' : '' }}"><i class="bx bx-server"></i> <span>User
                  Role Mapping</span></a></li>
          <li><a href="<?php echo url('/changePass');?>" class="nav-link scrollto {{ request()->route()->uri=='changePass' ? 'active' : '' }}"><i class="bx bx-badge-check"></i> <span>Change
                  Password</span></a></li>
          <li><a href="<?php echo url('/passwordPolicy');?>" class="nav-link scrollto {{ request()->route()->uri=='passwordPolicy' ? 'active' : '' }}"><i class='bx bx-shield-alt-2' style='color:#ffffff'></i> <span>Policy</span></a></li>

          <!-- <li><a href="#contact" class="nav-link scrollto"><i class="bx bx-envelope"></i> <span>Contact</span></a></li> -->
        </ul>
          <li>
            <div class="logout-button"><a class="dropdown-item logout-button" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"
            ><img src="{{url('build/assets/img/logout-button.png')}}">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
            </div>
        </li>
        {{-- <li> --}}
          <div class="mt-4 container row" style="color: #ffffff; font-size:12px; position:relative; top:70px">
            {{-- <small>&copy; S-Square Spenta Technologies LLP</small><br> --}}
            <span style="text-align: left" class="col-5">
              <small>Version:{{env('App_Version')}}</small>
          </span>
          <span style="text-align: right" class="col-7">
              <small>Released on:{{env('Released_on')}}</small>
          </span>
          </div>
        {{-- </li> --}}
      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->

      <main>
          @yield('content')
      </main>

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>
  <!-- Vendor JS Files -->
  <script src="{{url('/build/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{url('/build/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{url('/build/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{url('/build/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{url('/build/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{url('/build/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{url('/build/assets/vendor/typed.js/typed.min.js')}}"></script>
  <script src="{{url('/build/assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
  <script src="{{url('/build/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{url('/build/assets/js/main.js')}}"></script>
  <!-- Include jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Include DataTables -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

  <script>
    $(document).ready(function() {
    $('#exampleTable').DataTable({
      paging: false,
      info: false,
      language: { search: '<i class=""></i>', searchPlaceholder: "Search" },
    });
    
    $('#exampleTable_filter').css({
      'float':'right',
      // 'top': '-35px'
    })
    $('#exampleTable_filter input').addClass('sitefixedsearch');
    $('#exampleTable_filter label').append('<button type="button" class="btn btn-primary my-2 usraddbutton" data-bs-toggle="modal" data-bs-target="#addModal" onclick="emplyMdal()">'+
'<font style="position:relative;bottom:7px;font-size:29px;" ></font><font style="position:relative;bottom:12px">Add User</font></button>');
});
  </script>
</body>