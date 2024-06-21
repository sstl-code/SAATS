@extends('Layout.mainlayout')
@section('content')
    {{-- location view card header --}}
    <style>
        .parrow {
            display: none;
        }

        .noactive {
            display: none;
        }

        .siteasactive {
            display: none;
        }
        .histyactive {
            display: none;
        }
        .histypassive {
            display: none;
        }     
        .siteaspassive {
            display: none;
        }

        .asstasactive i {
            display: none;
        }

        .asstaspassive i {
            display: none;
        }
        .history1passive i{
            display: none;

        }
        .history1active i{
            display: none;

        }
        .locationsite i {
            display: none;
        }

        .searchasst {
            display: none;
        }

        */ .table>thead>tr>th,
        .table>thead>tr>td {
            background: #DEEBF6;

            top: 0px;
            position: sticky;
        }

        .table {
            width: 100%;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        .table>thead>tr>th,
        .table>tbody>tr>th,
        .table>thead>tr>td,
        .table>tbody>tr>td {
            border: 1px solid #ddd;
        }

        .input-icon {
            display: block !important;
            position: absolute;
            top: 29%;
            left: 161px;
            cursor: pointer;

        }

        .input-with-icon {
            position: relative;
            display: inline-block;
            /* left: 135px; */
            margin-right: auto;
            float: right;
        }

        .applybutton {
            font-size: 16px;
        }

        #location_search {
            height: 31px;
            width: 209px;
        }

        .apply_button {
            background-color: #202C55;
            color: white;
        }

        .radius_ip {
            width: 100%;
        }

        .km_ip {
            width: 100%;
        }

        .view_map {
            background-color: #202C55;
           /* float: right;*/
            color: white;
        }

        @media only screen and (max-width: 970px) and (min-width: 748px) {
            #location_search {
                width: 185px !important;
            }

            .map_filter_check {
                font-size: 12px;
            }

        }

        @media only screen and (max-width: 1152px) and (min-width: 930px) {
            .radius_div {
                flex: 0 0 auto;
                width: 50%;
            }

            .km_div {
                flex: 0 0 auto;
                width: 33.33333333%;
            }

            .apply_div {
                flex: 0 0 auto;
                width: 25%;
            }

            .view_map_div {
                flex: 0 0 auto;
                width: 41.66666667%;
            }


        }

        @media only screen and (max-width: 929px) and (min-width: 768px) {
            .radius_div {
                flex: 0 0 auto;
                width: 50%;
            }

            .km_div {
                flex: 0 0 auto;
                width: 33.33333333%;
            }

            .apply_div {
                flex: 0 0 auto;
                width: 33.33333333%;
            }

            .view_map_div {
                flex: 0 0 auto;
                width: 50%;

            }

            .view_map {
                float: left;
            }

        }

        @media screen (min-width: 1139px) {}

        @media only screen and (max-width: 970px) and (min-width: 489px) {
            .for-allignment{
        
                justify-content: left !important;
            }
        }
        @media only screen and (max-width: 970px) and (min-width: 767px) {
            .for-allignment{
        
                justify-content: left !important;
            }
        }
        @media screen (max-width: 767px) {
            .view_map {
                float: left ;
            }
            .my-1{
                justify-content: left !important;
            }
        }

        #map {
            display: none;
        }

        .table td:last-child {
            padding-left: 1.25rem !important;
            padding-right: 1.25rem !important;
            text-align: center;

        }

        #location_search {
            background-image: url("{{ url('/assets/images/search-icon.png') }}");
            background-size: 20px;
            background-position: right 10px center;
            background-repeat: no-repeat;
            padding-left: 18px;
        }

        .apply_button {
            background-color: #202C55;
            /* float: right; */
            color: white;
        }
    </style>

    <div class="card col-12" style="border-radius: unset;">
        <div class="card-header">
            <h4> Site Asset View </h4>
        </div>
    </div>
    {{-- Site list card --}}
    <div class="row mx-2">
        <div class="col-sm-4 my-2 ">
            <div class="card">

                <div class="card-header" style="background-color: #DEEBF6;">
                    <div class="row">
                        <div class="col-md-4" style="display: flex; justify-content: left;">
                            <button id="toggleButton" onclick="toggleDiv()" class="view_map my-1" style="font-size:14px">View Map</button>
                            <!--   <h6 class="mt-1"> Site List </h6>-->
                        </div>
                        <div class="col-md-4" style="display: flex; justify-content: center;">
                            <div class="input-with-icon" style="padding-top:4px">
                                <input type="text" class="input-field Search search_operatorsite" id="location_search" style="height:28px;"
                                    placeholder="Search Site">
                                <ul id="suggestionsList"></ul>

                                
                                <!-- <i class="input-icon fa-solid fa-rotate-right" onclick="handleIconClick()"></i> -->
                            </div>

                        </div>

                              <div class="col-md-4 for-allignment" style="display: flex; justify-content: right;">
                                <input type="button" value="Clear filter" class="view_map my-1" onClick="reload(this)" style="font-size:14px">
                            </div>


                    </div>
                </div>

                

            </div>
            <form method="post" id="frmlatlong">
                @csrf
                <input type="hidden" id="maplongitude" name="lng">
                <input type="hidden" id="maplatitude" name="lat">
                <input type="hidden" id="mapradius" name="radius">
            </form>
             <input type="hidden" id="location_search_result_html" value="">
            <div id="map" class="mapouter"> </div>
            <style>
                .mapouter {
                    position: relative;
                    text-align: right;
                    height: 494px;

                }
            </style>


            <div id="info" style="display: none;"></div>
            <div class="locationsite my-2">
                <div class="table_card">
                    <table id="topclass" class="table table-striped table-bordered " style="">
                        <thead style="position: sticky;top: -1px;background:#E5FCFF;">
                            <tr class="tableheadcolor">
                                <th class="tableheadborder" scope="col">Site ID </th>
                                <th class="tableheadborder" scope="col">Site Name</th>
                                <th class="tableheadborder" scope="col">Creation Date</th>

                                <th class="tableheadborder" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="location_search_result">
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($locationlist as $locationTable)
                                <?php //echo "<pre>";print_r($locationTable);die();
                                ?>
                                <tr style="cursor:pointer" onclick="getdetails(this);"
                                    data-id='{{ $locationTable->tl_location_id }}' class="tablehover <?php if ($i > 10) {
                                        echo 'noactive"';
                                    } ?>">


                                    <td>{{ $locationTable->tl_location_code }}</td>
                                    <td>{{ $locationTable->tl_location_name }}</td>
                                    {{-- <td>{{ $locationTable->created_at}}</td> --}}
                                     <td>{{ $locationTable->created_at != null ? date('d-M-Y', strtotime($locationTable->created_at)) : '' }}</td>
                                    

                                    @if ($locationTable->tagging_status == '')
                                        @php
                                            $html = '<span></span>';
                                        @endphp
                                    @elseif ($locationTable->tagging_status == 'Green')
                                        @php
                                            $html = "<span class='dotGreen'></span>";
                                        @endphp
                                    @elseif($locationTable->tagging_status == 'Orange')
                                        @php
                                            $html = "<span class='dotAmber'></span>";
                                        @endphp
                                    @else
                                        @php
                                            $html = "<span class='dotRed'></span>";
                                        @endphp
                                    @endif
                                    <td>{!! $html !!}</td>

                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>

                </div>

                <i class="paarrow fa-solid fa-angle-down text-center" onclick="showdata();" <?php if (count($locationlist) > 11) {
                    echo 'style=display:block;';
                } ?>></i>

            </div>
        </div>
        {{-- Site nav-tab card --}}
        <div class="col-sm-8 my-2">
            <div class="card">
                <div class="card-header" id="locationNamePannel" style="background-color: #E5FCFF;">
                </div>
                <!-- nav bar start -->
                <div class="card-body" style="background-color:#EBEFF2; padding:0px;">
                    <nav>
                        <div class="nav nav-underline" id="nav-tab" role="tablist">
                            <button class="nav-link active navtabbutton" id="nav-details-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-details" type="button" role="tab" aria-controls="nav-details"
                                aria-selected="true" style="margin-left: 10px;">
                                Details
                            </button>
                            <button class="nav-link navtabbutton" id="nav-attributes-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-attributes" type="button" role="tab"
                                aria-controls="nav-attributes" aria-selected="false">
                                Attributes
                            </button>
                            <button class="nav-link navtabbutton" id="nav-assets-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-assets" type="button" role="tab" aria-controls="nav-assets"
                                aria-selected="false">
                                Assets
                            </button>
                            <button class="nav-link navtabbutton" id="nav-assethistory-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-assethistory" type="button" role="tab" aria-controls="nav-assethistory"
                                aria-selected="false">
                                Assets History
                            </button>
                        </div>
                    </nav>
                </div>
            </div>
            {{-- location detail table --}}
            {{-- my-3 --}}
            {{-- 
<div class="col-sm-8 my-2">
   --}}
            <div class="card" style="border:none">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-details" role="tabpanel"
                        aria-labelledby="nav-details-tab">
                        <div class="card">
                            <!--<div class="card-body"> -->
                            <div class="row mt-3 p-3">
                                <div class="col">
                                    <div class="col-6 col-sm-4">Site Id</div>
                                    <p><b id='location_code'></b></p>

                                    <div class="col-6 col-sm-4">Address</div>
                                    <p><b id='location_address'></b></p>

                                    <div class="col-6 col-sm-4">Created By</div>
                                    <p><b id='location_created_by'></b></p>

                                </div>

                                <div class="col">

                                    <div class="col-6 col-sm-4">Site Name</div>
                                    <p><b id='location_name'></b></p>
                                    <div class="col-6 col-sm-4">Creation Date</div>
                                    <p><b id='location_creation_date'></b></p>
                                </div>
                            </div>
                            <div id="location_dynamic_attribute">

                            </div>
                        </div>
                    </div>

                    {{-- location attributes table --}}
                    <div class="tab-pane fade" id="nav-attributes" role="tabpanel" aria-labelledby="nav-attributes-tab">
                        <div class="card">
                            <!--<div class="card-body"> -->
                            <div class="row mt-2 p-3" id="owner_attr_value">

                            </div>
                        </div>
                    </div>
                    {{-- location assets table --}}
                        <div class="tab-pane fade" id="nav-assets" role="tabpanel" aria-labelledby="nav-assets-tab">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-assets" role="tablist">
                                        
                                            <button class="nav-link active asset_tab mx-2" id="nav-home-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-Active" type="button" role="tab" aria-controls="nav-home"
                                                aria-selected="true" style="border-radius: 0">
                                                Active
                                            </button>
                                            <button class="nav-link asset_tab" id="nav-profile-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-passive" type="button" role="tab"
                                                aria-controls="nav-profile" aria-selected="false"style="border-radius: 0">
                                                Passive
                                            </button>
                                        </div>
                                    </nav>
                                    <div class="tab-content my-2" id="nav-tabContent">
                                        <div class="tab-pane fade  asstasactive show active " id="nav-Active" role="tabpanel"
                                            aria-labelledby="nav-home-tab">
                                            {{-- Active asset table --}}
                                            <div class="col  table_card">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Asset Type</th>
                                                            <th scope="col">Asset Name</th>
                                                            <th scope="col">Tenancy</th>
                                                            <th scope="col">Serial No</th>
                                                            <th scope="col">Asset Tag No</th>
                                                            <th scope="col">Status</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_Data_active">
                                                    </tbody>
                                                </table>
                                            </div>
                                            {{-- <i class="fa-solid fa-angle-down dropdown_2"
                                                style="
                                                        margin-left: 442px;
                                                        margin-top: 5px;"
                                                onclick="showdpdwnactive();"></i> --}}
                                        </div>
                                        {{-- Passive asset table --}}
                                        <div class="tab-pane asstaspassive fade" id="nav-passive" role="tabpanel"
                                            aria-labelledby="nav-profile-tab">
                                                    <div class="col  table_card">
                                                    <table class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>

                                                                <th scope="col">Asset Type</th>
                                                                <th scope="col">Asset Name</th>
                                                                <th scope="col">Serial No</th>
                                                                <th scope="col">Asset Tag No</th>
                                                                <th scope="col">Status</th>
                                                                <th></th>
                                                                {{-- 
                                            <th scope="col">View</th>
                                            --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table_Data_passive">
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                            {{-- <i class="fa-solid fa-angle-down dropdown_2"
                                                style="
                                            margin-left: 442px;
                                            margin-top: 5px;"
                                                onclick="showdpdwnpassive();"></i> --}}
                                        </div>
                        </div>
                        {{-- Asset History --}}
                        <div class="tab-pane fade" id="nav-assethistory" role="tabpanel" aria-labelledby="nav-assethistory-tab">
                            <nav>
                                <div class="nav nav-tabs" id="nav-assethistory" role="tablist">
                                
                                    <button class="nav-link active asset_tab mx-2" id="nav-home1-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-AssetActive" type="button" role="tab" aria-controls="nav-home"
                                        aria-selected="true" style="border-radius: 0">
                                        Active
                                    </button>
                                    <button class="nav-link asset_tab" id="nav-profile1-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-AssetPassive" type="button" role="tab"
                                        aria-controls="nav-profile" aria-selected="false"style="border-radius: 0">
                                        Passive
                                    </button>
                                </div>
                            </nav>
                            <div class="tab-content my-2" id="nav-tabContent">
                                <div class="tab-pane fade  history1active show active " id="nav-AssetActive" role="tabpanel"
                                    aria-labelledby="nav-home-tab">
                                    {{-- Active asset table --}}
                                    <div class="col  table_card">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Asset Type</th>
                                                    <th scope="col">Asset Name</th>
                                                    <th scope="col">Tenancy</th>
                                                    <th scope="col">Serial No</th>
                                                    <th scope="col">Asset Tag No</th>
                                                    
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tablehistory_Data_active">
                                            </tbody>
                                        </table>
                                    </div>
                                   
                                </div>
                                {{-- Passive asset table --}}
                                <div class="tab-pane history1passive fade" id="nav-AssetPassive" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">
                                            <div class="col  table_card">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>

                                                        <th scope="col">Asset Type</th>
                                                        <th scope="col">Asset Name</th>
                                                        <th scope="col">Serial No</th>
                                                        <th scope="col">Asset Tag No</th>
                                                        
                                                        <th></th>
                                    
                                                    </tr>
                                                </thead>
                                                <tbody id="tablehistory_Data_passive">
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                   
                                </div>
                </div>

{{-- Asset History Model --}}
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
                            </body>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                            <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
                            <link rel="stylesheet"
                                href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
                            <script>
                                function toggleDiv() {

                                    const toggleButton = document.getElementById("toggleButton");
                                    const myDiv = document.getElementById("map");

                                    if (myDiv.style.display === "block") {

                                        myDiv.style.display = "none"; // Hide the div
                                        toggleButton.textContent = "View Map";
                                        closeImage();
                                        // Change button text
                                        //       document.getElementById("box").style.display = 'none';
                                        //       document.getElementById("apply").style.display = 'none';
                                        //       document.getElementById("unit").style.display = 'none';

                                    } else {

                                        showImage();
                                        myDiv.style.display = "block"; // Show the div
                                        toggleButton.textContent = "Close Map"; // Change button text
                                        //    document.getElementById("box").style.display = 'block';
                                        //    document.getElementById("apply").style.display = 'block';
                                        //   document.getElementById("unit").style.display = 'block';

                                    }
                                }

                                function showdata() {



                                    $('.noactive').toggle();
                                    if ($(".locationsite i").hasClass('fa-angle-down')) {
                                        $(".locationsite i").removeClass('fa-angle-down').addClass('fa-angle-up');
                                    } else {
                                        $(".locationsite i").removeClass('fa-angle-up').addClass('fa-angle-down');
                                    }

                                }

                                function showdpdwnactive() {



                                    $('.siteasactive').toggle();
                                    if ($(".asstasactive i").hasClass('fa-angle-down')) {
                                        $(".asstasactive i").removeClass('fa-angle-down').addClass('fa-angle-up');
                                    } else {
                                        $(".asstasactive i").removeClass('fa-angle-up').addClass('fa-angle-down');
                                    }

                                }
                                function historyshowdpdwnactive(){
                                    $('.histyactive').toggle();
                                    if ($(".history1active i").hasClass('fa-angle-down')) {
                                        $(".history1active i").removeClass('fa-angle-down').addClass('fa-angle-up');
                                    } else {
                                        $(".history1active i").removeClass('fa-angle-up').addClass('fa-angle-down');
                                    }

                                    
                                }
                                // function historyshowdpdwnpassive(){
                                //     $('.histypassive').toggle();
                                //     if ($(".history1passive i").hasClass('fa-angle-down')) {
                                //         $(".history1passive i").removeClass('fa-angle-down').addClass('fa-angle-up');
                                //     } else {
                                //         $(".history1passive i").removeClass('fa-angle-up').addClass('fa-angle-down');
                                //     }

                                    
                                // }
                                // function showdpdwnpassive() {



                                //     $('.siteaspassive').toggle();
                                //     if ($(".asstaspassive i").hasClass('fa-angle-down')) {
                                //         $(".asstaspassive i").removeClass('fa-angle-down').addClass('fa-angle-up');
                                //     } else {
                                //         $(".asstaspassive i").removeClass('fa-angle-up').addClass('fa-angle-down');
                                //     }

                                // }


                                $(document).ready(function() {
                                      $("#location_search_result_html").val( $("#location_search_result").html());
                                });    

                                var route = "{{ url('/search_location') }}";
                                var suggestionsContainer = $('<ul id="suggestions"></ul>');
                                $('#location_search').autocomplete({
                                    source: function(request, response) {
                                        //console.log(request.term);
                                        $.ajax({
                                            url: route,
                                            dataType: "json",
                                            data: {
                                                search: request.term
                                            },
                                            success: function(data) {
                                                response(data);
                                            }
                                        });
                                    },

                                    select: function(event, ui) {
                                        //console.log(ui);
                                        // Access the selected value using ui.item.value
                                        var selectedValue = ui.item.tl_location_id;
                                     
                                        $("#location_search_result").empty();
                                        var date1 = ui.item.created_at;

                                        var date = date1.split(' ');
                                        //console.log(date[0]);
                                        tag_green = "<span class='dotGreen'></span>";
                                        tag_red = "<span class='dotRed'></span>";
                                        tag_amber = "<span class='dotAmber'></span>";
                                        tag_white = "<span></span>"
                                        var i = 0;
                                        if (i > 2) {
                                            //console.log(val);
                                            $(".locationsite i").show();

                                            var active = "noactive";
                                        } else {
                                            $(".locationsite i").hide();
                                        }
                                        if (ui.item.tagging_status == 'Green') {

                                            $('#location_search_result').html(
                                                '<tr class="tablehover" style="cursor:pointer" data-id="' + ui.item.tl_location_id +
                                                '" onclick="getdetails(this)"> <td>' + ui.item.value + '</td><td>' + ui.item.label +
                                                '</td><td>' + date[0] + '</td><td>' + tag_green + '</td></tr>');
                                        } else if (ui.item.tagging_status == 'Orange') {
                                            $('#location_search_result').html(
                                                '<tr class="tablehover" style="cursor:pointer" data-id="' + ui.item.tl_location_id +
                                                '" onclick="getdetails(this)"> <td>' + ui.item.value + '</td><td>' + ui.item.label +
                                                '</td><td>' + date[0] + '</td><td>' + tag_amber + '</td></tr>');
                                        } else if (ui.item.tagging_status == '') {
                                            $('#location_search_result').html(
                                                '<tr class="tablehover" style="cursor:pointer" data-id="' + ui.item.tl_location_id +
                                                '" onclick="getdetails(this)"> <td>' + ui.item.value + '</td><td>' + ui.item.label +
                                                '</td><td>' + date[0] + '</td><td>' + tag_white + '</td></tr>');
                                        } else {

                                            $('#location_search_result').html(
                                                '<tr class="tablehover" style="cursor:pointer" data-id="' + ui.item.tl_location_id +
                                                '" onclick="getdetails(this)"> <td>' + ui.item.value + '</td><td>' + ui.item.label +
                                                '</td><td>' + ui.item.created_at + '</td><td>' + tag_red + '</td></tr>');
                                        }
                                        // Perform actions with the selected value
                                        //console.log("Selected: " + selectedValue);

                                        // Prevent the default behavior of filling the input with the selected value
                                        event.preventDefault();
                                    }
                                });
                                // });
                                const searchInput = document.getElementById('location_search');

                                searchInput.addEventListener('input', function() {
                                    if (this.value.trim() === '') {
                                        this.style.backgroundImage = 'url("{{ url('/assets/images/search-icon.png') }}")';
                                    } else {
                                        this.style.backgroundImage = 'none';
                                    }
                                });

                                // all  site data
function reload(){
       //  $('#loader').addClass('hidden');
                  $('.paarrow').toggle();
                    
                    $('#location_search').val("");
                    $('#location_search').css('background-image','url("{{ url('/assets/images/search-icon.png')}}")');       
                   
                  
                    // Clear the previous search results when the input is empty
                    $('#location_search_result').empty();
                    $('#location_search_result').html( $('#location_search_result_html').val());

            // Make an Ajax request to populate all role names and edit buttons
/*            $.ajax({
                type: 'GET',
                url: "{{url('all_sites')}}",
                beforeSend: function() {
                                            $('#loader').removeClass('hidden');
                                            $("#loading").show();
                                        },
                                        complete: function() {
                                            $("#loading").hide();
                                        }, // Replace with the actual route
                success: function(result) {
                    $('#loader').addClass('hidden');
                    $('#location_search').val("");
                    $('#location_search').css('background-image','url("{{ url('/assets/images/search-icon.png')}}")');       
                   
                  
                    // Clear the previous search results when the input is empty
                    $('#location_search_result').empty();
                    $('#location_search_result').html( $('#location_search_result_html').val());

                    $.each(result.locationlist, function(index, val) {
                        console.log(result.locationlist);
                        tag_green = "<span class='dotGreen'></span>";
                        tag_red = "<span class='dotRed'></span>";
                        tag_amber = "<span class='dotAmber'></span>";
                        tag_white = "<span></span>"
                        console.log(val['tl_created_by']);
                        if(val['tagging_status']!=null){
                            if(val['tagging_status']=='Green'){
                                val['tagging_status']=tag_green;
                            }else if(val['tagging_status']=='Orange'){
                                val['tagging_status']=tag_amber;
                            }else if(val['tagging_status']==' '){
                                val['tagging_status']=tag_white;
                            }else{
                                val['tagging_status']=tag_red;
                            }
                        }
                       
                        $('#location_search_result').append(
                        '<tr class="tablehover" style="cursor:pointer" data-id="' + val['tl_location_id'] +
                        '" onclick="getdetails(this)"> <td>' +  val['tl_location_code'] + '</td><td>' +  val['tl_location_name'] +
                        '</td><td>' +  val['created_at'].split(' ')[0] + '</td><td>' +  val['tagging_status'] + '</td></tr>');
                       
                    });
                }
            });*/
        
    }
                            </script>

                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v8.1.0/ol.css">
                            <script src="https://cdn.jsdelivr.net/npm/ol@v8.1.0/dist/ol.js"></script>
                            <script>
                                function getdetails(e) {
                                    //console.log(val);
                                    $('#location_search_result').find('.table_color').each(function() {
                                        $(this).removeClass("table_color");
                                    });
                                    $(e).addClass('table_color');
                                    var location_id=$(e).data("id");
                                    $.ajax({
                                        type: "GET",
                                        url: "{{ url('locationdb') }}",
                                        data: {
                                            'location_id': $(e).data("id"),
                                        },
                                        beforeSend: function() {
                                            $('#loader').removeClass('hidden');
                                            $("#loading").show();
                                        },
                                        complete: function() {
                                            $("#loading").hide();
                                        },
                                        success: function(result) {
                                           
                                             
                                            tag_green = "<span class='dotGreen'></span>";
                                            tag_amber = "<span class='dotAmber'></span>";
                                            tag_red = "<span class='dotRed'></span>";
                                            $('#loader').addClass('hidden');

                                            if (result.status == 'success') {
                                                
                                                 $('#nav-passive').show();
                                                $('#location_dynamic_attribute').empty();
                                              
                                                if (result.data.tl_location_code != '') {
                                                    $('#location_code').html(result.data.tl_location_code)
                                                }
                                                if (result.data.tl_location_address != '') {
                                                    $('#location_address').html(result.data.tl_location_address)
                                                }

                                                if (result.data.created_at != null) {

                                                    var creationdate = result.data.created_at;
                                                    $('#location_creation_date').html(creationdate)

                                                }

                                                if (result.data.tl_location_description != '') {
                                                    $('#location_description').html(result.data.tl_location_description)
                                                }
                                                if (result.data.tl_created_by != null) {

                                                    $('#location_created_by').html(result.data.tl_created_by)
                                                } else {
                                                    $('#location_created_by').html("Administrator")
                                                }
                                                if (result.data.location_name != '') {
                                                    $('#location_name').html(result.data.tl_location_name)
                                                }

                                                
                                                if (result.data.tl_location_code != '' || result.data.tl_location_name != '') {
                                                    $('#locationNamePannel').html(result.data.tl_location_code + '-' + result.data
                                                        .tl_location_name)
                                                }
                                                if (result.data.la_location_attribute_description != '') {
                                                    $('#location_attribute_description').html(result.data
                                                        .la_location_attribute_description)
                                                }

                                            }

                                            // Attributes value

                                            $("#owner_attr_value").empty();
                                            $("#table_Data_active").empty();
                                            $("#table_Data_passive").empty();
                                            $("#tablehistory_Data_active").empty();
                                            $("#tablehistory_Data_passive").empty();
                                            var count = 0;
                                            var strattribute = '<div class="row mt-3 p-3">';
                                            $.each(result.location_attribute_description, function(key, val) {

                                                //console.log(val['locationAllAttr']['la_location_type_id']);
                                                if (val['locationAllAttr'] != null) {
                                                    if (val['locationAllAttr']['la_location_type_id'] != 0) {
                                                        if (val['tla_location_attribute_value_text'] == null) {
                                                            var attr_value = '';
                                                        } else {
                                                            var attr_value = val['tla_location_attribute_value_text'];
                                                        }


                                                        $('#owner_attr_value').append(
                                                            '<div class="col-6 col-sm-6 text-muted" style="display: inline-grid;"><div><label>' +
                                                            val['tla_location_attribute_name'] +
                                                            ' </label></div> <div><strong> ' + attr_value +
                                                            ' </strong></div></div>');
                                                    }


                                                    if (val['locationAllAttr']['la_location_type_id'] == 0) {
                                                        count++;
                                                        if (val['tla_location_attribute_value_text'] == null) {
                                                            var attr_value = '';
                                                        } else {
                                                            var attr_value = val['tla_location_attribute_value_text'];
                                                        }


                                                        strattribute = strattribute +
                                                            ' <div class="col"><div class="col-6 col-sm-6 " style="display: inline-grid;"><div><label>' +
                                                            val['tla_location_attribute_name'] +
                                                            ' </label></div> <div><strong> ' +
                                                            attr_value + ' </strong></div></div></div>';
                                                        if (count % 2 == 0) {
                                                            strattribute = strattribute + '</div><div class="row mt-3 p-3">';
                                                           
                                                        }
                                                    }
                                                }
                                            });
                                            $('#location_dynamic_attribute').append(strattribute);


                                            var i = 0;
                                            $.each(result.location_asset, function(key, val) {
                                                console.log(result.location_asset);
                                                console.log(val['ta_asset_id']);
                                                if(val['ta_asset_id']!=null){
                                                    var asset_id = val['ta_asset_id'];

                                                }
                                               
                                                
                                                //console.log(asset_id);
                                                if (val['ta_asset_catagory'] != null) {
                                                    //alert("mmm");
                                                    if (val['ta_asset_catagory'].toUpperCase() == 'ACTIVE') {
                                                        var active = "";
                                                        if (i > 15) {
                                                            //console.log(val);
                                                            $(".asstasactive i").show();

                                                            var active = "siteasactive";
                                                        } else {
                                                            $(".asstasactive i").hide();
                                                        }


                                                        if (val['ta_asset_tag_number'] == null) {

                                                            var tag_no = '';
                                                        } else {
                                                            var tag_no = val['ta_asset_tag_number'];
                                                        }
                                                        if (val['ta_asset_active_inactive_status'] == null) {
                                                            var asset_status = '';
                                                        } else {
                                                            var asset_status = val['ta_asset_active_inactive_status'];
                                                        }
                                                        if (val['AssetType'] == null) {
                                                            var asset_type = '';
                                                        } else {
                                                            var asset_type = val['AssetType'];
                                                        }
                                                        if (val['operators'] == null) {
                                                            var operator = '';
                                                        } else {
                                                            var operator = val['operators'];
                                                        }
                                                        if (val['ta_asset_tag_number'] != null) {

                                                            $('#table_Data_active').append('<tr class="tablehover ' + active +
                                                                ' " ><td>' + asset_type +
                                                                '</td><td><a href="#"  onclick="assetdetails(' + asset_id +
                                                                ');"> ' +
                                                                val['ta_asset_name'] + '</a></td><td>' + operator +
                                                                '</td><td>' + val[
                                                                    'ta_asset_manufacture_serial_no'] + '</td><td>' +
                                                                tag_no +
                                                                '</td><td>' + asset_status + '</td><td>' + tag_green +
                                                                '</td></tr>');
                                                        } else {
                                                            $('#table_Data_active').append('<tr class="tablehover ' + active +
                                                                ' " ><td>' + asset_type +
                                                                '</td><td><a href="#"  onclick="assetdetails(' + asset_id +
                                                                ');"> ' +
                                                                val['ta_asset_name'] + '</a></td><td>' + operator +
                                                                '</td><td>' + val[
                                                                    'ta_asset_manufacture_serial_no'] + '</td><td>' +
                                                                tag_no +
                                                                '</td><td>' + asset_status + '</td><td>' + tag_red +
                                                                '</td></tr>');

                                                        }
                                                    }

                                                    if(val['child_HTML_Active']!=""){
                                                        $('#table_Data_active').append(val['child_HTML_Active']);
                                                     }
                                            

                                                  
                                                    if (val['ta_asset_catagory'].toUpperCase() == 'PASSIVE') {

                                            
                                                        if (val['AssetType'] == null) {
                                                            var asset_type = '';
                                                        } else {
                                                            var asset_type = val['AssetType'];
                                                        }
                                                        if (val['ta_asset_tag_number'] == null) {
                                                            var tag_no = '';

                                                        } else {
                                                            var tag_no = val['ta_asset_tag_number'];
                                                        }
                                                        if (val['ta_asset_active_inactive_status'] == null) {
                                                            var asset_status = '';
                                                        } else {
                                                            var asset_status = val['ta_asset_active_inactive_status'];
                                                        }

                                                        var active = "";
                                                        if (i > 15) {
                                                            //console.log(key + val);alert("h");

                                                            $(".asstaspassive i").show();

                                                            var active = "siteaspassive";
                                                        } else {
                                                            $(".asstaspassive i").hide();
                                                        }


                                                        if (val['ta_asset_tag_number'] != null) {
                                                            $('#table_Data_passive').append('<tr class="tablehover ' + active +
                                                                '"><td>' + asset_type +
                                                                '</td><td><a href="#"  onclick="assetdetails(' + asset_id +
                                                                ');">' + val[
                                                                    'ta_asset_name'] + '</td><td>' + val[
                                                                    'ta_asset_manufacture_serial_no'] + '</td><td>' +
                                                                tag_no +
                                                                '</td><td>' + asset_status + '</td><td>' + tag_green +
                                                                '</td></tr>');

                                                        } else {
                                                            $('#table_Data_passive').append('<tr class="tablehover ' + active +
                                                                '"><td>' + asset_type +
                                                                '</td><td><a href="#"  onclick="assetdetails(' + asset_id +
                                                                ');">' + val[
                                                                    'ta_asset_name'] + '</td><td>' + val[
                                                                    'ta_asset_manufacture_serial_no'] + '</td><td>' +
                                                                tag_no +
                                                                '</td><td>' + asset_status + '</td><td>' + tag_red +
                                                                '</td></tr>');

                                                        }
                                                     if(val['child_HTML_Passive']!=""){
                                                        $('#table_Data_passive').append(val['child_HTML_Passive']);
                                                     }
                                               

                                                  }


                                                 }


                                            });

                                    
                                        //   Site Asset History 
                                        $.each(result.Site_Asset_History, function(key, val) {
                                            console.log(val.asset_data);
                                            if(val.asset_data!=""){
                                            var asset_history=JSON.parse(val.asset_data);
                                            //console.log(asset_history.ta_asset_name);
                                            var asset_id=asset_history.ta_asset_id;
                                            var tag_number11="";
                                            //var location_id=asset_history.ta_asset_location_id;
                                            
                                            var operator=asset_history.Operator_Name;
                                            var status="";
                                            if(asset_history.
                                                ta_asset_tag_number==null){
                                                   tag_number11="";
                                                }else{
                                                    tag_number11=asset_history.
                                                ta_asset_tag_number;
                                                }
                                              if(asset_history['attr']){
                         
                            Object.entries(asset_history['attr']).forEach(([key1,value1]) => {
                         
                              if(value1['at_asset_attribute_value_text']=='' || value1['at_asset_attribute_value_text']==null)
                              {
                                value1['at_asset_attribute_value_text']="";
                              }
                              if(value1['at_asset_attribute_name']==="Status")
                              {
                                status=value1['at_asset_attribute_value_text'];
                              }
                             console.log(status);
                             
                            });
                            //console.log(status);
                           }
                        if ((asset_history.ta_asset_catagory).toUpperCase()== 'ACTIVE'){
                         
                            console.log(status);   
                                            if(tag_number11!="") {

                                    $('#tablehistory_Data_active').append('<tr class="tablehover" ><td>' + asset_history.Asset_Type +
                                        '</td><td><a  href="#" onclick="asset_details('+asset_id+','+location_id+');"> ' +
                                        asset_history.ta_asset_name + '</a></td><td>' + operator +
                                        '</td><td>' + asset_history.
                                            ta_asset_manufacture_serial_no + '</td><td>'+tag_number11+
                                        '</td><td>' + tag_green +
                                        '</td></tr>');
                                    } else {
                                    $('#tablehistory_Data_active').append('<tr class="tablehover" ><td>' + asset_history.Asset_Type +
                                        '</td><td><a  href="#" onclick="asset_details('+asset_id+','+location_id+');"> ' +
                                        asset_history.ta_asset_name + '</a></td><td>' + operator +
                                        '</td><td>' + asset_history.
                                            ta_asset_manufacture_serial_no + '</td><td>' +
                                                tag_number11 +
                                        '</td><td>'+tag_red+
                                        '</td></tr>');

                                    }
                                           }
                                           if ((asset_history.ta_asset_catagory).toUpperCase() == 'PASSIVE') {
                                      
                                            if (tag_number11!="") {

                                    $('#tablehistory_Data_passive').append('<tr class="tablehover " ><td>' + asset_history.Asset_Type +
                                        '</td><td><a  href="#" onclick="asset_details('+asset_id+','+location_id+');"> ' +
                                        asset_history.ta_asset_name + '</a></td><td>' + asset_history.
                                            ta_asset_manufacture_serial_no + '</td><td>' +
                                                tag_number11+
                                        '</td><td>' + tag_green +
                                        '</td></tr>');
                                    } else {
                                    $('#tablehistory_Data_passive').append('<tr class="tablehover" ><td>' + asset_history.Asset_Type +
                                        '</td><td><a  href="#" onclick="asset_details('+asset_id+','+location_id+');"> ' +
                                        asset_history.ta_asset_name + '</a></td><td>' + asset_history.
                                            ta_asset_manufacture_serial_no + '</td><td>' +
                                                tag_number11+
                                        '</td><td>'+tag_red+
                                        '</td></tr>');

                                    }

                                           }
                                        }
                                            });



                                        }
                                    })
                                   // $('#'+$(e).data("activeTab")).click(); 
                                    $("#nav-details-tab").removeClass('active');
                                     $("#nav-details").removeClass('active');
                                    
                                    $("#nav-assets-tab").click();
                                    $("#nav-profile-tab").click();
                                   
                                };


                                const showImage = () => {

                                    document.getElementById("location_search").style.display = 'none';
                                    document.getElementById("map").style.display = 'block';
                                    //     document.getElementById("map_part").style.display = 'block';

                                    let map;


                                    initMap();
                                    //  document.getElementById("closebtn").style.display = 'block';
                                    document.getElementById("topclass").style.display = 'none';

                                }
                                const closeImage = () => {
                                    document.getElementById("location_search").style.display = 'block';
                                    document.getElementById("map").style.display = 'none';
                                    //  document.getElementById("map_part").style.display = 'none';
                                    //   document.getElementById("closebtn").style.display = 'none';
                                    document.getElementById("topclass").style.display = 'revert';

                                }
                            </script>
                  
                            <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap&v=weekly" defer>
                            </script>
                            <script>
                                function initMap() {

                                    if (navigator.geolocation) {
                                        navigator.geolocation.getCurrentPosition(
                                            (position) => {

                                                const mapOptions = {
                                                    zoom: 11,
                                                    center: {
                                                        lat: position.coords.latitude,
                                                        lng: position.coords.longitude
                                                    },
                                                };

                                                map = new google.maps.Map(document.getElementById("map"), mapOptions);
                                                marker = new google.maps.Marker({
                                                    position: {
                                                        lat: position.coords.latitude,
                                                        lng: position.coords.longitude
                                                    },
                                                    icon: {
                                                        path: google.maps.SymbolPath.CIRCLE,
                                                        strokeColor: "blue",
                                                        scale: 6,

                                                    },
                                                    title: "Current Location",
                                                    map: map,
                                                });
                                                var infowindow = new google.maps.InfoWindow({
                                                    content: "Current Location (" + position.coords.latitude + "," + position.coords
                                                        .longitude + ")",

                                                });
                                                marker.addListener("click", () => {
                                                    infowindow.close();
                                                    infowindow.open({
                                                        anchor: marker,
                                                        map,
                                                    });
                                                });
                                                @foreach($locationlist as $index => $locations)
                                                 <?php 
                                                    $asset1='<div class="container">';
                                                     
                                                     foreach($locations->assets_site as $asset)
                                                      {
                                                        if(strtoupper($asset->ta_asset_catagory) == 'PASSIVE') {
                                                        $asset1.='<div class="row">';
                                                        $asset1.='<div class="col-10 tablehover" style="text-align:left;"><strong>'.$asset->ta_asset_name.'</strong></div><div class="col-2 tablehover">';
                                                        if(is_null($asset->ta_asset_tag_number)){
                                                         $asset1.='<span class=dotRed></span>';
                                                        }else{
                                                          $asset1.= '<span class=dotGreen></span>';
                                                        }
                                                       $asset1.="</div></div>";
                                                      }
                                                      }
                                                    $asset1.="</div>";
                                                  
                                                  ?>
                                                
                                                    @if ($locations->tl_location_latitude != '')
                                                    
                                                        var marker{{ $index }} = new google.maps.Marker({
                                                            position: {
                                                                lat: {{ $locations->tl_location_latitude }},
                                                                lng: {{ $locations->tl_location_longitude }}
                                                            },
                                                            icon: {
                                                                url: 'http://maps.google.com/mapfiles/marker_{{  !empty(strtolower($locations->tagging_status)) ? str_replace("red","white",strtolower($locations->tagging_status)) : "white"  }}.png',
                                                            },
                                                       
                                                            title: "{{ $locations->tl_location_code . '-' . $locations->tl_location_name }}",

                                                            map: map,
                                                        });
                                                        var infowindow{{ $index }} = new google.maps.InfoWindow({
                                                            content: '<div class="tablehover" style="cursor:pointer; text-align:center;min-width:200px;" data-id="{{ $locations->tl_location_id }}" data-activeTab="nav-profile-tab" onclick="getdetails(this)"> <strong>{{ $locations->tl_location_code . '-' . $locations->tl_location_name }} </strong><br />{{ $locations->tl_location_address }}<br /><br /> {!! $asset1 !!}</div>',

                                                        });
                                                        marker{{ $index }}.addListener("click", () => {
                                                            infowindow{{ $index }}.open({
                                                                anchor: marker{{ $index }},
                                                                map,
                                                            });
                                                        });
                                                    @endif
                                                @endforeach

                                            },

                                        );
                                    }


                                    // You can use a LatLng literal in place of a google.maps.LatLng object when
                                    // creating the Marker object. Once the Marker object is instantiated, its
                                    // position will be available as a google.maps.LatLng object. In this case,
                                    // we retrieve the marker's position using the
                                    // google.maps.LatLng.getPosition() method.

                                }

function asset_details(asset_id,location_id){
            $.ajax({
                type: "GET",       
             
                url: "{{url('history_site_assets')}}",
                data:{
                    'location_id' : location_id,
                    'asset_id':asset_id,
                },
                success: function(result) {
                    console.log(result);
                
                if(result.status == 'success'){
                //     alert("vhhg");
                //     console.log(result.Site_Asset_Data[0]['asset_data']);
                // }
                
                //   $('#asset_history').empty();
                  $('#Site_single_asset_table').empty();
                  var fixedattr="";
                  var dynamiattr="";
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
                        if(site_assets.ta_asset_image!=""){
                            image=site_assets.ta_asset_image;
                        }
                        else{
                            image="";
                        }
                        
                        $("#SiteAssetHistoryModal").html(site_assets.Asset_Type+'-'+site_assets.ta_asset_name);
                        
                            $('#Site_single_asset_table').append('<tr style="padding:0 !important"><td>Site Name</td><td>'+site_assets.Site_Name+'</td></tr><tr><td>Site Code</td><td>'+site_assets.Site_Code+'</td></tr><tr><td>Parent Asset Name</td><td>'+parent_asst_name+'</td></tr><tr><td>Asset Name</td><td>'+site_assets.ta_asset_name+'</td></tr><tr><td>Serial Number</td><td>'+site_assets.ta_asset_manufacture_serial_no+'</td></tr><tr><td>Tag Number</td><td>'+site_assets.ta_asset_tag_number+'</td></tr><tr><td>Asset Image</td><td><img style="width: 100px;" src="'+image+'"></td></tr>');
                       
                      
                          //$('#Site_single_asset_table').append('<tr  style="padding:0 !important"><td>'+site_assets.Site_Name+'</td></tr><tr><td>Tag Number</td><td>'+site_assets.Site_Code+'</td></tr><tr><td>Parent Asset Name</td><td>'+parent_asst_name+'</td></tr><tr><td>Asset Name</td><td>'+site_assets.ta_asset_name+'</td></tr><tr><td>Serial Number</td><td>'+site_assets.ta_asset_manufacture_serial_no+'</td></tr>');    

                       
                           
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
                           
                           Object.entries(result.Tag_history).forEach(([key2,value2]) => {
                            //console.log(result.Tag_history[0]);
                          //   console.log(value2['th_asset_tag_number']); 
                            
                            asset_tag_history=asset_tag_history+'<tr><td style="text-align:left">'+value2['created_at']+'</td><td>'+value2['th_asset_tag_number']+'</td><td>'+value2['UserName']+'</td></tr>';
                            });
                        //   console.log(asset_tag_history);
                           

                 
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
                    $('#Site_single_asset_table').append(fixedattr+dynamiattr+asset_tag_history);
                     $('#siteassetdetailsmodal').modal('toggle');
                 
                       
                        
                       
                      
               
                }
              
                
              }

                
            })

        }

                            </script>
                        @endsection
