@extends('Layout.mainlayout')
@section('content')

<style>
 table.dataTable{
   top: 1px !important;
   
 }
 div.dataTables_wrapper div.dataTables_filter input{
   bottom: 0px !important;
 }

 /* div.dataTables_wrapper div.dataTables_filter label {
  margin-left: 826px !important;
 } */
 iframe {
	margin: 0 103px;
	/* width: 100%; */
	/* height: 100%; */
}
.dataTables_length label select{
   margin: 0 10px;
}

 .pending_table{
   overflow: auto;
 }


 #force_filter{
		float: right !important;
	}
   #force_filter input{
		width:270px !important;
	}
 
 .dataTables_wrapper .dataTables_filter {

text-align: left;
float: right !important;
/* margin: 45px; */
}

 
</style>
  
    {{-- pendingApproval view card header --}}
   <div class="row">
      <div class="card col-12" style="border-radius: unset;">
        <div class="card-header">
            <h4>  Pending Approval  </h4>
        </div>
         <div class="card-body pending_table">
            <table id="force" class="table table-striped config_table_233">
               <thead style="background-color: #DEEBF6">
                     <tr>
                        <th>Case No</th>
                        <th>Site</th>
                        <th>Submitted By</th>
                        <th>Task Title</th>
                        <th>Initiation Date</th>
                        <th>Status</th>
                        <th>Approval</th>
                     </tr>
               </thead>
               <tbody><?php
                  $i=1; 
                  foreach($aCases as $aCase){ if(!empty($aCase->usrcr_usr_lastname)){?>
                        <tr>
                           <td>{{ $aCase->app_number }}</td>                     
                           <td>{{ $aCase->usrcr_usr_lastname}}</td>                     
                           <td>{{ $aCase->usrcr_usr_firstname}}</td>                     
                           <td>{{ $aCase->app_tas_title}}</td>                     
                                             
                           <td>{{ $aCase->del_init_date}}</td>                     
                           <td>Open</td>                   
                           <td><button class='btn btn-primary pmapprovedbtn' data-id="{{$aCase->app_uid}}" >View Details</button></td>                   
                        </tr><?php
                       }
                        $i++;
                     }?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
    <input type='hidden' id="token" value="<?php echo $accessToken; ?>">
   <div class="modal fade"  id="appmodal" tabindex="-1" role="dialog" aria-labelledby="appmodalLabel" aria-hidden="true">
      <div class="modal-dialog"style="max-width: 40% !important;" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="AddModal">Approved</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
              &times;
            </button>
          </div>
          <div class="modal-body" style="backdrop-filter: blur(2px)">
  
          </div>
        </div>
      </div>
   </div>
<script>
   $(document).ready(function() {
      $('.config_table_233').DataTable({       
         // paging: true,
         order:[5,'desc'], 
         language: {
        paginate: {
            previous: 'Prev',
            next:     'Next'
        },
        aria: {
            paginate: {
                previous: 'Previous',
                next:     'Next'
            },
         }
      }
      });
       
      $(".pmapprovedbtn").click(function(){
        var pro_uid = $(this).attr('data-id');
         var token = $("#token").val();
     
           var  loginwindow= window.open("{{env('PM_SERVER_URL')}}/sysworkflow/en/neoclassic/cases/main?sid={{session('PM_web_sessionId')}}","Login","width=0;height=0");
            
            // newwindow.focus();
            setTimeout(function () {
              loginwindow.location.href=("{{env('PM_SERVER_URL')}}/sysworkflow/en/neoclassic/cases/opencase/"+pro_uid);
            }, 3000);
          
          
            
      });
   });
</script>
@endsection