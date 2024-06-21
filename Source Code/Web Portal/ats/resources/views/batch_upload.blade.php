@extends('Layout.mainlayout')
@section('content')
<?php
$bulk_return = isset($bulk_return) ? $bulk_return : "";
$bulk_return_srn = isset($bulk_return_srn) ? $bulk_return_srn:"";
$active = isset($active) ? $active:"";
?>

<style>
    .noactive {
	display: none;
}

.scroll_srn i{
    display: none;
}
.paarrow{
   display: none;
 }
 table.dataTable {
    width: 100%;
    margin: 14px 0px;
    /* clear: both; */
    der-collapse: separate;
    border-spacing: 0;
}
.dataTables_length label select{
   margin: 0 10px;
}
.dataTables_wrapper .dataTables_filter {
    float: right !important;
    
}
@media only screen and (max-width: 550px){
  .nav .nav-link {

    font-size: small;
}
}
.dataTables_wrapper .dataTables_filter input {
      
      background-image: url('https://cdn3.iconfinder.com/data/icons/feather-5/24/search-512.png');
      background-repeat: no-repeat;
      padding-right: 30px;
      background-position: right 10px center;
      background-size: 16px 16px;
    }

</style>
<script>
  @if(session('status'))
      toastr.success('{{ session('status') }}');
  @endif
 
  </script>

<div class="card-body" style="background-color:#EBEFF2; padding-left: 15px;">
  <nav>
    <div class="nav nav-underline" id="myTab" role="tablist">
    
		  <button class="nav-link navtabbutton active" id="technician_map" data-bs-toggle="tab" data-bs-target="#mapping" type="button" role="tab" aria-controls="home" aria-selected="false">Technician to Site Mapping</button>
		  <button class="nav-link navtabbutton" id="addasset" data-bs-toggle="tab" data-bs-target="#addassetsrnstn" type="button" role="tab" aria-controls="home" aria-selected="false">Add Asset</button>
      <button class="nav-link navtabbutton" id="addstn" data-bs-toggle="tab" data-bs-target="#addassetstn" type="button" role="tab" aria-controls="home" aria-selected="false">Create STN</button>
      <button class="nav-link navtabbutton" id="addsrn" data-bs-toggle="tab" data-bs-target="#addassetsrn" type="button" role="tab" aria-controls="home" aria-selected="false">Create SRN</button>
       <button class="nav-link navtabbutton" id="generateERPFile" data-bs-toggle="tab" data-bs-target="#erpFarUpd" type="button" role="tab" aria-controls="home" aria-selected="false">ERP FAR Update</button>
        <button class="nav-link navtabbutton" id="generateReport" data-bs-toggle="tab" data-bs-target="#rptGen" type="button" role="tab" aria-controls="home" aria-selected="false">Reports</button>
    </div>
  </nav>
