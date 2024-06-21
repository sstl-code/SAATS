@extends('Layout.mainlayout')
@section('content')
<style>
  th, td { white-space: nowrap; } 
  div.dataTables_wrapper { width: 800px; margin: 0 auto; }
</style>

<div class="card-body" style="background-color:#EBEFF2; padding-left: 15px;">
  <nav>
    <div class="nav nav-underline" id="myTab" role="tablist">
    {{-- <ul class="nav nav-underline " id="myTab" role="tablist"> --}}
        {{-- <li class="nav-item " role="presentation"> --}}
          <button class="nav-link navtabbutton active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">STN Task Closure</button>
        {{-- </li> --}}
        {{-- <li class="nav-item" role="presentation"> --}}
          <button class="nav-link navtabbutton" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">SRN Task Closure</button>
        {{-- </li> --}}
    {{-- </ul> --}}
    </div>
  </nav>
</div>

<div class="tab-content mx-3 mt-3" id="myTabContent">
  <div class="tab-pane fade show active scroll_stn" id="home" role="tabpanel" aria-labelledby="home-tab">  
    <div class="card col-12" style="border-radius: unset;">
      <div class="card-header">
        <h4> STN Task Closure </h4>
      </div>
    </div>
    <div class="row">
        <div class="col-12">
          <div class="mt-5">
            <table class="stn_Task_Closure_table cell-border border stntaskclosureClass">
                <thead>
                  <tr class="tableheadcolor ">
                    <th>STN ID</th>
                    <th>STN Loaction ID</th>
                    <th>STN Location Name</th>
                    <th>STN Location Address</th>
                    <th>STN Asset Type Code</th>
                    <th>STN Asset Name</th>
                    <th>STN Asset Manufacture Serial No</th>
                    <th>STN Asset Status</th>
                    <th>STN Asset ID</th>
                    <th>STN Task ID</th>
                    <th>STN Asset Tag Number</th>
                    <th>STN Remarks</th>
                    <th>STN Creation Date</th>
                    <th>STN Created By</th>
                    <th>STN Effective Start Date</th>
                    <th>STN Last Updated Date</th>
                    <th>STN Last Updated By</th>
                    <th>STN Effective End Date</th>
                    <th>STN File Name</th>
                    <th>STN Approve/Reject</th>
                    <th>STN Approve/Reject Remarks</th>
                    <th>STN Approved/Rejected By</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($stnTaskClosureCon as $stnTaskClos)
                    <tr>
                    <td>{{ $stnTaskClos->stn_id}}</td>
                    <td>{{ $stnTaskClos->stn_loaction_id}}</td>
                    <td>{{ $stnTaskClos->stn_location_name}}</td>
                    <td>{{ $stnTaskClos->stn_location_address}}</td>
                    <td>{{ $stnTaskClos->stn_asset_type_code}}</td>
                    <td>{{ $stnTaskClos->stn_asset_name}}</td>
                    <td>{{ $stnTaskClos->stn_asset_manufacture_serial_no}}</td>
                    <td>{{ $stnTaskClos->stn_asset_status}}</td>
                    <td>{{ $stnTaskClos->stn_asset_id}}</td>
                    <td>{{ $stnTaskClos->stn_task_id}}</td>
                    <td>{{ $stnTaskClos->stn_asset_tag_number}}</td>
                    <td>{{ $stnTaskClos->stn_remarks}}</td>
                    <td>{{ $stnTaskClos->stn_creation_date}}</td>
                    <td>{{ $stnTaskClos->stn_created_by}}</td>
                    <td>{{ $stnTaskClos->stn_effective_start_date}}</td>
                    <td>{{ $stnTaskClos->stn_last_updated_date}}</td>
                    <td>{{ $stnTaskClos->stn_last_updated_by}}</td>
                    <td>{{$stnTaskClos->stn_effective_end_date}}</td>
                    <td>{{ $stnTaskClos->stn_file_name}}</td>
                    <td>{{ $stnTaskClos->stn_approve_reject}}</td>
                    <td>{{ $stnTaskClos->stn_approve_reject_remarks}}</td>
                    <td>{{ $stnTaskClos->stn_approved_rejected_by}}</td>
            
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>     
  </div>
    

  <div class="tab-pane fade scroll_srn" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <div class="card col-12" style="border-radius: unset;">
      <div class="card-header">
        <h4> SRN Task Closure </h4>
      </div>
    </div>
    <div class="row">
        <div class="col-12">
          <div class="mt-5">
            <table class="stn_Task_Closure_table cell-border border stntaskclosureClass">
                <thead>
                  <tr class="tableheadcolor ">
                    <th>SRN ID</th>
                    <th>SRN Loaction ID</th>
                    <th>SRN Location Name</th>
                    <th>SRN Location Address</th>
                    <th>SRN Asset Type Code</th>
                    <th>SRN Asset Name</th>
                    <th>SRN Asset Manufacture Serial No</th>
                    <th>SRN Asset Status</th>
                    <th>SRN Asset ID</th>
                    <th>SRN Task ID</th>
                    <th>SRN Asset Tag Number</th>
                    <th>SRN Remarks</th>
                    <th>SRN Creation Date</th>
                    <th>SRN Created By</th>
                    <th>SRN Effective Start Date</th>
                    <th>SRN Last Updated Date</th>
                    <th>SRN Last Updated By</th>
                    <th>SRN Effective End Date</th>
                    <th>SRN File Name</th>
                    <th>SRN Approve/Reject</th>
                    <th>SRN Approve/Reject Remarks</th>
                    <th>SRN Approved/Rejected By</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($srnTaskClosureCon as $srnTaskClos)
                    <tr>
                    <td>{{ $srnTaskClos->srn_id}}</td>
                    <td>{{ $srnTaskClos->srn_loaction_id}}</td>
                    <td>{{ $srnTaskClos->srn_location_name}}</td>
                    <td>{{ $srnTaskClos->srn_location_address}}</td>
                    <td>{{ $srnTaskClos->srn_asset_type_code}}</td>
                    <td>{{ $srnTaskClos->srn_asset_name}}</td>
                    <td>{{ $srnTaskClos->srn_asset_manufacture_serial_no}}</td>
                    <td>{{ $srnTaskClos->srn_asset_status}}</td>
                    <td>{{ $srnTaskClos->srn_asset_id}}</td>
                    <td>{{ $srnTaskClos->srn_task_id}}</td>
                    <td>{{ $srnTaskClos->srn_asset_tag_number}}</td>
                    <td>{{ $srnTaskClos->srn_remarks}}</td>
                    <td>{{ $srnTaskClos->srn_creation_date}}</td>
                    <td>{{ $srnTaskClos->srn_created_by}}</td>
                    <td>{{ $srnTaskClos->srn_effective_start_date}}</td>
                    <td>{{ $srnTaskClos->srn_last_updated_date}}</td>
                    <td>{{ $srnTaskClos->srn_last_updated_by}}</td>
                    <td>{{$srnTaskClos->srn_effective_end_date}}</td>
                    <td>{{ $srnTaskClos->srn_file_name}}</td>
                    <td>{{ $srnTaskClos->srn_approve_reject}}</td>
                    <td>{{ $srnTaskClos->srn_approve_reject_remarks}}</td>
                    <td>{{ $srnTaskClos->srn_approved_rejected_by}}</td>
            
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
  </div>

</div>


@endsection