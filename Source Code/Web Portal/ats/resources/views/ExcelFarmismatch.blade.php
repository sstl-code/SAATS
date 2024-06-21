@extends('Layout.mainlayout')
@section('content')


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
</style>

  <ul class="nav nav-tabs" id="myTab" role="tablist">
      {{-- <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">STN</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">SRN</button>
      </li> --}}
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Asset</button>
      </li>
  </ul>
  <div class="tab-content mx-3 mt-3" id="myTabContent">
    <div class="tab-pane fade show active scroll_stn" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="batchSubDiv col-md-6">
                <div class="">
                    {{-- {{ session('inserted_datetime') }} --}}
                    {{-- @php
                    // $inserted_datetime = $request->session()->get('inserted_datetime');
                      echo $inserted_datetime."aftab";
                    @endphp --}}
                    
                    <h6>Download AssetFAR Template:</h6>
                    <a class="btn btn-primary btn-sm" href="{{asset('assets/assets/excels/AssetBatchProcess.xlsx')}}" style="border-radius: 0; background-color: #202C55;"><i class="fa-solid fa-download"></i> Click here to download the template file</a>
                </div>
                <div class="mt-3">
                    <h6>Bulk Upload:</h6>
                    <form action="{{url('inventory_far_bulk')}}" id='stnValfrom' class="mb-3" method='post' enctype="multipart/form-data">
                        @csrf
                        <label for="files"></label>            
                        <input type="file" id="files" class="stn_file form-control" name="files"><br>
                        <input type="submit" id="stnVal" class="mb-3" value="Upload">
                        @if(session('exception_msg'))
                            {{ session('exception_msg') }};
                        @endif
                    </form>
                </div>
              </div>
            {{-- <div class="table_card_config"> --}}
              <?php if(!empty($bulk_inventory)){ ?>
              <table id="sitetable" class="table table-bordered my_table_batch cell-border border table_config" style="bottom: 0px;">
                  <thead>
                    <tr class="tableheadcolor" >
                      <th>Location Id </th>
                      <th>Asset Manufacture Serial Number</th>
                      <th>Aprove Reject Remarks</th>
                      <th>Active Inactive Status</th>
                      <th>Validation Status</th>
                      <th>Aprove Reject</th>
                      <th>Asset Type Code</th>
                      <th>Asset Name</th>
                      <th>Asset Status</th>
                      <th>Created By</th>
                      <th>Creation Date</th>
                      <th>Aprove Rejected By</th>
                      <th>Effective End Date</th>
                      </tr>
                </thead>
                  </thead>
                  <?php $manufact= array(); $y=0;?>
                  <tbody>
                      @foreach($bulk_inventory as $bulk_mismatch)
                      <tr class="<?php if($y > 1){ echo 'stnactive'; } ?>"<?php 
                      if($bulk_mismatch->tad_validation_status == 'MATCHED')
                      {
                        echo "style='background-color:#C6F6C6'";
                      } 
                      if($bulk_mismatch->tad_validation_status == 'MISMATCH')
                      {
                        echo "style='background-color:#FFCCCB;' "; 
                      } 
                      if($bulk_mismatch->tad_validation_status == "DOES NOT EXIST")
                      {
                        echo "style='background-color:#E1E0FF	'";
                      } 
                       ?> >
                      
                      <td>{{ $bulk_mismatch->tad_location_id}}</td>
                      <td>{{ $bulk_mismatch->tad_asset_manufacture_serial_no}}</td>
                      <td>{{ $bulk_mismatch->tad_approve_reject_remarks}}</td>
                      <td>{{ $bulk_mismatch->tad_asset_active_inactive_status}}</td>
                      <td>{{ $bulk_mismatch->tad_validation_status}}</td>
                      <td>{{ $bulk_mismatch->tad_approve_reject}}</td>
                      <td>{{ $bulk_mismatch->tad_asset_type_code}}</td>
                      <td>{{ $bulk_mismatch->tad_asset_name}}</td>
                      <td>{{ $bulk_mismatch->tad_asset_type_status}}</td>
                      <td>{{ $bulk_mismatch->tad_created_by}}</td>
                      <td>{{ $bulk_mismatch->tad_creation_date}}</td>
                      <td>{{ $bulk_mismatch->tad_approved_rejected_by}}</td>
                      <td>{{ $bulk_mismatch->tad_approve_reject}}</td>
                      {{-- {{array_push($manufact, $stn_bulk->stn_insert_asset_manufacture_serial_no);}} --}}
                      </tr>
                      <?php $y++; ?>
                      @endforeach
                  </tbody>
              </table>
            {{-- </div> --}}
            <i class="paarrow fa-solid fa-angle-down text-center" onclick="configstn();" <?php if(count($bulk_inventory) > 2){ echo "style=display:block;"; } ?>></i>

            <a class="btn btn-primary btn-sm my-3" onclick="UploadAsset();" style="border-radius: 0; background-color: #202C55;float: right;">Submit</a>
            <?php }?>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script>


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

    function configsrn() {
    $('.noactive').toggle();
    if($(".scroll_srn i").hasClass('fa-angle-down')){
      $(".scroll_srn i").removeClass('fa-angle-down').addClass('fa-angle-up');
    }else{
      $(".scroll_srn i").removeClass('fa-angle-up').addClass('fa-angle-down');
    }

    }
    function configstn() {
      $('.stnactive').toggle();
      if($(".scroll_stn i").hasClass('fa-angle-down')){
        $(".scroll_stn i").removeClass('fa-angle-down').addClass('fa-angle-up');
      }else{
        $(".scroll_stn i").removeClass('fa-angle-up').addClass('fa-angle-down');
      }

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

    $("#stnVal").click(function(e){
      e.preventDefault();
      if ($(".stn_file").val() != "") {
        $("#stnValfrom").submit();
      }
      return false;
    });

    $("#srnVal").click(function(e){
      e.preventDefault();
      if ($(".srn_file").val() != "") {
        $("#srnValfrom").submit();
      }
      return false;
    });
  </script>

@endsection