@extends('Layout.mainlayout')
@section('content')
<style>
   .oprdrpdwn{
      display:none;
   }
   .operator_table i {
      display:none;
   }
   .paarrow{
   display: none;
 }
 .oprsidrpdwn{
   display: none;
 }
 .opesite_tabl i {
   display: none;
 }
 .asstactive{
   display: none;
 }
 .opactive i{
   display: none;
 }
 .drpdwnpassive{
   display: none;
 }
 .oppass i{
   display: none;
 }
 /* .operator_site_hov tr:hover {
    background-color: #c6f2f3 !important;
} */

.table>thead>tr>th,
.table>thead>tr>td {
	background: #DEEBF6;
	
	top: 0px;
	position: sticky;
}
.table {
	
	width: 100%;
}
.input-icon{
   display:block !important;
}

table {
	border-collapse: collapse;
	border-spacing: 0;
}

.table>thead>tr>th,
.table>tbody>tr>th,
.table>thead>tr>td,
.table>tbody>tr>td {
	border: 1px solid #ddd;
}

.input-icon{
   display:block !important;
    position: absolute;
    top: 29%;
    left:162px;
    cursor: pointer;
}
.input-with-icon{
   position: relative;
    display: inline-block;
    /* left: 124px; */
    /* top: 4px; */
    /* margin-left: auto; */
    width: 100%;
}
.search_operatorsite{
   height: 42px;
    margin-right: auto;
    float: right;
    text-align: left;
    background-image: url("{{url('/assets/images/search-icon.png')}}");
    background-size: 20px;
    background-position: right 10px  center; 
    background-repeat: no-repeat;
    padding-left: 18px;
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


<div class="card card_top p-3" style="border-radius: unset;">
   <h4>
      Operator Site  View
      </h4>
</div>

<div class="card-header">
   
</div>
{{-- <div class="card">
   
</div> --}}
{{-- Operator Table--}}
<div class="row">
   <div class="col-sm-2 my-2 ">
      <div class="card table_card unique operator_table" style="margin-top: 66px; box-shadow: 1px 1px 2px;">
         <table id="force1" class="table">
            <thead style="background-color: #DEEBF6">
               <tr>
                  <th>Operator Name</th>
               </tr>
            </thead>
             <tbody class="operatortb_hover"><?php
               $i=0;
               foreach($operator_name as $operatorName){ ?>
                      <tr class="<?php if($i > 10){ echo 'oprdrpdwn"'; } ?>"id="transfer" onclick="getdetails(this)" data-id="{{$operatorName->op_id}}" style="cursor:pointer" class="tablehover">
                        <td>{{ $operatorName->op_operator_name}}</td>                     
                     </tr><?php
                     $i++;
                  }?>
                
      
             </tbody>
         </table>
         <i class="paarrow fa-solid fa-angle-down text-center" onclick="showOpdpdwn();" <?php if(count($operator_name) > 11){ echo "style=display:block;"; } ?>></i>


      </div>
   </div>

   {{--Search box--}}
   <div class="col-sm-3 my-2 opesite_tabl" style="position: relative;  right: 10px;">
     
       
         {{-- Search_Bar --}}
         <div class="input-with-icon">
            <input type="hidden" name="operator_id" value="" id="operator_id">
            <input type="text" class="input-field Search search_operatorsite" style="height: 42px;" id="tech_search" placeholder="Search Operator Site">
            <!-- <img src="{{url('/assets/images/search-icon.png')}}"> -->
            <!-- <i class="input-icon fa-solid fa-rotate-right" onclick="handleIconClick()"></i> -->
         </div>
          {{--site table--}}
      <div class="card table_card action mt-4" style="box-shadow: 1px 1px 2px;">

         <table id="site_table" class="table" >
            <thead style="background-color: #DEEBF6">
                <tr>
                  <th style="border:none">Site ID</th>
                  <th style="border:none">Site Name</th>
                  <th style="border:none"></th>
               </tr>
            </thead>
            <tbody id="operator_site_table" class="operator_site_hov">

               
              
            </tbody>
         </table>
        
         <i class="fa-solid fa-angle-down" style="margin-left: 409px;
      margin-top: 1px;" onclick="showop();"></i>
      </div>
      
   </div>
   <div class="col-sm-7 my-2 mx-0" style="position: relative;right: 18px;">
      <div class="card" >
         <div class="card-header" id="operator_site_name" style="background-color: #DEEBF6;">
            {{-- Asset Details(LS-SALTLAKE/2-Salt Lake 2) --}}
         </div>

      {{--Active and Passive button--}}
         <div class="navactivepassive my-3">
            <nav>
               <div class="nav" id="nav-tab" role="tablist">
                  <button class="nav-link active asset_tab navtabbutton mx-2" id="nav-home-tab" data-bs-toggle="tab"
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

      {{-- Active Table --}}

      <div class="card" style="border:none">
         <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active opactive" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
               <div class="card table_card ">
                  <table id="tablet" class="table table-bordered" style="font-size: smaller;">
                     <thead>
                        <tr>
                           
                           
                           <th scope="col" style="border:none; width: 17%;">Asset Type</th>
                           <th scope="col" style="border:none;width: 16%;">Asset Name</th>
                           <th scope="col" style="border:none;width: 15%;">Tenancy</th>
                           <th scope="col" style="border:none;width: 15%;">Serial No</th>
                           <th scope="col" style="border:none;width: 17%; ">Asset Tag No</th>
                           <th scope="col" style="border:none;width: 15%;">Status</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody id="operator_active">
                     </tbody>
                  </table>
               </div>
               {{-- <i class="fa-solid fa-angle-down" style="margin-left: 409px;
                  margin-top: 1px;" onclick="showActive();"></i> --}}
            </div>
            
            {{-- passive table --}}
            <div class="tab-pane  fade oppass" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
               <div class="card table_card ">
                  <table id="mobile" class="table table-bordered" style="font-size: smaller;">
                     <thead>
                        <tr>
                           
                           
                           <th scope="col" style="border:none;width: 20%">Asset Type</th>
                           <th scope="col" style="border:none; width: 25%">Asset Name</th>
                           <th scope="col" style="border:none; width: 20%">Serial No</th>
                           <th scope="col" style="border:none; width: 20%">Asset Tag No</th>
                           <th scope="col" style="border:none; width: 15%">Status</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody id="operator_passive">
                       
                     </tbody>
                                            
                  </table>
                  
               </div>
               <i class="fa-solid fa-angle-down" style="
                  margin-left: 418px;
                  margin-top: 5px;" onclick="showPassive();"></i> 
            </div>
            
       
         
   </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
   
  function showOpdpdwn() {
    
    
    
    $('.oprdrpdwn').toggle();
    if($(".operator_table i").hasClass('fa-angle-down')){
      $(".operator_table i").removeClass('fa-angle-down').addClass('fa-angle-up');
    }else{
      $(".operator_table i").removeClass('fa-angle-up').addClass('fa-angle-down');
    }

  }
  function showop() {
    
    
    
    $('.oprsidrpdwn').toggle();
    if($(".opesite_tabl i").hasClass('fa-angle-down')){
      $(".opesite_tabl i").removeClass('fa-angle-down').addClass('fa-angle-up');
    }else{
      $(".opesite_tabl i").removeClass('fa-angle-up').addClass('fa-angle-down');
    }

  }
  function showActive() {
    
    
    
    $('.asstactive').toggle();
    if($(".opactive i").hasClass('fa-angle-down')){
      $(".opactive i").removeClass('fa-angle-down').addClass('fa-angle-up');
    }else{
      $(".opactive i").removeClass('fa-angle-up').addClass('fa-angle-down');
    }

  }
  function showPassive() {
    
    
    
    $('.drpdwnpassive').toggle();
    if($(".oppass i").hasClass('fa-angle-down')){
      $(".oppass i").removeClass('fa-angle-down').addClass('fa-angle-up');
    }else{
      $(".oppass i").removeClass('fa-angle-up').addClass('fa-angle-down');
    }

  }
  const searchInput = document.getElementById('tech_search');

   searchInput.addEventListener('input', function() {
    if (this.value.trim() === '') {
        this.style.backgroundImage = 'url("{{url('/assets/images/search-icon.png')}}")';
    } else {
        this.style.backgroundImage = 'none';
    }
   });

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">   
<script>
   // $(document).ready(function() {

     
    var route = "{{ url('/operator_active_passive_serarch') }}";
    var suggestionsContainer = $('<ul id="suggestions"></ul>');
    $('#tech_search').autocomplete({
        source: function(request, response) {
        // alert(request);
            $.ajax({
                url: route,
                dataType: "json",
                data: {
                    search: request.term,
                    //operator_id : $('#operator_id').val()
                },
                success: function(data) {
                    response(data);
                }
            });
        },

        select: function(event, ui) { //console.log(ui);
            // Access the selected value using ui.item.value
            
            var selectedValue = ui.item.tl_location_id;
            tag_green = "<span class='dotGreen'></span>";
            tag_red = "<span class='dotRed'></span>";
            tag_amber = "<span class='dotAmber'></span>";
            //console.log(ui.item.tl_location_id);
            
            $("#operator_site_table").empty();
            if(ui.item.tagging_status=='Green'){
               $('#operator_site_table').append('<tr class="" style="cursor:pointer" data-id="'+ ui.item.value+'" onclick="getassetdetails(this)"> <td>' + ui.item.label + '</td><td>' + ui.item.value + '</td><td>'+tag_green+'</td></tr>');
            }else if(ui.item.tagging_status=='Orange'){
               $('#operator_site_table').append('<tr class="" style="cursor:pointer" data-id="'+ ui.item.value+'" onclick="getassetdetails(this)"> <td>' + ui.item.label + '</td><td>' + ui.item.value + '</td><td>'+tag_amber+'</td></tr>');
            }else{
               $('#operator_site_table').append('<tr class="" style="cursor:pointer" data-id="'+ ui.item.value+'" onclick="getassetdetails(this)"> <td>' + ui.item.label + '</td><td>' + ui.item.value + '</td><td>'+tag_red+'</td></tr>');
            }
            
            // Perform actions with the selected value
            console.log("Selected: " + selectedValue);
            
            // Prevent the default behavior of filling the input with the selected value
            event.preventDefault();
         }
    });


</script>


<script>
   function getdetails(e){
      $('#force1').find('.table_color').each(function(){
         $(this).removeClass("table_color");
      });
      $(e).addClass('table_color');
      $('#operator_id').val($(e).data("id"));
     
   //alert($(e).data("id") );
    $.ajax({
        type: "GET",       
        //url: 'http://3.111.113.246/umprojnew/public/index.php/locationdb',
        url: "{{url('operator_site_jason')}}",
        data:{
            'operator_id' : $(e).data("id"),
        },
        beforeSend: function(){
         $('#loader').removeClass('hidden');
            $("#loading").show();
        },
        complete: function(){
            $("#loading").hide();
        },
        success: function(result) { 
         //console.log(result)
         $('#loader').addClass('hidden');
        
         if(result.status='success'){
           // console.log(result.location_asset);
            $("#operator_site_table").empty();
            $("#operator_active").empty();
            $("#operator_passive").empty();
            $("#operator_site_name").empty();
            tag_green = "<span class='dotGreen'></span>";
            tag_red = "<span class='dotRed'></span>";
            tag_amber = "<span class='dotAmber'></span>";
            tag_white="<span></span>"
            var i = 0;
            if(result.operator_site_table.length != 0){    
               $.each(result.operator_site_table, function (key, val) {
                  //console.log(val['tl_location_code']);
                  $("#operator_site_name").html('Asset Details( '+val['tl_location_code']+'-'+val['tl_location_name']+')');
               
                  var active ="";
                  if(i >10){ 
                     $(".opesite_tabl i").show();

                     var active ="oprsidrpdwn"; 
                  }else{
                     $(".opesite_tabl i").hide();
                  }
                  //($tech_site_table as $locationdetail)
                  // console.log(key + val['asset_id']);
                  if(val['tagging_status']){
                  if(val['tagging_status']=='Green'){
                     
                  $('#operator_site_table').append('<tr class="'+active+'" style="cursor:pointer;" data-id="'+val['tl_location_id']+'" data-operator="'+$(e).data("id")+'" onclick="getassetdetails(this)"><td>'+val['tl_location_code']+'</td><td>'+val['tl_location_name']+'</td><td>'+tag_green+'</td></tr>');
                  } else if(val['tagging_status']=='Orange'){
                     
                     $('#operator_site_table').append('<tr class="'+active+'" style="cursor:pointer;" data-id="'+val['tl_location_id']+'" data-operator="'+$(e).data("id")+'" onclick="getassetdetails(this)"><td>'+val['tl_location_code']+'</td><td>'+val['tl_location_name']+'</td><td>'+tag_amber+'</td></tr>');
                     }
                     else if(val['tagging_status']==''){
                     
                     $('#operator_site_table').append('<tr class="'+active+'" style="cursor:pointer;" data-id="'+val['tl_location_id']+'" data-operator="'+$(e).data("id")+'" onclick="getassetdetails(this)"><td>'+val['tl_location_code']+'</td><td>'+val['tl_location_name']+'</td><td>'+tag_white+'</td></tr>');
                     }else{
                     
                     $('#operator_site_table').append('<tr class="'+active+'" style="cursor:pointer;" data-id="'+val['tl_location_id']+'" data-operator="'+$(e).data("id")+'" onclick="getassetdetails(this)"><td>'+val['tl_location_code']+'</td><td>'+val['tl_location_name']+'</td><td>'+tag_red+'</td></tr>');
                     }
                  }
                  
                  i++;
                  

               });
            }else{
               
               $('#operator_site_table').append('<tr style="cursor:pointer;"> <td colspan="3">No Sites Found !!</td></tr>');
            }
         }

          }  
        

        })
    }



//asset_tech_table

function getassetdetails(e){
   //alert("hi");
   $('#site_table').find('.table_color').each(function(){
         $(this).removeClass("table_color");
      });
      $(e).addClass('table_color');
      //alert(val);


    var operatorID=$(e).data("operator");
    $.ajax({
        type: "GET",       
        //url: 'http://3.111.113.246/umprojnew/public/index.php/locationdb',
        url: "{{url('operator_active_passive')}}",
        data:{
            'site_id' : $(e).data("id"),
             'operator_id': $(e).data("operator")
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
            //console.log(result.operator_asset_detail[0]['assets_site']);
         if(result.status='success'){
            //console.log(result.operator_asset_detail);
            if(result.operator_asset_detail[0]){
               $('#operator_site_name').html("Asset Details( "+result.operator_asset_detail[0].locationtype.tl_location_code+"-"+result.operator_asset_detail[0].locationtype.tl_location_name+" )");
            }
            $("#operator_active").empty();
            $("#operator_passive").empty();
           
           
            var i = 0;
            $.each(result.operator_asset_detail, function (key, val) {
               //console.log(result.operator_asset_detail[0]['assets_site'][0]['childs']);
                 //console.log(val['childs']);
                var asset_id=val['ta_asset_id'];
                if (val['AssetType'] == null) {
                  var asset_type = '';
               } else {
                       var asset_type =val['AssetType'];
               }
         
               if(val['ta_asset_name']==null){
                  val['ta_asset_name'] = '';
               }
               //if(val['ta_asset_catagory']!=null){
               if(val['ta_asset_catagory'].toUpperCase()=='ACTIVE') {
               
               tag_green = "<span class='dotGreen'></span>";
               tag_amber = "<span class='dotAmber'></span>";
               tag_red = "<span class='dotRed'></span>";
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
              
               if(val['operator_id']==operatorID){
               if(tag_no!=''){

                  //console.log(val);
                   
                     $('#operator_active').append('<tr class="'+active+'"><td>' +asset_type+ '</td><td><a href="#" onclick="assetdetails('+asset_id+');">'+val['ta_asset_name']+'</td><td>'+val['operators']+'</td><td>'+val['ta_asset_manufacture_serial_no']+'</td><td>'+tag_no+'</td><td>'+asset_status+'</td><td>'+ tag_green +'</td></tr>');
                        //alert("mm");
                
               }
               
               else{
                 
                  
                     $('#operator_active').append('<tr class="'+active+'"><td>' +asset_type+ '</td><td><a href="#" onclick="assetdetails('+asset_id+');">'+val['ta_asset_name']+'</td><td>'+val['operators']+'</td><td>'+val['ta_asset_manufacture_serial_no']+'</td><td>'+tag_no+'</td><td>'+asset_status+'</td><td>'+ tag_red +'</td></tr>');
                   }
                  
                
               
            
              }
            }
            if(val['child_HTML_Active']!=""){
                  $('#operator_active').append(val['child_HTML_Active']);
                           }
               
           
               //ta_asset_catagory
         
            if(val['ta_asset_catagory'].toUpperCase()=='PASSIVE') {
               
               // console.log(key + val['asset_id']);
               tag_green = "<span class='dotGreen'></span>";
               tag_amber = "<span class='dotAmber'></span>";
               tag_red = "<span class='dotRed'></span>";
              
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
                  $(".oppass i").show();
                  var active ="drpdwnpassive"; 
               }else{
                  $(".oppass i").hide();
               }
               if(tag_no!=''){
                    
                     $('#operator_passive').append('<tr class="'+active+'"><td>' +asset_type+ '</td><td><a href="#" onclick="assetdetails('+asset_id+');">'+val['ta_asset_name']+'</td><td>'+val['ta_asset_manufacture_serial_no']+'</td><td>'+tag_no+'</td><td>'+asset_status+'</td><td>'+ tag_green +'</td></tr>');
             }else{
                  $('#operator_passive').append('<tr class="'+active+'"><td>' +asset_type+ '</td><td><a href="#" onclick="assetdetails('+asset_id+');">'+val['ta_asset_name']+'</td><td>'+val['ta_asset_manufacture_serial_no']+'</td><td>'+tag_no+'</td><td>'+asset_status+'</td><td>'+ tag_red +'</td></tr>');

               }
               

               if(val['child_HTML_Passive']!=""){
                  $('#operator_passive').append(val['child_HTML_Passive']);
                     }



              
            }
                     //  }
         });
      }
   }
   
      });
    }

// Refresh_Icon

// Function to handle icon click event
function handleIconClick() {
// Refresh the page when the icon is clicked
            location.reload();
        }
   
</script>

@endsection