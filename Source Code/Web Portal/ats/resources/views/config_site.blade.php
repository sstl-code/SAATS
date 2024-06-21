@extends('Layout.mainlayout')
@section('content')
<style>
   .dataTables_filter{
      position: relative !important;
      right: 10px !important;
      
      
    
}

.dataTables_wrapper .dataTables_filter {
      float: right;
    }
    .dataTables_wrapper .dataTables_filter input {
      width: 100px;
      padding-right: 30px; /* Add space for the search icon */
      background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIEAAAB+CAMAAAA0uoKuAAAAZlBMVEX///8AAADw8PDk5OT39/f8/PwUFBTg4ODt7e3GxsaLi4stLS02NjaHh4e3t7cyMjKgoKAlJSVLS0vX19fAwMBoaGg+Pj5FRUXPz89jY2NwcHALCwtXV1eXl5eurq6mpqYbGxt9fX2Ld7qBAAAFeUlEQVRogcVb6ZqqMAxFFkHEBcEFRJH3f8k7OH5jUpqSQPSe39Ae0uwNnsdHcNm2m7o5Z1l2qOpNu70EgrdnIrnsm/VyYWK5rvaX5Avbb6vdYPM3snrrf3T/snbs/sK1Xn1q+2Q/vv2LxP4Tggi6K5dAj1RbMf30Idn/B/kt1CRwz4X7Pzls1faPDxP279HEOgRuE/fvsVfY329mEFgs6tlWUbg04Hp95Hm+vLqsZFfMI7AlF+7asvCj50ORX5RtR7rKWQqZWpfMu63N0sJtbRfYDGXY2CR/XNFH65fVMGQtFrepBGwS2IwZWGyjnaoRSDmanXRKFIYEam70D4YhdMJB3M011pKgWw50UmwRxUAAMteSHM0FhH7BN79BblFmNrGWfYLhipcXMYGhGBvJy0YwyqelG8V6shwN9rup+U6R4YX465zxAU5PuGKcWVXc91qsA3MyvgAL4c57K8GufV50vWBx8nwaduxM2iSwUbK8c4xEUM8k4HnYQ3OEgN7I5qfcPrLJzfgLMaI8xROZWKEVxz8JhcROgYAh1fEgiQjrlH/IJHdjQtjK+PKA5Fq6n40q8OxSq/JLYKQdcYxIYFoiwEJ4uH1sy39UAvRh7mwJ5gXzndEb0ByceUIAY9nMcgsB+oSHyy+W4MGzZgcigsfgSnlhUGL4TwE6poafmUzlgH7GoQgoQ1Yl4PkL1tIFj+gkwJSRVkWoiHru6BdQEegDhpWaXiNsuDb9ddAUNDIDCJgw0rka9FzafdkCJH+0t4V9w0iZQQL6THR4BBldrkzAC0/vxQ/k54GokGkziIC3o/Nf0Bc8aTOAR7wmGQA1OH+SQf7fZUAzAAajrgceSw+ALay1CfBsAdC8ajPwWf4A+kTVOxoPNzNonwjjgmaW2IMXF2Curh0bYZJEx0beU9MAixa6cIM5ErvrxARMQelSKIHlgi4BlK47ngM2q6yKsGRx+duOpbBTkDJXRlm9qkeAdYCrg4CaSEoXpk9AHXfX5LB21izb4PG6Az9squ/0RjqQkbXOR9ExzG2nvoE61e7TjWC6rBahQ1iyjZWDqA2sJYRWsmgIH17qFA0hvBlfjpZCwgYoB6hZP25h+IZHwyfgTjWjQYeu2RS6CBG6M+KEXHwrMj864NtjVrzDt6Vz20klWo3Xo8Tndp3nGfGNzZKpV1hu2RyTDPHtMdu28GXbYXqYDvHN5Yn9MfheZnqmYE4SCTpDHX6TrrLcBIxZLkmrPDRGe7Ip6pgYF9+j1ysIsfHuVW6UK3N/iSZ6llEoYYiI7KNMkrxrsEIluXIJqHE+iS4MBkkEYnCM81UCrR5SWPLK2btznlSg1WFlef0+lmD492z4GsKaH/JtFBanNKDlGAXp2P69KPkFYTQ8iB7Nza6U8Z47TSmwbbtN9WPR7QrSiFctY5j6DUEOTI5I9jTyc1NVVXPORaPMTwjcizlUpIWUb5WhSLwG7Ir0RCeIuKVt7pKDR2lknQiioN9NIvAUdEyfomhWrnCIk0D1cjzBmXwkF5UjF3ohG5p3PmQmKgDCmb8LXw41Wjmy+dYXJElL/zW3E73WH07D/yds87svuPsZQ4TFxj3If0gLm4o7fv+QV8dhca8sv/L82N66useUhbWWF16Y1q+KyzZt3mEwa1IcJ4ZwuPfjJApyXGi/pjru4UBM/4hw/tIPYcMC4g8nzfapA6HDjrTvdCg44uzH/gQzQCVdC80GqhuOUkJ76IIC7Zv0b5oJ2EraXwjD1HQUVGKrM5TKokD8eaR/3U4iIKL89xhQvumLDGyV+U9y8VUGXjdkoH3TPIahb/pWbPiDmbRoX3UzYPzc8Nk/pQkKcPLlSymCgeDPJI7/QwJPFPtjlh3bXwH8A67YPCrfx+fUAAAAAElFTkSuQmCC'); /* Replace with the path to your search icon */
      background-repeat: no-repeat;
      background-position: 226px;
      background-size: 16px 16px;
    }

    .dataTables_filter input[type="search"]::-webkit-search-cancel-button,
    .dataTables_filter input[type="search"]::-webkit-search-decoration {
    -webkit-appearance: none;
     appearance: none;
     display: none;
}


/* .dataTables_filter input[type="search"] { */
  /* padding-right: 30px; Adjust the padding as needed */
/* } */

/* .dataTables_filter::after { */
  /* content: ""; */
  /* background-image: url("{{ asset('images/magnifying-glass-solid.png') }}"); Replace with the path to your search icon image */
  /* background-size: 16px; Adjust the size of the icon */
  /* background-repeat: no-repeat; */
  /* width: 16px; Adjust the width of the icon */
  /* height: 16px; Adjust the height of the icon */
  /* position: absolute; */
  /* top: 50%; */
  /* right: 10px; Adjust the right position as needed */
  /* transform: translateY(-50%); */
  /* pointer-events: none; */
/* } */

