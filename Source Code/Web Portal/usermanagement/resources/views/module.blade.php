@extends('layouts.masterLayout')
@section('title', 'Module Management')
@section('content')
<style>
  @media only screen and (max-width: 550px) {
    .right-list li {
      min-height: 88px;
    }

    button.nav-link {
      min-height: 88px;
    }
  }
  .module_search{
  background-image: url("{{url('/build/assets/img/searchicon.jpeg')}}"); 
    background-size: 20px; 
    background-position: 10px center; 
    background-repeat: no-repeat;
    padding-left: 20px;
}
</style>
<main id="main">

  <!-- ======= Breadcrumbs ======= -->
  <!-- <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>User Management</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>User Management</li>
          </ol>
        </div>

      </div>
    </section> -->
  <!-- End Breadcrumbs -->

  <section class="inner-page">

    <div class="container my-4" style="">
      <div class="row">
        <div class="col-sm-12 col-md-6 page-heading">
          <div class="module-logo">
            <img src="{{url('/build/assets/img/module-management-logo.png')}}">
          </div>

          <h4>Module Management</h4>
        </div>

        <div class="col-sm-12 col-md-6 search-field">
          {{-- <input type="hidden" name="moduleid" value="" id="moduleid"> --}}
          <div id="example_filter" class="dataTables_filter" style="margin-right: 20px;">
            <label><input type="search" class="form-control form-control-sm search module_search" id="searchiteam" placeholder="Search Function" aria-controls="example" style="padding-left: 34px;"></label>
            {{-- <img src="{{url('/build/assets/img/searchicon.jpeg')}}"> --}}
          </div>
        </div>
      </div>

      <table id="example" class="table table-striped moduletable3">

        <thead class="module-back">
          <tr>
            <th class="table-head" style="width: 50%">Module Name</th>
            <th style="width: 50%">Function</th>
          </tr>
        </thead>
      </table>
      <div class="tab-sec">
        <div class="d-flex align-items-start row moduletable2">


          <div class="col-6 nav flex-column nav-pills left-tab" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            @php $rightPanel=''; $rowno=1; @endphp
            @foreach($moduleData as $data)
            <button class="nav-link @if($rowno==1) active @endif" id="v-pills-{{$data->id}}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{$data->id}}" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true" style="padding-left: 32px;" data-id="{{$data->id}}" onclick="functionnane(this)">{{$data->module_name}}<img src="{{url('/build/assets/img/active-arrow.png')}}" class="arrow-active"></button>
            @php

            $rightPanel.='<div class="tab-pane fade ';
               if($rowno==1){ $rightPanel.=' show active '; }
               $rightPanel.=' " id="v-pills-'.$data->id.'" role="tabpanel" aria-labelledby="v-pills-home-tab">
              <ul class="right-list">';
                foreach($data->functions as $function)
                {
                $rightPanel.=' <li>'. $function->function_name .'</li>';
                }
                $rightPanel.='</ul>
            </div>';
            $rowno++;
            @endphp
            @endforeach
          </div>

          <div class="col-6 tab-content" id="v-pills-tabContent">
            {!! $rightPanel !!}

            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
              ...</div>
          </div>
        </div>
      </div>
    </div>
  </section>

</main><!-- End #main -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>


function functionnane(e){
  $.ajax({
  type: "GET",       
//   url: 'http://3.111.113.246/umprojnew/public/index.php/',
  url: "{{url('searchFunction')}}",
  data:{
    'search':"",
      'moduleusrid' : $(e).data("id"),
  },
  
  success: function(result) { 
    console.log(result);
    $('#v-pills-tabContent').empty();

$.each(result, function(index, val) {
 //console.log(val['label']);


  $("#v-pills-tabContent").append('<div class="tab-pane fade active show" id="v-pills-'+$(e).data("id")+'" role="tabpanel" aria-labelledby="v-pills-home-tab"><ul class="right-list"><li>' + val['label'] + '</li></ul>');
   
 
 });
}
})

}
  var route = "{{ url('searchFunction') }}"; // Replace 'searchRole' with your actual route name

  $('#searchiteam').autocomplete({
    source: function(request, response) {
      //console.log($('.tab-pane.show').attr('id'));
      moduleusrid = $('.tab-pane.show').attr('id');
      match = moduleusrid.match(/v-pills-(\d+)/);
      moduleusrid = match[1];
      console.log(moduleusrid);
      $.ajax({
        url: route,
        dataType: "json",
        data: {
          search: request.term,
          moduleusrid: moduleusrid
        },
        success: function(data) {
          response(data); // Assuming the response is an array of module names
        }
      });
    },
    select: function(event, ui) {
      var selectedValue = ui.item.value;
      var moduleId = ui.item.id;
      $("#v-pills-tabContent").empty();
      $("#v-pills-tabContent").append('<div class="tab-pane fade active show" id="v-pills-' + moduleusrid + '" role="tabpanel" aria-labelledby="v-pills-home-tab"><ul class="right-list"><li>' + selectedValue + '</li></ul>');
        }
  });
  

  $('#searchiteam').on('keyup', function() {
    var inputVal = $(this).val();

      moduleusrid = $('.tab-pane.show').attr('id');
      match = moduleusrid.match(/v-pills-(\d+)/);
      moduleusrid = match[1];

    console.log(moduleusrid);
    if (inputVal === '') {
      // Make an Ajax request to populate all role names and edit buttons
      $.ajax({
        type: 'GET',
        url: "{{url('searchFunction')}}", // Replace with the actual route
        data: {
          search: $('#searchiteam').val(),
          moduleusrid: moduleusrid
        },
      //   select: function(event, ui) {

      // var selectedValue = ui.item.value;
      // console.log(selectedValue);
      // var moduleId = ui.item.id;
      // $("#v-pills-tabContent").empty();
      // $("#v-pills-tabContent").append('<div class="tab-pane fade active show" id="v-pills-5" role="tabpanel" aria-labelledby="v-pills-home-tab"><ul class="right-list"><li>' + selectedValue + '</li></ul>');
      //   }
        success: function(result) {
          console.log(result);
          //alert("ggh");
          $('#v-pills-tabContent').empty();

           $.each(result, function(index, val) {
            //console.log(val['label']);
           

             $("#v-pills-tabContent").append('<div class="tab-pane fade active show" id="v-pills-' + moduleusrid + '" role="tabpanel" aria-labelledby="v-pills-home-tab"><ul class="right-list"><li>' + val['label'] + '</li></ul>');
              
            
            });
        }
      });
    }
  });
</script>
@endsection