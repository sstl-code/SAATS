@extends('Layout.mainlayout')
@section('content')
{{-- location view card header --}}
<div class="card col-12" style="border-radius: unset;">
   <div class="card-header">
     <h4>  Asset View </h4>
   </div>
</div>
<!-- Asset List -->
<div class="row mx-2">
   <div class="col-sm-4 my-2 ">
      <div class="card">
         <div class="card-header" style="background-color: #DEEBF6;">
            Asset List
         </div>
         
         <div class="card-header" >
            <input type = "checkbox" style="background-color: white">Apply Filter Map
            <button onclick="showImage()" class="viewmapbutton" align="right" style="width:103px; position: relative; left: 6px; margin-left: 15px">View Map</button>
            {{-- <div id="first" style="height:400px; width:400px; display:none;">
               
              </div> --}}
              {{-- <div id="closebtn" style="height:400px; width:400px; display:block;">
            
              </div> --}}
           
            <div class="row my-4">
                   <input class="mx-2"type="text" style="width:100px" placeholder>
                   <button class="btn btn-secondary btn-sm dropdown-toggle" style="width: 60px;color: black;background-color: white;"type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Unit</button>
                   <button class="viewmapbutton applybutton mx-3" align="right" style="width: 87px;">Apply</button>
                   <button onclick="closeImage()" id="closebtn" class="viewmapbutton" align="right" style="width:103px;position: relative; left: 6px ; display:none;">Close Map</button>
               
               <!-- <div class="col-3">
                   <input class="mx-2"type="text" style="width:100px" placeholder>
                   <button class="btn btn-secondary btn-sm dropdown-toggle" style="width: 60px;color: black;background-color: white;"type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Unit</button>
               </div>
               <button class="viewmapbutton applybutton mx-3" align="right">Apply</button>
               <button class="viewmapbutton closemapbutton"  align="right">Close Map</button> -->
            </div>
           </div> 
         
        
      </div>
      
      
       {{-- <div id="first" style="display:none" class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=University of Oxford&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://capcuttemplate.org/">Capcut Template</a></div><style>.mapouter{position:relative;text-align:right;width:200px;height:200px;}.gmap_canvas {overflow:hidden;background:none!important;width:200px;height:200px;}.gmap_iframe {width:400px!important;height:600px!important;}</style>
      </div> --}}
      <div id="first" class="mapouter">
         <div class="gmap_canvas">
            <iframe width="411" height="494" id="gmap_canvas" src="https://maps.google.com/maps?q=saltlake&t=&z=10&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
            </iframe><a href="https://2yu.co">2yu</a><br>
            <style>.mapouter{position:relative;text-align:right;height:494px;width:411px; display: none} </style>
            <a href="https://embedgooglemap.2yu.co">html embed google map</a>
            <style>.gmap_canvas {overflow:hidden;background:none!important;height:494px;width:411px; display: block}</style>
         </div>
      </div>
      <table id="topclass" class="table table-bordered my-2" border="1" >
         
            
           
         <thead>
            <tr class="tableheadcolor">
               {{-- 
               <th class="tableheadborder" scope="col"></th>
               --}}
               <th class="tableheadborder" scope="col">Asset Name</th>
               <th class="tableheadborder" scope="co">Asset Tag No</th>
               <th class="tableheadborder" scope="col">Status</th>
               <th class="tableheadborder" scope="col"></th>
            </tr>
         </thead>
         <tbody>
                  @foreach($assets_data as $asset)
                        
                  <tr class="tablehover">
                     

                     <td style="cursor:pointer" onclick="getdetails(this);" data-id='{{ $asset->ta_asset_id}}'>{{ $asset->ta_asset_name}}</td>
                     <td>{{ $asset->ta_asset_tag_number}}</td>
                     <td>{{ $asset->ta_asset_status}}</td>
                     
                     @if($asset->tag_status == 'Y')
                        @php
                              $html = "<span class='dotGreen'></span>";
                        @endphp
                     
                     @else
                        @php
                              $html = "<span class='dotRed'></span>";
                        @endphp
                     
                     @endif
                     <td>{!!$html!!}</td> 
                  </tr>
                  @endforeach
         </tbody>
      </table>
      
   </div>
   {{-- asset nav-tab card --}}
   <div class="col-sm-8 my-2">
      <div class="card">
         <div class="card-header" id="pannel" style="background-color: #E5FCFF;">
            
         </div>
         <!-- nav bar start -->
         <div class="card-body" style="background-color:#EBEFF2; padding:0px;">
            <nav>
               <div class="nav nav-underline" id="nav-tab" role="tablist">
                  <button class="nav-link active navtabbutton mx-2" id="nav-home-tab" data-bs-toggle="tab"
                     data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                     aria-selected="true">
                  Details
                  </button>
                  <button class="nav-link navtabbutton" id="nav-profile-tab" data-bs-toggle="tab"
                     data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                     aria-selected="false">
                  Attributes
                  </button>
                  <button class="nav-link navtabbutton" id="nav-child-tab" data-bs-toggle="tab"
                     data-bs-target="#nav-child" type="button" role="tab" aria-controls="nav-child"
                     aria-selected="false">
                  Child Assets
                  </button>
                  <button class="nav-link navtabbutton" id="nav-location-tab" data-bs-toggle="tab"
                     data-bs-target="#nav-location" type="button" role="tab" aria-controls="nav-location"
                     aria-selected="false">
                  Site
                  </button>
                  <button class="nav-link navtabbutton" id="nav-History-tab" data-bs-toggle="tab"
                     data-bs-target="#nav-history" type="button" role="tab" aria-controls="nav-location"
                     aria-selected="false">
                  History
                  </button>
               </div>
            </nav>
         </div>
      </div>
      <div class="card" style="border:none">
         <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
               <div class="card">
                  <div class="row mt-3 p-3">
                     <div class="col">
                        <div class="col-6 col-sm-4">Serial No</div>
                                    <p><b id='serial_number'></b></p>
                                    <br />
                                    <div class="col-6 col-sm-4">Asset Name</div>
                                    <p><b id='asset_name'></b></p>
                                    <br />
                                    <div class="col-6 col-sm-4">Status</div>
                                    <p><b id='status'></b></p>
                                    <br />
                                    <div class="col-6 col-sm-4">Description</div>
                                    <p><b id='describtion'></b></p>
                                </div>
                                <div class="col">
                                    <div class="col-6 col-sm-4">Asset Tag No</div>
                                    <p><b id='asset_tag'></b></p>
                                    <br />
                                    <div class="col-6 col-sm-4">Parent Asset Name</div>
                                    <p><b id='p_asset_name'></b></p>
                                    <br />
                                    <div class="col-6 col-sm-4">Asset Type</div>
                                    <p><b id='asset_type'></b></p>
                                    <br>
                                    <div class="col-6 col-sm-4">Location Code</div>
                                    <p><b id='loc_code'></b></p>
                                </div>
                  </div>
               </div>
            </div>
            {{-- asset attributes table --}}
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
               <div class="card">
                  <div class="row mt-2 p-3">
                     <div class="col" id="owner_attr_value">
                        {{-- @foreach() --}}
                        {{-- <div class="col-6 col-sm-6 text-muted" id="owner_att"></div> --}}
                                    {{-- <p><b id='Owner_Company'></b></p> --}}
                                    {{-- <br>
                                    <div class="col-6 col-sm-6  text-muted">Make</div>
                                    <p><b id='Make'></b></p>
                                    <br>
                                    <div class="col-6 col-sm-6 text-muted">Model</div>
                                    <p><b id='Model'></b></p>
                                    <br> --}}
                                </div>
                                {{-- @endforeach --}}
                                {{-- <div class="col">
                                    <div class="col-6 col-sm-6 text-muted">Capacity Per Panel</div>
                                    <p><b id='Capacity_Per_Panel'></b></p>
                                    <br>
                                    <div class="col-6 col-sm-6 text-muted"> Capacity</div>
                                    <p><b id='S_Capacity'></b></p>
                                    <br>
                                </div> --}}
                  </div>
               </div>
            </div>
            {{-- asset child asset table --}}
            <div class="tab-pane fade" id="nav-child" role="tabpanel" aria-labelledby="nav-profile-tab">
               <!-- <div class="card">
                  <div class="card-body"> -->
               <div class="" style="margin-top: 4px">
                  <table class="table table-bordered" border="1">
                     <thead>
                        <tr>
                           <th scope="col">Asset Name</th>
                           <th scope="col">Serial No</th>
                           <th scope="col">Parent Asset Name</th>
                           <th scope="col">Status</th>
                           <th scope="col"></th>
                           <th scope="col"></th>
                        </tr>
                     </thead>
                     <tbody id="table_Data_child">
                        {{-- <tr>
                           <td scope="row">Solar child1</td>
                           <td>123-546/1</td>
                           <td>Solar child1</td>
                           <td>Active</td>
                           <td><span class="dotRed"></span></td>
                           <td><button type="button" class="btn btn-sm viewmapbutton" style="background-color: aqua;color:white">View Details</button>
                           </td>
                        </tr>
                        <tr>
                           <td scope="row">Solar child2</td>
                           <td>123-546/1</td>
                           <td>Solar child1</td>
                           <td>Active</td>
                           <td><span class="dotRed"></span></td>
                           <td><button type="button" class="btn btn-sm viewmapbutton">View Details</button>
                           </td>
                        </tr>
                    
                     </tbody>
                  </table>
               </div>
            </div>
            {{-- asset location table --}}
            <div class="tab-pane fade" id="nav-location" role="tabpanel" aria-labelledby="nav-profile-tab">
               <div class="card">
                  <div class="row g-3 mt-3 p-3">
                     <div class="col">
                        <div class="col-6 col-sm-6 text-muted">Location Code</div>
                                    <p><b id='location_code'></b></p>
                                    <br>
                                    <div class="col-6 col-sm-6  text-muted">Address</div>
                                    <p><b id='location_address'></b></p>
                                    <br>
                                    <div class="col-6 col-sm-6 text-muted">Status</div>
                                    <p><b id='location_status'></b></p>
                                    <br>
                                </div>
                                <div class="col">
                                    <div class="col-6 col-sm-6 text-muted">Location Type</div>
                                    <p><b id='location_type'></b></p>
                                    <br>
                                    <div class="col-6 col-sm-6 text-muted">Region</div>
                                    <p><b id='location_region'></b></p>
                                    <br>
                                </div>
                  </div>
               </div>
            </div>
            {{-- asset history --}}
            <div class="tab-pane fade" id="nav-history" role="tabpanel" aria-labelledby="nav-profile-tab">
               <!-- <div class="card">
                  <div class="card-body"> -->
               <div class="" style="margin-top: 4px">
                  <table class="table table-bordered" border="1">
                     <thead>
                        <tr>
                           <th scope="col">ID</th>
                           <th scope="col">From Site ID</th>
                           <th scope="col">From Site Name</th>
                           <th scope="col">Asset Name</th>
                           <th scope="col">To Site ID</th>
                           <th scope="col">To Site Name</th>
                           <th scope="col">MOD By</th>
                           <th scope="col">MOD ON</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td scope="row">103</td>
                           <td>LS-SALTLAKE/3</td>
                           <td>Salt Lake Sector III</td>
                           <td>Solar Panel 1</td>
                           <td>LS-SALTLAKE/2</td>
                           <td>Salt Lake Sector V</td>
                           <td>Sachin Kumar</td>
                           <td><span>22/05/2022</span>&nbsp;&nbsp;<span>10:35:50 AM</span></td>
                        </tr>
                        <tr>
                           <td scope="row">102</td>
                           <td>LS-SALTLAKE/6</td>
                           <td>Salt Lake Sector VI</td>
                           <td>Solar Panel 1</td>
                           <td>LS-SALTLAKE/3</td>
                           <td>Salt Lake Sector III</td>
                           <td>Sachin Kumar</td>
                           <td><span>22/05/2022</span>&nbsp;&nbsp;<span>11:25:50 AM</span></td>
                        </tr>
                        <tr>
                           <td scope="row">101</td>
                           <td>LS-SALTLAKE/2</td>
                           <td>Salt Lake Sector III</td>
                           <td>Solar Panel 1</td>
                           <td>LS-SALTLAKE/6</td>
                           <td>Salt Lake Sector VI</td>
                           <td>Sachin Kumar</td>
                           <td><span>22/05/2022</span>&nbsp;&nbsp;<span>12:35:50 AM</span></td>
                        </tr>
                        <tr>
                           <td scope="row">100</td>
                           <td>LS-SALTLAKE/5</td>
                           <td>Park Street 2</td>
                           <td>Solar Panel 1</td>
                           <td>LS-SALTLAKE/3</td>
                           <td>Salt Lake Sector VI</td>
                           <td>Sachin Kumar</td>
                           <td><span>22/05/2022</span>&nbsp;&nbsp;<span>01:35:50 AM</span></td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<script>
   const showImage = () => {
    
    document.getElementById("first").style.display ='block';
    document.getElementById("closebtn").style.display ='block';
    document.getElementById("topclass").style.display ='none';
}
const closeImage = () => {
   
   document.getElementById("first").style.display ='none';
  document.getElementById("closebtn").style.display ='none';
  document.getElementById("topclass").style.display ='block';
    }
</script>
<!--Asset table-->
<!-- <div class="row mx-2">
   <div class="col-sm-4 my-2 padding-right assetTableSide">
       
   </div>
   {{-- asset detail table --}}
   {{-- my-3 --}}
   <div class="col-sm-8">
       
   </div>
   </div> -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function getdetails(e){
          //  alert($(e).data("id") );
            $.ajax({
                type: "GET",       
               // url: 'http://3.111.113.246/umprojnew/public/index.php/Test',
                url: "{{url('asset_json_data')}}",
                data:{
                    'asset_id' : $(e).data("id"),
                },
                beforeSend: function(){
                  $('#loader').removeClass('hidden');
                    $("#loading").show();
                },
                complete: function(){
                    $("#loading").hide();
                },
                success: function(result) { 
                   // console.log(result.data);
                   $('#loader').addClass('hidden');
                    if(result.status == 'success'){ 
                        if(result.data.ta_asset_manufacture_serial_no != ''){ 
                            $('#serial_number').html(result.data.ta_asset_manufacture_serial_no)
                        }
                        
                    }if(result.status == 'success'){ 
                        if(result.data.ta_asset_name != ''){ 
                            $('#asset_name').html(result.data.ta_asset_name)
                        }
                        
                    }

                    if(result.status == 'success'){ 
                        if(result.data.tag_status != ''){ 
                          
                            if(result.data.tag_status=='y'){
                                var status = 'Active';
                            }else{
                                var status = 'Inactive';
                            }
                            $('#status').html(status)
                        }
                        
                    }
                    if(result.status == 'success'){ 
                        if(result.data.ta_asset_description != ''){ 
                            $('#describtion').html(result.data.ta_asset_description)
                        }
                        
                    }
                    if(result.status == 'success'){ 
                        if(result.data.ta_asset_tag_number != ''){ 
                            $('#asset_tag').html(result.data.ta_asset_tag_number)
                        }
                        
                    }
                    if(result.status == 'success'){ 
                        if(result.data.parent_asset_name != ''){ 
                            $('#p_asset_name').html(result.data.parent_asset_name)
                        }
                        
                    }
                    if(result.status == 'success'){ 
                        if(result.data.at_asset_type_name != ''){ 
                            $('#asset_type').html(result.data.at_asset_type_name)
                        }
                        
                    }
                    if(result.status == 'success'){ 
                        if(result.data.tl_location_code != ''){ 
                            $('#loc_code').html(result.data.tl_location_code)
                        }
                        
                    }
                    if(result.status == 'success'){ 
                        if(result.data.ta_asset_name != ''){ 
                            $('#pannel').html(result.data.ta_asset_name)
                        }
                        
                    }
                    if(result.status == 'success'){ 
                        if(result.data.tl_location_code != ''){ 
                            $('#location_code').html(result.data.tl_location_code)
                        }
                        
                    }
                    if(result.status == 'success'){ 
                        if(result.data.tl_location_address != ''){ 
                            $('#location_address').html(result.data.tl_location_address)
                        }
                        
                    }
                    if(result.status == 'success'){ 
                        if(result.data.tl_location_status != ''){ 
                            $('#location_status').html(result.data.tl_location_status)
                        }
                        
                    }
                    if(result.status == 'success'){ 
                        if(result.data.tl_location_type != ''){ 
                            $('#location_type').html(result.data.tl_location_type)
                        }
                        
                    }
                    if(result.status == 'success'){ 
                        if(result.data.tl_location_region != ''){ 
                            $('#location_region').html(result.data.tl_location_region)
                        }
                        
                    }

                  //   if(result.status == 'success'){ 
                  //       if(result.data.at_asset_attribute_description != ''){ 
                  //           $('#owner_att').html(result.data.at_asset_attribute_description)
                  //       }
                  //   }

                  //   if(result.status == 'success'){ 
                  //       if(result.data.at_asset_attribute_value_text != ''){ 
                  //           $('#Owner_Company').html(result.data.at_asset_attribute_value_text)
                  //       }
                        
                  //   }
                    
                        
                    // }
                    // if(result.status == 'success'){ 
                    //     if(result.data.tl_location_region != ''){ 
                    //         $('#Model').html(result.data.tl_location_region)
                    //     }
                        
                    // }
                    // if(result.status == 'success'){ 
                    //     if(result.data.tl_location_region != ''){ 
                    //         $('#Capacity_Per_Panel').html(result.data.tl_location_region)
                    //     }
                        
                    // }
                    // if(result.status == 'success'){ 
                    //     if(result.data.tl_location_region != ''){ 
                    //         $('#S_Capacity').html(result.data.tl_location_region)
                    //     }
                        
                    // }
                    
                    console.log(result.child_asset);
                    $("#table_Data_child").empty();
                    $.each(result.child_asset, function (key, val) {
                       // console.log(key + val['ta_asset_id']);
                        $('#table_Data_child').append('<tr class="tablehover"> <td>'+val['ta_asset_name']+'</td><td>'+val['ta_asset_manufacture_serial_no']+'</td><td>'+val['parent_asset_name']+'</td><td>'+val['ta_asset_status']+'</td><td>'+val['tag_status']+'</td><td><div class="container"><button type="button" class="btn btn-sm" style="background-color: #202C55;color: white;">Click Me</button></div></td></tr>');
                        // $.each(currProgram, function (key, val) {
                        //     alert(key + val);
                        // });
                    });

                    console.log(result.at_asset_attribute_description);
                     $("#owner_attr_value").empty();
                     $.each(result.at_asset_attribute_description, function (key, val) {
                       // console.log(key + val['ta_asset_id']);
                        $('#owner_attr_value').append('<div class="col-6 col-sm-6 text-muted">'+val['at_asset_attribute_description']+'</div><p><b>'+val['at_asset_attribute_value_text']+'</b></p>');
                        //$('#owner_attr_value').append('<tr class="tablehover"> <td>'+val['ta_asset_name']+'</td><td>'+val['ta_asset_manufacture_serial_no']+'</td><td>'+val['parent_asset_name']+'</td><td>'+val['ta_asset_status']+'</td><td>'+val['tag_status']+'</td><td><div class="container"><button type="button" class="btn btn-sm" style="background-color: #202C55;color: white;">Click Me</button></div></td></tr>');
                        // $.each(currProgram, function (key, val) {
                        //     alert(key + val);
                        // });
                    });

                    

                }
            });

        }
        
       
    </script>
@endsection