@extends('Layout.mainlayout')
@section('content')
<style>
    .text-muted div label{
        cursor: default !important;
    }
</style>
    {{-- Asset history view card header --}}
    <div class="card col-12" style="border-radius: unset;">
        <div class="card-header">
          <h4>  Asset History </h4>
        </div>
    </div>
     
    {{--Asset search-box--}}
  <div class="row mx-2" >
    <div class="card col-12 my-1 " style="border-radius: unset;background-color:#DEEB">
        <p class="assetserial my-1" style="">Enter Asset Serial No.</p>
        <div class="row " style="margin: inherit;">
            <div class="col-md-4 mt-2 ">
                <input type="text" id="test_history" class="Search search_box my-1" placeholder="Serial No:">  
                <button class="assetsearchbtn my-1" align="right" id="btn1" onclick="getdetails();">Search</button>
                <p id="data_not_found"></p>
                
            </div>
            <div class="col-md-8 alert alert-warning" id="no_data_found" style="display:none" role="alert">
                No data found!
            </div>
            
        </div>
    </div>
</div>

    {{--Details Part--}}
     <div class="card col-12 asset_details" style="border-radius: unset;">
        <div class="card" style="border:none">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
                    <div class="card ">
                        <!--<div class="card-body"> -->
                        <div class="row mt-3 p-2" id="test_id" style="display:none;">

                        </div>
                </div>
            </div>

{{--TABLE PART--}}

<div class="row mx-2 my-1 assethistory">
        <table class="table table-bordered mt-2">
            <thead><tr class="tableheadcolor">
                    <th class="tableheadborder" scope="col">Site ID </th>
                    <th class="tableheadborder" scope="col">Site Name</th>
                    <th class="tableheadborder" scope="col">Move In Date</th>
                    <th class="tableheadborder" scope="col">Move Out Date</th>
                    <th class="tableheadborder" scope="col">Deployment Date </th>
                    <th class="tableheadborder" scope="col">Usage</th>
                    <th class="tableheadborder" scope="col">Last PM Date</th>
                    <th class="tableheadborder" scope="col">Next PM Date</th>
                </tr>
            </thead>

            <tbody id="table_Data">
                
                    

        </tbody>
        </table>

        {{-- Modal Asset Details --}}
  <div class="modal fade" id="siteassetdetailsmodal" tabindex="-1" role="dialog" aria-labelledby="SiteAssetHistoryModal" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 50%;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="SiteAssetHistoryModal"></h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
            &times;
          </button>
        </div>
        <div class="modal-body">
          <table id="tablet" class="table table-bordered" style="font-size: smaller;">
            <tbody id="Site_single_asset_table">
              </tbody>
         </table>
        </div>
        <div class="modal-footer">
          
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
  const monthnumber = ["Jan","Feb","Mar","Apr","May","June","Jul","Aug","Sep","Oct","Nov","Dec"];
            

            var input = document.getElementById("test_history");
                            input.addEventListener("keypress", function(event) {
                    if (event.key === "Enter") {
                        event.preventDefault();
                        document.getElementById("btn1").click();
                    }
                    });

