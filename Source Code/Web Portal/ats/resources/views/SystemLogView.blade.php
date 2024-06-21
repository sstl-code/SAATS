@extends('Layout.mainlayout')
@section('content')
{{-- System Log View --}}
<div class="row">
    <div class="card col-12" style="border-radius: unset;">
      
          
          <div class="table-responsive" style="background-color:rgba(250, 248, 248, 0.923)">
            <table class="table" style="width:80%">
                  <tbody>
                        <tr>
                           <th style="vertical-align: middle;width:20%;font-size:20px;">Audit Trail</th>
                           <form method="POST" action="{{ url('systemlog') }}">
                              @csrf
                                 <th style="vertical-align: middle;width:2%" nowrap >User</th>
                                 <td width="15%">
                                          <select data-container="body" class="form-select my-element" name="user_id">
                                             <option value=''>All Users</option>
                                             @foreach($Users as $User)
                                                <option value='{{$User->id}}' @if(app()->request->user_id==$User->id) selected @endif>{{$User->name}}</option>
                                             @endforeach                        
                                          </select>
                                 </td>
                                    <th style="vertical-align: middle" nowrap width="5%">Start Date</th>
                                 <td width="12%">
                                    <input type="date" class="form-control" id="" name="start_date" required value="{{ app()->request->start_date }}" max="{{ date('Y-m-d') }}">
                                 </td>
                                 <th style="vertical-align: middle" nowrap width="5%">End Date </th>
                                 <td width="12%">
                                 <input type="date" class="form-control" id="" value="{{ isset(app()->request->end_date)?app()->request->end_date:date('Y-m-d') }}"   name="end_date" required  max="{{ date('Y-m-d') }}">
                                 </td>
                                 
                                 <td>
                                    <button type="submit" class="btn btn-primary btn-sm form-control syslogbutton" >Search</button>
                                 </td>
                                 
                           </form>   
                        </tr>
                  </tbody>
               </table>
                    
      
                      
         </div>
    
     
       <div class="table-responsive">
          <table class="table table-striped system_log_table" style="bottom:0px">
             <thead style="background-color: #DEEBF6">
                  <tr>
                    <!--  <th>Id</th>-->
                      <th>Source</th>
                      <th>Event Name</th>
                      <th>Modified By</th>
                      <th>Modified On</th>
                      <th>Old Value</th>
                      <th>Changed Value</th>
                      
                  </tr>
             </thead>
             <tbody>
                <?php
                $i=1; 
               //  $area = json_decode($SystemLogDetails);

               //  foreach($area as $student) {
               //    foreach($student as $mykey=>$myValue) {
               //       echo "$mykey - $myValue </br>";
               //    }}
                foreach($SystemLogDetails as $SystemLogDetail){ if(!empty($SystemLogDetail)){?>
                      <tr>
                                      
                         <td>{{ $SystemLogDetail->guard_name}}</td>                                         
                         <td>{{ $SystemLogDetail->module_name}}</td>                     
                         <td>
                           {{$SystemLogDetail->userdetails->name}}
                        </td>
                         <td>{{ date('d-M-Y H:i',strtotime($SystemLogDetail->created_at))}}</td>
                         <td>
                           @if(!empty($SystemLogDetail->old_value))
                           @foreach(json_decode($SystemLogDetail->old_value) as $key=>$value)
                           @foreach($value as $key1=>$value1)
                           @if(!empty($value1))
                           {{$key1.": ".$value1}}<br />
                           @endif
                           @endforeach
                         @endforeach
                        @endif</td> 
                         <td>
                           @if(!empty($SystemLogDetail->new_value))
                           @foreach(json_decode($SystemLogDetail->new_value) as $key=>$value)
                           @foreach($value as $key1=>$value1)
                           @if(!empty($value1))
                           {{$key1.": ".$value1}}<br />
                           @endif
                           @endforeach
                         @endforeach
                         @endif
                         </td> 
                       
                        
                      </tr><?php
                     }
                      $i++;
                   }?>
             </tbody>
          </table>
       </div>
    </div>
 </div>
 {{-- Script --}}
            <script>
              


            </script>
@endsection
