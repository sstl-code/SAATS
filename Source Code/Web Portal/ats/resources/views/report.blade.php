@extends('Layout.mainlayout')
@section('content')
    <div class="card col-12" style="border-radius: unset;">
        <div class="table-responsive row" style="background-color:rgba(250, 248, 248, 0.923);margin:6px;">



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

            <table class="table card" style="width:100%">
              <tbody>
                <tr>

                  <form method="POST" action="{{ url('generate_report') }}" id="frmsearchForm1" target="_blank">
                  <input type="hidden" name="rptId" id="rptId1" value="" >
                   <input type="hidden" name="rptformat" id="rptformat1" value="" >
                 @csrf
                  
                  </form>
                   

                <!--  <th style="vertical-align: middle; text-align: center;" nowrap="" width="5%">Start Date</th>
                  <td width="12%" style="vertical-align: middle;">
                    <input type="date" class="form-control" id="" value="{{ date('Y-m-d') }}" name="start_date" required="" value=""
                      max="{{ date('Y-m-d') }}">
                  </td>
                  <th style="vertical-align: middle; text-align: center;" nowrap="" width="5%">End Date </th>
                  <td width="12%" style="vertical-align: middle;">
                    <input type="date" class="form-control" id="" value="{{ date('Y-m-d') }}" name="end_date" required=""
                      max="{{ date('Y-m-d') }}">
                  </td>
                  <!--<th style="vertical-align: middle;width:2%; text-align: center;" nowrap="">Site</th>
                  <td width="15%" style="vertical-align: middle;">
                    <select data-container="body" class="form-select my-element" name="user_id">
                      <option value="">Site</option>


                    </select>
                  </td>-->
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


          <div class="input-parameters" id="rptsearchForm2" style="display:none;">

            <table class="table card" style="width:100%">
              <tbody>
                <tr>

                  <form method="POST" action="{{ url('systemlog') }}"></form>
                  <input type="hidden" name="_token" value="EpxFW2s4N6323dH9eu7qePmoI7h9Ect84TV49BIX" autocomplete="off">

                  <th style="vertical-align: middle; text-align: center;" nowrap="" width="3%">Technician Name</th>
                  <td width="15%" style="vertical-align: middle;">
                    <select data-container="body" class="form-select my-element" name="user_id">
                      <option value="">All</option>
                      @foreach($technicians as $technician)
                        <option value="{{ $technician->id }}">{{ $technician->name }}</option>
                      @endforeach
                      
                    </select>
                  </td>
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
          </div>
          <!-- Fully Tagged Site Identification Report-->
        <div class="input-parameters" id="rptsearchForm11" style="display:none;">

            <table class="table card" style="width:100%">
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

            <table class="table card" style="width:100%">
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

            <table class="table card" style="width:100%">
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

            <table class="table card" style="width:100%">
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

@endsection