</div>
{{-- Tencian mapping to site --}}
  <div class="tab-content mx-3 mt-3" id="myTabContent">

	 <div class="tab-pane fade show scroll_stn" id="mapping" role="tabpanel" aria-labelledby="home-tab">
            <div class="batchSubDiv col-md-6">
                <div class="">
					
                    <a class="" href="{{asset('assets/excel/User_site_tagging.xlsx')}}" style="border-radius: 0; background-color: #202C55;"> <h6>Download Template File</h6></a>
                </div>
                <div class="mt-3">
                  @if(session('error1'))
                  <div class="alert alert-danger" id="useraddmessage1">
                      {{ session('error1') }}
                  </div>
                    @endif
                    @if(session('success1'))
                  <div class="alert alert-success" id="useraddmessage3">
                      {{ session('success1') }}
                  </div>
                    @endif
                    
                    <form action="{{url('location_user_mapping')}}" id='stnValfrom' class="mb-3" method='post' enctype="multipart/form-data">
                        @csrf
                        <label for="files"></label>            
                        <input accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" type="file" id="files" class="stn_file form-control" name="files" onchange="UserMapping()"><br>
                        <input type="hidden" id="tab-1" name="activetab" value="mapping">  
                        <input type="submit"  class="mb-3" value="Upload" id="UserMap" disabled>
                                              
                    </form>
              </div>
          </div>
          <h4>Failed Data</h4>
          <table id="batchtabletech" class="table table-striped table-borderedn cell-border border table_batch_technician batchcss">
            
            <thead class="thead_names" style="position: sticky;top: 0;background:#DEEBF6;">
               <tr >
                  <th>Serial Number</th>
                  <th>Reason</th>
                  <th>Date</th>
                </tr>
            </thead>
            <tbody style="font-size: small;">
              
               @foreach($Techfaileddata as $Faileddata)
               <tr class="dataTbltdhight">
                 <td >{{$Faileddata->ul_user_location_id}}</td>
               
                  <td>{{$Faileddata->reason}}</td>
                  <td>{{$Faileddata->created_at}}</td>
                  
                  
               </tr>
            
              @endforeach
               
            </tbody>
         </table>       
    </div>
	{{-- Add Asset --}}
	<div class="tab-pane fade show scroll_stn" id="addassetsrnstn" role="tabpanel" aria-labelledby="home-tab">
            <div class="batchSubDiv col-md-12">
                <div class="">
                    <a class="" href="{{asset('assets/excel/ADD_ASSETS.xlsx')}}" style="border-radius: 0; background-color: #202C55;"><h6>Download Template File</h6></a>
                </div>
                
                <div class="mt-3">
                  @if(session('error'))
              <div class="alert alert-danger" id="useraddmessage">
                  {{ session('error') }}
              </div>
              @endif
              @if(session('success'))
              <div class="alert alert-success" id="useraddmessage2">
                  {{ session('success') }}
              </div>
                @endif
                    <form action="{{url('addasset_srn_stn')}}" id='stnValfrom' class="mb-3" method='post' enctype="multipart/form-data">
                        @csrf
                        <label for="files"></label>            
                        <input accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" type="file" id="files_Add_Asset" class="stn_file form-control" name="files" onchange="StnSrnAddAsset(this.id,'addstnsrn')"><br>
                        <input type="hidden" id="tab-13" name="activetab" value="addassetsrnstn">
                        <input type="hidden" id="task_title" name="task_title" value="ADDASSET"> 
                        <input type="submit"  class="mb-3" value="Upload" id="addstnsrn" disabled> 
                                             
                    </form>

                    
                </div>
            <div>
              <h4>Failed Data</h4>
              <table id="batchtable" class="table table-striped table-borderedn cell-border border table_batch_asset batchcss">
                
                <thead class="thead_names" style="position: sticky;top: 0;background:#DEEBF6;">
                   <tr >
                      <th>Serial Number</th>
                      <th>Action</th>
                      <th>Reason</th>
                      <th>Date</th>
                    </tr>
                </thead>
                <tbody style="font-size: small;">
                  
                   @foreach($BatchFailedData as $BatchFailDetails)
                   <tr class="dataTbltdhight">
                     <td >{{$BatchFailDetails->f2a_manufacture_serial_no}}</td>
                     <td>{{$BatchFailDetails->f2a_type}}</td>
                      <td>{{$BatchFailDetails->f2a_reason}}</td>
                      <td>{{$BatchFailDetails->created_at}}</td>
                      
                      
                   </tr>
                
                  @endforeach
                   
                </tbody>
             </table>
            </div>

                
            </div>       
    </div>
    {{-- STN --}}
    <div class="tab-pane fade show scroll_stn" id="addassetstn" role="tabpanel" aria-labelledby="home-tab">
      <div class="batchSubDiv col-md-12">
          <div class="">
              <a class="" href="{{asset('assets/excel/CREATE_STN.xlsx')}}" style="border-radius: 0; background-color: #202C55;"><h6>Download Template File</h6></a>
          </div>
          
          <div class="mt-3">
            @if(session('error'))
        <div class="alert alert-danger" id="useraddmessage5">
            {{ session('error') }}
        </div>
        @endif
        @if(session('success'))
        <div class="alert alert-success" id="useraddmessage6">
            {{ session('success') }}
        </div>
          @endif
              <form action="{{url('addasset_srn_stn')}}" id='stnValfrom' class="mb-3" method='post' enctype="multipart/form-data">
                  @csrf
                  <label for="files"></label>            
                  <input accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" type="file" id="files_Stn" class="stn_file form-control" name="files" onchange="StnSrnAddAsset(this.id,'addstnbttnsubm')"><br>
                  <input type="hidden" id="tab-14" name="activetab" value="addassetstn">
                  <input type="hidden" id="task_title" name="task_title" value="STN">
                  <input type="submit"  class="mb-3" value="Upload" id="addstnbttnsubm" disabled>
                                         
              </form>

              
          </div>
      <div>
        <h4>Failed Data</h4>
        <table id="batchtable" class="table table-striped table-borderedn cell-border border table_batch_asset batchcss">
          
          <thead class="thead_names" style="position: sticky;top: 0;background:#DEEBF6;">
             <tr >
                <th>Serial Number</th>
                <th>Action</th>
                <th>Reason</th>
                <th>Date</th>
              </tr>
          </thead>
          <tbody style="font-size: small;">
            
             @foreach($BatchFailedDataStn as $BatchFailDetailsSTN)
             <tr class="dataTbltdhight">
               <td >{{$BatchFailDetailsSTN->f2a_manufacture_serial_no}}</td>
               <td>{{$BatchFailDetailsSTN->f2a_type}}</td>
                <td>{{$BatchFailDetailsSTN->f2a_reason}}</td>
                <td>{{$BatchFailDetailsSTN->created_at}}</td>
                
                
             </tr>
          
            @endforeach
             
          </tbody>
       </table>
      </div>

          
      </div>       
