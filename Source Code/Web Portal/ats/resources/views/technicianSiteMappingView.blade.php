@extends('Layout.mainlayout')
@section('content')
<style>
   .dataTables_filter{
        position: relative;
        right: 10px;
   }
   .nav-tabs .nav-link.active{
	background-color: none !important;
}
.dataTables_wrapper .dataTables_filter {
      float: right;
    }
    div.dataTables_wrapper div.dataTables_filter input {
  margin-left: 13px;
  position: relative;
  bottom: 21px;
  width: 147% !important;
}
    .dataTables_wrapper .dataTables_filter input {
      width: 100px;
      padding-right: 30px; /* Add space for the search icon */
      background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIEAAAB+CAMAAAA0uoKuAAAAZlBMVEX///8AAADw8PDk5OT39/f8/PwUFBTg4ODt7e3GxsaLi4stLS02NjaHh4e3t7cyMjKgoKAlJSVLS0vX19fAwMBoaGg+Pj5FRUXPz89jY2NwcHALCwtXV1eXl5eurq6mpqYbGxt9fX2Ld7qBAAAFeUlEQVRogcVb6ZqqMAxFFkHEBcEFRJH3f8k7OH5jUpqSQPSe39Ae0uwNnsdHcNm2m7o5Z1l2qOpNu70EgrdnIrnsm/VyYWK5rvaX5Avbb6vdYPM3snrrf3T/snbs/sK1Xn1q+2Q/vv2LxP4Tggi6K5dAj1RbMf30Idn/B/kt1CRwz4X7Pzls1faPDxP279HEOgRuE/fvsVfY329mEFgs6tlWUbg04Hp95Hm+vLqsZFfMI7AlF+7asvCj50ORX5RtR7rKWQqZWpfMu63N0sJtbRfYDGXY2CR/XNFH65fVMGQtFrepBGwS2IwZWGyjnaoRSDmanXRKFIYEam70D4YhdMJB3M011pKgWw50UmwRxUAAMteSHM0FhH7BN79BblFmNrGWfYLhipcXMYGhGBvJy0YwyqelG8V6shwN9rup+U6R4YX465zxAU5PuGKcWVXc91qsA3MyvgAL4c57K8GufV50vWBx8nwaduxM2iSwUbK8c4xEUM8k4HnYQ3OEgN7I5qfcPrLJzfgLMaI8xROZWKEVxz8JhcROgYAh1fEgiQjrlH/IJHdjQtjK+PKA5Fq6n40q8OxSq/JLYKQdcYxIYFoiwEJ4uH1sy39UAvRh7mwJ5gXzndEb0ByceUIAY9nMcgsB+oSHyy+W4MGzZgcigsfgSnlhUGL4TwE6poafmUzlgH7GoQgoQ1Yl4PkL1tIFj+gkwJSRVkWoiHru6BdQEegDhpWaXiNsuDb9ddAUNDIDCJgw0rka9FzafdkCJH+0t4V9w0iZQQL6THR4BBldrkzAC0/vxQ/k54GokGkziIC3o/Nf0Bc8aTOAR7wmGQA1OH+SQf7fZUAzAAajrgceSw+ALay1CfBsAdC8ajPwWf4A+kTVOxoPNzNonwjjgmaW2IMXF2Curh0bYZJEx0beU9MAixa6cIM5ErvrxARMQelSKIHlgi4BlK47ngM2q6yKsGRx+duOpbBTkDJXRlm9qkeAdYCrg4CaSEoXpk9AHXfX5LB21izb4PG6Az9squ/0RjqQkbXOR9ExzG2nvoE61e7TjWC6rBahQ1iyjZWDqA2sJYRWsmgIH17qFA0hvBlfjpZCwgYoB6hZP25h+IZHwyfgTjWjQYeu2RS6CBG6M+KEXHwrMj864NtjVrzDt6Vz20klWo3Xo8Tndp3nGfGNzZKpV1hu2RyTDPHtMdu28GXbYXqYDvHN5Yn9MfheZnqmYE4SCTpDHX6TrrLcBIxZLkmrPDRGe7Ip6pgYF9+j1ysIsfHuVW6UK3N/iSZ6llEoYYiI7KNMkrxrsEIluXIJqHE+iS4MBkkEYnCM81UCrR5SWPLK2btznlSg1WFlef0+lmD492z4GsKaH/JtFBanNKDlGAXp2P69KPkFYTQ8iB7Nza6U8Z47TSmwbbtN9WPR7QrSiFctY5j6DUEOTI5I9jTyc1NVVXPORaPMTwjcizlUpIWUb5WhSLwG7Ir0RCeIuKVt7pKDR2lknQiioN9NIvAUdEyfomhWrnCIk0D1cjzBmXwkF5UjF3ohG5p3PmQmKgDCmb8LXw41Wjmy+dYXJElL/zW3E73WH07D/yds87svuPsZQ4TFxj3If0gLm4o7fv+QV8dhca8sv/L82N66useUhbWWF16Y1q+KyzZt3mEwa1IcJ4ZwuPfjJApyXGi/pjru4UBM/4hw/tIPYcMC4g8nzfapA6HDjrTvdCg44uzH/gQzQCVdC80GqhuOUkJ76IIC7Zv0b5oJ2EraXwjD1HQUVGKrM5TKokD8eaR/3U4iIKL89xhQvumLDGyV+U9y8VUGXjdkoH3TPIahb/pWbPiDmbRoX3UzYPzc8Nk/pQkKcPLlSymCgeDPJI7/QwJPFPtjlh3bXwH8A67YPCrfx+fUAAAAAElFTkSuQmCC'); /* Replace with the path to your search icon */
      background-repeat: no-repeat;
      background-position: 263px;
      background-size: 16px 16px;
    }

    .dataTables_filter input[type="search"]::-webkit-search-cancel-button,
    .dataTables_filter input[type="search"]::-webkit-search-decoration {
    -webkit-appearance: none;
     appearance: none;
     display: none;
}
   /* .dataTables_wrapper{
      margin: 0 32p;
   } */
   div#sitetable_wrapper {
    /* margin: 0 15px; */
}
element.style {
    position: sticky;
    top: 0;
    background: red;
}
.noactive {
	display: none;
}
.fixconfigass{
   display: none;
}
.dynamicconfigass{
   display: none;
}
.siteactive{
    display: none;
}
.paarrow{
   display: none;
 }
 .siteactivefixed{
   display: none;
 }
 .siteactivedynamic{
   display: none;
 }
 .locationsite i{
   display: none;
 }
 .congigfixasset i{
   display: none;
 }
 .congigdynamicasset i{
   display: none;
 }
 .siteassetdrp i {
   display: none;
 }
 .sitefixtable i{
   display: none;
}
 .sitedynamictable i{
   display: none;
}
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
   
<div class="card col-12 " style="border-radius: unset;">
   <div class="card-header">
      Configuration Management
   </div>
