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
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Asset</button>
      </li>
      {{-- <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">SRN</button>
      </li> --}}
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
                    
                    <h6>Download Additional  Template:</h6>
                    <a class="btn btn-primary btn-sm" href="{{asset('assets/assets/excels/stn.xlsx')}}" style="border-radius: 0; background-color: #202C55;"><i class="fa-solid fa-download"></i> Click here to download the template file</a>
                </div>
                <div class="mt-3">
                    <h6>Asset Upload:</h6>
                    <form action="{{url('additional_item_batch')}}" id='stnValfrom' class="mb-3" method='post' enctype="multipart/form-data">
                        @csrf
                        <label for="files">Select files:</label>            
                        <input type="file" id="files" class="stn_file" name="files"><br><br>
                        <input type="submit" id="stnVal">
                    </form>

                    
                </div>
                
            </div>
            {{-- <div class="table_card_config"> --}}
              <?php if(!empty($asset_return)){ ?>
              <table id="sitetable" class="table table-bordered my_table_batch cell-border border table_config">
                  <thead>
                    <tr class="tableheadcolor">
                        
                        <th>Location Id </th>
                        <th>Asset Manufacture Serial Number</th>
                        <th>Aprove Reject Remarks</th>
                        <th>Active Inactive Status</th>
                        <th>Validation Status</th>
                        <th>Aprove Reject</th>
                        <th>Transaction Direction</th>
                        <th>Created By</th>
                        <th>Creation Date</th>
                        <th>Aprove Rejected By</th>
                        <th>Effective End Date</th>
                        </tr>
                  </thead>
                  <?php $manufact= array(); $y=0;?>
                  <tbody>
                      @foreach($asset_return as $asset_bulk)
                      <tr class="<?php if($y > 1){ echo 'stnactive"'; } ?>">
                      <td>{{ $asset_bulk->tad_location_id}}</td>
                      <td>{{ $asset_bulk->tad_asset_manufacture_serial_no}}</td>
                      <td>{{ $asset_bulk->tad_approve_reject_remarks}}</td>
                      <td>{{ $asset_bulk->tad_asset_active_inactive_status}}</td>
                      <td>{{ $asset_bulk->tad_validation_status}}</td>
                      <td>{{ $asset_bulk->tad_approve_reject}}</td>
                      <td>{{ $asset_bulk->tad_transactional_direction}}</td>
                      <td>{{ $asset_bulk->tad_created_by}}</td>
                      <td>{{ $asset_bulk->tad_creation_date}}</td>
                      <td>{{ $asset_bulk->tad_approved_rejected_by}}</td>
                      <td>{{ $asset_bulk->tad_effective_end_date}}</td>
                      
                      
                      {{-- <td>{{ $asset_bulk->tad_approve_reject}}</td> --}}

              {{-- {{array_push($manufact, $stn_bulk->stn_insert_asset_manufacture_serial_no);}} --}}
                      </tr>
                      <?php $y++; ?>
                      @endforeach
                  </tbody>
              </table>
            {{-- </div> --}}
            <i class="paarrow fa-solid fa-angle-down text-center" onclick="configstn();" <?php if(count($asset_return) > 2){ echo "style=display:block;"; } ?>></i>

            <a class="btn btn-primary btn-sm my-3" onclick="uploadstn();" style="border-radius: 0; background-color: #202C55;float: right;">Upload</a>
            <?php }?>
    </div>
      

    {{-- <div class="tab-pane fade scroll_srn" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="batchSubDiv col-md-6">
                <div>
                    <h6>Download SRN Template:</h6>
                    <a class="btn btn-primary btn-sm" href="{{asset('assets/assets/excels/srn.xlsx')}}" style="border-radius: 0; background-color: #202C55;"><i class="fa-solid fa-download"></i> Click here to download the template file</a>
                </div>
                <div class="mt-3">
                    <h6>Bulk Upload:</h6>
                    <form action="{{url('batch_upload3')}}" id="srnValfrom" class="mb-3" method='post' enctype="multipart/form-data">
                        @csrf
                        <label for="files">Select files:</label>
                        <input type="file" id="files" class="srn_file" name="files"><br><br>
                        <input type="submit" id="srnVal">
                    </form>
                    
                </div>
            </div> --}}
            {{-- <div class="table_card_config"> --}}
              {{-- <?php if(!empty($bulk_return_srn)){ ?>
              <table id="sitetable" class="table  table-bordered my_table_batch cell-border border table_config">
                  <thead>
                    <tr class="tableheadcolor">
                        <th>Asset Id</th>
                        <th>Asset Master Type Id</th>
                        <th>Asset Type Code</th>
                        <th>Asset Manufacture Serial Number</th>
                        <th>Asset Name</th>
                        <th>Asset Describtion</th>
                        <th>Asset Manufacture Serial No</th>
                        <th>Asset Tag No</th>

                        <th>SRN Remarks</th>
                        <th>SRN File Name</th>
                        <th>SRN Creation Date</th>
                    </tr>
                  </thead>
                  <?php $manufact2= array(); $y=0; ?>
                  <tbody>
                      @foreach($bulk_return_srn as $srn_bulk)
                      <tr class="<?php if($y > 1){ echo 'noactive"'; } ?>" <?php if($srn_bulk->srn_validation == 'REJECT'){echo "style='background-color:red;' "; } ?>>
                      <td>{{ $srn_bulk->srn_location_id}}</td>
                      <td>{{ $srn_bulk->tl_location_name}}</td>
                      <td>{{ $srn_bulk->tl_location_address}}</td>
                      <td>{{ $srn_bulk->srn_asset_id}}</td>
                      <td>{{ $srn_bulk->ta_asset_type_code}}</td>
                      <td>{{ $srn_bulk->ta_asset_name}}</td>
                      <td>{{ $srn_bulk->srn_insert_asset_manufacture_serial_no}}</td>
                      <td>{{ $srn_bulk->srn_remarks}}</td>
                      <td>{{ $srn_bulk->srn_file_name}}</td>
                      <td>{{ $srn_bulk->srn_creation_date}}</td> --}}
                      {{-- {{array_push($manufact2, $srn_bulk->srn_insert_asset_manufacture_serial_no);}} --}}
                      {{-- </tr>
                      <?php //$y++; ?>
                      @endforeach
                  </tbody>
              </table> --}}
            </div>
            {{-- <i class="paarrow fa-solid fa-angle-down text-center" onclick="configsrn();" <?php //if(count($bulk_return_srn) > 2){ echo "style=display:block;"; } ?>></i> --}}

            {{-- <a class="btn btn-primary btn-sm my-3" style="border-radius: 0; background-color: #202C55;float: right;">Upload</a> --}}
            <?php //}?>
    </div>

  </div>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  {{-- <script>
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
  
    function uploadstn(e){
      $.ajax({
        url: "{{url('stnUpload_json')}}",
        type: 'GET',
        dataType: 'json',
        success: function(response) {
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
  </script> --}}

@endsection