</div>
{{-- SRN --}}
<div class="tab-pane fade show scroll_stn" id="addassetsrn" role="tabpanel" aria-labelledby="home-tab">
  <div class="batchSubDiv col-md-12">
      <div class="">
          <a class="" href="{{asset('assets/excel/CREATE_SRN.xlsx')}}" style="border-radius: 0; background-color: #202C55;"><h6>Download Template File</h6></a>
      </div>
      
      <div class="mt-3">
        @if(session('error'))
    <div class="alert alert-danger" id="useraddmessage7">
        {{ session('error') }}
    </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success" id="useraddmessage8">
        {{ session('success') }}
    </div>
      @endif
          <form action="{{url('addasset_srn_stn')}}" id='stnValfrom' class="mb-3" method='post' enctype="multipart/form-data">
              @csrf
              <label for="files"></label>            
              <input accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" type="file" id="files_SRN" class="stn_file form-control" name="files" onchange="StnSrnAddAsset(this.id,'addsrnsubmbuttn')"><br>
              <input type="hidden" id="tab-12" name="activetab" value="addassetsrn">
              <input type="hidden" id="task_title" name="task_title" value="SRN"> 
              <input type="submit"  class="mb-3" value="Upload" id="addsrnsubmbuttn" disabled >

                                      
          </form>

          
      </div>
  <div>
    <h4>Failed Data</h4>
    <table id="batchtable" class="table table-striped table-borderedn cell-border border table_batch_asset batchcss">
      
      <thead class="thead_names" style="position: sticky;top: 0;background:#DEEBF6;">
         <tr >
            <th>Serial Number</th>
            <th>Action</th>
            <th>Reason</th>
            <th>Date</th>
          </tr>
      </thead>
      <tbody style="font-size: small;">
        
         @foreach($BatchFailedDataSrn as $BatchFailDetailsSRN)
         <tr class="dataTbltdhight">
           <td >{{$BatchFailDetailsSRN->f2a_manufacture_serial_no}}</td>
           <td>{{$BatchFailDetailsSRN->f2a_type}}</td>
            <td>{{$BatchFailDetailsSRN->f2a_reason}}</td>
            <td>{{$BatchFailDetailsSRN->created_at}}</td>
            
            
         </tr>
      
        @endforeach
         
      </tbody>
   </table>
  </div>

      
  </div>       
</div>
<!--Output File generate -->
 <div class="tab-pane fade show scroll_stn" id="erpFarUpd" role="tabpanel" aria-labelledby="home-tab">
      <div class="batchSubDiv col-md-6">
      ERP FAR Update<br />
         <button style="float:left !important;" class="btn btn-primary btn-sm point" onclick="javascript:window.open('{{ url('generate_output_file')}}');">Generate File</button>
          
      </div>       
 </div>
