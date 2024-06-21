@extends('layouts.masterLayout')

@section('content')
@section('title', 'Dashboard')

<main id="main">


    <section class="inner-page" style="overflow: hidden">

        <div class="container" style="padding: 0;">
            <div class="row">
                <div class="col-sm-12 col-md-6 page-heading">
                    <div class="module-logo">
                        <img src="{{url('/build/assets/img/dash.logo.svg')}}">
                    </div>

                    <h4>Dashboard</h4>
                </div>
            </div>
            
            <div class="dashboard-card-sec">
                <div class="row">
                    @foreach($moduleData as $data)
                    <div class="col-md-4 p-0">
                        @if($data->url)
                        <div class="card dashBoardClass" onclick="javascript:login('{{$data->url}}')">
                        @else
                        <div class="card dashBoardClass" style="cursor: default;">
                        @endif
                            <div class="card-header">
                                @if($data->module_icon)
                                <img src="{{ url($data->module_icon) }}">
                                @endif
                                {{-- <img style="width: 100px;" src="''"> --}}
                            </div>
                            <div class="card-body">
                                {{-- <h3>ATS</h3> --}}
                                <p class="dashCardBody"><span>{{ substr($data->module_name,0,strpos($data->module_name,"(")) }}</span><span class="dashModName">{{substr($data->module_name,strpos($data->module_name,"("),strlen($data->module_name))}}</span></p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
           

        </div>

     <form id="loginFrm" name="loginFrm" method="post">
     @csrf
     <input type="hidden" name="token" value="{{ base64_encode(Auth::user()->id) }}">
     </form>
    <script>
    function login(strURL)
    {
     document.getElementById('loginFrm').action=strURL;
     document.loginFrm.submit();
    }
    </script>
    </section>

</main><!-- End #main -->

{{-- <div class="d-flex align-items-center justify-content-center"  style="height: 250px; margin-left: 300px;">
    @foreach($moduleData as $data)
    <div class="btn p-2 m-2 bg-secondary text-info shadow rounded-2" onclick="window.location='{{$data->url}}'">
        <img src="{{url('/build/assets/img/truebyl-logo.png')}}" alt="ATS Image"><br>
        
        {{$data->module_name}}
        
    </div>
    @endforeach
</div> --}}
@endsection