.searchIn{
       background:url(https://cdn0.iconfinder.com/data/icons/basic-website/512/search-website-512.png) no-repeat scroll left center / 15px auto;
     }
     
     .searchOut{
     background:none; 
     }
/* #sitetable2_filter{
   padding-left: 20px;
  background-image: url('public/assets/images/search-icon.png');
  background-repeat: no-repeat;
  background-position: left center;
} */
.navs{
   position: relative;
    left: 39px;

    
}

.hovbutton:hover{
   color: black !important;

}
.hovbutton{
   color:  #808080 !important;
}
.navs .nav-link.active{
   text-decoration: underline;
}

.dataTables_info{
   display: none !important;
}

.modwidth{
   max-width:80% !important;
}

/* .hl{
   color: #808080;
}

.hl:hover {
	color: black;
} */



.hl.active{
	background-color: #EBEFF2 !important;
	color:black !important;
	font-weight:bolder !important;
	
}
.hl{
	color:gray !important;
   border-radius: 0 !important;
}










</style>
<script>
   @if(session('status'))
       toastr.success('{{ session('status') }}');
   @endif
</script>
<div class="card col-12" style="border-radius: unset;">
   <div class="card-header">
      Configuration Management
   </div>
</div>

      <nav>
         <div class="nav nav-tabs configbutton hovbutton" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-asset" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Asset</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-site" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Site</button>
            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-reason" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Reason</button>
         </div>
      </nav>
      
         {{-- site --}}
         <div class="tab-pane fade" id="nav-site" role="tabpanel" aria-labelledby="nav-profile-tab">
            <nav>
               <div class="nav nav-tabs navs" id="nav-tab" role="tablist">
                  <button class="nav-link active hl" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-site_nav" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Site</button>
                  <button class="nav-link hl" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-site_attribute" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Attribute</button>
               </div>
            </nav>
           
            <div class="tab-content" id="nav-tabContent">
               
               {{-- site table --}}
               <div class="tab-pane fade show active" id="nav-site_nav" role="tabpanel" aria-labelledby="nav-home-tab">
                  <button type="button" class="btn btn-primary btn-sm point" data-bs-toggle="modal" data-bs-target="#site_add"onclick="addsite_type(this)">Add Site</button>
                 
                  <table id="sitetable" class="table table-striped table-bordered mx-2 config_table table_config" style="width:100%">
                     
                     <thead>

                        <tr>
                           <th>ID</th>
                           <th>Location Code</th>
                           <th>Site Type</th>
                           <th>Name</th>
                           <th>Address</th>
                           <th>Site Description</th>
                           <th>Site Region</th>
                           <th>Site Latitude</th>
                           <th>Site Longitude</th>
                           <th>Status</th>
                           <th></th>
                          
                          
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($configLocation as $sitedetails)
                        <tr>
                           <td>{{$sitedetails->tl_location_id}}</td>
                           <td>{{$sitedetails->tl_location_code}}</td>
                           <td>{{$sitedetails->tl_location_type}}</td>
                           <td>{{$sitedetails->tl_location_name}}</td>
                           <td>{{$sitedetails->tl_location_address}}</td>
                           <td>{{$sitedetails->tl_location_description}}</td>
                           <td>{{$sitedetails->tl_location_region}}</td>
                           <td>{{$sitedetails->tl_location_latitude}}</td>
                           <td>{{$sitedetails->tl_location_longitude}}</td>
                           <td>{{$sitedetails->tl_location_status}}</td>
                           
                           
                           
                           <td>
                              <button type="button" class="btn btn-primary btn-sm edtbtn" style="border-radius: 0;
                                 background-color: #202C55;width: 76px;" data-bs-toggle="modal" data-bs-target="#site_edit" onclick="siteDetails(this)" data-id="{{$sitedetails->tl_location_code}}">Edit</button>
                              {{-- <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0;
                                 background-color: #202C55;">Sub Reason</button> --}}
                           </td>
                        </tr>
                        @endforeach
                        
                     </tbody>
                  </table>
               </div>
               {{--Site Attribute navbar--}}
               <div class="tab-pane fade" id="nav-site_attribute" role="tabpanel" aria-labelledby="nav-profile-tab">
                  <nav>
                     <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active hl" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-sit_fixed" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Fixed</button>
                        <button class="nav-link hl" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-sit_dynamic" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Dynamic</button>
                     </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                     {{--Attribute Fixed table--}}
                     <div class="tab-pane fade active show" id="nav-sit_fixed" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <button type="button" class="btn btn-primary btn-sm point" data-bs-toggle="modal" data-bs-target="#atr_add" onclick="addfixatr(this)">Add Attribute</button>
                        <table id="sitetable2" class="table table-striped table-bordered mx-2 config_table_2 table_config" style="width:100%">
                           <thead>
                              <tr>
                                 <th>ID</th>
                                 <th>Attribute</th>
                                 <th>Description</th>
                                 <th>Data Type</th>
                                 <th>Fixed List of Values</th>
                                 <th>Mandatory Flag</th>
                                 <th>Default Value</th>
                                 <th>Display</th>
                                 <th>Editable</th>
                                 <th>Status</th>
                                 <th></th>
                                 
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($config_fixed_attribute as $fixed_attr)
                              <tr>
                                 <td>{{$fixed_attr->la_location_attribute_id}}</td>
                                 <td>{{$fixed_attr->la_location_attribute_name}}</td>
                                 <td>{{$fixed_attr->la_location_attribute_description}}</td>
                                 <td>{{$fixed_attr->la_location_attribute_datatype}}</td>
                                 <td>{{$fixed_attr->la_flov}}</td>
                                 <td>{{$fixed_attr->la_location_attribute_mandatory_flag}}</td>
                                 <td>{{$fixed_attr->la_location_attribute_default_value}}</td>
                                 <td>{{$fixed_attr->la_display}}</td>
                                 <td>{{$fixed_attr->la_editable}}</td>
                                 <td>{{$fixed_attr->la_status}}</td>
                                 
                                 {{-- <td>{{$fixed_attr->tl_location_type}}</td>
                                 <td>{{$sitedetails->tl_location_type}}</td> --}}
                                 <td style="text-align: center">
                                    <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0;
                                       background-color: #202C55;width: 76px;" data-bs-toggle="modal" data-bs-target="#atr_edit" data-id="{{$fixed_attr->la_location_attribute_id}}" onclick="fixed_attr(this)">Edit</button>
                                    {{-- <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0;
                                       background-color: #202C55;">Sub Reason</button> --}}
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                     {{--Site dynamic table--}}
                     <div class="tab-pane fade " id="nav-sit_dynamic" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <button type="button" class="btn btn-primary btn-sm point" data-bs-toggle="modal" data-bs-target="#atr_dynamic" onclick="adddynaatr(this)">Add Attribute</button>
                        <table id="sitetable3" class="table table-striped table-bordered mx-2 config_table_3 table_config" style="width:100%">
                           <thead>
                              <tr>
                                 <th>ID</th>
                                 <th>Site Type</th>
                                 <th>Attribute</th>
                                 <th>Description</th>
                                 <th>Data Type</th>
                                 <th>Fixed List of Values</th>
                                 <th>Mandatory Flag</th>
                                 <th>Default Value</th>
                                 <th>Display</th>
                                 <th>Editable</th>
                                 <th>Status</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($config_dynamic_attribute as $dynamic_atr)
                              <tr>
                                 <td >{{$dynamic_atr->la_location_attribute_id}}</td>
                                 <td>{{$dynamic_atr->la_location_attribute_location_type}}</td>
                                 <td>{{$dynamic_atr->la_location_attribute_name}}</td>
                                 <td>{{$dynamic_atr->la_location_attribute_description}}</td>
                                 
                                 <td>{{$dynamic_atr->la_location_attribute_datatype}}</td>
                                 <td>{{$dynamic_atr->la_flov}}</td>
                                 <td>{{$dynamic_atr->la_location_attribute_mandatory_flag}}</td>
                                 <td>{{$dynamic_atr->la_location_attribute_default_value}}</td>
                                 <td>{{$dynamic_atr->la_display}}</td>
                                 <td>{{$dynamic_atr->la_editable}}</td>
                                 <td>{{$dynamic_atr->la_status}}</td>
                               
                                 
                                 <td style="text-align: center">
                                    <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0;
                                       background-color: #202C55;width: 76px;" data-bs-toggle="modal" data-bs-target="#dynamicatr_edit" data-id="{{$dynamic_atr->la_location_attribute_id}}" onclick="dynamic_attr(this)">Edit</button>
                                    {{-- <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0;
                                       background-color: #202C55;">Sub Reason</button> --}}
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div> 
               
            </div>
         </div>
         
      {{-- Site Modal Start --}}
      
      <div class="modal fade" id="site_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modwidth" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="AddModal">Add Site</h5>
               <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                 &times;
               </button>
             </div>
             <div class="modal-body">
               <div class="row">
               <div class="col-md-6">
                
                  <form action="{{url('congiguration_add_site')}}" method="POST" id="myform">
                     <div class="form-group">
                       <label for="site_id" class="col-form-label">Location Code</label>
                       <input type="text" class="form-control" id="site_id" name="site_id">
                     </div>
                     <div class="form-group">
                      <label for="site_type" class="col-form-label">Site Type</label>
                      
                      <select name="site_type" class="form-select random" id="site_type"  >
                         
                          <option value="" selected>Select</option>
                          @foreach( $sitetype as $location_site)
      
                          <option value="{{$location_site->lt_location_type_id}}">{{$location_site->lt_location_type}}</option>
                          @endforeach
                       </select>
                    </div>
                    <div class="form-group">
                      <label for="site_name" class="col-form-label">Site Name</label>
                      
                      <input type="site_name" class="form-control" id="site_name" name="site_name">
                      
                    </div>
                    <div class="form-group">
                      <label for="site_address" class="col-form-label">Site Address</label>
                      <input type="text" class="form-control" id="site_address" name="site_address">
                    </div>
                    <div class="form-group">
                      <label for="site_description" class="col-form-label">Site Description</label>
                      <input type="text" class="form-control" id="site_description" name="site_description">
                    </div>

               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="site_region" class="col-form-label">Site Region</label>
                     <input type="text" class="form-control" id="site_region" name="site_region">
                   </div>
                   <div class="form-group">
                     <label for="site_latitude" class="col-form-label">Site Latitude</label>
                     <input type="text" class="form-control" id="site_latitude" name="site_latitude">
                   </div>
                   <div class="form-group">
                     <label for="site_longitude" class="col-form-label">Site Longitude</label>
                     <input type="text" class="form-control" id="site_longitude" name="site_longitude">
                   </div>
                   <div class="form-group">
                     <label for="site_status" class="col-form-label">Site Status</label>
                     {{-- <input type="text" class="form-control" id="site_status" name="site_status">  
                      --}}
                     <select name="site_status" class="form-select" id="site_status">
                      <option value="" selected>Select</option>
                      <option value="Active">Active</option>
                      <option value="Inactive">Inactive</option>
                     </select>
                   </div>
                    {{-- <div class="form-group">
                      <label for="message-text" class="col-form-label">Message:</label>
                      <textarea class="form-control" id="message-text"></textarea>
                    </div> --}}
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" id="submit_button" onclick="saveadd()">Save</button>
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="resetBtn" value="Reset">Cancel</button>
                </div>
              </div>
            </div>
          </div>
         </div>
         </div>


               
                
       

       {{-- Site Edit Modal Start --}}

       <div class="modal fade" id="site_edit" tabindex="-1" role="dialog" aria-labelledby="sitemodallLabel" aria-hidden="true">
         <div class="modal-dialog modwidth" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="site_edit2">Update Site</h5>
               <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                 &times;
               </button>
             </div>
             <div class="modal-body">
               <div class="row">
                  <div class="col-md-6">

                    <div class="form-group">
                      <label for="site_editid" class="col-form-label">Location Code</label>
                      <input type="text" class="form-control" id="site_editid" name="site_editid" disabled>
                    </div>
                     
                        <div class="form-group">
                          
                          <label for="site_type" class="col-form-label">Site Type</label>
                         
                           <select name="site_type" class="form-select" id="site_typeedit">
                           
                            
                             @foreach( $sitetype as $location_site)
                             <option value="{{$location_site->lt_location_type}}" data-val="{{$location_site->lt_location_type_id}}">{{$location_site->lt_location_type}}</option>
                             @endforeach
                          </select>
                           {{-- <input type="text" class="form-control" id="site_type" name="site_type"> --}}

                           {{-- <input type="hidden" class="form-control" id="site_editid" name="site_editid"> --}}
                        </div>
                        <div class="form-group">
                         <label for="edtsite_name" class="col-form-label">Site Name</label>
                         <input type="text" class="form-control" id="edtsite_name" name="edtsite_name">
                       </div>
                       <div class="form-group">
                        <label for="edtsite_address" class="col-form-label">Site Address</label>
                        
                        {{-- <input type="text" class="form-control" id="parent_asset_type"  --}}
                        <input type="text" class="form-control" id="edtsite_address" name="edtsite_address">
                      </div>

                      <div class="form-group">
                        <label for="edtsite_description" class="col-form-label">Site Description</label>
                        <input type="text" class="form-control" id="edtsite_description" name="edtsite_description">
                      </div>

                  </div>
                  <div class="col-md-6">
                     

                      <div class="form-group">
                        <label for="edtsite_region" class="col-form-label">Site Region</label>
                        <input type="text" class="form-control" id="edtsite_region" name="edtsite_region">
                      </div>

                      <div class="form-group">
                        <label for="edtsite_latitude" class="col-form-label">Site Latitude</label>
                        <input type="text" class="form-control" id="edtsite_latitude" name="edtsite_latitude">
                      </div>

                      <div class="form-group">
                        <label for="edtsite_longitude" class="col-form-label">Site Longitude</label>
                        <input type="text" class="form-control" id="edtsite_longitude" name="edtsite_longitude">
                      </div>
                      <div class="form-group">
                        <label for="site_status" class="col-form-label">Site Status</label>
                        {{-- <input type="text" class="form-control" id="site_status" name="site_status"> --}}

                        <select name="edtsite_status" class="form-select" id="edtsite_status">
                           <option value="" selected>Select</option>
                          <option value="Active">Active</option>
                          <option value="Inactive">Inactive</option>
                         </select>
                    
                      </div>
                     </form>
                   </div>
                   <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" onclick="update_site()">Update</button>
                     <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                   </div>
                 </div>
               </div>
             </div>

                  </div>



               </div>
              
                
        {{-- End --}}

        {{--Site Fixed Attribute modal start --}}

        <div class="modal fade" id="atr_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modwidth" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="add_atr">Add Attribute</h5>
               <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                 &times;
               </button>
             </div>
             <div class="modal-body">
               <div class="row">
                  <div class="col-md-6">
                     <form action="{{url('configuration_add_atr')}}" method="POST" id="myform2">                        
                        <div class="form-group">
                         <label for="atr_attribute" class="col-form-label">Attribute</label>
                         <input type="text" class="form-control" id="atr_attribute" name="atr_attribute">
                         
                          
                       </div>
                       <div class="form-group">
                         <label for="atr_description" class="col-form-label">Description</label>
                         
                         <input type="text" class="form-control" id="atr_description" name="atr_description">
                         
                       </div>
                       <div class="form-group">
                         <label for="atr_datatype" class="col-form-label">Data Type</label>
                         {{-- <input type="text" class="form-control" id="atr_datatype" name="atr_datatype"> --}}
                         <select class="form-select" name="atr_datatype" id="atr_datatype">
                           <option value="" selected>Select</option>
                           <option value="TEXT">Text</option>
                           <option value="ALPHA-NUMERIC">Alpha-Numeric</option>
                           <option value="DATE">Date</option>
                           <option value="DATETIME">Datetime</option>
                           <option value="NUMBER">Number</option>
                           <option value="VARCHAR">Varchar</option>
                         </select>
                       </div>
                       <div class="form-group">
                        <label for="atr_fixed_list_of_values" class="col-form-label">Fixed List of Values</label>
                        <input type="text" class="form-control" id="atr_fixed_list_of_values" name="atr_fixed_list_of_values">
                      </div>  

                  </div>
                  <div class="col-md-6">
                                         
                      <div class="form-group">
                        <label for="atr_default_value" class="col-form-label">Default Value</label>
                        <input type="text" class="form-control" id="atr_default_value" name="atr_default_value">
                      </div> 
                      <div class="form-group">
                        <label for="atr_display" class="col-form-label">Display</label>
                        <input type="text" class="form-control" id="atr_display" name="atr_display">
                      </div>
                      <div class="form-group">
                        <label for="atr_editable" class="col-form-label">Editable</label>
                        <input type="text" class="form-control" id="atr_editable" name="atr_editable">
                      </div>
                      <div class="form-group">
                        <label for="atr_status" class="col-form-label">Status</label>
                        {{-- <input type="text" class="form-control" id="atr_status" name="atr_status"> --}}
                        <select name="atr_status" class="form-select" id="atr_status">
                           <option value="" selected>Select</option>
                          <option value="Active">Active</option>
                          <option value="Inactive">Inactive</option>
                         </select>
                      </div>
                       {{-- <div class="form-group">
                         <label for="message-text" class="col-form-label">Message:</label>
                         <textarea class="form-control" id="message-text"></textarea>
                       </div> --}}
                     </form>
                   </div>
                   <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" onclick="add_fix_attribute()">Save</button>
                     <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                   </div>
                 </div>
               </div>
             </div>

                  </div>
               </div>
               
                
       {{-- End Attribute Fixed Add Attribute Modal --}}

       {{--Site  Fixed Attribute edit modal start --}}



       <div class="modal fade" id="atr_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modwidth" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="add_atr">Update Attribute</h5>
               <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                 &times;
               </button>
             </div>
             <div class="modal-body">

               <div class="row">
                  <div class="col-md-6">

                     <div class="form-group d-none">
                        <label for="editatr_id" class="col-form-label">Id</label>
                        <input type="text" class="form-control" id="editatr_id" name="editatr_id" readonly>
                      </div>
                      <div class="form-group">
                       <label for="editatr_attribute" class="col-form-label">Attribute</label>
                       <input type="text" class="form-control" id="editatr_attribute" name="editatr_attribute">                       
                        
                     </div>
                     <div class="form-group">
                       <label for="editatr_description" class="col-form-label">Description</label>
                       
                       <input type="text" class="form-control" id="editatr_description" name="editatr_description">
                       
                     </div>
                     <div class="form-group">
                       <label for="editatr_datatype" class="col-form-label">Data Type</label>
                       {{-- <input type="text" class="form-control" id="editatr_datatype" name="editatr_datatype"> --}}
                       <select class="form-select" name="editatr_datatype" id="editatr_datatype">
                        <option value="" selected>Select</option>
                        <option value="TEXT">Text</option>
                        <option value="ALPHA-NUMERIC">Alpha-Numeric</option>
                        <option value="DATE">Date</option>
                        <option value="DATETIME">Datetime</option>
                        <option value="NUMBER">Number</option>
                        <option value="VARCHAR">Varchar</option>
                      </select>
                     </div>
                     <div class="form-group">
                        <label for="editatr_fixed_list_of_values" class="col-form-label">Fixed List of Values</label>
                        <input type="text" class="form-control" id="editatr_fixed_list_of_values" name="editatr_fixed_list_of_values">
                      </div>
                     

                  </div>
                  <div class="col-md-6">
                     
                     <div class="form-group d-none">
                        <label for="editatr_mandatory_flag" class="col-form-label">Mandatory Flag</label>
                        <input type="text" class="form-control" id="editatr_mandatory_flag" name="editatr_mandatory_flag">
                      </div>
                      <div class="form-group">
                        <label for="editatr_default_value" class="col-form-label">Default Value</label>
                        <input type="text" class="form-control" id="editatr_default_value" name="editatr_default_value">
                      </div>
                      <div class="form-group">
                        <label for="editatr_display" class="col-form-label">Display</label>
                        <input type="text" class="form-control" id="editatr_display" name="editatr_display">
                      </div>
                      <div class="form-group">
                        <label for="editatr_editable" class="col-form-label">Editable</label>
                        <input type="text" class="form-control" id="editatr_editable" name="editatr_editable">
                      </div>
                      <div class="form-group">
                        <label for="editatr_status" class="col-form-label">Status</label>
                        {{-- <input type="text" class="form-control" id="editatr_status" name="editatr_status"> --}}

                        <select name="editatr_status" class="form-select" id="editatr_status">
                           <option value="" selected>Select</option>
                          <option value="Active">Active</option>
                          <option value="Inactive">Inactive</option>
                         </select>
                      </div>
                       {{-- <div class="form-group">
                         <label for="message-text" class="col-form-label">Message:</label>
                         <textarea class="form-control" id="message-text"></textarea>
                       </div> --}}
                     </form>
                   </div>
                   <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" onclick="fixed_atr_updt()">Update</button>
                     <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                   </div>
                 </div>
               </div>
             </div>
             </div>
             </div>
               
                
                

       {{-- Site Attribute dynamic modal --}}

       <div class="modal fade" id="atr_dynamic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modwidth" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="dynamic_add">Add Attribute</h5>
               <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                 &times;
               </button>
             </div>
             <div class="modal-body">
               <div class="row">
                  <div class="col-md-6">
                     <form action="{{url('configuration_add_atr')}}" method="POST" id="myform3">
                        <div class="form-group d-none">
                          <label for="dynamicatr_id" class="col-form-label">Id</label>
                          <input type="text" class="form-control" id="#dynamicatr_id" name="dynamicatr_id">
                        </div>
                        <div class="form-group">
                          <label for="dynamicatr_sitetype" class="col-form-label">Site Type</label>
   
                          {{-- <select name="dynamicatr_sitetype" class="form-select" id="dynamicatr_sitetype"> --}}
                           {{-- <option value="SITES">SITES</option>
                           <option value="WAREHOUSE">WAREHOUSE</option> --}}
                        {{-- </select> --}}

                        <select name="dynamicatr_sitetype" class="form-select" id="dynamicatr_sitetype">
                         
                          <option value="" selected>Select</option>
                          @foreach( $dynamicatrsitetype as $dynamic_site)
      
                          <option value="{{$dynamic_site->lt_location_type_id}}">{{$dynamic_site->lt_location_type}}</option>
                          @endforeach
                       </select>
                        </div>
                        <div class="form-group">
                         <label for="dynamicatr_attribute" class="col-form-label">Attribute</label>
                         <input type="text" class="form-control" id="dynamicatr_attribute" name="dynamicatr_attribute">
                         
                            
                         
                       </div>
                       <div class="form-group">
                         <label for="dynamicatr_description" class="col-form-label">Description</label>
                         
                         <input type="text" class="form-control" id="dynamicatr_description" name="dynamicatr_description">
                         
                       </div>
                       <div class="form-group">
                        <label for="dynamicatr_datatype" class="col-form-label">Data Type</label>
                        {{-- <input type="text" class="form-control" id="dynamicatr_datatype" name="dynamicatr_datatype"> --}}
                        <select class="form-select" name="dynamicatr_datatype" id="dynamicatr_datatype">
                           <option value="" selected>Select</option>
                           <option value="TEXT">Text</option>
                           <option value="ALPHA-NUMERIC">Alpha-Numeric</option>
                           <option value="DATE">Date</option>
                           <option value="DATETIME">Datetime</option>
                           <option value="NUMBER">Number</option>
                           <option value="VARCHAR">Varchar</option>
                         </select>
                      </div>
                      <div class="form-group">
                        <label for="dynamicatr_fixedlist" class="col-form-label">Fixed List of Values</label>
                        <input type="text" class="form-control" id="dynamicatr_fixedlist" name="dynamicatr_fixedlist">
                      </div>
                       

                  </div>
                  <div class="col-md-6">
                     
                     
                      {{-- <div class="form-group">
                        <label for="dynamicatr_mandatory_flag" class="col-form-label">Mandatory Flag</label>
                        <input type="text" class="form-control" id="dynamicatr_mandatory_flag" name="dynamicatr_mandatory_flag">
                      </div> --}}
                      <div class="form-group">
                        <label for="dynamicatr_default_value" class="col-form-label">Default Value</label>
                        <input type="text" class="form-control" id="dynamicatr_default_value" name="dynamicatr_default_value">
                      </div>
                      <div class="form-group">
                        <label for="dynamicatr_display" class="col-form-label">Display</label>
                        <input type="text" class="form-control" id="dynamicatr_display" name="dynamicatr_display">
                      </div>
                      <div class="form-group">
                        <label for="dynamicatr_editable" class="col-form-label">Editable</label>
                        <input type="text" class="form-control" id="dynamicatr_editable" name="dynamicatr_editable">
                      </div>
                      
                      <div class="form-group">
                        <label for="dynamicatr_status" class="col-form-label">Status</label>
                        {{-- <input type="text" class="form-control" id="dynamicatr_status" name="dynamicatr_status"> --}}
                        <select name="dynamicatr_status" class="form-select" id="dynamicatr_status">
                           <option value="" selected>Select</option>
                          <option value="Active">Active</option>
                          <option value="Inactive">Inactive</option>
                         </select>
                      </div>
                       {{-- <div class="form-group">
                         <label for="message-text" class="col-form-label">Message:</label>
                         <textarea class="form-control" id="message-text"></textarea>
                       </div> --}}
                     </form>
                   </div>
                   <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" onclick="add_dynamic_attribute()">Save</button>
                     <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                   </div>
                 </div>
               </div>
             </div>

                  </div>
               </div>
               
                

       {{-- Dynamic Attribute edit modal --}}

       <div class="modal fade" id="dynamicatr_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modwidth" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="dynamicmodify_atr">Update Attribute</h5>
               <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                 &times;
               </button>
             </div>
             <div class="modal-body">

               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group d-none">
                        <label for="dynamiceditatr_id" class="col-form-label">Id</label>
                        <input type="text" class="form-control" id="dynamiceditatr_id" name="dynamiceditatr_id" readonly>
                      </div>
                      <div class="form-group">
                        <label for="dynamicatr_sitetype" class="col-form-label">Site Type</label>
 
                        {{-- <select name="dynamicatr_sitetype" class="form-select" id="dynamicatr_sitetype"> --}}
                         {{-- <option value="SITES">SITES</option>
                         <option value="WAREHOUSE">WAREHOUSE</option> --}}
                      {{-- </select> --}}

                      <select name="dynamiceditatr_sitetype" class="form-select" id="dynamiceditatr_sitetype">
                       
                        <option selected>Select</option>
                        @foreach( $dynamicatrsitetype as $dynamic_site)
    
                        <option value="{{$dynamic_site->lt_location_type_id}}">{{$dynamic_site->lt_location_type}}</option>
                        @endforeach
                     </select>
                      </div>


                      <div class="form-group">
                       <label for="dynamiceditatr_attribute" class="col-form-label">Attribute</label>
                       <input type="text" class="form-control" id="dynamiceditatr_attribute" name="dynamiceditatr_attribute">
                       {{-- <select name="dynamiceditatr_attribute" class="form-control" id="dynamiceditatr_attribute">
                          <option value="SITES">SITES</option>
                          <option value="WAREHOUSE">WAREHOUSE</option>
                          <option value="CITY">CITY</option>
                          
                        </select> --}}
                        
                     </div>
                     <div class="form-group">
                       <label for="dynamiceditatr_description" class="col-form-label">Description</label>
                       
                       <input type="text" class="form-control" id="dynamiceditatr_description" name="dynamiceditatr_description">
                       
                     </div>
                     <div class="form-group">
                       <label for="dynamiceditatr_datatype" class="col-form-label">Data Type</label>
                       {{-- <input type="text" class="form-control" id="dynamiceditatr_datatype" name="dynamiceditatr_datatype"> --}}

                       <select class="form-select" name="dynamiceditatr_datatype" id="dynamiceditatr_datatype">
                        <option value="" selected>Select</option>
                        <option value="TEXT">Text</option>
                        <option value="ALPHA-NUMERIC">Alpha-Numeric</option>
                        <option value="DATE">Date</option>
                        <option value="DATETIME">Datetime</option>
                        <option value="NUMBER">Number</option>
                        <option value="VARCHAR">Varchar</option>
                      </select>
                     </div>
                     <div class="form-group">
                        <label for="dynamiceditatr_fixed_list_of_values" class="col-form-label">Fixed List of Values</label>
                        <input type="text" class="form-control" id="dynamiceditatr_fixed_list_of_values" name="dynamiceditatr_fixed_list_of_values">
                      </div>

                  </div>
                  <div class="col-md-6">
                     
                      <div class="form-group">
                        <label for="dynamiceditatr_mandatory_flag" class="col-form-label">Mandatory Flag</label>
                        <input type="text" class="form-control" id="dynamiceditatr_mandatory_flag" name="dynamiceditatr_mandatory_flag">
                      </div>
                      <div class="form-group">
                        <label for="dynamiceditatr_default_value" class="col-form-label">Default Value</label>
                        <input type="text" class="form-control" id="dynamiceditatr_default_value" name="dynamiceditatr_default_value">
                      </div>
                      <div class="form-group">
                        <label for="dynamiceditatr_display" class="col-form-label">Display</label>
                        <input type="text" class="form-control" id="dynamiceditatr_display" name="dynamiceditatr_display">
                      </div>
                      <div class="form-group">
                        <label for="dynamiceditatr_editable" class="col-form-label">Editable</label>
                        <input type="text" class="form-control" id="dynamiceditatr_editable" name="dynamiceditatr_editable">
                      </div>
                      <div class="form-group">
                        <label for="dynamiceditatr_status" class="col-form-label">Status</label>
                        {{-- <input type="text" class="form-control" id="dynamiceditatr_default_value" name="dynamiceditatr_default_value"> --}}
                        <select name="dynamiceditatr_status" class="form-select" id="dynamiceditatr_status">
                           <option value="" selected>Select</option>
                          <option value="Active">Active</option>
                          <option value="Inactive">Inactive</option>
                         </select>
                      </div>
                       {{-- <div class="form-group">
                         <label for="message-text" class="col-form-label">Message:</label>
                         <textarea class="form-control" id="message-text"></textarea>
                       </div> --}}
                     </form>
                   </div>
                   <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" onclick="dynamic_atr_updt()">Update</button>
                     <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                   </div>
                 </div>
               </div>
             </div>
             </div>
            </div>
               
                
               





   {{-- </div>  --}}
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script>
      $(document).ready(function() {
  // Add event listeners to form elements
   $('#site_id, #site_type, #site_name, #site_address, #site_description, #site_region, #site_latitude, #site_longitude').on('input change', checkFormSite);
   });

// Function to check if all fields are filled
function checkFormSite() {
  var allFieldsFilled = true;
  // Check if all fields have values
  $('#myform input[type="text"],#myform select').each(function() {
    if ($(this).val().trim() == '') {
      allFieldsFilled = false;
      return false; // Exit the loop if any field is empty
    }
  });
  
  // Change button color based on field values
  if (allFieldsFilled) {

    $('#save_site').removeClass('btn-secondary').addClass('btn-primary');
  } else {
    $('#save_site').removeClass('btn-primary').addClass('btn-secondary');
  }
}


// site fixed attribute
$(document).ready(function() {
  // Add event listeners to form elements
   $('#atr_attribute, #atr_description, #atr_datatype, #atr_fixed_list_of_values, #atr_default_value, #atr_display, #atr_editable, #atr_status').on('input change',checkFormSitefix);
   });

// Function to check if all fields are filled
function checkFormSitefix() {
  var allFieldsFilled = true;
  // Check if all fields have values
  $('#myform2 input[type="text"],#myform2 select').each(function() {
    if ($(this).val().trim() == '') {
      allFieldsFilled = false;
      alert("asd");
      return false; // Exit the loop if any field is empty
    }
  });
  
  // Change button color based on field values
  if (allFieldsFilled) {
    $('#sitefixat').removeClass('btn-secondary').addClass('btn-primary');
  } else {
    $('#sitefixat').removeClass('btn-primary').addClass('btn-secondary');
  }
}
   </script>
       <script>
       $(document).ready(function() {
            $(".edtbtn").click(function(){
            $("#site_editid").val($(this).attr('data-id'));
         });
         $(".searchIn").keypress(function(){
           $(this).removeClass().addClass("searchOut")
         })
         
         $(".searchIn").click(function(){
           if(!$(this).hasClass("searchOut"))
             $(this).addClass("searchIn")
         })
         
         $(document).on("keyup",".searchOut", function(){
           if(($(this).val().length) == 0 )
             $(this).removeClass().addClass("searchIn")
         })
     })

     function saveadd(){
      if ($("#site_type").val() === '') {
          event.preventDefault(); 
        }

        

      
      
        $('#site_add').on('hidden.bs.modal', function () {
        $('#site_add form')[0].reset();
       });
         $("#site_add").find(".error").removeClass("error");
         $("#site_add").find("span").remove();



         var locationcode=$("#site_id").val().trim();
        //  alert(locationcode);
         var sitetype=$("#site_type").val().trim();
        //  alert(sitetype);
         var sitename = $("#site_name").val().trim();
         var siteaddress = $("#site_address").val().trim();
         var sitedescription = $("#site_description").val().trim();
         var sitestatus=$("#site_status").val().trim();
         var siteregion=$("#site_region").val().trim();
         var sitelatitude=$("#site_latitude").val().trim();
         var sitelongitude=$("#site_longitude").val().trim();
         var csrfToken = '{{ csrf_token() }}';

         if (locationcode ==  "") {
			   $("#site_id").focus();
            $("#site_id").addClass("error");
            $("#site_id").after("<span>Required</span>");
			   return false;          
			}

         if (sitetype ==  "") {
			   $("#site_type").focus();
            $("#site_type").addClass("error");
            $("#site_type").after("<span>Required</span>");
			   return false;          
			}
         
         if (sitename ==  "") {
			   $("#site_name").focus();
            $("#site_name").addClass("error");
            $("#site_name").after("<span>Required</span>");
			   return false;          
			}

         if (siteaddress ==  "") {
			   $("#site_address").focus();
            $("#site_address").addClass("error");
            $("#site_address").after("<span>Required</span>");
			   return false;          
			}

         if (sitedescription ==  "") {
			   $("#site_description").focus();
            $("#site_description").addClass("error");
            $("#site_description").after("<span>Required</span>");
			   return false;          
			} 
      if (siteregion ==  "") {
			   $("#site_region").focus();
            $("#site_region").addClass("error");
            $("#site_region").after("<span>Required</span>");
			   return false;          
			} 
      if (sitelatitude ==  "") {
			   $("#site_latitude").focus();
            $("#site_latitude").addClass("error");
            $("#site_latitude").after("<span>Required</span>");
			   return false;          
			} 
      if (sitelongitude ==  "") {
			   $("#site_longitude").focus();
            $("#site_longitude").addClass("error");
            $("#site_longitude").after("<span>Required</span>");
			   return false;          
			} 
      if (sitestatus ==  "") {
			   $("#site_status").focus();
            $("#site_status").addClass("error");
            $("#site_status").after("<span>Required</span>");
			   return false;          
			}

         
         $.ajax({
         method:"POST",
         url: "{{url('congiguration_add_site')}}",
         data:{              
               '_token': csrfToken,       
               'location_code':locationcode,
               'location_type' : sitetype,
               'location_name' : sitename,
               'location_address' : siteaddress,
               'location_description': sitedescription,
               'location_region': siteregion,
               'location_latitude' : sitelatitude,
               'location_longitude' : sitelongitude,
               'location_status' : sitestatus,
         },
         
         success: function(data){
            $('#site_add').modal('hide');
            $(document).ajaxStop(function(){
               window.location.reload();
            });
      }
      
      })


     }
     $("#site_id").on('blur', isValueExists);
     function isValueExists(){
         $("#site_id").removeClass("error");
         $("#site_id").parent().find("span").remove();
      var locationcode = $('#site_id').val();
      var csrfToken = '{{ csrf_token() }}';
      var submitButton = $("#submit_button");
      $.ajax({
         method:"POST",
         url: "{{url('congiguration_check_site')}}",
         data:{              
               '_token': csrfToken,      
               'location_code':locationcode
         },
         success: function(data){
            if(data['sitecheck'] != ""){
            $("#site_id").focus();
            $("#site_id").addClass("error");
            $("#site_id").after("<span>Location Code already exists</span>");
            submitButton.prop("disabled", true); // Disable the submit button
            // return false;
            }else {
            submitButton.prop("disabled", false); // Enable the submit button
         }
         }
      
      });
     }

     function siteDetails(e){

      

      
      // alert($(e).data("id"));
    $.ajax({
        type: "GET",       
      //   url: 'http://3.111.113.246/umprojnew/public/index.php/',
        url: "{{url('congiguration_edit_site')}}",
        data:{
            'location_id' : $(e).data("id"),
        },
        beforeSend: function(){
         $('#loader').removeClass('hidden');
            $("#loading").show();
        },
        complete: function(){
            $("#loading").hide();
        },
        success: function(result) { 
          console.log(result);
         $('#loader').addClass('hidden');

        if(result.status == 'success'){
         
         $("#site_edit #site_editid").val(result.fetch_site_details[0]['tl_location_code'])
         }
         if(result.status == 'success'){
         $("#site_edit #site_typeedit").val(result.fetch_site_details[0]['tl_location_type'])
         }
         if(result.status == 'success'){ 
            $("#site_edit #edtsite_name").val(result.fetch_site_details[0]['tl_location_name'])
         }
         
         if(result.status == 'success'){
           
            $("#site_edit #edtsite_address").val(result.fetch_site_details[0]['tl_location_address'])
            
         }

         if(result.status == 'success'){ 
            $("#site_edit #edtsite_description").val(result.fetch_site_details[0]['tl_location_description'])
         }

         if(result.status == 'success'){ 
            $("#site_edit #edtsite_region").val(result.fetch_site_details[0]['tl_location_region'])
         }
         if(result.status == 'success'){ 
            $("#site_edit #edtsite_latitude").val(result.fetch_site_details[0]['tl_location_latitude'])
         }

         if(result.status == 'success'){ 
            $("#site_edit #edtsite_longitude").val(result.fetch_site_details[0]['tl_location_longitude'])
         }

         
         if(result.status == 'success'){
                      
            $("#site_edit #edtsite_status").val(result.fetch_site_details[0]['tl_location_status'])
            
         }

         }  
        

        })
        $("#site_edit").find(".error").removeClass("error");
         $("#site_edit").find("span").remove();

        
    }
    function update_site() { 
      
      $("#site_edit").find(".error").removeClass("error");
      $("#site_edit").find("span").remove();

         var locationcode= $("#site_edit #site_editid").val();  
         var sitetype=$("#site_edit #site_typeedit option:selected").attr('data-val');
        //  console.log(sitetype);
         var sitename= $("#site_edit #edtsite_name").val();
         var siteaddress= $("#site_edit #edtsite_address").val();
        
         var sitedescription=$("#site_edit #edtsite_description").val();
         var siteregion=$("#site_edit #edtsite_region").val();
         var sitelatitude=$("#site_edit #edtsite_latitude").val();
         var sitelongitude=$("#site_edit #edtsite_longitude").val();
         var sitestatus=$("#site_edit #edtsite_status").val();
      
         var csrfToken = '{{ csrf_token() }}';


         if (locationcode ==  "") {
			   $("#site_id").focus();
            $("#site_id").addClass("error");
            $("#site_id").after("<span>Required</span>");
			   return false;          
			}
         if (sitetype ==  "") {
			   $("#site_typeedit").focus();
            $("#site_typeedit").addClass("error");
            $("#site_typeedit").after("<span>Required</span>");
			   return false;          
			}
         
         if (sitename ==  "") {
			   $("#edtsite_name").focus();
            $("#edtsite_name").addClass("error");
            $("#edtsite_name").after("<span>Required</span>");
			   return false;          
			}

         if (siteaddress ==  "") {
			   $("#edtsite_address").focus();
            $("#edtsite_address").addClass("error");
            $("#edtsite_address").after("<span>Required</span>");
			   return false;          
			}

         if (sitedescription ==  "") {
			   $("#edtsite_description").focus();
            $("#edtsite_description").addClass("error");
            $("#edtsite_description").after("<span>Required</span>");
			   return false;          
			} 
      if (siteregion ==  "") {
			   $("#edtsite_region").focus();
            $("#edtsite_region").addClass("error");
            $("#edtsite_region").after("<span>Required</span>");
			   return false;          
			} 
      if (sitelatitude ==  "") {
			   $("#edtsite_latitude").focus();
            $("#edtsite_latitude").addClass("error");
            $("#edtsite_latitude").after("<span>Required</span>");
			   return false;          
			} 
      if (sitelongitude ==  "") {
			   $("#edtsite_longitude").focus();
            $("#edtsite_longitude").addClass("error");
            $("#edtsite_longitude").after("<span>Required</span>");
			   return false;          
			} 
      if (sitestatus ==  "") {
			   $("#edtsite_status").focus();
            $("#edtsite_status").addClass("error");
            $("#edtsite_status").after("<span>Required</span>");
			   return false;          
			}
         $.ajax({
         method:"POST",
         url: "{{url('congiguration_update_site')}}",
         data:{              
               '_token': csrfToken,       
               'lt_location_type' :sitetype ,
                'location_name' : sitename,
                'location_address' :siteaddress,
                 'location_description':sitedescription,
                'location_region': siteregion,
                'location_latitude':sitelatitude,
                'location_longitude':sitelongitude,
                'location_status' : sitestatus,
                'location_id' : locationcode,
               
               
         },
         
         success: function(data){
          $('#site_edit').modal('hide');
            $(document).ajaxStop(function(){
               window.location.reload();
            });
      }
      
      })
         
   }
      function add_fix_attribute(){  

         
        $('#atr_add').on('hidden.bs.modal', function () {
        $('#atr_add form')[0].reset();
       });
         $("#atr_add").find(".error").removeClass("error");
         $("#atr_add").find("span").remove();
         
         
         var atrtype =$("#atr_add #atr_attribute").val().trim();
         var atrdescription = $("#atr_add #atr_description").val().trim();
         var atrdatatype = $("#atr_add #atr_datatype").val();
         var atrfixedlistofvalues = $("#atr_add #atr_fixed_list_of_values").val().trim();
         var atrmandatoryflag= "REQUIRED".trim();
         var atrdefaultvalue=$("#atr_add #atr_default_value").val().trim();
         var atrdisplay=$("#atr_add #atr_display").val().trim();
         var atreditable=$("#atr_add #atr_editable").val().trim();
         var atrstatus=$("#atr_add #atr_status").val().trim();
         
         
         var csrfToken = '{{ csrf_token() }}';

         if (atrtype ==  "") {
			   $("#atr_attribute").focus();
            $("#atr_attribute").addClass("error");
            $("#atr_attribute").after("<span>Required</span>");
			   return false;          
			}
         if (atrdescription ==  "") {
			   $("#atr_description").focus();
            $("#atr_description").addClass("error");
            $("#atr_description").after("<span>Required</span>");
			   return false;          
			}
         
         if (atrdatatype ==  "") {
			   $("#atr_datatype").focus();
            $("#atr_datatype").addClass("error");
            $("#atr_datatype").after("<span>Required</span>");
			   return false;          
			}

         // if (atrfixedlistofvalues ==  "") {
			//    $("#atr_fixed_list_of_values").focus();
         //    $("#atr_fixed_list_of_values").addClass("error");
         //    $("#atr_fixed_list_of_values").after("<span>Required</span>");
			//    return false;          
			// }

         // if (atrmandatoryflag ==  "") {
			//    $("#").focus();
         //    $("#").addClass("error");
         //    $("#").after("<span>Required</span>");
			//    return false;          
			// } 
         // if (atrdefaultvalue ==  "") {
			//    $("#atr_default_value").focus();
         //    $("#atr_default_value").addClass("error");
         //    $("#atr_default_value").after("<span>Required</span>");
			//    return false;          
			// }  
         // if (atrdisplay ==  "") {
			//    $("#atr_display").focus();
         //    $("#atr_display").addClass("error");
         //    $("#atr_display").after("<span>Required</span>");
			//    return false;          
			// } 
         // if (atreditable ==  "") {
			//    $("#atr_editable").focus();
         //    $("#atr_editable").addClass("error");
         //    $("#atr_editable").after("<span>Required</span>");
			//    return false;          
			// }  
         if (atrstatus ==  "") {
			   $("#atr_status").focus();
            $("#atr_status").addClass("error");
            $("#atr_status").after("<span>Required</span>");
			   return false;          
			} 
      
         $.ajax({
         method:"POST",
         url: "{{url('configuration_fixedadd_atr')}}",
         data:{              
               '_token': csrfToken,
               'la_location_attribute_location_type' : atrtype,
               'la_location_attribute_name' : atrtype,
               'la_location_attribute_description' : atrdescription,
               'la_location_attribute_datatype': atrdatatype,
               'la_flov': atrfixedlistofvalues,
               
               'la_location_attribute_mandatory_flag': atrmandatoryflag,
               'la_location_attribute_default_value' : atrdefaultvalue,
               'la_display' : atrdisplay,
               'la_editable' : atreditable,
               'la_status' : atrstatus
               
               
         },
         
         success: function(data){
            $('#atr_add').modal('hide');
            $(document).ajaxStop(function(){
               window.location.reload();
            });
      }
      
      })


         
      }

      function fixed_attr(e){
      //alert($(e).data("id"));
    $.ajax({
        type: "GET",       
        //url: 'http://3.111.113.246/umprojnew/public/index.php/locationdb',
        url: "{{url('configuration_fixedfetch_atr')}}",
        data:{
            'fixedatr_id' : $(e).data("id"),
        },
        beforeSend: function(){
         $('#loader').removeClass('hidden');
            $("#loading").show();
        },
        complete: function(){
            $("#loading").hide();
        },
        success: function(result) { 
         console.log(result);

         $('#loader').addClass('hidden');
        
         if(result.status == 'success'){
         //console.log(result.fetchfixattr[0]['ata_asset_type_attribute_code']);
         $("#atr_edit #editatr_id").val(result.fixed_atr_fetch_edit[0]['la_location_attribute_id']); 
         }
         if(result.status == 'success'){ 
            $("#atr_edit #editatr_attribute").val(result.fixed_atr_fetch_edit[0]['la_location_attribute_name']);
         }
         
         if(result.status == 'success'){
           
            $("#atr_edit #editatr_description").val(result.fixed_atr_fetch_edit[0]['la_location_attribute_description']);
            
         }
         if(result.status == 'success'){
            // console.log(result.fixed_atr_fetch_edit[0]['la_location_attribute_datatype']);
            $("#atr_edit #editatr_datatype").val(result.fixed_atr_fetch_edit[0]['la_location_attribute_datatype']);
            
         }
          if(result.status == 'success'){
                      
            $("#atr_edit #editatr_fixed_list_of_values").val(result.fixed_atr_fetch_edit[0]['la_flov']);
            
         }
         if(result.status == 'success')
      {
      $("#atr_edit #editatr_mandatory_flag").val(result.fixed_atr_fetch_edit[0]['la_location_attribute_mandatory_flag']);
      }
         
         if(result.status == 'success'){
          $("#atr_edit #editatr_default_value").val(result.fixed_atr_fetch_edit[0]['la_location_attribute_default_value']);          
            
         }
         if(result.status == 'success'){
          $("#atr_edit #editatr_display").val(result.fixed_atr_fetch_edit[0]['la_display']);          
            
         }
         if(result.status == 'success'){
          $("#atr_edit #editatr_editable").val(result.fixed_atr_fetch_edit[0]['la_editable']);          
            
         }
         if(result.status == 'success'){
          $("#atr_edit #editatr_status").val(result.fixed_atr_fetch_edit[0]['la_status']);          
            
         }
         
         
         

         

          }  
        

        })
        
      $("#atr_edit").find(".error").removeClass("error");
         $("#atr_edit").find("span").remove();
        
        
    }


    function fixed_atr_updt() {    
      
      $("#atr_edit").find(".error").removeClass("error");
       $("#atr_edit").find("span").remove();

         var atrfixedid= $("#atr_edit #editatr_id").val();  
         var atrfixedatrname=$("#atr_edit #editatr_attribute").val();
         var atrfixeddescription= $("#atr_edit #editatr_description").val();
         var atrfixeddatatype= $("#atr_edit #editatr_datatype").val().trim();
         var atrfixedflov= $("#atr_edit #editatr_fixed_list_of_values").val();

         var atrfixedmandflg=$("#atr_edit #editatr_mandatory_flag").val();
         var atrfixeddefaultvalue=$("#atr_edit #editatr_default_value").val();
         var atrfixeddisplay=$("#atr_edit #editatr_display").val();
         var atrfixededitable=$("#atr_edit #editatr_editable").val();
         var atrfixedstatus=$("#atr_edit #editatr_status").val();
      
         var csrfToken = '{{ csrf_token() }}';
         //return false;

         if (atrfixedid ==  "") {
			   $("#editatr_id").focus();
            $("#editatr_id").addClass("error");
            $("#editatr_id").after("<span>Required</span>");
			   return false;          
			}
         if (atrfixedatrname ==  "") {
			   $("#editatr_attribute").focus();
            $("#editatr_attribute").addClass("error");
            $("#editatr_attribute").after("<span>Required</span>");
            
			   return false;          
			}
         
         if (atrfixeddescription ==  "") {
			   $("#editatr_description").focus();
            $("#editatr_description").addClass("error");
            $("#editatr_description").after("<span>Required</span>");
			   return false;          
			}

         if (atrfixeddatatype ==  "") {
			   $("#editatr_datatype").focus();
            $("#editatr_datatype").addClass("error");
            $("#editatr_datatype").after("<span>Required</span>");
			   return false;          
			}
         // if (atrfixedflov ==  "") {
			//    $("#editatr_fixed_list_of_values").focus();
         //    $("#editatr_fixed_list_of_values").addClass("error");
         //    $("#editatr_fixed_list_of_values").after("<span>Required</span>");
			//    return false;          
			// }

         if (atrfixedmandflg ==  "") {
			   $("#editatr_mandatory_flag").focus();
            $("#editatr_mandatory_flag").addClass("error");
            $("#editatr_mandatory_flag").after("<span>Required</span>");
			   return false;          
			} 
      // if (atrfixeddefaultvalue ==  "") {
		// 	   $("#editatr_default_value").focus();
      //       $("#editatr_default_value").addClass("error");
      //       $("#editatr_default_value").after("<span>Required</span>");
		// 	   return false;          
		// 	}  
      //    if (atrfixeddisplay ==  "") {
		// 	   $("#editatr_display").focus();
      //       $("#editatr_display").addClass("error");
      //       $("#editatr_display").after("<span>Required</span>");
		// 	   return false;          
		// 	}  
      //    if (atrfixededitable ==  "") {
		// 	   $("#editatr_editable").focus();
      //       $("#editatr_editable").addClass("error");
      //       $("#editatr_editable").after("<span>Required</span>");
		// 	   return false;          
		// 	} 
        if (atrfixedstatus ==  "") {
			   $("#editatr_status").focus();
            $("#editatr_status").addClass("error");
            $("#editatr_status").after("<span>Required</span>");
			   return false;          
			} 
     
         $.ajax({
         method:"POST",
         url: "{{url('configuration_fixedupdate_atr')}}",
         data:{
               'la_location_attribute_id' : atrfixedid,
               '_token': csrfToken,
               'la_location_attribute_location_type' :atrfixedatrname ,
               'la_location_attribute_description' : atrfixeddescription,
               'la_location_attribute_datatype' :atrfixeddatatype ,
               'la_flov' : atrfixedflov,
               'la_location_attribute_mandatory_flag' :atrfixedmandflg,
               'la_location_attribute_default_value': atrfixeddefaultvalue,
               'la_display':atrfixeddisplay ,
               'la_editable':atrfixededitable ,
               'la_status':atrfixedstatus 

         },
         success: function(data){
            $('#atr_edit').modal('hide');
            $(document).ajaxStop(function(){
               window.location.reload();
            });
      }
      
      })
   }
   
   function add_dynamic_attribute(){

      // if ($("#dynamicatr_sitetype").val() === '') {
      //     event.preventDefault(); 
      //   }

        $('#atr_dynamic').on('hidden.bs.modal', function () {
        $('#atr_dynamic form')[0].reset();
       });
         $("#atr_dynamic").find(".error").removeClass("error");
         $("#atr_dynamic").find("span").remove();
         

        //  var dynamicatrid = $("#atr_dynamic #dynamicatr_id").val();
         var dynamicatrtype =$("#atr_dynamic #dynamicatr_sitetype").val().trim();         
         var dynamicatr =$("#dynamicatr_attribute").val().trim();
         
         var dynamicatrdescription = $("#atr_dynamic #dynamicatr_description").val().trim();         
         var dynamicatrdatatype = $("#atr_dynamic #dynamicatr_datatype").val().trim();
         var dynamicatrfixedlistofvalues = $("#atr_dynamic #dynamicatr_fixedlist").val().trim();
         var dynamicatrmandatoryflag="NOT REQUIRED";
         var dynamicatrdefaultvalue=$("#atr_dynamic #dynamicatr_default_value").val().trim();
         var dynamicatrdisplay=$("#atr_dynamic #dynamicatr_display").val().trim();
         var dynamicatreditable=$("#atr_dynamic #dynamicatr_editable").val().trim();
         var dynamicatrstatus=$("#atr_dynamic #dynamicatr_status").val().trim();
         
         
         var csrfToken = '{{ csrf_token() }}';

         if (dynamicatrtype ==  "") {
			   $("#dynamicatr_sitetype").focus();
            $("#dynamicatr_sitetype").addClass("error");
            $("#dynamicatr_sitetype").after("<span>Required</span>");
			   return false;          
			}
         if (dynamicatr ==  "") {
			   $("#dynamicatr_attribute").focus();
            $("#dynamicatr_attribute").addClass("error");
            $("#dynamicatr_attribute").after("<span>Required</span>");
			   return false;          
			}
         
         if (dynamicatrdescription ==  "") {
			   $("#dynamicatr_description").focus();
            $("#dynamicatr_description").addClass("error");
            $("#dynamicatr_description").after("<span>Required</span>");
			   return false;          
			}

         if (dynamicatrdatatype ==  "") {
			   $("#dynamicatr_datatype").focus();
            $("#dynamicatr_datatype").addClass("error");
            $("#dynamicatr_datatype").after("<span>Required</span>");
			   return false;          
			}
         // if (dynamicatrfixedlistofvalues ==  "") {
			//    $("#dynamicatr_fixedlist").focus();
         //    $("#dynamicatr_fixedlist").addClass("error");
         //    $("#dynamicatr_fixedlist").after("<span>Required</span>");
			//    return false;          
			// }
         
         // if (dynamicatrdefaultvalue ==  "") {
			//    $("#dynamicatr_default_value").focus();
         //    $("#dynamicatr_default_value").addClass("error");
         //    $("#dynamicatr_default_value").after("<span>Required</span>");
			//    return false;          
			// }
         // if (dynamicatrdisplay ==  "") {
			//    $("#dynamicatr_display").focus();
         //    $("#dynamicatr_display").addClass("error");
         //    $("#dynamicatr_display").after("<span>Required</span>");
			//    return false;          
			// }
         // if (dynamicatreditable ==  "") {
			//    $("#dynamicatr_editable").focus();
         //    $("#dynamicatr_editable").addClass("error");
         //    $("#dynamicatr_editable").after("<span>Required</span>");
			//    return false;          
			// } 
         if (dynamicatrstatus ==  "") {
			   $("#dynamicatr_status").focus();
            $("#dynamicatr_status").addClass("error");
            $("#dynamicatr_status").after("<span>Required</span>");
			   return false;          
			}

        
     


         $.ajax({
         method:"POST",
         url: "{{url('configuration_dynamicadd_atr')}}",
         data:{              
               '_token': csrfToken,       
              //  'la_location_attribute_id':dynamicatrid,
               'dynamicatrtype' : dynamicatrtype,
               'la_location_attribute_name' : dynamicatr,
               'la_location_attribute_description' : dynamicatrdescription,
               'la_location_attribute_datatype': dynamicatrdatatype,
               'la_flov': dynamicatrfixedlistofvalues,
               'la_location_attribute_mandatory_flag': dynamicatrmandatoryflag,
               'la_location_attribute_default_value' : dynamicatrdefaultvalue,
               'la_display' : dynamicatrdisplay,
               'la_editable' :dynamicatreditable,
               'la_status' :  dynamicatrstatus 
               
               
         },
         
         success: function(data){
            $('#atr_dynamic').modal('hide');
            $(document).ajaxStop(function(){
               window.location.reload();
            });
      }
      
      })


         




    
   }

   function dynamic_attr(e){
    var csrfToken = '{{ csrf_token() }}';
    $.ajax({
        type: "post",       
        //url: 'http://3.111.113.246/umprojnew/public/index.php/locationdb',
        url: "{{url('configuration_dynamicfetch_atr')}}",
        data:{
            '_token': csrfToken,
            'dynamicatr_id' : $(e).data("id"),
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
        
         if(result.status == 'success'){
         //console.log(result.fetchfixattr[0]['ata_asset_type_attribute_code']);
         $("#dynamicatr_edit #dynamiceditatr_id").val(result.dynamic_atr_fetch_edit[0]['la_location_attribute_id']); 
         }
        //  if(result.status == 'success'){ 
        //     $("#dynamicatr_edit #").val(result.dynamic_atr_fetch_edit[0]['']);
        //  }

        if(result.status == 'success'){ 
            $("#dynamicatr_edit #dynamiceditatr_sitetype").val(result.dynamic_atr_fetch_edit[0]['la_location_type_id']);
         }
         if(result.status == 'success'){ 
            $("#dynamicatr_edit #dynamiceditatr_attribute").val(result.dynamic_atr_fetch_edit[0]['la_location_attribute_name']);
         }
         
         if(result.status == 'success'){
           
            $("#dynamicatr_edit #dynamiceditatr_description").val(result.dynamic_atr_fetch_edit[0]['la_location_attribute_description']);
            
         }
         if(result.status == 'success'){
                      
            $("#dynamicatr_edit #dynamiceditatr_datatype").val(result.dynamic_atr_fetch_edit[0]['la_location_attribute_datatype']);
            
         }
         if(result.status == 'success'){
                      
            $("#dynamicatr_edit #dynamiceditatr_fixed_list_of_values").val(result.dynamic_atr_fetch_edit[0]['la_flov']);
            
         }
         if(result.status == 'success')
      {
      $("#dynamicatr_edit #dynamiceditatr_mandatory_flag").val(result.dynamic_atr_fetch_edit[0]['la_location_attribute_mandatory_flag']);
      }
         
         if(result.status == 'success'){
          $("#dynamicatr_edit #dynamiceditatr_default_value").val(result.dynamic_atr_fetch_edit[0]['la_location_attribute_default_value']);          
            
         }
         if(result.status == 'success'){
          $("#dynamicatr_edit #dynamiceditatr_display").val(result.dynamic_atr_fetch_edit[0]['la_display']);          
            
         }
         if(result.status == 'success'){
          $("#dynamicatr_edit #dynamiceditatr_editable").val(result.dynamic_atr_fetch_edit[0]['la_editable']);          
            
         }
         if(result.status == 'success'){
          $("#dynamicatr_edit #dynamiceditatr_status").val(result.dynamic_atr_fetch_edit[0]['la_status']);          
            
         }
         
         
         

         

          }  
        

        })

        $("#dynamicatr_edit").find(".error").removeClass("error");
         $("#dynamicatr_edit").find("span").remove();
        
        
    }

    function dynamic_atr_updt() { 
      
         $("#dynamicatr_edit").find(".error").removeClass("error");
         $("#dynamicatr_edit").find("span").remove();
         var atrfixedid= $("#dynamicatr_edit #dynamiceditatr_id").val(); 
         var atrdynamictype= $("#dynamicatr_edit #dynamiceditatr_sitetype").val();
         var atrfixedatrname=$("#dynamicatr_edit #dynamiceditatr_attribute").val();
         var atrfixeddescription= $("#dynamicatr_edit #dynamiceditatr_description").val();
         var atrfixeddatatype= $("#dynamicatr_edit #dynamiceditatr_datatype").val().trim();
         var atrfixedlist= $("#dynamicatr_edit #dynamiceditatr_fixed_list_of_values").val();
         var atrfixedmandflg=$("#dynamicatr_edit #dynamiceditatr_mandatory_flag").val();
         var atrfixeddefaultvalue=$("#dynamicatr_edit #dynamiceditatr_default_value").val();
         var atrfixeddisplay=$("#dynamicatr_edit #dynamiceditatr_display").val();
         var atrfixededitable=$("#dynamicatr_edit #dynamiceditatr_editable").val();
         var atrfixedstatus=$("#dynamicatr_edit #dynamiceditatr_status").val();
      
         var csrfToken = '{{ csrf_token() }}';
         //return false;

         if (atrfixedid ==  "") {
			   $("#dynamiceditatr_id").focus();
            $("#dynamiceditatr_id").addClass("error");
            $("#dynamiceditatr_id").after("<span>Required</span>");
			   return false;          
			}
         if (atrdynamictype ==  "") {
			   $("#dynamiceditatr_sitetype").focus();
            $("#dynamiceditatr_sitetype").addClass("error");
            $("#dynamiceditatr_sitetype").after("<span>Required</span>");
			   return false;          
			}
         
         if (atrfixedatrname ==  "") {
			   $("#dynamiceditatr_attribute").focus();
            $("#dynamiceditatr_attribute").addClass("error");
            $("#dynamiceditatr_attribute").after("<span>Required</span>");
			   return false;          
			}

         if (atrfixeddescription ==  "") {
			   $("#dynamiceditatr_description").focus();
            $("#dynamiceditatr_description").addClass("error");
            $("#dynamiceditatr_description").after("<span>Required</span>");
			   return false;          
			}

         if (atrfixeddatatype ==  "") {
			   $("#dynamiceditatr_datatype").focus();
            $("#dynamiceditatr_datatype").addClass("error");
            $("#dynamiceditatr_datatype").after("<span>Required</span>");
			   return false;          
			} 
         // if (atrfixedlist ==  "") {
			//    $("#dynamiceditatr_fixed_list_of_values").focus();
         //    $("#dynamiceditatr_fixed_list_of_values").addClass("error");
         //    $("#dynamiceditatr_fixed_list_of_values").after("<span>Required</span>");
			//    return false;          
			// } 
      if (atrfixedmandflg ==  "") {
			   $("#dynamiceditatr_mandatory_flag").focus();
            $("#dynamiceditatr_mandatory_flag").addClass("error");
            $("#dynamiceditatr_mandatory_flag").after("<span>Required</span>");
			   return false;          
			} 
         
         // if (atrfixeddefaultvalue ==  "") {
			//    $("#dynamiceditatr_default_value").focus();
         //    $("#dynamiceditatr_default_value").addClass("error");
         //    $("#dynamiceditatr_default_value").after("<span>Required</span>");
			//    return false;          
			// } 
         // if (atrfixeddisplay ==  "") {
			//    $("#dynamiceditatr_display").focus();
         //    $("#dynamiceditatr_display").addClass("error");
         //    $("#dynamiceditatr_display").after("<span>Required</span>");
			//    return false;          
			// } 
         // if (atrfixededitable ==  "") {
			//    $("#dynamiceditatr_editable").focus();
         //    $("#dynamiceditatr_editable").addClass("error");
         //    $("#dynamiceditatr_editable").after("<span>Required</span>");
			//    return false;          
			// } 
         if (atrfixedstatus ==  "") {
			   $("#dynamiceditatr_status").focus();
            $("#dynamiceditatr_status").addClass("error");
            $("#dynamiceditatr_status").after("<span>Required</span>");
			   return false;          
			} 
     


         $.ajax({
         method:"POST",
         url: "{{url('configuration_dynamicupdate_atr')}}",
         data:{
               'la_location_attribute_id' : atrfixedid,
               '_token': csrfToken,
               'dynamicatrtype': atrdynamictype,
               'la_location_attribute_location_type' :atrfixedatrname ,
               'la_location_attribute_description' : atrfixeddescription,
               'la_location_attribute_datatype' : atrfixeddatatype ,
               'la_flov' : atrfixedlist ,
               'la_location_attribute_mandatory_flag' :atrfixedmandflg,
               'la_location_attribute_default_value': atrfixeddefaultvalue,
               'la_display': atrfixeddisplay ,
               'la_editable':atrfixededitable ,
               'la_status': atrfixedstatus

         },
         success: function(data){
            $('#dynamicatr_edit').modal('hide');
            $(document).ajaxStop(function(){
               window.location.reload();
            });
      }
      
      })
   }

   

   function addsite_type()
   {
      $('#myform')[0].reset();

      $("#site_add").find(".error").removeClass("error");
         $("#site_add").find("span").remove();

      
      
   }

   function addfixatr()
   {
      $('#myform2')[0].reset();

      $("#atr_add").find(".error").removeClass("error");
      $("#atr_add").find("span").remove();  
   }

   function adddynaatr(){
      $('#myform3')[0].reset();

      $("#atr_dynamic").find(".error").removeClass("error");
      $("#atr_dynamic").find("span").remove();   
   }


   
    
</script>



     
   
<!-- reason table -->

@endsection