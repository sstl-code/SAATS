@extends('Layout.tech_site_layout')
@section('content')
<style>
  li.my-3.hoverHead:hover a{
   color: #fff;
  }
  .noactive {
   display: none;
  }
  .activeasset {
   display: none;
  }
  .passiveasset{
   display: none;
  }
  .userdrpdwn{
   display: none;
  }
  .techdrpdwn{
   display: none;
  }
  .table4 i {
   display:none;
  }
  .table3 i {
   display:none;
  }
  .cus_table i {
   display:none;
  }
 .paarrow{
   display: none;
 }
 @media only screen and (max-width: 550px){
   #mobile {
    width: 174%;
}
#tablet{
   width: 190%;
}


 }

</style>
@php
// echo "<pre>";print_r($userdetails);die();
@endphp
<div class="card card_top p-3">
   <h4>Technician to Site Tagging Status </h4>
</div>
<div class="card-header">
  
</div>
<div class="row">
   <div class="col-sm-3 my-2 padding-right">
      <div class="card user_table">
         
            <table id="work" class="table  table-bordered">
               
               <thead style="background-color: #DEEBF6">
                  <tr>
                     <th style="border:none">User Id</th>
                     <th style="border:none">User Name</th>
                  </tr>
               </thead>
               <tbody id="tech_search"><?php
                  $i = 0;                              
                  foreach($userdetails as $userdetail){
                     if($userdetail){ ?>
                      <tr  class="tablehover <?php if($i > 6){ echo 'techdrpdwn"'; } ?>" id="transfer" onclick="getdetails(this)" data-id="{{$userdetail->id}}" style="cursor:pointer">
                        <td style='max-width:100px;'>{{ $userdetail->email}}</td>
                        <td style='max-width:50px;'>{{ $userdetail->name}}</td>
                     </tr><?php
                     $i++;
                  }
                  }?>
                     
               </tbody>
            </table>
            <i class="paarrow fa-solid fa-angle-down text-center" onclick="showtech();" <?php if(count($userdetails) > 7){ echo "style=display:block;"; } ?>></i>
         </div>
   </div>
   <div class="col-sm-3 my-2 padding-right cus_table" >
      <div class="card table_card ">
         <table id="worknone" class="table table-bordered">
            <thead style="background-color: #DEEBF6">
               <tr>
                  <th style="border:none">Site ID</th>
                  <th style="border:none">Site Name</th>
                  <th style="border:none"></th>
               </tr>
            </thead>
            <tbody id="technicial_site" class="technical_site_hov">
            
            </tbody>
         </table>
         
      </div>
      <i class="fa-solid fa-angle-down dropdown_2" style=" margin-left: 160px;
      margin-top: 5px;" onclick="showsite();"></i>
   </div>
   <div class="col-sm-6 my-2" >
      <div class="card" >
         <div class="card-header" style="background-color: #DEEBF6;" id="asset_details_location">
           
         </div>
         <div class="navactivepassive my-3">
            <nav>
               <div class="nav" id="nav-tab" role="tablist">
                  
                  <button  class="nav-link active asset_tab  navtabbutton mx-2" id="nav-home-tab" data-bs-toggle="tab"
                     data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                     aria-selected="true" style="border-radius: 0">
                  Active
                  </button>
                
                  <button class="nav-link asset_tab navtabbutton" id="nav-profile-tab" data-bs-toggle="tab"
                     data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                     aria-selected="false" style="border-radius: 0">
                  Passive
                  </button>
                  
               </div>
            </nav>
         </div>
      </div>
      
      <div class="card" style="border:none">
         <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active table3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
               <div class="card table_card ">
                  <table id="tablet" class="table table-bordered" style="font-size: smaller;">
                     <thead>
                        <tr>
                           
                           <th scope="col" style="border:none; width: 17%;">Asset Type</th>
                           <th scope="col" style="border:none;width: 16%;">Asset Name</th>
                           <th scope="col" style="border:none;width: 15%;">Tenancy</th>
                           <th scope="col" style="border:none;width: 15%;">Serial No</th>
                           <th scope="col" style="border:none;width: 17%;">Asset Tag No</th>
                           <th scope="col" style="border:none;width: 15%;">Status</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody id="tech_active">
                        
                     </tbody>
                  </table>
               </div>
               <i class="fa-solid fa-angle-down" style="margin-left: 337px;
                  margin-top: 1px;" onclick="showtab2();"></i>
            </div>
            
            {{-- passive table --}}
            <div class="tab-pane  fade table4" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
               <div class="card table_card ">
                  <table id="mobile" class="table table-bordered" style="font-size: smaller;">
                     <thead>
                        <tr>
                           
                           <th scope="col" style="border:none; width: 20%">Asset Type</th>
                           <th scope="col" style="border:none; width: 25%">Asset Name</th>
                           <th scope="col" style="border:none; width: 20%">Serial No</th>
                           <th scope="col" style="border:none; width: 20%">Asset Tag No</th>
                           <th scope="col" style="border:none; width: 15%">Status</th>
                        </tr>
                     </thead>
                     <tbody id="tech_passive">
                       
                     </tbody>
                                            
                  </table>
                  
               </div>
               <i class="fa-solid fa-angle-down" style="
                  margin-left: 337px;
                  margin-top: 5px;" onclick="showtabpassive();"></i> 
            </div>
             </div>
         

 

 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>


  function showtab2() {
    
    
    
    $('.activeasset').toggle();
    if($(".table3 i").hasClass('fa-angle-down')){
      $(".table3 i").removeClass('fa-angle-down').addClass('fa-angle-up');
    }else{
      $(".table3 i").removeClass('fa-angle-up').addClass('fa-angle-down');
    }

  }
  function showtabpassive() {
    
    
    
    $('.passiveasset').toggle();
    if($(".table4 i").hasClass('fa-angle-down')){
      $(".table4 i").removeClass('fa-angle-down').addClass('fa-angle-up');
    }else{
      $(".table4 i").removeClass('fa-angle-up').addClass('fa-angle-down');
    }

  }

  function showsite() {
    
    
    
    $('.userdrpdwn').toggle();
    if($(".cus_table i").hasClass('fa-angle-down')){
      $(".cus_table i").removeClass('fa-angle-down').addClass('fa-angle-up');
    }else{
      $(".cus_table i").removeClass('fa-angle-up').addClass('fa-angle-down');
    }

  }
  function showtech() {
    
    
    
    $('.techdrpdwn').toggle();
    if($(".user_table i").hasClass('fa-angle-down')){
      $(".user_table i").removeClass('fa-angle-down').addClass('fa-angle-up');
    }else{
      $(".user_table i").removeClass('fa-angle-up').addClass('fa-angle-down');
    }

  }
  
  

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">


