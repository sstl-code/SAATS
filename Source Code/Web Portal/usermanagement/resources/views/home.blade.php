{{-- @extends('layouts.masterLayout')

@section('content')
@section('title', 'Dashboard')

<div class="d-flex align-items-center justify-content-center"  style="height: 250px; margin-left: 300px;">
    @foreach($moduleData as $data)
    <div class="btn p-2 m-2 bg-secondary text-info shadow rounded-2" onclick="window.location='{{$data->url}}'">
        <img src="{{url('/build/assets/img/truebyl-logo.png')}}" alt="ATS Image"><br>
        
        {{$data->module_name}}
        
    </div>
    @endforeach
</div>
@endsection --}}
