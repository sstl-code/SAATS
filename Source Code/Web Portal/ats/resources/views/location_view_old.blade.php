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

        .siteaspassive {
            display: none;
        }

        .asstasactive i {
            display: none;
        }

        .asstaspassive i {
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
        .applybutton{
            font-size: 16px;
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
                    Site List

                    <div class="input-with-icon">
                        <input type="text" class="input-field Search search_operatorsite"
                            style="height: 31px;width: 189px;" id="location_search" placeholder="Search Site">
                        <ul id="suggestionsList"></ul>
                        <i class="input-icon fa-solid fa-rotate-right" onclick="handleIconClick()"></i>
                    </div>


                </div>

                <div class="card-header">
                    <input id="track" type = "checkbox" style="background-color: white" name="filter">Apply Map Filter
                    <button onclick="showImage()" class="viewmapbutton" 
                        >View Map</button>
                    <div id="map_part"class="row my-4">
                        <div class="col-md-4"><input id="box" class="mx-2"type="text"
                            style="width: 100%; display:none;" placeholder="Type Radius"></div>
                        <div class="col-md-2">
                            <input type="text" id="unit" style="width:100%; display: none;" value="KM" disabled/>
                            <!-- <button  class="btn btn-secondary btn-sm dropdown-toggle"
                            style="width: auto;color: black;background-color: white; border-radius: 0; display:none;"type="button"
                            data-toggle="dropdown" aria-expanded="false">KM</button> -->
                        </div>
                        <div class="col-md-2"><button id="apply" class="viewmapbutton applybutton " 
                            style=" display:none;">Apply</button></div>
                        <div class="col-md-4"><button onclick="closeImage()" id="closebtn" class="viewmapbutton" 
                            style="width:100%; display:none;">Close Map</button></div>
                        <!-- <input id="box" class="mx-2"type="text"
                            style="width: 112px; display:none;" placeholder="Type Radius">
                        <button id="unit" class="btn btn-secondary btn-sm dropdown-toggle"
                            style="width: auto;color: black;background-color: white; border-radius: 0; display:none;"type="button"
                            data-toggle="dropdown" aria-expanded="false">KM</button>

                        <button id="apply" class="viewmapbutton applybutton mx-2" align="right"
                            style="width: auto; display:none;">Apply</button>
                        <button onclick="closeImage()" id="closebtn" class="viewmapbutton" align="right"
                            style="width:auto; display:none;">Close Map</button> -->
                    </div>
                </div>

            </div>
            <form method="post" id="frmlatlong">
                @csrf
                <input type="hidden" id="maplongitude" name="lng">
                <input type="hidden" id="maplatitude" name="lat">
                <input type="hidden" id="mapradius" name="radius">
            </form>
            {{-- Site table
<div class="row mx-2">
<div class="col-sm-4 my-2 padding-right assetTableSide ">
   --}}
            <div id="map" class="mapouter">
                <style>
                    .mapouter {
                        position: relative;
                        text-align: right;
                        height: 494px;
                        display: none
                    }
                </style>
                {{-- <div class="gmap_canvas">
                    <iframe width="411" height="494" id="gmap_canvas"
                        src="https://maps.google.com/maps?q=saltlake&t=&z=10&ie=UTF8&iwloc=&output=embed" frameborder="0"
                        scrolling="no" marginheight="0" marginwidth="0">
                    </iframe><a href="https://2yu.co">2yu</a><br>
                  
                    <a href="https://embedgooglemap.2yu.co">html embed google map</a>
                    <style>
                        .gmap_canvas {
                            overflow: hidden;
                            background: none !important;
                            height: 494px;
                            width: 419px;
                            display: block
                        }
                    </style>
                </div> --}}
            </div>
            <div id="info" style="display: none;"></div>
            <div class="locationsite my-2">
                <div class="table_card">
                    <table id="topclass" class="table table-bordered " style="">
                        <thead style="position: sticky;top: -1px;background:#E5FCFF;">
                            <tr class="tableheadcolor">
                                <th class="tableheadborder" scope="col">Site ID </th>
                                <th class="tableheadborder" scope="col">Site Name</th>

                                <th class="tableheadborder" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="location_search_result">
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($locationlist as $locationTable)
                                <?php // echo "<pre>";print_r($locationTable);die();
                                ?>
                                <tr style="cursor:pointer" onclick="getdetails(this);"
                                    data-id='{{ $locationTable->tl_location_id }}' class="tablehover <?php if ($i > 10) {
                                        echo 'noactive"';
                                    } ?>">


                                    <td>{{ $locationTable->tl_location_code }}</td>
                                    <td>{{ $locationTable->tl_location_name }}</td>

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



                                    <div id='location_creation_date'></div>




                                </div>

                                <div class="col">

                                    <div class="col-6 col-sm-4">Site Name</div>
                                    <p><b id='location_name'></b></p>




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
                                {{-- <button class="nav-link active" id="nav-home-tab" style="color: gray;box-shadow: 2px 2px 2px 2px; background-color: #EBEF2;" data-bs-toggle="tab" data-bs-target="#nav-Active" type="button" role="tab" aria-controls="nav-home" aria-selected="true">ACTIVE</button>
            <button class="nav-link" id="nav-profile-tab" style="color: gray;box-shadow: 2px 2px 2px 2px; background-color: #EBEF2;" data-bs-toggle="tab" data-bs-target="#nav-passive" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">PASSIVE</button> --}}
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
                                    <table class="table table-bordered">
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
                                <i class="fa-solid fa-angle-down dropdown_2"
                                    style="
                  margin-left: 442px;
                  margin-top: 5px;"
                                    onclick="showdpdwnactive();"></i>
                            </div>
                            {{-- Passive asset table --}}
                            <div class="tab-pane asstaspassive fade" id="nav-passive" role="tabpanel"
                                aria-labelledby="nav-profile-tab">
                                {{-- 
            <div class="card">
               --}}
                                <div class="row ">
                                    {{-- 
                  <div class="" style="margin-top: 4px">
                     --}}
                                    <div class="col  table_card">
                                        <table class="table table-bordered">
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
                                <i class="fa-solid fa-angle-down dropdown_2"
                                    style="
                  margin-left: 442px;
                  margin-top: 5px;"
                                    onclick="showdpdwnpassive();"></i>
                            </div>

                            </body>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                            <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
                            <link rel="stylesheet"
                                href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
                            <script>
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

                                function showdpdwnpassive() {



                                    $('.siteaspassive').toggle();
                                    if ($(".asstaspassive i").hasClass('fa-angle-down')) {
                                        $(".asstaspassive i").removeClass('fa-angle-down').addClass('fa-angle-up');
                                    } else {
                                        $(".asstaspassive i").removeClass('fa-angle-up').addClass('fa-angle-down');
                                    }

                                }


                                // $(document).ready(function() {
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
                                                '</td><td>' + tag_green + '</td></tr>');
                                        } else if (ui.item.tagging_status == 'Orange') {
                                            $('#location_search_result').html(
                                                '<tr class="tablehover" style="cursor:pointer" data-id="' + ui.item.tl_location_id +
                                                '" onclick="getdetails(this)"> <td>' + ui.item.value + '</td><td>' + ui.item.label +
                                                '</td><td>' + tag_amber + '</td></tr>');
                                        } else if (ui.item.tagging_status == '') {
                                            $('#location_search_result').html(
                                                '<tr class="tablehover" style="cursor:pointer" data-id="' + ui.item.tl_location_id +
                                                '" onclick="getdetails(this)"> <td>' + ui.item.value + '</td><td>' + ui.item.label +
                                                '</td><td>' + tag_white + '</td></tr>');
                                        } else {

                                            $('#location_search_result').html(
                                                '<tr class="tablehover" style="cursor:pointer" data-id="' + ui.item.tl_location_id +
                                                '" onclick="getdetails(this)"> <td>' + ui.item.value + '</td><td>' + ui.item.label +
                                                '</td><td>' + tag_red + '</td></tr>');
                                        }
                                        // Perform actions with the selected value
                                        //console.log("Selected: " + selectedValue);

                                        // Prevent the default behavior of filling the input with the selected value
                                        event.preventDefault();
                                    }
                                });
                                // });
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
                                            // console.log(result.data);
                                            tag_green = "<span class='dotGreen'></span>";
                                            tag_amber = "<span class='dotAmber'></span>";
                                            tag_red = "<span class='dotRed'></span>";
                                            $('#loader').addClass('hidden');

                                            if (result.status == 'success') {

                                                $('#location_dynamic_attribute').empty();
                                                $('#location_creation_date').empty();
                                                if (result.data.tl_location_code != '') {
                                                    $('#location_code').html(result.data.tl_location_code)
                                                }
                                                if (result.data.tl_location_address != '') {
                                                    $('#location_address').html(result.data.tl_location_address)
                                                }

                                                if (result.data.tl_creation_date != null) {

                                                    var creationdate = result.data.tl_creation_date;
                                                    var text1 = creationdate;
                                                    const myArray1 = text1.split(" ");
                                                    var word1 = myArray1[0];
                                                    const MInDate = word1;
                                                    const date = MInDate.split('-');
                                                    var newDate = date[2] + '/' + date[1] + '/' + date[0];

                                                    $('#location_creation_date').append(
                                                        '<div class="col-6 col-sm-6 text-muted" style="display: inline-grid;" >Creation Date</div><div><label><strong>' +
                                                        newDate + '</strong></label><div>')
                                                }
                                                if (result.data.tl_location_description != '') {
                                                    $('#location_description').html(result.data.tl_location_description)
                                                }
                                                if (result.data.location_name != '') {
                                                    $('#location_name').html(result.data.tl_location_name)
                                                }

                                                // if (result.data.tl_location_latitude != '' || result.data.tl_location_longitude != '') {
                                                //     $('#location_lat').html(result.data.tl_location_latitude + '/' + result.data
                                                //         .tl_location_longitude)
                                                // }
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
                                            var count = 0;
                                            var strattribute = '<div class="row mt-3 p-3">';
                                            $.each(result.location_attribute_description, function(key, val) {

                                                //console.log(val['locationAllAttr']['la_location_type_id']);
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
                                                        val['tla_location_attribute_name'] + ' </label></div> <div><strong> ' +
                                                        attr_value + ' </strong></div></div></div>';
                                                    if (count % 2 == 0) {
                                                        strattribute = strattribute + '</div><div class="row mt-3 p-3">';
                                                        //$('#location_dynamic_attribute').append('</div></div><div class="row mt-3 p-3">');
                                                    }
                                                }
                                            });
                                            $('#location_dynamic_attribute').append(strattribute);


                                            var i = 0;
                                            $.each(result.location_asset, function(key, val) {
                                                //console.log(result.location_asset[0]['assets_site']);
                                                var asset_id = val['ta_asset_id'];
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


                                                        //

                                                        //console.log(val['childs']);
                                                        //var asset_id=0;
                                                        $.each(val['childs'], function(key2, val2) {
                                                            var asset_id = val2['ta_asset_id'];
                                                            if (val2['AssetType'] == null) {
                                                                var asset_type = '';
                                                            } else {
                                                                var asset_type = val2['AssetType'];
                                                            }

                                                            if (val2['ta_asset_tag_number'] == null) {
                                                                var tag_no = '';
                                                            } else {

                                                                var tag_no = val2['ta_asset_tag_number'];
                                                            }
                                                            if (val2['ta_asset_active_inactive_status'] == null) {
                                                                var asset_status = '';
                                                            } else {
                                                                var asset_status = val2[
                                                                    'ta_asset_active_inactive_status'];
                                                            }
                                                            if (val2['operators'] == null) {
                                                                var operator = '';
                                                            } else {
                                                                var operator = val2['operators'];
                                                            }
                                                            if (val2['ta_asset_tag_number'] != null) {
                                                                $('#table_Data_active').append(
                                                                    '<tr class="tablehover ' + active +
                                                                    ' " ><td>' + asset_type +
                                                                    '</td><td><a href="#" onclick="assetdetails(' +
                                                                    asset_id +
                                                                    ');">' + val2['ta_asset_name'] +
                                                                    '<img src="{{ url('/assets/images/icon_group.png') }}" width="41px"></td><td>' +
                                                                    operator + '</td><td>' + val2[
                                                                        'ta_asset_manufacture_serial_no'] +
                                                                    '</td><td>' +
                                                                    tag_no + '</td><td>' + asset_status +
                                                                    '</td><td>' +
                                                                    tag_green + '</td></tr>');
                                                            } else {
                                                                $('#table_Data_active').append(
                                                                    '<tr class="tablehover ' + active +
                                                                    ' " ><td>' + asset_type +
                                                                    '</td><td><a href="#" onclick="assetdetails(' +
                                                                    asset_id +
                                                                    ');">' + val2['ta_asset_name'] +
                                                                    '<img src="{{ url('/assets/images/icon_group.png') }}" width="41px"></td><td>' +
                                                                    operator + '</td><td>' + val2[
                                                                        'ta_asset_manufacture_serial_no'] +
                                                                    '</td><td>' +
                                                                    tag_no + '</td><td>' + asset_status +
                                                                    '</td><td>' +
                                                                    tag_red + '</td></tr>');

                                                            }

                                                        });







                                                        i++;
                                                    }


                                                    //console.log(result.location_asset_passive_child);
                                                    if (val['ta_asset_catagory'].toUpperCase() == 'PASSIVE') {

                                                        // var asset_id=val['ta_asset_id'];

                                                        //console.log(key + val);alert("h");

                                                        //console.log(val['ta_asset_active_inactive_status']);
                                                        //console.log(val['ta_asset_tag_number']);
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

                                                        $.each(val['childs'], function(key3, val3) {

                                                            var asset_id = val3['ta_asset_id'];
                                                            if (val3['AssetType'] == null) {
                                                                var asset_type = '';
                                                            } else {
                                                                var asset_type = val3['AssetType'];
                                                            }

                                                            if (val3['ta_asset_tag_number'] == null) {
                                                                var tag_no = "";
                                                            } else {

                                                                var tag_no = val3['ta_asset_tag_number'];
                                                            }
                                                            if (val3['ta_asset_active_inactive_status'] == null) {
                                                                var asset_status = '';
                                                            } else {
                                                                var asset_status = val3[
                                                                    'ta_asset_active_inactive_status'];
                                                            }
                                                            if (val3['ta_asset_tag_number'] != null) {
                                                                $('#table_Data_passive').append(
                                                                    '<tr class="tablehover ' + active +
                                                                    ' " ><td>' + asset_type +
                                                                    '</td> <td><a href="#" onclick="assetdetails(' +
                                                                    asset_id +
                                                                    ');">' + val3['ta_asset_name'] +
                                                                    '<img src="{{ url('/assets/images/icon_group.png') }}" width="41 px"> </td><td>' +
                                                                    val3['ta_asset_manufacture_serial_no'] +
                                                                    '</td><td>' +
                                                                    tag_no + '</td><td>' + asset_status +
                                                                    '</td><td>' +
                                                                    tag_green + '</td></tr>');
                                                            } else {
                                                                $('#table_Data_passive').append(
                                                                    '<tr class="tablehover ' + active +
                                                                    ' " ><td>' + asset_type +
                                                                    '</td> <td><a href="#" onclick="assetdetails(' +
                                                                    asset_id +
                                                                    ');">' + val3['ta_asset_name'] +
                                                                    '<img src="{{ url('/assets/images/icon_group.png') }}" width="41 px"> </td><td>' +
                                                                    val3['ta_asset_manufacture_serial_no'] +
                                                                    '</td><td>' +
                                                                    tag_no + '</td><td>' + asset_status +
                                                                    '</td><td>' +
                                                                    tag_red + '</td></tr>');
                                                            }

                                                        });

                                                    }


                                                }


                                            });



                                        }
                                    })
                                };


                                const showImage = () => {

                                    document.getElementById("map").style.display = 'block';
                                    document.getElementById("closebtn").style.display = 'block';
                                    document.getElementById("topclass").style.display = 'none';

                                }
                                const closeImage = () => {

                                    document.getElementById("map").style.display = 'none';
                                    document.getElementById("closebtn").style.display = 'none';
                                    document.getElementById("topclass").style.display = 'revert';

                                }
                              
                            </script>
                            <script type='module'>
                                var Feature = ol.Feature;
                                //  import Feature from "/node_modules/ol/Feature.js";
                                // import Geolocation from "/node_modules/ol/Geolocation.js";
                                var Geolocation = ol.Geolocation;
                                var Map = ol.Map;
                                var Point = ol.geom.Point;
                                var View = ol.View;
                                var {
                                    Circle,
                                    Fill,
                                    Stroke,
                                    Style
                                } = ol.style;
                                var {
                                    OSM,
                                    Vector
                                } = ol.source;
                                var VectorSource = Vector;
                                var {
                                    Tile,
                                    Vector
                                } = ol.layer;
                                var {
                                    fromLonLat
                                } = ol.proj;
                                const view = new View({
                                    center: [0, 0],
                                    zoom: 8,
                                });

                                const map = new Map({
                                    layers: [
                                        new Tile({
                                            source: new OSM(),
                                        }),
                                    ],
                                    target: 'map',
                                    view: view,
                                });


                                const geolocation = new Geolocation({
                                    // enableHighAccuracy must be set to true to have the heading value.
                                    trackingOptions: {
                                        enableHighAccuracy: true,
                                    },
                                    projection: view.getProjection(),
                                });

                                function el(id) {
                                    return document.getElementById(id);
                                }

                                el('track').addEventListener('change', function() {
                                    geolocation.setTracking(true);
                                });

                                // update the HTML page when the position changes.


                                // handle geolocation error.
                                geolocation.on('error', function(error) {
                                    const info = document.getElementById('info');
                                    info.innerHTML = error.message;
                                    info.style.display = '';
                                });

                                const accuracyFeature = new Feature();
                                geolocation.on('change:accuracyGeometry', function() {
                                    accuracyFeature.setGeometry(geolocation.getAccuracyGeometry());
                                });

                                const positionFeature = new Feature();

                                positionFeature.setStyle(
                                    new Style({
                                        image: new Circle({
                                            radius: 6,
                                            fill: new Fill({
                                                color: '#3399CC',
                                            }),
                                            stroke: new Stroke({
                                                color: '#fff',
                                                width: 2,
                                            }),
                                        }),
                                    })
                                );

                                geolocation.on('change:position', function() {
                                    const coordinates = geolocation.getPosition();
                                    //console.log(ol.proj.transform(coordinates, 'EPSG:3857', 'EPSG:4326'));
                                    var lonlat = ol.proj.transform(coordinates, 'EPSG:3857', 'EPSG:4326');
                                    $('#maplongitude').val(lonlat[0]);
                                    $('#maplatitude').val(lonlat[1]);
                                    // get it as: alert("latitude : " + lonlat[1] + ", longitude : " + lonlat[0]);
                                    map.getView().setCenter(coordinates);
                                    positionFeature.setGeometry(coordinates ? new Point(coordinates) : null);

                                });


                                new Vector({
                                    map: map,
                                    source: new VectorSource({
                                        features: [accuracyFeature, positionFeature],
                                    }),
                                });
                          

                                jQuery('[name="filter"]').click(function() {
                                    if (jQuery('[name="filter"]:checked').length > 0) {
                                        jQuery('#box').show();
                                        geolocation.setTracking(true);
                                    } else {
                                        jQuery('#box').hide();
                                    }
                                });
                                jQuery('[name="filter"]').click(function() {
                                    if (jQuery('[name="filter"]:checked').length > 0)
                                        jQuery('#unit').show();
                                    else jQuery('#unit').hide();
                                });
                                jQuery('[name="filter"]').click(function() {
                                    if (jQuery('[name="filter"]:checked').length > 0)
                                        jQuery('#apply').show();
                                    else jQuery('#apply').hide();
                                });

                                // Refresh_Icon

                                // Function to handle icon click event
                                function handleIconClick() {
                                    // Refresh the page when the icon is clicked
                                    location.reload();
                                }
                                  $('#apply').on('click', function() {
                                            if ($('#box').val() != "") {
                                                $('#mapradius').val($('#box').val());
                                                $.ajax({
                                                        type: "POST",
                                                        url: "{{ url('mapview') }}",
                                                        data: $('#frmlatlong').serialize(),
                                                        success: function(data) {
                                                            const positionFeature1 = new Feature();
                                                            positionFeature1.setStyle(
                                                                new Style({
                                                                    image: new Circle({
                                                                        radius: 6,
                                                                        fill: new Fill({
                                                                            color: '#33CCCC',
                                                                        }),
                                                                        stroke: new Stroke({
                                                                            color: '#fff',
                                                                            width: 2,
                                                                        }),
                                                                    }),
                                                                })
                                                            );
                                                             $.each(data.data, function(key, val) {

                                                                    var coordinates1 = fromLonLat([val["tl_location_longitude"], val[
                                                                        "tl_location_latitude"]]);
                                                                    positionFeature1.setGeometry(coordinates1 ? new Point(
                                                                        coordinates1) : null);
                                                                    new Vector({
                                                                        map: map,
                                                                        source: new VectorSource({
                                                                            features: [positionFeature1],
                                                                        }),
                                                                    });

                                                                });

                                                            }
                                                        })
                                                }

                                            })
                            </script>
                            {{-- <script>
   $(document).ready( function () {
    $('#topclass').DataTable();
} );
</script> --}}
                        @endsection