<script>
  
    var route = "{{ url('/technician_search') }}";
    var suggestionsContainer = $('<ul id="suggestions"></ul>');
    $('#search-input').autocomplete({
        source: function(request, response) {
        // alert(request);
            $.ajax({
                url: route,
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function(data) {
                    response(data);
                },
                complete: function(){
               $('#loader').addClass('hidden')
               }, 
            });
        },
       
        select: function(event,ui) { console.log(ui);
            // Access the selected value using ui.item.value
            var selectedValue = ui.item.loc_id;
            $("#tech_search").empty();
               $('#tech_search').append('<tr class="tablehover" style="cursor:pointer" data-id="'+ ui.item.value+'" onclick="getdetails(this)"> <td>' + ui.item.email + '</td><td>' + ui.item.name + '</td></tr>');
            
            // Perform actions with the selected value
            //console.log("Selected: " + selectedValue);
            
            // Prevent the default behavior of filling the input with the selected value
            event.preventDefault();
         }
    });
  function getdetails(e){
      $(".table4 i").hide();
      $('#work').find('.table_color').each(function(){
         $(this).removeClass("table_color");
      });
      $(e).addClass('table_color');
     
   //alert($(e).data("id") );
    $.ajax({
        type: "GET",       
        //url: 'http://3.111.113.246/umprojnew/public/index.php/locationdb',
        url: "{{url('technician_site_map_jason')}}",
        data:{
            'user_id' : $(e).data("id"),
        },
        beforeSend: function(){
         $('#loader').removeClass('hidden');
            $("#loading").show();
        },
        complete: function(){
            $("#loading").hide();
        },
        success: function(result) { 
         $('#loader').addClass('hidden');
        
         if(result.status='success'){
           // console.log(result.location_asset);
            $("#technicial_site").empty();
            $("#tech_active").empty();
            $("#tech_passive").empty();
            $("#asset_details_location").empty();
            //var i = 0;
          
            $.each(result.tech_site_table, function (key, val) {

               var active ="";
               // if(i >11){ 
               //    $(".cus_table i").show();

               //    var active ="userdrpdwn"; 
               // }else{
               //    $(".cus_table i").hide();
               // }
               
               tag_green = "<span class='dotGreen'></span>";
               tag_amber = "<span class='dotAmber'></span>";
               tag_red = "<span class='dotRed'></span>";
               tag_white="<span></span>"
              
                  if(val['locations'][0]&&val['locations'][0]['tagging_status']=='Green'){
                     $('#technicial_site').append('<tr class="'+active+'" style="cursor:pointer;" data-id="'+val['locations'][0]['tl_location_id']+'" onclick="getassetdetails(this)"><td>'+val['locations'][0]['tl_location_code']+'</td><td>'+val['locations'][0]['tl_location_name']+'</td><td>'+ tag_green +'</td></tr>');
                  }
                  else if(val['locations'][0]&&val['locations'][0]['tagging_status']=='Orange'){
                     $('#technicial_site').append('<tr class="'+active+'" style="cursor:pointer;" data-id="'+val['locations'][0]['tl_location_id']+'" onclick="getassetdetails(this)"><td>'+val['locations'][0]['tl_location_code']+'</td><td>'+val['locations'][0]['tl_location_name']+'</td><td>'+ tag_amber +'</td></tr>');
                  }
                  else if(val['locations'][0]&&val['locations'][0]['tagging_status']==''){
                     $('#technicial_site').append('<tr class="'+active+'" style="cursor:pointer;" data-id="'+val['locations'][0]['tl_location_id']+'" onclick="getassetdetails(this)"><td>'+val['locations'][0]['tl_location_code']+'</td><td>'+val['locations'][0]['tl_location_name']+'</td><td>'+ tag_white +'</td></tr>');
                  }
                  else{
                     $('#technicial_site').append('<tr class="'+active+'" style="cursor:pointer;" data-id="'+val['locations'][0]['tl_location_id']+'" onclick="getassetdetails(this)"><td>'+val['locations'][0]['tl_location_code']+'</td><td>'+val['locations'][0]['tl_location_name']+'</td><td>'+ tag_red +'</td></tr>');
                  }
              

               
                 

            });
            
         }

          }  
        

        })
    }
   