</div>
<nav>
         <div class="nav nav-tabs configbutton mx-5" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-asset" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Asset</button>
            <button class="nav-link " id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-site" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Site</button>
            {{-- <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-reason" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Reason</button> --}}
         </div>
      </nav>
      <div class="tab-content mx-5" id="nav-tabContent">
         {{-- Asset --}}
         <div class="tab-pane fade active show" id="nav-asset" role="tabpanel" aria-labelledby="nav-profile-tab">
            <nav>
               <div class="nav nav-tabs configsubbutton" id="nav-tab" role="tablist">
                  <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-asset_type" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Asset Type</button>
                  <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-asset_attribute" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Attribute</button>
               </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
               {{-- Asset Type table --}}
               
               <div class="tab-pane fade show active locationsite" id="nav-asset_type" role="tabpanel" aria-labelledby="nav-home-tab">
                  <div class="table_card_config">
                  <button type="button" class="btn btn-primary btn-sm point" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="assetconfig_add(this)">Add Asset Type</button>
                  
                  <table id="sitetable" class="table table-striped table-bordered my-table cell-border border table_config">
                     <thead style="position: sticky;top: 0;background:#E5FCFF;">
                        <tr>
                           <th>ID</th>
                           <th>Type Code</th>
                           <th>Description</th>
                           <th>Parent Asset Type</th>
                           <th>Catagory </th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $i = 1;
                           $y=0;
                        ?>
                        @foreach($assettype_details as $asttypedetails)
                        <tr class="<?php if($y > 10){ echo 'noactive"'; } ?>">
                          <td style="text-align: center">{{$i}}</td>
                           <td>{{$asttypedetails->at_asset_type_code}}</td>
                           <td>{{$asttypedetails->at_asset_type_description}}</td>
                           <td style="text-align: left">{{ !empty($asttypedetails->parent_name) ? $asttypedetails->parent_name : 'NA' }}</td>                                                      
                           <td>{{$asttypedetails->at_asset_type_category}}</td>
                           <td>{{$asttypedetails->at_asset_type_status}}</td>
                           <td style="text-align: center">
                              
                             <button type="button" class="edit" style="border-radius: 0;
                                 background-color: #202C55;width: 76px;" data-bs-toggle="modal" data-bs-target="#editmodal" onclick="asttypedetails(this)" data-id="{{$asttypedetails->at_asset_type_id}}" >Edit</button>
                              
                           </td>
                        </tr>
                       <?php $i++;  $y++; ?>
                       @endforeach
                        
                     </tbody>
                  </table>
               </div>
               <i class="paarrow fa-solid fa-angle-down text-center" onclick="configasst();" <?php if(count($assettype_details) > 11){ echo "style=display:block;"; } ?>></i>
            </div>
               {{--Asser Attribute navbar--}}
               <div class="tab-pane fade" id="nav-asset_attribute" role="tabpanel" aria-labelledby="nav-profile-tab">
                  <nav>
                     <div class="nav nav-tabs congifbuttonasset " id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-asset_fixed" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Fixed</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-asset_dynamic" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Dynamic</button>
                     </div>
                  </nav>
                  
                  <div class="tab-content" id="nav-tabContent">
                     {{--Asset Fixed table--}}
                     <div class="tab-pane fade active show congigfixasset" id="nav-asset_fixed" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="table_card_config">
                        <button type="button" class="btn btn-primary btn-sm point" data-bs-toggle="modal" data-bs-target="#fixedattribute" onclick="assetatrrifix_button(this)">Add Attribute</button>
                        <table id="sitetable" class="table table-striped table-bordered my-table1 table_config" style="width:100%">
                           <thead style="position: sticky; top: 0;background: #E5FCFF;">
                              <tr>
                                 <th>ID </th>                                 
                                 <th>Attribute Name</th>
                                 <th>Description</th>
                                 <th>Data Type</th>
                                 <th>Fixed List of Values</th>
                                 <th>Mandatory Flag</th>
                                 <th>Defaults Values</th>
                                 <th>Status</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                               $i=1;
                               $y=0;
                              ?>
                              @foreach($assetfixed_details as $assetfixed)
                             
                              <tr class="<?php if($y > 10){ echo ' fixconfigass"'; } ?>">
                                 <td style="text-align: center">{{$i}}</td>
                                 <td>{{$assetfixed->ata_asset_type_attribute_name}}</td>
                                 <td style="text-align: center">{{$assetfixed->ata_asset_type_attribute_description}}</td>
                                 <td>{{$assetfixed->ata_asset_type_attribute_datatype}}</td>
                                 <td style="text-align: center">{{$assetfixed->ata_flov}}</td>
                                 <td>{{$assetfixed->ata_asset_type_attribute_mandatory_flag}}</td>
                                 <td>{{$assetfixed->ata_asset_type_attribute_default_value}}</td>
                                 <td>{{$assetfixed->ata_status}}</td>
                                 <td><button type="button" class="edit" style="border-radius: 0;
                                    background-color: #202C55;width: 76px;"data-bs-toggle="modal" data-bs-target="#fixedattributeedit" onclick="fixededit(this)" data-id="{{$assetfixed->ata_asset_type_attribute_id}}" >Edit</button></td>
                              </tr>
                              <?php $i++; $y++; ?>
                              @endforeach
                              
                           </tbody>
                        </table>
                     </div>
                     <i class="paarrow fa-solid fa-angle-down text-center" onclick="configfixasst();" <?php if(count($assetfixed_details) > 11){ echo "style=display:block;"; } ?>></i>
                  </div>
                     {{--Asset dynamic table--}}
                     <div class="tab-pane fade congigdynamicasset " id="nav-asset_dynamic" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="table_card_cnfdyasst">
                        <button type="button" class="btn btn-primary btn-sm point" data-bs-target="#asset_attribute_dynamic" data-bs-toggle="modal" onclick="asstdynamic_button(this)">Add Attribute</button>
                        <table id="sitetable" class="table table-striped table-bordered my-table2 table_config" style="width:100%">
                           <thead style="position: sticky; top: 0;background: #E5FCFF;">
                              <tr>
                                 <th>ID</th>
                                 <th>Asset Type Name</th>
                                 <th>Attribute Name</th>
                                 <th>Description</th>
                                 <th>Data Type</th>
                                 <th>Fixed List of Values</th>
                                 <th>Mandatory Flag</th>
                                 <th>Defaults Values</th>
                                 <th>Status</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $i=1;
                              $y=0;
                              ?>
                              @foreach($asset_att_dynamic as $assetatt_dynamic)

                              <?php 
                              $ata_asset_type_id= $assetatt_dynamic->ata_asset_type_id;
                              $ata_asset_type_name=DB::table("product.t_asset_type_master")->select('at_asset_type_name')->where('at_asset_type_id',$ata_asset_type_id)->first();
                              $ata_asset_type_name = $ata_asset_type_name->at_asset_type_name;
                              ?>
                              <tr class="<?php if($y > 10){ echo ' dynamicconfigass"'; } ?>">
                                 <td style="text-align: center">{{$i}}</td>
                                 <td>{{$ata_asset_type_name}}</td>
                                 <td>{{$assetatt_dynamic->ata_asset_type_attribute_name}}</td>
                                 <td>{{$assetatt_dynamic->ata_asset_type_attribute_description}}</td>
                                 <td style="text-align: center">{{$assetatt_dynamic->ata_asset_type_attribute_datatype}}</td>
                                 <td>{{$assetatt_dynamic->ata_flov}}</td>
                                 <td>{{$assetatt_dynamic->ata_asset_type_attribute_mandatory_flag}}</td>
                               
                                 <td>{{$assetatt_dynamic->ata_asset_type_attribute_default_value}}</td>
                                 <td>{{$assetatt_dynamic->ata_status}}</td>
                                
                                 <td> <button type="button" class="edit" style="border-radius: 0;
                                    background-color: #202C55;width: 76px; "data-bs-target="#dynamic_edit_att" data-bs-toggle="modal" onclick="dynamicedit(this)" data-id="{{$assetatt_dynamic->ata_asset_type_attribute_id}}">Edit</button></td>

                              </tr>
                              <?php $i++; $y++; ?>
                              @endforeach
                              
                              
                           </tbody>
                        </table>
                     </div>
                     <i class="paarrow fa-solid fa-angle-down text-center" onclick="configdynamicasst();" <?php if(count($asset_att_dynamic) > 11){ echo "style=display:block;"; } ?>></i>
                  </div>
                  </div>
               </div>
               
            </div>
         </div>
         {{-- site --}}
         <div class="tab-pane fade" id="nav-site" role="tabpanel" aria-labelledby="nav-profile-tab">
            <nav>
               <div class="nav nav-tabs congifbuttonsite " id="nav-tab" role="tablist" style="margin:0px;padding:4px;">
                  <button class="nav-link active hl" style="background-color:transparent"       id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-site_nav" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Site</button>
                  <button class="nav-link hl" style="background-color:transparent" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-site_attribute" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Attribute</button>
               </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
               {{-- site table --}}
               <div class="tab-pane fade show active siteassetdrp" id="nav-site_nav" role="tabpanel" aria-labelledby="nav-home-tab">
                  <div class="table_card_site">
                  <button type="button" class="btn btn-primary btn-sm point" data-bs-toggle="modal" data-bs-target="#site_add"onclick="addsite_type(this)">Add Site</button>
                 
                  <table id="sitetable" class="table table-striped table-bordered mx-2 config_table table_config" style="width:100%">
                     
                     <thead style="position: sticky;top: 0;background:#E5FCFF;">

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
                        <?php
                        $y=0;
                        ?>
                        @foreach($configLocation as $sitedetails)
                        <tr class="<?php if($y > 2){ echo 'siteactive"'; } ?>">
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
                              <button type="button" class="edit edtbtn" style="border-radius: 0;
                                 background-color: #202C55;width: 76px;" data-bs-toggle="modal" data-bs-target="#site_edit" onclick="siteDetails(this)" data-id="{{$sitedetails->tl_location_code}}">Edit</button>
                              {{-- <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0;
                                 background-color: #202C55;">Sub Reason</button> --}}
                           </td>
                        </tr>
                        <?php  $y++; ?>
                        @endforeach
                        
                     </tbody>
                  </table>
               </div>
               <i class="paarrow fa-solid fa-angle-down text-center" onclick="siteasstdropdown();" <?php if(count($configLocation) > 3){ echo "style=display:block;"; } ?>></i>
               </div>
               {{--Site Attribute navbar--}}
               <div class="tab-pane fade" id="nav-site_attribute" role="tabpanel" aria-labelledby="nav-profile-tab">
                  <nav>
                     <div class="nav nav-tabs congifbuttonasset" id="nav-tab" role="tablist">
                        <button class="nav-link active hl" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-sit_fixed" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Fixed</button>
                        <button class="nav-link hl" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-sit_dynamic" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Dynamic</button>
                     </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                     {{--Attribute Fixed table--}}
                     <div class="tab-pane fade active show sitefixtable" id="nav-sit_fixed" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="table_card_site">
                        <button type="button" class="btn btn-primary btn-sm point" data-bs-toggle="modal" data-bs-target="#atr_add" onclick="addfixatr(this)">Add Attribute</button>
                        <table id="sitetable2" class="table table-striped table-bordered mx-2 config_table_2 table_config" style="width:100%">
                           <thead style="position: sticky;top: 0;background:#E5FCFF;">
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
                              <?php
                              $y=0;
                              ?>
                              @foreach($config_fixed_attribute as $fixed_attr)
                              <tr class="<?php if($y > 4){ echo 'siteactivefixed"'; } ?>">
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
                                    <button type="button" class="edit" style="border-radius: 0;
                                       background-color: #202C55;width: 76px;" data-bs-toggle="modal" data-bs-target="#atr_edit" data-id="{{$fixed_attr->la_location_attribute_id}}" onclick="fixed_attr(this)">Edit</button>
                                    {{-- <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0;
                                       background-color: #202C55;">Sub Reason</button> --}}
                                 </td>
                              </tr>
                              <?php
                              $y++;
                              ?>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                     <i class="paarrow fa-solid fa-angle-down text-center" onclick="sitefixeddrpdwn();" <?php if(count($config_fixed_attribute) > 5){ echo "style=display:block;"; } ?>></i>
                     </div>
                     {{--Site dynamic table--}}
                     <div class="tab-pane fade sitedynamictable" id="nav-sit_dynamic" role="tabpanel" aria-labelledby="nav-contact-tab">
                       
                        <button type="button" class="btn btn-primary btn-sm point" data-bs-toggle="modal" data-bs-target="#atr_dynamic" onclick="adddynaatr(this)">Add Attribute</button>
                        <table id="sitetable3" class="table table-striped table-bordered mx-2 config_table_3 table_config" style="width:100%">
                           <thead style="position: sticky;top: 0;background:#E5FCFF;">
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
                              <?php
                              $y=0;
                              ?>
                              @foreach($config_dynamic_attribute as $dynamic_atr)
                              <tr class="<?php if($y > 4){ echo 'siteactivedynamic"'; } ?>">
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
                                    <button type="button" class="edit" style="border-radius: 0;
                                       background-color: #202C55;width: 76px;" data-bs-toggle="modal" data-bs-target="#dynamicatr_edit" data-id="{{$dynamic_atr->la_location_attribute_id}}" onclick="dynamic_attr(this)">Edit</button>
                                    {{-- <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0;
                                       background-color: #202C55;">Sub Reason</button> --}}
                                 </td>
                              </tr>
                              <?php
                              $y++;
                              ?>
                              @endforeach
                           </tbody>
                        </table>

                     </div>
                  </div>
               </div>
               
            </div>
         </div>
         {{--Reason--}}
         <div class="tab-pane fade " id="nav-reason" role="tabpanel" aria-labelledby="nav-home-tab">

            {{-- Table --}}
            <table id="sitetable" class="table table-striped table-bordered mx-2 my-table" style="width:100%">
               <thead>
                  <tr>
                     <th>ID Reason</th>
                     <th>Reason Code</th>
                     <th>Description</th>
                     <th>Status</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td style="text-align: center">101</td>
                     <td>Asset Modification</td>
                     <td style="text-align: center">Reason code for asset related modification</td>
                     <td>Active</td>
                     <td style="text-align: center">
                        <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0;
                           background-color: #202C55;width: 76px;">Edit</button>
                        {{-- <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0;
                           background-color: #202C55;">Sub Reason</button> --}}
                     </td>
                  </tr>
                  
                 
               </tbody>
            </table>

         </div>

         <!--Add Asset type modal-->
         <div class="modal fade"  id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog"style="max-width: 40% !important;" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="AddModal">Add Asset Type</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
                    &times;
                  </button>
                </div>
                <div class="modal-body" style="backdrop-filter: blur(2px)">
                  <form id="asset_type_config">
                    <div class="form-group">
                      <label for="type_code" class="col-form-label"><strong>Type Code </strong></label>
                      <input type="text" class="form-control" id="type_code">
                    </div>
                    <div class="form-group">
                     <label for="type_description" class="col-form-label"><strong> Description</strong></label>
                     <input type="text" class="form-control" id="type_description">
                   </div>
                   <div class="form-group">
                     <label for="parent_asset_type" class="col-form-label"><strong> Parent Asset Type </strong></label>
                     
                     {{-- <input type="text" class="form-control" id="parent_asset_type"  --}}
                     <select class="form-select" id="parent_asset_type">
   
                        <option value=' '>NA</option>
                        
                        @foreach($parenttype_details as $asttypedetails)
                           <option value='{{$asttypedetails->at_asset_type_id}}'>{{$asttypedetails->at_asset_type_name}}</option>
                        @endforeach                     
                      </select>
                   </div>
                   <div class="form-group">
                     <label for="category" class="col-form-label"><strong> Category </strong></label>
                  
                     <select data-container="body" class="form-select" id="category">
                        <option></option>
                        <option value="ACTIVE">ACTIVE</option>
                        <option value="PASSIVE">PASSIVE</option>                       
                      </select>
                      <span id="select_span"></span>
                   </div>
                   <div class="form-group">
                     <label for="asset_status" class="col-form-label"><strong>Status</strong></label>                       
                     <select data-container="body" class="form-select"id="asset_statusadd">
                        <option >  </option>
                        <option value="ACTIVE">ACTIVE</option>
                        <option value="INACTIVE">INACTIVE</option>                       
                      </select>                  
                   </div>
                   
                  
                 
                </div>
                <div class="modal-footer">
                  <p id="assettype_add_msg"></p>
                  <button type="button" id="submitButton" class="btn btn-secondary save_one" onclick="saveaddbutton()">Save</button>
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>

                </div>
              </div>
            </form>
            </div>
         </div>
   <!-- Edit modal of assettype-->
   <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodallLabel" aria-hidden="true">
      <div class="modal-dialog"style="max-width: 40% !important;" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="editmodal">Modify Asset Type</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
            &times;
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-6">

               </div>
               <div class="col-md-6">

               </div>
            </div> 
            <form>
            <div class="form-group">
               <label for="type_code" class="col-form-label"><strong>Type Code</strong></label>
               <input type="text" class="form-control" id="type_code" disabled>
            </div>
            <div class="form-group">
               <label for="type_description" class="col-form-label"><strong>Type Description</strong></label>
               <input type="text" class="form-control" id="type_description">
            </div>
            <div class="form-group">
               <label for="parent_asset_type" class="col-form-label"><strong>Parent Asset Type </strong></label>
               
               <select class="form-control" id="parent_asset_type" disabled="true">

                  <option value=' '>NA</option>
                  @foreach($parenttype_details as $asttypedetails)
                     <option value='{{$asttypedetails->at_asset_type_id}}'>{{$asttypedetails->at_asset_type_name}}</option>
                  @endforeach                     
               </select>
            </div>
            <div class="form-group">
               <label for="category" class="col-form-label"><strong>Category </strong></label>
               <select data-container="body" class="form-control" id="category" disabled="true">
                  <option value="ACTIVE">ACTIVE</option>
                  <option value="PASSIVE">PASSIVE</option>                       
               </select>
            </div>
            <div class="form-group">
               <label for="asset_status" class="col-form-label"><strong>Status</strong></label>
               <select data-container="body" class="form-control" id="asset_status">
                  <option value="ACTIVE">ACTIVE</option>
                  <option value="INACTIVE">INACTIVE</option>                       
               </select>
               <input type="hidden" class="form-control" id="id">
            </div>
            
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="savebtn()">Update</button>
            
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
         </div>
      </div>
      </div>
   </div>
 </div>

          <!--Add Asset type modal of fixed attribute-->
         <div class="modal fade" id="fixedattribute" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="AddModal">Fixed Attribute</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
                        &times;
                        </button>
                     </div>
                  <div class="modal-body">
                 
                  <form id="fixed_attribute_validation" action="{{url('configuration_fixedasstadd')}}" method="POST">
                     @csrf

              <div class="row">
                <div class="col-md-6">
                     
                        <div class="form-group">
                           <label for="fixedatt_code" class="col-form-label"><strong>Attribute Code</strong></label>
                           <input type="text" name="attribute_code"class="form-control" id="fixedatt_code">
                        </div>
                        <div class="form-group">
                           <label for="fixedatt_name" class="col-form-label"><strong>Attribute Name </strong></label>
                           <input type="text" name="attribute_attname" class="form-control" id="fixedatt_name">
                        </div>
                        <div class="form-group">
                           <label for="description_fixed" class="col-form-label"><strong>Description </strong></label>
                           <input type="text" name="attribute_fixdescription" class="form-control" id="description_fixed">
                        </div>
                        <div class="form-group">
                           <label for="fixed_data_type" class="col-form-label"> <strong>Data Type </strong></label>
                           {{-- <input type="text" name="attribute_fixdata" class="form-control" id="fixed_data_type"> --}}
                           <select data-container="body" class="form-select" id="fixedstatus_data_type" name='attribute_fixdata'>
                              <option></option>
                              <option value="INT">INT</option>
                              <option value="VARCHAR">VARCHAR</option>      
                              <option value="TEXT" > TEXT </option>  
                              <option value="NUMERIC">NUMERIC</option>
                              <option value="DATE">DATE</option>  
                           </select>    
                        </div>
                   
                        <div class="form-group">
                           <label for="fixedlistvl_data_type" class="col-form-label"> <strong>Fixed List Of Values </strong></label>
                           <input type="text" name="fixflov" class="form-control" id="fixedlistvl_data_type">
                        </div>
                </div>

                   {{-- <div class="form-group">
                     <label for="asset_type_name" class="col-form-label"><strong>Asset Type Name</strong></label>
                     <select class="form-select" id="asset_type_name" name="asset_name">
                        <option value=' '>--Select--</option>
                     
                        @foreach($asset_name as $asttypedetails)
                           <option value='{{$asttypedetails->at_asset_type_id}}'>{{$asttypedetails->at_asset_type_name}}</option>
                        @endforeach                     
                      </select>
                   </div> --}}
                
                  <div class="col-md-6">
                        <div class="form-group">
                           <label for="fixed_mandatory_flag" class="col-form-label"><strong>Mandatory Flag</strong></label>
                           <select data-container="body" class="form-select" id="fixed_mandatory_flag" name='attribute_fixflag'>
                              <option></option>
                              <option value="REQUIRED">REQUIRED</option>
                              <option value="NOT REQUIRED">NOT REQUIRED</option>                      
                           </select>
                        </div>
                        <div class="form-group">
                           <label for="fixed_default" class="col-form-label"><strong>Default Value</strong></label>
                           <input type="text" class="form-control" id="fixed_default">                       
                        </div>
                           <div class="form-group">
                           <label for="fixedstatus" class="col-form-label"> <strong>Status </strong></label>
                           <select data-container="body" class="form-select" id="fixedstatus" name='fixstatus'>
                              <option></option>
                              <option value="ACTIVE">ACTIVE</option>
                              <option value="INACTIVE">INACTIVE</option>                      
                           </select>
                           </div>
                  </div>
               </div>
            </div>
                  

                        <div class="modal-footer">
                           <button type="submit" class="btn btn-secondary" id="saveattfix">Save</button>
                           <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                        </div>
               </form>
              </div>
            </div>
         </div>

          
          <!--Edit modal of fixed attribute-->
          <div class="modal fade" id="fixedattributeedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="AddModal">Fixed Attribute</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    &times;
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                     <div class="col-6"></div>
                     <div class=""></div>
                  </div>
                  <form >
                  
               <div class="row">
                 <div class="col-md-6">
                    <div class="form-group">
                     <label for="fixedatt_code" class="col-form-label"><strong>Attribute Code</strong></label>
                     <input type="text" name="attribute_code"class="form-control" id="fixedatt_code" disabled>
                   </div>
                    <div class="form-group">
                     <label for="fixedatt_name" class="col-form-label"><strong>Attribute Name</strong></label>
                     <input type="text" name="attribute_attname" class="form-control" id="fixedatt_name" disabled>
                   </div>
                   <div class="form-group">
                     <label for="description_fixed" class="col-form-label"><strong>Description</strong></label>
                     <input type="text" name="attribute_fixdescription" class="form-control" id="description_fixed">
                   </div>
                   <div class="form-group">
                     <label for="fixed_data_type" class="col-form-label"><strong>Data Type</strong></label>
                     {{-- <input type="text" name="attribute_fixdata" class="form-control" id="fixed_data_type" disabled> --}}
                     <select data-container="body" class="form-select" id="fixed_data_type_edit" name='attribute_fixdata'>
                        <option></option>
                        <option value="INT">INT</option>
                        <option value="VARCHAR">VARCHAR</option>      
                        <option value="TEXT" > TEXT </option>  
                        <option value="NUMERIC">NUMERIC</option>
                        <option value="DATE">DATE</option>  
                     </select>         
                   </div>
                        <div class="form-group">
                           <label for="fixedlistvl_data_type_edit" class="col-form-label"> <strong>Fixed List Of Values </strong></label>
                           <input type="text" name="fixflov" class="form-control" id="fixedlistvl_data_type_edit">
                           <input type="hidden" class="form-control" id="asset_type_edit_id">
                        </div>
                 </div>
                   {{-- <div class="form-group">
                     <label for="asset_type_name" class="col-form-label"><strong>Asset Type Name</strong></label>
                     <select class="form-control" id="asset_type_name" name="asset_name" disabled="true">
                        <option value=' '>--Select--</option>
                        
                        @foreach($asset_name as $asttypedetails)
                           <option value='{{$asttypedetails->at_asset_type_id}}'>{{$asttypedetails->at_asset_type_name}}</option>
                        @endforeach                     
                      </select>
                       
                   </div> --}}
                
                     <div class="col-md-6">
                   <div class="form-group">
                     <label for="fixed_mandatory_flag_EDIT" class="col-form-label"><strong>Mandatory Flag</strong></label>
                     <select data-container="body" class="form-select" id="fixed_mandatory_flag_EDIT" name='attribute_fixflag'>
                        <option value="REQUIRED">REQUIRED</option>
                        <option value="NOT REQUIRED">NOT REQUIRED</option>                      
                      </select> 
                   </div>
                   <div class="form-group">
                     <label for="fixed_default_val" class="col-form-label"><strong>Default Value</strong></label>
                     <input type="text" class="form-control" id="fixed_default_val">   
                                        
                   </div>
                   <div class="form-group">
                     <label for="fixedstatusedit" class="col-form-label"> <strong>Status </strong></label>
                     <select data-container="body" class="form-select" id="fixedstatusedit" name='fixstatus'>
                        <option></option>
                        <option value="ACTIVE">ACTIVE</option>
                        <option value="INACTIVE">INACTIVE</option>                      
                      </select>
                     
                    
                   </div>
                     </div>
                     </div>
                  
                </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" onclick="updatefix() ">Update</button>
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
            
               </form>
              </div>
            </div>
          </div>

          {{-- Add modal of asset dynamic attribute --}}
          
          <div class="modal fade" id="asset_attribute_dynamic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="AddModal">Dynamic Attribute</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    &times;
                  </button>
                </div>
                <div class="modal-body">
                  <form id="dynamic_attribute" action="{{url('configuration_dynamicattribute')}}" method="POST">
                     @csrf

                     <div class="row">
                     <div class="col-md-6">
                    <div class="form-group">
                     <label for="dynamic_att_code" class="col-form-label"><strong>Attribute Code</strong></label>
                     <input type="text" name="attribute_code"class="form-control" id="dynamic_att_code">
                   </div>
                    <div class="form-group">
                     <label for="dynamic_at_name" class="col-form-label"><strong>Attribute Name</strong></label>
                     <input type="text" name="attribute_attname" class="form-control" id="dynamic_at_name">
                   </div>
                   <div class="form-group">
                     <label for="description_dynamic" class="col-form-label"><strong>Description</strong></label>
                     <input type="text" name="attribute_fixdescription" class="form-control" id="description_dynamic">
                   </div>
                   <div class="form-group">
                     <label for="dynamic_att_data_type" class="col-form-label"><strong>Data Type</strong></label>
                     {{-- <input type="text" name="attribute_fixdata" class="form-control" id="dynamic_att_data_type"> --}}
                     <select data-container="body" class="form-select"   id="dynamic_att_data_type" name='attribute_fixdata'>
                        <option></option>
                        <option value="INT">INT</option>
                        <option value="VARCHAR">VARCHAR</option>      
                        <option value="TEXT" > TEXT </option>  
                        <option value="NUMERIC">NUMERIC</option>
                        <option value="DATE">DATE</option>  
                     </select>              
                   </div>
                   <div class="form-group">
                     <label for="dynamiclistvl_data_type" class="col-form-label"> <strong>Fixed List Of Values </strong></label>
                     <input type="text" name="fixflov" class="form-control" id="dynamiclistvl_data_type">
                   </div>
                   <div class="form-group">
                     <label for="dynamic_asset_type_name" class="col-form-label"><strong>Asset Type Name</strong></label>
                     <select class="form-select" id="dynamic_asset_type_name" name="asset_name" >
                        <option value=' '>--Select--</option>
                      
                        @foreach($asset_name as $asttypedetails)
                           <option value='{{$asttypedetails->at_asset_type_id}}'>{{$asttypedetails->at_asset_type_name}}</option>
                        @endforeach                     
                      </select>
                   </div>
                   

                     </div>
                     
                     <div class="col-md-6">
                   <div class="form-group">
                     <label for="dynamic_mandatory_flag" class="col-form-label"><strong>Mandatory Flag</strong></label>
                  
                     <select data-container="body" class="form-select"   id="dynamic_mandatory_flag" name='attribute_fixflag'>
                        <option> </option>
                        <option value="REQUIRED">REQUIRED</option> 
                        <option value="NOT REQUIRED">NOT REQUIRED</option> 
                     </select>
                   </div>
                   <div class="form-group">
                     <label for="dynamic_default_val" class="col-form-label"><strong>Default Value</strong></label>
                     <input type="text" class="form-control" id="dynamic_default_val" name="attribute_fixdefault">                       
                   </div>
                   <div class="form-group">
                     <label for="dynamicstatus" class="col-form-label"> <strong>Status</strong></label>
                     {{-- <input type="text" name="fixstatus" class="form-control" id="dynamicstatus" > --}}
                     <select data-container="body" class="form-select"   id="dynamicstatus" name='fixstatus'>
                        <option> </option>
                        <option value="ACTIVE">ACTIVE</option> 
                        <option value="INACTIVE">INACTIVE</option> 
                     </select>
                   </div>
                     </div>
                      </div>
                  </div>
                  
                  <div class="modal-footer">
                     <button type="submit"  class="btn btn-secondary" id="quickform">Save</button>
                     <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                  </div>
               </form>
              </div>
            </div>
         </div>

         <!--Edit modal of dynamic attribute-->
         <div class="modal fade" id="dynamic_edit_att" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="AddModal">Dynamic Attribute</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    &times;
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                     <div class="col-6">

                     </div>
                     <div class="">

                     </div>
                  </div>
                  <form >
                  
                     <div class="row">
                        <div class="col-md-6">
                    <div class="form-group">
                     <label for="dynamic_edit_code" class="col-form-label"><strong>Attribute Code</strong></label>
                     <input type="text" name="attribute_code"class="form-control" id="dynamic_edit_code" disabled>
                   </div>
                    <div class="form-group">
                     <label for="dynamic_edit_name" class="col-form-label"><strong>Attribute Name</strong></label>
                     <input type="text" name="attribute_attname" class="form-control" id="dynamic_edit_name" disabled>
                   </div>
                   <div class="form-group">
                     <label for="description_dynamic_edit" class="col-form-label"><strong>Description</strong></label>
                     <input type="text" name="attribute_fixdescription" class="form-control" id="description_dynamic_edit">
                   </div>
                   <div class="form-group">
                     <label for="dynamic_edit_data_type" class="col-form-label"><strong>Data Type</strong></label>
                     {{-- <input type="text" name="attribute_fixdata" class="form-control" id="dynamic_edit_data_type" disabled> --}}
                     <select data-container="body" class="form-select" id="dynamic_edit_data_type" name='attribute_fixdata'>
                        <option></option>
                        <option value="INT">INT</option>
                        <option value="VARCHAR">VARCHAR</option>      
                        <option value="TEXT" > TEXT </option>  
                        <option value="NUMERIC">NUMERIC</option>
                        <option value="DATE">DATE</option>  
                     </select>     
                   </div>
                   <div class="form-group">
                     <label for="dynamiclistvl_data_type" class="col-form-label"> <strong>Fixed List Of Values </strong></label>
                     <input type="text" name="fixflov" class="form-control" id="dynamiclistvl_data_type">
                   </div>
                        </div>

                   <div class="col-md-6">
                   <div class="form-group">
                     <label for="asset_type_name_dynamicedit" class="col-form-label"><strong>Asset Type Name</strong></label>
                     <select class="form-control" id="asset_type_name_dynamicedit" name="asset_name" disabled="true">
                        <option value=' '>--Select--</option>
                     
                        @foreach($asset_name as $asttypedetails)
                           <option value='{{$asttypedetails->at_asset_type_id}}'>{{$asttypedetails->at_asset_type_name}}</option>
                        @endforeach                     
                      </select>
                      <input type="hidden" class="form-control" id="dynamic_type_edit_id"> 
                   </div>
                  <div class="form-group">
                     <label for="dynamicedit_mandatory_flag" class="col-form-label"><strong>Mandatory Flag</strong></label>
                     {{-- <input type="text" class="form-control" id="dynamicedit_mandatory_flag" name='attribute_fixflag' readonly>  --}}
                     <select data-container="body" class="form-control" id="dynamicedit_mandatory_flag" name='attribute_fixflag'>
                        <option value="REQUIRED">REQUIRED</option> 
                        <option value="NOT REQUIRED">NOT REQUIRED</option> 
                     </select>
                  </div>
                   <div class="form-group">
                     <label for="dynamicedit_default_val" class="col-form-label"><strong>Default Value</strong></label>
                     <input type="text" class="form-control" id="dynamicedit_default_val">   
                                        
                   </div>
                   <div class="form-group">
                     <label for="dynamicstatus" class="col-form-label"> <strong>Status</strong></label>
                     {{-- <input type="text" name="fixstatus" class="form-control" id="dynamicstatus" > --}}
                     <select data-container="body" class="form-select"   id="dynamicstatus" name='fixstatus'>
                     <option> </option>
                     <option value="ACTIVE">ACTIVE</option> 
                     <option value="INACTIVE">INACTIVE</option> 
                  </select>
                   </div>
                    
                </div>
               </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" onclick="dynamic_edit() ">Update</button>
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
               </form>
              </div>
            </div>
          </div>
     

<!-- reason table -->

{{-- <script>
   $('#point').click(function() {
   $('#exampleModal').modal('show');
});
</script> --}}
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
const typeCodeInput = document.getElementById('type_code');
const typeDescriptionInput = document.getElementById('type_description');
const parentAssetTypeSelect = document.getElementById('parent_asset_type');
const categorySelect = document.getElementById('category');
const assetStatusSelect = document.getElementById('asset_statusadd');
const submitButton = document.getElementById('submitButton');

// Add event listeners to form elements
typeCodeInput.addEventListener('input', checkFormAsset);
typeDescriptionInput.addEventListener('input', checkFormAsset);
parentAssetTypeSelect.addEventListener('change', checkFormAsset);
categorySelect.addEventListener('change', checkFormAsset);
assetStatusSelect.addEventListener('change', checkFormAsset);

// Function to check if all fields are filled
function checkFormAsset() {
  // Check if all fields have values
  if (
    typeCodeInput.value.trim() !== '' &&
    typeDescriptionInput.value.trim() !== '' &&
    parentAssetTypeSelect.value.trim() !== '' &&
    categorySelect.value.trim() !== '' &&
    assetStatusSelect.value.trim() !== ''
  ) {
    submitButton.classList.add('active');
  } else {
    submitButton.classList.remove('active');
  }
}




</script>


{{-- <script>
const dynamictypeCodeInput = document.getElementById('dynamic_att_code');
const dynamicnameInput = document.getElementById('dynamic_at_name');
const dynamicdescriptionInput = document.getElementById('description_dynamic');
const dynamicatdatatypeInput = document.getElementById('dynamic_att_data_type');
const dynamicnameAssetTypeSelect = document.getElementById('dynamic_asset_type_name');
const dynamicmandSelect = document.getElementById('dynamic_mandatory_flag');
const dynamicdefaultval = document.getElementById('dynamic_default_val');
const submitButtonone = document.getElementById('quickform');

// Add event listeners to form elements
dynamictypeCodeInput.addEventListener('input', checkFormone);
dynamicnameInput.addEventListener('input', checkFormone);
dynamicdescriptionInput.addEventListener('input', checkFormone);
dynamicatdatatypeInput.addEventListener('input', checkFormone);
dynamicnameAssetTypeSelect.addEventListener('change', checkFormone);
dynamicmandSelect.addEventListener('change', checkFormone);
dynamicdefaultval.addEventListener('Input', checkFormone);

// Function to check if all fields are filled-
function checkFormone() {
  // Check if all fields have values
  if (
   dynamictypeCodeInput.value.trim() !== '' &&
   dynamicnameInput.value.trim() !== '' &&
   dynamicdescriptionInput.value.trim() !== '' &&
   dynamicatdatatypeInput.value.trim() !== '' &&
   dynamicnameAssetTypeSelect.value.trim() !== '' &&
   dynamicmandSelect.value.trim() !== '' &&
   dynamicdefaultval.value.trim() !== ''
  ) {
   submitButtonone.classList.add('active');
  } else {
    submitButtonone.classList.remove('active');
  }
}
</script> --}}
<script>
       // COLOR CHANGE OF BUTTON
   $(document).ready(function() {
  // Add event listeners to form elements
  $('#dynamic_att_code, #dynamic_at_name, #description_dynamic, #dynamic_att_data_type, #dynamic_asset_type_name, #dynamiclistvl_data_type, #dynamic_mandatory_flag, #dynamic_default_val, #dynamicstatus').on('input change', checkFormdynamic);
});

// Function to check if all fields are filled
function checkFormdynamic() {
  var allFieldsFilled = true;
  // Check if all fields have values
  $('#dynamic_attribute input[type="text"], #dynamic_attribute select').each(function() {
    if ($(this).val().trim() === '') {
      allFieldsFilled = false;
      return false; // Exit the loop if any field is empty
    }
  });
  
  // Change button color based on field values
  if (allFieldsFilled) {
    $('#quickform').removeClass('btn-secondary').addClass('btn-primary');
  } else {
    $('#quickform').removeClass('btn-primary').addClass('btn-secondary');
  }
}


$(document).ready(function() {
  // Add event listeners to form elements
   $('#fixedatt_code, #fixedatt_name, #description_fixed, #fixedstatus_data_type, #fixedlistvl_data_type, #fixed_mandatory_flag, #fixed_default, #fixedstatus').on('input change', checkForm);
   });

// Function to check if all fields are filled
function checkForm() {
  var allFieldsFilled = true;
  // Check if all fields have values
  $('#fixed_attribute_validation input[type="text"], #fixed_attribute_validation select').each(function() {
    if ($(this).val().trim() == '') {
      allFieldsFilled = false;
      return false; // Exit the loop if any field is empty
    }
  });
  
  // Change button color based on field values
  if (allFieldsFilled) {

    $('#saveattfix').removeClass('btn-secondary').addClass('btn-primary');
  } else {
    $('#saveattfix').removeClass('btn-primary').addClass('btn-secondary');
  }
}

</script>

<script>
    function asttypedetails(e){
      //alert($(e).data("id"));
    $.ajax({
      
        type: "GET",       
        //url: 'http://3.111.113.246/umprojnew/public/index.php/locationdb',
        url: "{{url('congiguration_asset')}}",
        data:{
            'assttype_id' : $(e).data("id"),
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
         //console.log(result.config_assetadd[0]['at_asset_type_code']);
         if(result.status == 'success'){
           // console.log(result.config_assetadd);
           console.log(result.config_assetadd[0]['at_asset_type_code']);
            $("#editmodal #type_code").val(result.config_assetadd[0]['at_asset_type_code']);
            
         }
         if(result.status == 'success'){
           console.log(result.config_assetadd[0]['at_asset_type_description']);
            $("#editmodal #type_description").val(result.config_assetadd[0]['at_asset_type_description']);
            
         }
         if(result.status == 'success'){
           console.log(result.config_assetadd[0]['at_parent_asset_type_id']);           
            $('#editmodal #parent_asset_type option[value="'+result.config_assetadd[0]['at_parent_asset_type_id']+'"]').prop('selected', true);
            
         }
         if(result.status == 'success'){
           console.log(result.config_assetadd[0]['at_asset_type_category']);            
            $('#editmodal #category option[value="'+result.config_assetadd[0]['at_asset_type_category']+'"]').prop('selected', true);
            
         }
         if(result.status == 'success'){
           console.log(result.config_assetadd[0]['at_asset_type_status']);            
            $('#editmodal #asset_status option[value="'+result.config_assetadd[0]['at_asset_type_status']+'"]').prop('selected', true);
         }
         if(result.status == 'success'){
           console.log(result.config_assetadd[0]);
            $("#editmodal #id").val(result.config_assetadd[0]['at_asset_type_id']);
            
         }
          }  
        

        })
    }
    function savebtn() {
         var id= $("#editmodal #id").val();               
         var describtion=$("#editmodal #type_description").val();
         var passttype= $("#editmodal #parent_asset_type").val();
         var catagory= $("#editmodal #category").val();
         var status=$("#editmodal #asset_status").val();
         var csrfToken = '{{ csrf_token() }}';
         $.ajax({
         method:"POST",
         url: "{{url('congiguration_asset_update')}}",
         data:{
               'id' : id,
               '_token': csrfToken,
               'describtion' : describtion,
               'passttype' : passttype,
               'catagory' : catagory,
               'status' : status,
         },
         
         success: function(data){
            $('#editmodal').modal('hide');
            $(document).ajaxStop(function(){
               window.location.reload();
            });
      }
      
      })
   }
   
   function assetconfig_add()
   {
      $('#asset_type_config')[0].reset();
      // $("#submitButton").removeClass("active");
      $("#exampleModal").find(".error").removeClass("error");
      $("#exampleModal").find("span").remove();

   }

   function assetatrrifix_button()
   {
      $('#fixed_attribute_validation')[0].reset();
      $("#saveattfix").removeClass("active");
      $("#fixed_attribute_validation").find(".error").removeClass("error");
         $("#fixed_attribute_validation").find("span").remove();

   }
   function asstdynamic_button()
   {
      $('#dynamic_attribute')[0].reset();
      $("#quickform").removeClass("active");
      $("#dynamic_attribute").find(".error").removeClass("error");
         $("#dynamic_attribute").find("span").remove();

   }

   // $("#exampleModal .modal-body").on("change, keyup", function(){
   //    $(".save_one").css("background-color", "yellow");
   // });

   
   function saveaddbutton() {  
      
   $('#exampleModal').on('hidden.bs.modal', function () {
    $('#exampleModal form')[0].reset();
   });
         $("#exampleModal").find(".error").removeClass("error");
         $("#exampleModal").find("span").remove();
         var typecode= $("#exampleModal #type_code").val().trim(); 
         var describtion=$("#exampleModal #type_description").val().trim();
         var passttype= $("#exampleModal #parent_asset_type").val().trim();
         var catagory= $("#exampleModal #category").val().trim();
         var status=$("#asset_statusadd").val().trim();
         var csrfToken = '{{ csrf_token() }}';
         if (typecode ==  "") {
			   $("#type_code").focus();
            $("#type_code").addClass("error");
            $("#type_code").after("<span>Required</span>");
			   return false;          
			}
         if (describtion ==  "") {
			   $("#type_description").focus();
            $("#type_description").addClass("error");
            $("#type_description").after("<span>Required</span>");
			   return false;          
			}
         
         // if (passttype ==  "") {
			//    $("#parent_asset_type").focus();
         //    $("#parent_asset_type").addClass("error");
         //    $("#parent_asset_type").after("<span>Required</span>");
			//    return false;          
			// }

         if (catagory ==  "") {
			   $("#category").focus();
            $("#category").addClass("error");
            $("#category").after("<span>Required</span>");
			   return false;          
			}

         if (status ==  "") {
			   $("#asset_statusadd").focus();
            $("#asset_statusadd").addClass("error");
            $("#asset_statusadd").after("<span>Required</span>");
			   return false;          
			}
         
         $.ajax({
         method:"POST",
         url: "{{url('congiguration_assettype')}}",
         data:{              
               '_token': csrfToken,       
               'typecode':typecode,
               'describtion' : describtion,
               'passttype' : passttype,
               'catagory' : catagory,
               'status' : status,
         },
         success: function(data){
            //console.log(data);
         
            $('#exampleModal').modal('hide');
            $('#exampleModal').on('hidden.bs.modal', function () {
            $('#exampleModal form')[0].reset();
            });
            window.location.reload();
           
      }
      
      })
   }

   function fixededit(e){
      //alert($(e).data("id"));
    $.ajax({
        type: "GET",       
        //url: 'http://3.111.113.246/umprojnew/public/index.php/locationdb',
        url: "{{url('configuration_editfixfetch')}}",
        data:{
            'fixatt_id' : $(e).data("id"),
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
         $("#fixedattributeedit #fixedatt_code").val(result.fetchfixattr[0]['ata_asset_type_attribute_code']); 
         }
         if(result.status == 'success'){ 
            $("#fixedattributeedit #fixedatt_name").val(result.fetchfixattr[0]['ata_asset_type_attribute_name']);
         }
         
         if(result.status == 'success'){
           
            $("#fixedattributeedit #description_fixed").val(result.fetchfixattr[0]['ata_asset_type_attribute_description']);
            
         }
         if(result.status == 'success'){
                      
            $("#fixedattributeedit #fixed_data_type_edit").val(result.fetchfixattr[0]['ata_asset_type_attribute_datatype']);
            
         }
         if(result.status == 'success')
      {
      $("#fixedattributeedit #fixed_mandatory_flag_EDIT").val(result.fetchfixattr[0]['ata_asset_type_attribute_mandatory_flag']).prop('selected', true);
      }

      if(result.status == 'success')
      {
      $("#fixedattributeedit #fixedstatusedit").val(result.fetchfixattr[0]['ata_status']);
      }
      if(result.status == 'success')
      {
      $("#fixedattributeedit #fixedlistvl_data_type_edit").val(result.fetchfixattr[0]['ata_flov']);
      }
         // if(result.status == 'success'){
         //  $("#fixedattributeedit #asset_type_name").val(result.fetchfixattr[0]['ata_asset_type_id']);          
            
         // }
         if(result.status == 'success'){

            console.log(result.fetchfixattr[0]);
          $("#fixedattributeedit #fixed_default_val").val(result.fetchfixattr[0]['ata_asset_type_attribute_default_value']);          
            
         }
         
         if(result.status == 'success'){
           console.log(result.fetchfixattr[0]);
            $("#fixedattributeedit #asset_type_edit_id").val(result.fetchfixattr[0]['ata_asset_type_attribute_id']);
            
         }
         

         

          }  
        

        })
    }
    function updatefix() {
      //alert("mm");
         var id= $("#fixedattributeedit #asset_type_edit_id").val();  
         //console.log(id);             
         var fixcode=$("#fixedattributeedit #fixedatt_code").val();
         //console.log(fixcode);
         var fixname= $("#fixedattributeedit #fixedatt_name").val();
         //console.log(fixname);
         var fixdes= $("#fixedattributeedit #description_fixed").val();
         //console.log(fixdes);
         var fixdata=$("#fixedattributeedit #fixed_data_type_edit").val();
         console.log(fixdata);
         // var fixastname=$("#fixedattributeedit #asset_type_name").val();
         //console.log(fixastname);
         var fixdefault=$("#fixedattributeedit #fixed_default_val").val();
         //console.log(fixdefault);
         var fixdmandtry=$("#fixedattributeedit #fixed_mandatory_flag_EDIT").val();
          //console.log(fixdmandtry);
          var fixvalues=$("#fixedattributeedit #fixedlistvl_data_type_edit").val();
          var fixsta=$("#fixedattributeedit #fixedstatusedit").val();

         var csrfToken = '{{ csrf_token() }}';
         //return false;
         $.ajax({
         method:"POST",
         url: "{{url('configuration_updfixfetch')}}",
         data:{
               'id' : id,
               '_token': csrfToken,
               'attribute_code' :fixcode ,
               'attribute_attname' : fixname,
               'attribute_fixdescription' :fixdes ,
               'attribute_fixdata' : fixdata,
               // 'asset_name' : fixastname,
               'attribute_fixdefault' :fixdefault ,
               'attribute_fixflag' :fixdmandtry ,
               'fixstatus':fixsta,
               'fixflov':fixvalues,

         },
         
         success: function(data){
            $('#fixedattributeedit').modal('hide');
            $(document).ajaxStop(function(){
               window.location.reload();
            });
      }
      
      })
   }

function dynamicedit(e)

{
   $.ajax({
        type: "GET",       
        //url: 'http://3.111.113.246/umprojnew/public/index.php/locationdb',
        url: "{{url('configuration_editdynamic')}}",
        data:{
            'dynamic_id' : $(e).data("id"),
        },
        success: function(result) { 
         if(result.status == 'success'){
            // console.log(result);
         $("#dynamic_edit_att #dynamic_edit_code").val(result.fetchdynamicatt[0]['ata_asset_type_attribute_code']);
         }

         if(result.status == 'success'){
         $("#dynamic_edit_att #dynamic_edit_name").val(result.fetchdynamicatt[0]['ata_asset_type_attribute_name']);
         }

         if(result.status == 'success'){
         $("#dynamic_edit_att #description_dynamic_edit").val(result.fetchdynamicatt[0]['ata_asset_type_attribute_description']);
         }

         
         if(result.status == 'success'){
         $("#dynamic_edit_att #dynamic_edit_data_type").val(result.fetchdynamicatt[0]['ata_asset_type_attribute_datatype']);
         }

         if(result.status == 'success'){
         $("#dynamic_edit_att #asset_type_name_dynamicedit").val(result.fetchdynamicatt[0]['ata_asset_type_id']);
         }

         if(result.status == 'success'){
            console.log(result.fetchdynamicatt[0]['ata_asset_type_attribute_mandatory_flag']);
         $("#dynamic_edit_att #dynamicedit_mandatory_flag").val(result.fetchdynamicatt[0]['ata_asset_type_attribute_mandatory_flag']);
         }
         
         if(result.status == 'success'){
         $("#dynamic_edit_att #dynamicedit_default_val").val(result.fetchdynamicatt[0]['ata_asset_type_attribute_default_value']);
         }
         if(result.status == 'success'){
         $("#dynamic_edit_att #dynamicstatus").val(result.fetchdynamicatt[0]['ata_status']);
         }
         if(result.status == 'success'){
         $("#dynamic_edit_att #dynamiclistvl_data_type").val(result.fetchdynamicatt[0]['ata_flov']);
         }
         if(result.status == 'success'){
           console.log(result.fetchdynamicatt[0]);
            $("#dynamic_edit_att #dynamic_type_edit_id").val(result.fetchdynamicatt[0]['ata_asset_type_attribute_id']);
            
         }

        }
}
   )
}

function dynamic_edit() {
      //alert("mm");
         var id= $("#dynamic_edit_att #dynamic_type_edit_id").val();  
      console.log(id);
         //alert(id);             
         var dynamiccode=$("#dynamic_edit_att #dynamic_edit_code").val();
         //console.log(fixcode);
         var dynamicname= $("#dynamic_edit_att #dynamic_edit_name").val();
         var dynamicdes= $("#dynamic_edit_att #description_dynamic_edit").val();
         var dynamicdata=$("#dynamic_edit_att #dynamic_edit_data_type").val();
         var dynamicastname=$("#dynamic_edit_att #asset_type_name_dynamicedit").val();
         var dynamicdefault=$("#dynamic_edit_att #dynamicedit_default_val").val();
         var dynamicmandflag=$("#dynamic_edit_att #dynamicedit_mandatory_flag").val();
         var dymic_status=$("#dynamic_edit_att #dynamicstatus").val();
         var dynamic_flov=$("#dynamic_edit_att #dynamiclistvl_data_type").val();
         var csrfToken = '{{ csrf_token() }}';
         //return false;
         $.ajax({
         method:"POST",
         url: "{{url('configuration_updatedynamic')}}",
         data:{
               'id' : id,
               '_token': csrfToken,
               'attribute_code' :dynamiccode ,
               'attribute_attname' : dynamicname,
               'attribute_fixdescription' :dynamicdes ,
               'attribute_fixdata' : dynamicdata,
               'asset_name' : dynamicastname,
               'attribute_fixdefault' :dynamicdefault ,
               'attribute_fixflag' :dynamicmandflag ,
               'fixstatus':dymic_status,
               'fixflov':dynamic_flov,


         },
         
         success: function(data){
            $('#dynamic_edit_att').modal('hide');  
            $(document).ajaxStop(function(){
               window.location.reload();
            });
      }
      
      })
   }

   function configasst() {
    
    
    
    $('.noactive').toggle();
    if($(".locationsite i").hasClass('fa-angle-down')){
      $(".locationsite i").removeClass('fa-angle-down').addClass('fa-angle-up');
    }else{
      $(".locationsite i").removeClass('fa-angle-up').addClass('fa-angle-down');
    }

  }
  function configfixasst() {
    
    
    
    $('.fixconfigass').toggle();
    if($(".congigfixasset i").hasClass('fa-angle-down')){
      $(".congigfixasset i").removeClass('fa-angle-down').addClass('fa-angle-up');
    }else{
      $(".congigfixasset i").removeClass('fa-angle-up').addClass('fa-angle-down');
    }

  }
  function configdynamicasst() {
    
    
    
    $('.dynamicconfigass').toggle();
    if($(".congigdynamicasset i").hasClass('fa-angle-down')){
      $(".congigdynamicasset i").removeClass('fa-angle-down').addClass('fa-angle-up');
    }else{
      $(".congigdynamicasset i").removeClass('fa-angle-up').addClass('fa-angle-down');
    }

  } 
</script>
<script>
    
</script>

<script>
   $("#quickform").click(function(e){
			e.preventDefault();         
         $("#asset_attribute_dynamic").find(".error").removeClass("error");
         $("#asset_attribute_dynamic").find("span").remove();
         var typecode= $("#dynamic_att_code").val().trim(); 
         if (typecode ==  "") {
			   $("#dynamic_att_code").focus();
            $("#dynamic_att_code").addClass("error");
            $("#dynamic_att_code").after("<span>Required</span>");
			   return false;          
			}

         var dynamicname= $("#dynamic_at_name").val().trim(); 
         if (dynamicname ==  "") {
			   $("#dynamic_at_name").focus();
            $("#dynamic_at_name").addClass("error");
            $("#dynamic_at_name").after("<span>Required</span>");
			   return false;          
			}

         var dynamicdescription= $("#description_dynamic").val().trim(); 
         if (dynamicdescription ==  "") {
			   $("#description_dynamic").focus();
            $("#description_dynamic").addClass("error");
            $("#description_dynamic").after("<span>Required</span>");
			   return false;          
			}

        
         var dynamicdatatype= $("#dynamic_att_data_type").val().trim(); 
         if (dynamicdatatype ==  "") {
			   $("#dynamic_att_data_type").focus();
            $("#dynamic_att_data_type").addClass("error");
            $("#dynamic_att_data_type").after("<span>Required</span>");
			   return false;          
			}

         // var dynamicfixlistval= $("#dynamiclistvl_data_type").val().trim(); 
         // if (dynamicfixlistval ==  "") {
			//    $("#dynamiclistvl_data_type").focus();
         //    $("#dynamiclistvl_data_type").addClass("error");
         //    $("#dynamiclistvl_data_type").after("<span>Required</span>");
			//    return false;          
			// }

         var dynamicassetname= $("#dynamic_asset_type_name").val().trim(); 
         if (dynamicassetname ==  "") {
			   $("#dynamic_asset_type_name").focus();
            $("#dynamic_asset_type_name").addClass("error");
            $("#dynamic_asset_type_name").after("<span>Required</span>");
			   return false;          
			}

         var dynamiflag= $("#dynamic_mandatory_flag").val().trim(); 
         if (dynamiflag ==  "") {
			   $("#dynamic_mandatory_flag").focus();
            $("#dynamic_mandatory_flag").addClass("error");
            $("#dynamic_mandatory_flag").after("<span>Required</span>");
			   return false;          
			}

         // var dynamicdeafultvalue= $("#dynamic_default_val").val().trim(); 
         // if (dynamicdeafultvalue ==  "") {
			//    $("#dynamic_default_val").focus();
         //    $("#dynamic_default_val").addClass("error");
         //    $("#dynamic_default_val").after("<span>Required</span>");
			//    return false;          
			// }

         var dynamicstatus= $("#dynamicstatus").val().trim(); 
         if (dynamicstatus ==  "") {
			   $("#dynamicstatus").focus();
            $("#dynamicstatus").addClass("error");
            $("#dynamicstatus").after("<span>Required</span>");
			   return false;          
			}

			$("#dynamic_attribute").submit();
	});



   $("#saveattfix").click(function(e){
			e.preventDefault();         
         $("#fixedattribute").find(".error").removeClass("error");
         $("#fixedattribute").find("span").remove();
         var fixtypecode= $("#fixedatt_code").val().trim(); 
         if (fixtypecode ==  "") {
			   $("#fixedatt_code").focus();
            $("#fixedatt_code").addClass("error");
            $("#fixedatt_code").after("<span>Required</span>");
			   return false;          
			}

         var fixname= $("#fixedatt_name").val().trim(); 
         if (fixname ==  "") {
			   $("#fixedatt_name").focus();
            $("#fixedatt_name").addClass("error");
            $("#fixedatt_name").after("<span>Required</span>");
			   return false;          
			}

         var fixdescription= $("#description_fixed").val().trim(); 
         if (fixdescription ==  "") {
			   $("#description_fixed").focus();
            $("#description_fixed").addClass("error");
            $("#description_fixed").after("<span>Required</span>");
			   return false;          
			}

        
         var fixdatatype= $("#fixedstatus_data_type").val().trim(); 
         if (fixdatatype ==  "") {
			   $("#fixedstatus_data_type").focus();
            $("#fixedstatus_data_type").addClass("error");
            $("#fixedstatus_data_type").after("<span>Required</span>");
			   return false;          
			}

         var fixlistvaluename= $("#fixedlistvl_data_type").val().trim(); 
         if (fixlistvaluename ==  "") {
			   $("#fixedlistvl_data_type").focus();
            $("#fixedlistvl_data_type").addClass("error");
            $("#fixedlistvl_data_type").after("<span>Required</span>");
			   return false;          
			}

         // var fixassetname= $("#asset_type_name").val().trim(); 
         // if (fixassetname ==  "") {
			//    $("#asset_type_name").focus();
         //    $("#asset_type_name").addClass("error");
         //    $("#asset_type_name").after("<span>Required</span>");
			//    return false;          
			// }

         var fixflag= $("#fixed_mandatory_flag").val().trim(); 
         if (fixflag ==  "") {
			   $("#fixed_mandatory_flag").focus();
            $("#fixed_mandatory_flag").addClass("error");
            $("#fixed_mandatory_flag").after("<span>Required</span>");
			   return false;          
			}

         // var fixeddeafultvalue= $("#fixed_default").val().trim(); 
         // // alert(fixeddeafultvalue);
         // if (fixeddeafultvalue ==  "") {
			//    $("#fixed_default").focus();
         //    $("#fixed_default").addClass("error");
         //    $("#fixed_default").after("<span>Required</span>");
			//    return false;          
			// }

         var fixedstatusvalue= $("#fixedstatus_data_type").val().trim(); 
         if (fixedstatusvalue ==  "") {
			   $("#fixedstatus_data_type").focus();
            $("#fixedstatus_data_type").addClass("error");
            $("#fixedstatus_data_type").after("<span>Required</span>");
			   return false;          
			}

         var fixedstatus= $("#fixedstatus").val().trim(); 
         if (fixedstatus ==  "") {
			   $("#fixedstatus").focus();
            $("#fixedstatus").addClass("error");
            $("#fixedstatus").after("<span>Required</span>");
			   return false;          
			}
			$("#fixed_attribute_validation").submit();

         
	});



   
</script>
{{-- SITE MODAL AND SCRIPT --}}
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
       <form action="{{url('congiguration_add_site')}}" method="POST" id="myform">
         <div class="row">
         <div class="col-md-6">
          
            
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
            <button type="button" class="btn btn-secondary" onclick="saveadd()" id="save_site">Save</button>
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
         <form action="{{url('congiguration_update_site')}}" method="POST" id="myform2">
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
               <button type="button" class="btn btn-secondary" onclick="update_site()" id="updt_site">Update</button>
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
         <form action="{{url('configuration_fixedadd_atr')}}" method="POST" id="myform3">
         <div class="row">
            <div class="col-md-6">
                                       
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
               <button type="button" class="btn btn-secondary" onclick="add_fix_attribute()" id="sitefixat">Save</button>
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
         <form action="{{url('configuration_fixedupdate_atr')}}" method="POST" id="myform4">
         

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
               <button type="button" class="btn btn-secondary" onclick="fixed_atr_updt()" id="updt_fixesite">Update</button>
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
         <form action="{{url('configuration_dynamicadd_atr')}}" method="POST" id="myform5">
         <div class="row">
            <div class="col-md-6">
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
               <button type="button" class="btn btn-secondary" onclick="add_dynamic_attribute()" id="savedyna">Save</button>
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

         <form action="{{url('configuration_dynamicupdate_atr')}}" method="POST" id="myform6">

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
                 
                  <option value="" selected>Select</option>
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
               <button type="button" class="btn btn-secondary" onclick="dynamic_atr_updt()" id="updtdyna">Update</button>
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
   $('#site_id, #site_type, #site_name, #site_address, #site_description, #site_region, #site_latitude, #site_longitude, #site_status').on('input change', checkFormSite);
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

$(document).ready(function() {
  // Add event listeners to form elements
   $('#site_editid, #site_typeedit, #edtsite_name, #edtsite_address, #edtsite_description, #edtsite_region, #edtsite_latitude, #edtsite_longitude, #edtsite_status').on('input change', checkFormSite2);
   });

// Function to check if all fields are filled
function checkFormSite2() {
  var allFieldsFilled = true;
  // Check if all fields have values
  $('#myform2 input[type="text"],#myform2 select').each(function() {
    if ($(this).val().trim() == '') {
      allFieldsFilled = false;
      return false; // Exit the loop if any field is empty
    }
  });
  
  // Change button color based on field values
  if (allFieldsFilled) {

    $('#updt_site').removeClass('btn-secondary').addClass('btn-primary');
  } else {
    $('#updt_site').removeClass('btn-primary').addClass('btn-secondary');
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
  $('#myform3 input[type="text"],#myform3 select').each(function() {
    if ($(this).val().trim() == '') {
      allFieldsFilled = false;
      // alert("asd");
      return false; // Exit the loop if any field is empty
    }
  });
  console.log(allFieldsFilled);
  
  // Change button color based on field values
  if (allFieldsFilled) {
    $('#sitefixat').removeClass('btn-secondary').addClass('btn-primary');
  } else {
    $('#sitefixat').removeClass('btn-primary').addClass('btn-secondary');
  }
}

// Site fixed edit attribute

$(document).ready(function() {
  // Add event listeners to form elements
   $('#editatr_id, #editatr_attribute, #editatr_description, #editatr_datatype, #editatr_fixed_list_of_values, #editatr_mandatory_flag, #editatr_default_value, #editatr_display, #editatr_editable, #editatr_status').on('input change',checkFormSitefixedit);
   });

// Function to check if all fields are filled
function checkFormSitefixedit() {
  var allFieldsFilled = true;
  // Check if all fields have values
  $('#myform4 input[type="text"],#myform4 select').each(function() {
    if ($(this).val().trim() == '') {
      allFieldsFilled = false;
      // alert("asd");
      return false; // Exit the loop if any field is empty
    }
  });
//   console.log(allFieldsFilled);
  // Change button color based on field values
  if (allFieldsFilled) {
    $('#updt_fixesite').removeClass('btn-secondary').addClass('btn-primary');
  } else {
    $('#updt_fixesite').removeClass('btn-primary').addClass('btn-secondary');
  }
}

// Site dynamic add attribute color code

$(document).ready(function() {
  // Add event listeners to form elements
   $('#dynamicatr_sitetype, #dynamicatr_default_value, #dynamicatr_attribute, #dynamicatr_display, #dynamicatr_description, #dynamicatr_editable, #dynamicatr_datatype, #dynamicatr_status, #dynamicatr_fixedlist').on('input change',checkFormSitedynamicadd);
   });

// Function to check if all fields are filled
function checkFormSitedynamicadd() {
  var allFieldsFilled = true;
  // Check if all fields have values
  $('#myform5 input[type="text"],#myform5 select').each(function() {
    if ($(this).val().trim() == '') {
      allFieldsFilled = false;
      // alert("asd");
      return false; // Exit the loop if any field is empty
    }
  });

  console.log(allFieldsFilled);
  
  // Change button color based on field values
  if (allFieldsFilled) {
    $('#savedyna').removeClass('btn-secondary').addClass('btn-primary');
  } else {
    $('#savedyna').removeClass('btn-primary').addClass('btn-secondary');
  }
}

// Site dynamic edit color code

$(document).ready(function() {
  // Add event listeners to form elements
   $('#dynamiceditatr_id, #dynamiceditatr_sitetype, #dynamiceditatr_attribute, #dynamiceditatr_description, #dynamiceditatr_datatype, #dynamiceditatr_fixedlist, #dynamiceditatr_default_value, #dynamiceditatr_display, #dynamiceditatr_editable, #dynamiceditatr_status').on('input change',checkFormSitedynamicedit);
   });

// Function to check if all fields are filled
function checkFormSitedynamicedit() {
  var allFieldsFilled = true;
  // Check if all fields have values
  $('#myform6 input[type="text"],#myform6 select').each(function() {
    if ($(this).val().trim() == '') {
      allFieldsFilled = false;
      // alert("asd");
      return false; // Exit the loop if any field is empty
    }
  });
  
  // Change button color based on field values
  if (allFieldsFilled) {
    $('#updtdyna').removeClass('btn-secondary').addClass('btn-primary');
  } else {
    $('#updtdyna').removeClass('btn-primary').addClass('btn-secondary');
  }
}







</script>









<script>

// $(document).ready(function() {
//   // Add event listeners to form elements
//   $('#site_id, #site_type, #site_name, #site_address, #site_description, #site_region, #site_latitude, #site_longitude, #site_status').on('input change', checkFormSite);
// });

// // Function to check if all fields are filled
// function checkFormSite() {
//   var allFieldsFilled = true;
//   // Check if all fields have values
//   $('#site_add input[type="text"], #site_add select').each(function() {
//     if ($(this).val().trim() === '') {
//       allFieldsFilled = false;
//       return false; // Exit the loop if any field is empty
//     }
//   });
  
//   // Change button color based on field values
//   if (allFieldsFilled) {
//     $('#quickform').removeClass('btn-secondary').addClass('btn-primary');
//   } else {
//     $('#quickform').removeClass('btn-primary').addClass('btn-secondary');
//   }
// }










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
   //alert("mm");
      if ($("#site_type").val() === '') {
          event.preventDefault(); 
        }
        $('#site_add').on('hidden.bs.modal', function () {
        $('#site_add form')[0].reset();
       });
         $("#site_add").find(".error").removeClass("error");
         $("#site_add").find("span").remove();
         var locationcode=$("#site_id").val().trim();
         //alert(locationcode);
         var sitetype=$("#site_type").val().trim();
         //alert(sitetype);
         var sitename = $("#site_name").val().trim();
         //alert(sitename);
         var siteaddress = $("#site_address").val().trim();
         //alert(siteaddress);
         var sitedescription = $("#site_description").val().trim();
         //alert(sitedescription);
         var sitestatus=$("#site_status").val().trim();
         //alert(sitestatus);
         var siteregion=$("#site_region").val().trim();
         //alert(siteregion);
         var sitelatitude=$("#site_latitude").val().trim();
         //alert(sitelatitude);
         var sitelongitude=$("#site_longitude").val().trim();
         //alert(sitelongitude);
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
 //duplicate site
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

  if($('#updt_site').hasClass("btn-primary")){
   $('#updt_site').removeClass("btn-primary")
   $('#updt_site').addClass("btn-secondary")
}


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
if($('#updt_fixesite').hasClass("btn-primary")){
   $('#updt_fixesite').removeClass("btn-primary")
   $('#updt_fixesite').addClass("btn-secondary")
}
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
   var atrfixeddatatype= $("#atr_edit #editatr_datatype").val();
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
//       $("#editatr_default_value").focus();
//       $("#editatr_default_value").addClass("error");
//       $("#editatr_default_value").after("<span>Required</span>");
//       return false;          
//    }  
   // if (atrfixeddisplay ==  "") {
   //    $("#editatr_display").focus();
   //    $("#editatr_display").addClass("error");
   //    $("#editatr_display").after("<span>Required</span>");
   //    return false;          
   // }  
   // if (atrfixededitable ==  "") {
   //    $("#editatr_editable").focus();
   //    $("#editatr_editable").addClass("error");
   //    $("#editatr_editable").after("<span>Required</span>");
   //    return false;          
   // } 
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
if($('#updtdyna').hasClass("btn-primary")){
   $('#updtdyna').removeClass("btn-primary")
   $('#updtdyna').addClass("btn-secondary")
}
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
$('#myform3')[0].reset();

$("#atr_add").find(".error").removeClass("error");
$("#atr_add").find("span").remove();  
}

function adddynaatr(){
$('#myform5')[0].reset();

$("#atr_dynamic").find(".error").removeClass("error");
$("#atr_dynamic").find("span").remove();   
}



   function siteasstdropdown() {
    
      $('.siteactive').toggle();
    if($(".siteassetdrp i").hasClass('fa-angle-down')){
      $(".siteassetdrp i").removeClass('fa-angle-down').addClass('fa-angle-up');
    }else{
      $(".siteassetdrp i").removeClass('fa-angle-up').addClass('fa-angle-down');
    }

  }
  function sitefixeddrpdwn() {
    
    $('.siteactivefixed').toggle();
  if($(".sitefixtable i").hasClass('fa-angle-down')){
    $(".sitefixtable i").removeClass('fa-angle-down').addClass('fa-angle-up');
  }else{
    $(".sitefixtable i").removeClass('fa-angle-up').addClass('fa-angle-down');
  }

}

// function sitedynamicdrpdwn() {
    
//     $('.siteactivedynamic').toggle();
//   if($(".sitedynamictable i").hasClass('fa-angle-down')){
//     $(".sitedynamictable i").removeClass('fa-angle-down').addClass('fa-angle-up');
//   }else{
//     $(".sitedynamictable i").removeClass('fa-angle-up').addClass('fa-angle-down');
//   }

// }


 </script>




@endsection