<!--Report File generate -->
 <div class="tab-pane fade show scroll_stn" id="rptGen" role="tabpanel" aria-labelledby="home-tab">
      <div class="batchSubDiv">
         <div class=" col-12" style="border-radius: unset;">
        <div class="table-responsive row" >



            <div class="row">

                
                <div class="col-md-4" >
          
                    <select id="rptSelect" onchange="showDescription()" data-container="body"
                        class="form-select my-element card" name="user_id">
                        <option data-description="Select a Report">Select Report</option>
                        @foreach ($data as $value)
                            <option data-description="{{ $value->report_description }}" value="{{ $value->id }}">
                                {{ $value->report_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-7" style="text-align: left;" id="reportDescription">
    
                </div>
        </div>
           
            
          <div class="input-parameters" id="rptsearchForm1" style="display:none;">

            <table class="table " style="width:100%">
              <tbody>
                <tr>

                  <form method="POST" action="http://172.16.200.25:85/public/systemlog"></form>
                  <input type="hidden" name="_token" value="EpxFW2s4N6323dH9eu7qePmoI7h9Ect84TV49BIX" autocomplete="off">

                  <th style="vertical-align: middle; text-align: center;" nowrap="" width="5%">Start Date</th>
                  <td width="12%" style="vertical-align: middle;">
                    <input type="date" class="form-control" id="" value="2023-12-21" name="start_date" required="" value=""
                      max="2023-12-19">
                  </td>
                  <th style="vertical-align: middle; text-align: center;" nowrap="" width="5%">End Date </th>
                  <td width="12%" style="vertical-align: middle;">
                    <input type="date" class="form-control" id="" value="2023-12-21" name="end_date" required=""
                      max="2023-12-19">
                  </td>
                  <!--<th style="vertical-align: middle;width:2%; text-align: center;" nowrap="">Site</th>
                  <td width="15%" style="vertical-align: middle;">
                    <select data-container="body" class="form-select my-element" name="user_id">
                      <option value="">Site</option>


                    </select>
                  </td>-->
                  <th style="vertical-align: middle;width:2%; text-align: center;" nowrap="">Download Report As</th>
                  <td style="width: 6%;">
                  
                    <button class="pdf_down_button"><img  src="{{ url('assets/images/pdf.png') }}"
                        class="icon"></button>
                    <button class="pdf_down_button"><img  src="{{ url('assets/images/xls.png') }}"
                        class="icon"></button>
                  </td>


                </tr>
              </tbody>
            </table>
          </div>


          
          <!-- Fully Tagged Site Identification Report-->
        <div class="input-parameters" id="rptsearchForm11" style="display:none;">

            <table class="table " style="width:100%">
              <tbody>
                <tr>

                  <form method="POST" action="{{ url('generate_report') }}" id="frmsearchForm11" target="_blank">
                  <input type="hidden" name="rptId" id="rptId11" value="" >
                   <input type="hidden" name="rptformat" id="rptformat11" value="" >
                 @csrf
                 </form>
                  <th style="vertical-align: middle;width:2%; text-align: center;" nowrap="">Download Report As</th>
                  <td style="width: 6%;">
                  
                   <button class="pdf_down_button" onclick="javascript:generateReport('pdf');"><img  src="{{ url('assets/images/pdf.png') }}"
                        class="icon"></button>
                    <button class="pdf_down_button" onclick="javascript:generateReport('xlsx');"><img  src="{{ url('assets/images/xls.png') }}"
                        class="icon"></button>
                  </td>


                </tr>
              </tbody>
            </table>
              </div>
          </div>
                
        </div>
        <!--Not Found Asset -->
        <div class="input-parameters" id="rptsearchForm12" style="display:none;">

            <table class="table" style="width:100%">
              <tbody>
                <tr>

                  <form method="POST" action="{{ url('generate_report') }}" id="frmsearchForm12" target="_blank">
                  <input type="hidden" name="rptId" id="rptId12" value="" >
                   <input type="hidden" name="rptformat" id="rptformat12" value="" >
                 @csrf
                 </form>
                  <th style="vertical-align: middle;width:2%; text-align: center;" nowrap="">Download Report As</th>
                  <td style="width: 6%;">
                  
                   <button class="pdf_down_button" onclick="javascript:generateReport('pdf');"><img  src="{{ url('assets/images/pdf.png') }}"
                        class="icon"></button>
                    <button class="pdf_down_button" onclick="javascript:generateReport('xlsx');"><img  src="{{ url('assets/images/xls.png') }}"
                        class="icon"></button>
                  </td>


                </tr>
              </tbody>
            </table>
              </div>
          </div>
                
        </div>
<!--Inventory FAR Mismatch-->
        <div class="input-parameters" id="rptsearchForm13" style="display:none;">

            <table class="table" style="width:100%">
              <tbody>
                <tr>

                  <form method="POST" action="{{ url('generate_report') }}" id="frmsearchForm13" target="_blank">
                  <input type="hidden" name="rptId" id="rptId13" value="" >
                   <input type="hidden" name="rptformat" id="rptformat13" value="" >
                 @csrf
                 </form>
                  <th style="vertical-align: middle;width:2%; text-align: center;" nowrap="">Download Report As</th>
                  <td style="width: 6%;">
                  
                   <button class="pdf_down_button" onclick="javascript:generateReport('pdf');"><img  src="{{ url('assets/images/pdf.png') }}"
                        class="icon"></button>
                    <button class="pdf_down_button" onclick="javascript:generateReport('xlsx');"><img  src="{{ url('assets/images/xls.png') }}"
                        class="icon"></button>
                  </td>


                </tr>
              </tbody>
            </table>
        </div>
        
        </div>
                
        </div>
     <!-- Asset Audit -->
        <div class="input-parameters" id="rptsearchForm14" style="display:none;">

            <table class="table" style="width:100%">
              <tbody>
                <tr>

                  <form method="POST" action="{{ url('generate_report') }}" id="frmsearchForm14" target="_blank">
                  <input type="hidden" name="rptId" id="rptId14" value="" >
                   <input type="hidden" name="rptformat" id="rptformat14" value="" >
                 @csrf
                 </form>
                  <th style="vertical-align: middle;width:2%; text-align: center;" nowrap="">Download Report As</th>
                  <td style="width: 6%;">
                  
                   <button class="pdf_down_button" onclick="javascript:generateReport('pdf');"><img  src="{{ url('assets/images/pdf.png') }}"
                        class="icon"></button>
                    <button class="pdf_down_button" onclick="javascript:generateReport('xlsx');"><img  src="{{ url('assets/images/xls.png') }}"
                        class="icon"></button>
                  </td>


                </tr>
              </tbody>
            </table>
              </div>
          </div>
                
        </div>
    </div>

    <script language="javascript">
        function showDescription() {
            // Get the select element
            var selectElement = document.getElementById("rptSelect");

            // Get the selected option
            var selectedOption = selectElement.options[selectElement.selectedIndex];

            // Get the label output element
            var labelOutputElement = document.getElementById("reportDescription");


            // Change the label text based on the selected option
            labelOutputElement.textContent = selectedOption.getAttribute("data-description");
            inputparam= document.getElementsByClassName("input-parameters");
            for (let i = 0; i < inputparam.length; i++) {
               inputparam[i].style.display="none";
              }
            document.getElementById("rptsearchForm"+selectedOption.value).style.display="block";
            
        }
        function generateReport(strFormat)
        {
            var selectElement = document.getElementById("rptSelect");
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            document.getElementById("rptId"+selectedOption.value).value=selectedOption.value;
            document.getElementById("rptformat"+selectedOption.value).value=strFormat;
            document.getElementById("frmsearchForm"+selectedOption.value).submit();
           
        }
    </script>
          
      </div>       
 </div>
 

  </div>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script>
    //srn
    function configsrn() {
    $('.noactive').toggle();
    if($(".scroll_srn i").hasClass('fa-angle-down')){
      $(".scroll_srn i").removeClass('fa-angle-down').addClass('fa-angle-up');
    }else{
      $(".scroll_srn i").removeClass('fa-angle-up').addClass('fa-angle-down');
    }

    }
    //srn
    //stn
    function configstn() {
      $('.stnactive').toggle();
      if($(".scroll_stn i").hasClass('fa-angle-down')){
        $(".scroll_stn i").removeClass('fa-angle-down').addClass('fa-angle-up');
      }else{
        $(".scroll_stn i").removeClass('fa-angle-up').addClass('fa-angle-down');
      }

    }
    //stn
    //far_con
    function configfar() {
      $('.faractive').toggle();
      if($(".scroll_stn i").hasClass('fa-angle-down')){
        $(".scroll_stn i").removeClass('fa-angle-down').addClass('fa-angle-up');
      }else{
        $(".scroll_stn i").removeClass('fa-angle-up').addClass('fa-angle-down');
      }

    }
    //far_con
    function uploadstn(e){
      $.ajax({
        url: "{{url('stnUpload_json')}}",
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          location.reload()
            // Process the received data
            console.log(response);
        },
    });
    }

    function UploadAsset(e){
      $.ajax({
        url: "{{url('bulkasst_upload')}}",
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          location.reload();
            // Process the received data
            console.log(response);
        },
    });
    }

    function uploadsrn(e){
      $.ajax({
        url: "{{url('srnUpload_json')}}",
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Process the received data
            location.reload()
            console.log(response);
        },
    });
    }