//asset_tech_table

function getassetdetails(e){
   //alert("hi");
   $('#worknone').find('.table_color').each(function(){
         $(this).removeClass("table_color");
      });
      $(e).addClass('table_color');
      //alert(val);

     
   
    $.ajax({
        type: "GET",       
        //url: 'http://3.111.113.246/umprojnew/public/index.php/locationdb',
        url: "{{url('technician_site_active_passive')}}",
        data:{
            'asset_site' : $(e).data("id"),
        },
        beforeSend: function(){
         $('#loader').removeClass('hidden');
            $("#loading").show();
        },
        complete: function(){
            $("#loading").hide();
        },
        success: function(result) { 
         $('#loader').addClass('hidden');
            //console.log(result.status);
         if(result.status='success'){
           // console.log(result);
            if(result.tech_asset_details){
            //console.log(result.tech_asset_details[0]['location_name']);
            $("#tech_active").empty();

            $("#asset_details_location").html('Asset Details( '+result.tech_asset_heading['tl_location_code']+'-'+result.tech_asset_heading['tl_location_name']+')');
           
            var i = 0;
            $.each(result.tech_asset_details, function (key, val) {
            
               
               tag_green = "<span class='dotGreen'></span>";
               tag_amber ="<span class='dotAmber'></span>";
               tag_red = "<span class='dotRed'></span>";

               var asset_id=val['ta_asset_id'];
               if (val['AssetType'] == null) {
                  var asset_type = '';
                  } else {
               var asset_type =val['AssetType'];
                   }
               // asset_tag_number
               if(val['ta_asset_tag_number']==null){
                  var tag_no = '';
               }else{
                  var tag_no = val['ta_asset_tag_number'];
               }
               // status
               if(val['ta_asset_active_inactive_status']==null){
                  var asset_status = '';
               }else{
                  var asset_status = val['ta_asset_active_inactive_status'];
               }
               var active ="";
               if(i >7){ 
                  $(".table3 i").show();

                  var active ="activeasset"; 
               }else{
                  $(".table3 i").hide();
               }
               if(val['operators']==null){
                  var operator_name = '';
               }else{
                  var operator_name =val['operators'];
               }
               
               if(val['ta_asset_tag_number'] !=null){
                  //console.log(val['operators'][0]['op_operator_name']);
                   
                     $('#tech_active').append('<tr class="'+active+'"><td>' +asset_type+ '</td><td><a href="#"  onclick="assetdetails('+asset_id+');">'+val['ta_asset_name']+'</td><td>'+operator_name+'</td><td>'+val['ta_asset_manufacture_serial_no']+'</td><td>'+tag_no+'</td><td>'+asset_status+'</td><td>'+ tag_green +'</td></tr>');
               }
                else{
                  
                     $('#tech_active').append('<tr class="'+active+'"><td>' +asset_type+ '</td><td><a href="#"  onclick="assetdetails('+asset_id+');">'+val['ta_asset_name']+'</td><td>'+operator_name+'</td><td>'+val['ta_asset_manufacture_serial_no']+'</td><td>'+tag_no+'</td><td>'+asset_status+'</td><td>'+ tag_red +'</td></tr>');
                  }
                 
                
                
                i++;

                if(val['child_HTML_Active']!=""){
               $('#tech_active').append(val['child_HTML_Active']);
                                 }
            });

         }
         //console.log(result.site_asset_passive);
         if(result.site_asset_passive){
            //console.log(result.site_asset_passive[0]['tl_location_name']);
            $("#tech_passive").empty();
      
            var i = 0;
            $.each(result.site_asset_passive, function (key, val) {
                //console.log(key + val);alert("h");
               tag_green = "<span class='dotGreen'></span>";
               tag_amber ="<span class='dotAmber'></span>";
               tag_red = "<span class='dotRed'></span>";
               if (val['AssetType'] == null) {
                     var asset_type = '';
                  } else {
                       var asset_type =val['AssetType'];
                  }

               var asset_id=val['ta_asset_id'];

               if(val['ta_asset_tag_number']==null){
                  var tag_no = '';
               }else{
                  var tag_no = val['ta_asset_tag_number'];
               }
               if(val['ta_asset_active_inactive_status']==null){
                  var asset_status = '';
               }else{
                  var asset_status = val['ta_asset_active_inactive_status'];
               }
               var active ="";
               if(i >7){  
                  $(".table4 i").show();
                  var active ="passiveasset"; 
               }else{
                  $(".table4 i").hide();
               }
               if(val['ta_asset_tag_number'] !=null){
                    
                     $('#tech_passive').append('<tr class="'+active+'"><td>' +asset_type+ '</td><td><a href="#"  onclick="assetdetails('+asset_id+');">'+val['ta_asset_name']+'</td><td>'+val['ta_asset_manufacture_serial_no']+'</td><td>'+tag_no+'</td><td>'+asset_status+'</td><td>'+ tag_green +'</td></tr>');
             }
               else{
                  $('#tech_passive').append('<tr class="'+active+'" ><td>' +asset_type+ '</td><td><a href="#"  onclick="assetdetails('+asset_id+');">'+val['ta_asset_name']+'</td><td>'+val['ta_asset_manufacture_serial_no']+'</td><td>'+tag_no+'</td><td>'+asset_status+'</td><td>'+ tag_red +'</td></tr>');

               }
              //console.log(key);
              

              if(val['child_HTML_Passive']!=""){
                  $('#tech_passive').append(val['child_HTML_Passive']);
                     }

               
                i++;
            });

        
          }
         }
            
         }  
        

        })
    }



</script>





@endsection
