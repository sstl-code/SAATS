@extends('Layout.mainlayout')
@section('content')

<style>
  .map_button{
		display: block;
  }
  table.dataTable {
    position: relative;
    bottom: 0px !important;
}
.dataTables_wrapper .dataTables_filter {
    text-align: left;
    float:right !important;
    /* margin: 45px; */
}
</style>
    <div class="card col-12 sup_map" style="border-radius: unset;">
        <div class="card-header">
          <h4>Technician Supervisor Mapping</h4>
        </div>
        @if(auth()->user()->is_admin)
        <div class="card-body pb-3">
          <div class="row">
          @csrf
              <div class="col-md-3"> 
                <div class="form-group">
                  <label for="parent_asset_type" class="col-form-label">Technician Name<strong class="text-danger">*</strong></label>
                  <select class="form-select" id="technician_id" name="passttype" data-required="true" required>
                    <option selected disabled hidden>Choose here</option>
                    @foreach($alluser as $user)
                     @if(!$user->is_supervisor)
                      <option value='{{$user->id}}'>{{$user->name}}</option>
                     @endif
                      @endforeach                      
                  </select>
                </div>
                
              </div>
              <div class="col-md-3"> 
                <div class="form-group">
                  <label for="parent_asset_type" class="col-form-label">Supervisor Name<strong class="text-danger">*</strong></label>
                  <select class="form-select" id="supervisor_id" name="passttype" data-required="true" required>
                    <option selected disabled hidden>Choose here</option>
                    @foreach($alluser as $user)
                     @if($user->is_supervisor)
                      <option value='{{$user->id}}'  data-mail='{{$user->email}}'>{{$user->name}}</option>
                     @endif
                      @endforeach                      
                  </select>
                </div>
                
              </div>
         
              <div class="col-md-2">
                <button type="button" id="SubmitButton" class="btn btn-primary subbutton map_button" onclick="savetechnician()">Map</button>
              </div>
          </div>
        </div>
      @endif
    </div>

    <div class="row mx-2 my-1 sup_map_table">
      <table class="table table-striped table-bordered mt-2" id="supertechtable">
          <thead>
            <tr class="tableheadcolor">
                  {{-- <th class="tableheadborder" scope="col" style="width:15px;">Id</th>  --}}
                  <th class="tableheadborder" scope="col">Supervisor Name</th>
                  <th class="tableheadborder" scope="col">Technician Name</th>
                  {{-- <th class="tableheadborder" scope="col">PM User Id</th> --}}
                  <th class="tableheadborder" scope="col">Created Date</th>
                 @if(auth()->user()->is_admin) <th class="tableheadborder" scope="col">Action</th>@endif
                  
              </tr>
          </thead>

          <tbody id="table_Data">
            @foreach($userdetail as $details)
           
            <tr id='' class="dataTbltdhight  ">
              {{-- <td >{{$details['id']}}</td> --}}
              <td >{{isset($details['supervisor_details']->name)?$details['supervisor_details']->name:'NA'}}</td>
              <td >{{!empty($details['technician_details']->name)?$details['technician_details']->name : 'NA'}}</td>
              
              {{-- <td >{{$details['pm_user_id']}}</td> --}}
              <td >{{date($details['created_at'])}}</td>
              @if(auth()->user()->is_admin)
              <td >
                              
                <button type="button" class="edit" style="border-radius: 0;
                    background-color: #202C55;width: 76px;" data-bs-toggle="modal" data-bs-target="#editmodal" onclick="supervisor_edit(this)" data-id="{{$details['id']}}" >Delete</button>
                 
              </td>
              @endif
            </tr>
              @endforeach
      </tbody>
      </table>
    </div>
<script>
  function savetechnician()
  {
    var technician_id=$("#technician_id").val();
    var supervisor_id= $("#supervisor_id").val();
    //var pmuser_id= $("#pmuser_id").val();
    var supervisor_mail = $('#supervisor_id').find('option:selected').attr('data-mail');
    var csrftoken = $("input[name='_token']").val();
    if (technician_id ==  "") {
         $("#technician_id").focus();
         $("#technician_id").addClass("error");
         $("#technician_id").after("<span>Required</span>");
         return false;          
      }
      if (supervisor_id ==  "") {
         $("#supervisor_id").focus();
         $("#supervisor_id").addClass("error");
         $("#supervisor_id").after("<span>Required</span>");
         return false;          
      }
    $.ajax({
    method:"POST",
    url: "{{url('supervisor_technician_mapping')}}",
    data:{              
          '_token': csrftoken,       
          'technician_id':technician_id,
          'supervisor_id' : supervisor_id,
          'supervisor_mail' : supervisor_mail,
         // 'pmuser_id':pmuser_id
          
    },
    success: function(data){
      console.log(data);
      if(data.code==200){
        window.location.reload();
      }else{
        alert("This technician is already mapped with supervisor");
      }
    }
  })
  }
  function supervisor_edit(e)
  {
    var csrftoken = $("input[name='_token']").val();
    $.ajax({
      
      type: "POST",       
      
      url: "{{url('technician_delete')}}",
      data:{
          '_token': csrftoken,
          'id' : $(e).data("id"),
      },
      success: function(data){
      console.log(data);
      if(data){
        window.location.reload();
      }
    }
      
    })
  }
</script>


@endsection