//stn
    // $("#stnVal").click(function(e){
    //   e.preventDefault();
    //   if ($(".stn_file").val() != "") {
    //     $("#stnValfrom").submit();
    //   }
    //   return false;
    // });
//stn
//srn
    // $("#srnVal").click(function(e){
    //   e.preventDefault();
    //   if ($(".srn_file").val() != "") {
    //     $("#srnValfrom").submit();
    //   }
    //   return false;
    // });
//srn
// far
    $("#farVal").click(function(e){
      e.preventDefault();
      if ($(".far_file").val() != "") {
        $("#farValfrom").submit();
      }
      return false;
    });
// far
  </script>


<script>
  window.onload = function() {
   var sessionData = @json(session()->all());
    var activeTab = "{{ Session::get('active_tab') }}";
    console.log(activeTab);
    document.getElementById(activeTab).classList.add('active');

    $('#technician_map').removeClass("active show");
    $('#addasset').removeClass("active show");
    $('#addstn').removeClass("active show");
    $('#addsrn').removeClass("active show");
    $('[data-bs-target="#'+activeTab+'"]').addClass("active");

    // if(activeTab == 'mapping'){
    //   $('[data-bs-target="#activeTab"]').addClass("active");
    //   $('#far-tab1').addClass("active show");
    //   $('[data-bs-target="#far-tab2"]').removeClass("active");
    //   $('#far-tab2').removeClass("active show");
      
    // }
    //technician_map addasset addstn addsrn
    
    // else{
    //   console.log(activeTab);
    //   $('[data-bs-target="#far-tab2"]').addClass("active");
    //   $('#far-tab2').addClass("active show");
    //   $('[data-bs-target="#far-tab1"]').removeClass("active");
    //   $('#far-tab1').removeClass("active show");
      
    // }
     
  
     
  }
 
  function UserMapping() {
  // Get the file input element
  var fileInput = document.getElementById("files");

  // Get the "Upload" button element
  var uploadButton = document.getElementById("UserMap");

  // Check if a file has been selected
  if (fileInput.files.length > 0) {
    // Enable the "Upload" button
    uploadButton.disabled = false;
  } else {
    // Disable the "Upload" button if no file is selected
    uploadButton.disabled = true;
  }
}
  function StnSrnAddAsset(fileid,uplbuttonid) {
  // Get the file input element
  // var fileInput = document.getElementById("files");

  // Get the "Upload" button element
  var fileInput = document.getElementById(fileid);
  var uploadButton = document.getElementById(uplbuttonid);
  
  // Check if a file has been selected
  if (fileInput.files.length > 0) {
    // Enable the "Upload" button
    uploadButton.disabled = false;
  } else {
    // Disable the "Upload" button if no file is selected
    uploadButton.disabled = true;
  }
}

setTimeout(() => {
      $('#useraddmessage').remove();
      $('#useraddmessage1').remove();
      $('#useraddmessage2').remove();
      $('#useraddmessage3').remove();
      $('#useraddmessage5').remove();
      $('#useraddmessage6').remove();
      $('#useraddmessage7').remove();
      $('#useraddmessage8').remove();
     }, 6000);
   
     



  //javascript:document.getElementById('UserMap').disabled=false
</script>
@endsection