function getdetails(){
        //    alert('hi');
        var search_text=$("#test_history").val();
        //alert(search_text);
            $.ajax({
                type: "GET",       
               // url: 'http://3.111.113.246/umprojnew/public/index.php/Test',
                url: "{{url('Asset_History_Jason')}}",
                data:{
                    'search' : search_text,
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
                        //console.log(result.data['ta_asset_id']);
                        $("#no_data_found").css("display", "none")
                        var asset_data = [];
                        asset_data['Asset Type']=result.data['AssetType'];
                        if(result.data['ParentAssetName']!=" "){
                        asset_data['Parent Asset Name']=result.data['ParentAssetName'];
                        }else{
                            asset_data['Parent Asset Name']="NA";
                        }

                        asset_data['TAG no']=result.data['ta_asset_tag_number'];
                        
                        asset_data['Creation Date']=result.data['ta_creation_date'];

                        asset_data['Asset Name']=result.data['ta_asset_name'];

                        

                        
                        
                        //console.log(asset_data);
                        //console.log(result.data);
                        $('#test_id').empty();
                        $('#table_Data').empty();
                        Object.entries(asset_data).forEach(([key, value]) => {
                            
                            //console.log(key, value)
                            
                            if(value != null && (key != "childs" && key != "locationtype")){
                                $('#test_id').append('<div class="col-6 col-sm-6 text-muted" style="display: inline-grid;"><div><label>'+key+" : <b>"+value+ '</b></label></div>');
                            }

                           

                     
                        });
                        $.each(result.data.TypeAttr, function (key3, val3) {
                                //console.log(val3['at_asset_attribute_name']+"   -->"+val3['at_asset_attribute_value_text']);
                                $('#test_id').append('<div class="col-6 col-sm-6 text-muted" style="display: inline-grid;"><div><label>'+val3['at_asset_attribute_name']+" : <b>"+val3['at_asset_attribute_value_text']+ ' </b></label></div>');


                            });   
                            
                            $.each(result.data.locationtype, function (key4,val4) {
                                
                                //console.log(val4['tl_location_id']);
                                

                                

                                if(val4 != null &&  (key4 != "childs" && key4 != "location") ){
                                   var append=0;
                                   var location_code=0;
                                   var location_name=0;
                                    switch(key4){
                                      case "tl_location_code":
                                        key4="Site Code";
                                        append=1;
                                        location_code=1;
                                       if(!result.data['is_shown'])
                                       {
                                        val4="";
                                       }
                                        break;
                                        case "tl_location_type":
                                        key4="Site Type";
                                        append=1;
                                        if(!result.data['is_shown'])
                                       {
                                        val4="";
                                       }
                                        break;
                                        case "tl_location_name":
                                        key4="Site Name";
                                        append=1;
                                        location_code=2;
                                        if(!result.data['is_shown'])
                                       {
                                        val4="";
                                       }
                                        break;
                                    }
                                    //console.log(key4);
                                   
                                    if(append!=0){
                                    $('#test_id').append('<div class="col-6 col-sm-6 text-muted" style="display: inline-grid;"><div><label>'+key4+' : <b>'+val4+ '</b></label></div>');
                                   
                                    }
                                }
                               
                            }); 
                            var countmoveIn=1;
                            $.each(result.data.asset_history, function (key5, val5) {
                              
                                //console.log(result.data.asset_history);
                                //console.log(val5['sitedetails'])
                               
                                //
                                if(val5['status']==1 && countmoveIn==1){

                                     $('#test_id').append('<div class="col-6 col-sm-6 text-muted" style="display: inline-grid;"><div><label>Move In Date : <b>'+val5['movein_date']+ '</b></label></div>');
                                 countmoveIn++;
                                }
                                

                                
                                if(val5['moveout_date']==null){
                                    
                                    var newDate1 =" ";
                                }
                                else{
                                   
                                    var newDate1 = val5['moveout_date'];
                                }
                                if(val5['movein_date']==null){
                                    
                                    var tagged_date =" ";
                                }
                                else{
                                   
                                    var tagged_date = val5['movein_date'];
                                }
                                
                                $asset_id=result.data['ta_asset_id'];
                                $location_id=val5['sitedetails'][0]['tl_location_id'];
                                

                                $('#table_Data').append('<tr><td><a  href="#" onclick="asset_details('+$asset_id+','+$location_id+');">'+val5['sitedetails'][0]['tl_location_code']+'</a></td><td>'+val5['sitedetails'][0]['tl_location_name']+'</td><td>'+tagged_date+'</td><td>'+newDate1+'</td></tr>'); 
                                
                        }); 
                          
                   
                    }
                    else{
                       
                        $("table tbody").html('');
                        $("#no_data_found").css("display", "block");
                        $('#table_Data').empty();
                        $('#test_id').empty();

                    }

                    
                             }
           })
        }
        function asset_details(asset_id,location_id){
            $.ajax({
                type: "GET",       
             
                url: "{{url('site_assets')}}",
                data:{
                    'location_id' : location_id,
                    'asset_id':asset_id,
                },
                success: function(result) {
                    //console.log(result);
                
                if(result.status == 'success'){
                //     alert("vhhg");
                //     console.log(result.Site_Asset_Data[0]['asset_data']);
                // }
                //   $('#asset_history').empty();
                  $('#Site_single_asset_table').empty();
                  var fixedattr="";
                  var dynamiattr="";
                  var tag_number="";
                  var image="";
                  var parent_asst_name="";
                  var asset_tag_history="<table class='table table-striped' width='100%'><thead><tr><td style='text-align:left'>Tagged On</td><td scope='col'>Tag Number</td><td scope='col'>Tagged By</td></tr></thead><tbody>";
                  var site_assets=JSON.parse(result.Site_Asset_Data[0]['asset_data']);
                    if(site_assets!=""){
                        //alert("fhgvhv");
                       
                         console.log(site_assets);
                         //console.log(site_assets.ta_asset_name);
                         if(site_assets.Parent_asset_name!=null){
                             parent_asst_name=site_assets.Parent_asset_name;
                            
                        }
                        else{
                            parent_asst_name="NA";
                        }
                        if(site_assets.ta_asset_tag_number!=null){
                          tag_number=site_assets.ta_asset_tag_number;
                        }
                        else{
                          tag_number="";
                        }
                        if(site_assets.ta_asset_image!=null){
                           image=site_assets.ta_asset_image;
                        }
                        else{
                          image="";
                        }
                        $("#SiteAssetHistoryModal").html(site_assets.Asset_Type+'-'+site_assets.ta_asset_name);
                        //if(site_assets.ta_asset_image!=null){
                            $('#Site_single_asset_table').append('<tr><td>Site Name</td><td>'+site_assets.Site_Name+'</td></tr><tr><td>Site Code</td><td>'+site_assets.Site_Code+'</td></tr><tr><td>Parent Asset Name</td><td>'+parent_asst_name+'</td></tr><tr><td>Asset Name</td><td>'+site_assets.ta_asset_name+'</td></tr><tr><td>Serial Number</td><td>'+site_assets.ta_asset_manufacture_serial_no+'</td></tr><tr><td>Tag Number</td><td>'+tag_number+'</td></tr><tr><td>Asset Image</td><td><img style="width: 100px;" src="'+image+'"></td></tr>');
                        //}
                        //else{
                          //$('#Site_single_asset_table').append('<tr><td>'+site_assets.Site_Name+'</td></tr><tr><td>Tag Number</td><td>'+site_assets.Site_Code+'</td></tr><tr><td>Parent Asset Name</td><td>'+parent_asst_name+'</td></tr><tr><td>Asset Name</td><td>'+site_assets.ta_asset_name+'</td></tr><tr><td>Serial Number</td><td>'+site_assets.ta_asset_manufacture_serial_no+'</td></tr>');    

                        //}
                       
                           
                         if(site_assets['attr']){
                            //console.log(site_assets['attr']);
                            Object.entries(site_assets['attr']).forEach(([key1,value1]) => {
                             //console.log(value1['at_asset_attribute_value_text']); 
                              if(value1['at_asset_attribute_value_text']=='' || value1['at_asset_attribute_value_text']==null)
                              {
                                value1['at_asset_attribute_value_text']="";
                              }
                             
                              if(value1['attr_catagory']==0){
                              
                                fixedattr=fixedattr+'<tr><td>'+value1['at_asset_attribute_name']+'</td><td>'+value1['at_asset_attribute_value_text']+'</td></tr>';
                            
                              }
                               if(value1['attr_catagory']==1){
                              
                             
                                dynamiattr=dynamiattr+'<tr><td>'+value1['at_asset_attribute_name']+'</td><td>'+value1['at_asset_attribute_value_text']+'</td></tr>';
                            
                              }
                            });
                           }
                          //  Tag History

                          Object.entries(result.Tag_history).forEach(([key2,value2]) => {
                            console.log(result.Tag_history[0]);
                             console.log(value2['th_asset_tag_number']); 
                            
                            asset_tag_history=asset_tag_history+'<tr><td style="text-align:left">'+value2['created_at']+'</td><td>'+value2['th_asset_tag_number']+'</td><td>'+value2['UserName']+'</td></tr>';
                            });
                           console.log(asset_tag_history);
                           }
                      //console.log(result.parentdetails.ta_asset_name);
                   
                    

                    if(fixedattr!=""){
                      fixedattr="<tr><td colspan='2' align='center' class='attrasstdetails'>Fixed Attribute</td></tr>"+fixedattr;
                    }
                    if(dynamiattr!="")
                    {
                      dynamiattr="<tr><td colspan='2' align='center' class='attrasstdetails'>Dynamic Attribute</td></tr>"+dynamiattr;
                    }
                    if(asset_tag_history!="")
                    {   
                        asset_tag_history="<tr><td colspan='2'  class='attrasstdetails'>Tag History</td></tr><tr><td colspan='2' style='padding: 0 ! important'>"+asset_tag_history+'</td></tr>';
                    }
                    console.log(fixedattr);
                    console.log(dynamiattr);
                    $('#Site_single_asset_table').append(fixedattr+dynamiattr+asset_tag_history);
                     $('#siteassetdetailsmodal').modal('toggle');
                 
                       
                        
                       
                      
               
                }
              
                
              }

                
            })

        }


        

        
        </script>

@endsection
