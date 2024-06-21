@extends('Layout.mainlayout')
@section('content')
    <style>
        .dataTables_filter {
            position: relative;
            right: 10px;
        }

        .nav-tabs .nav-link.active {
            background-color: none !important;
        }

        .dataTables_wrapper .dataTables_filter {
            float: right;
        }

        div.dataTables_wrapper div.dataTables_filter input {
            margin-left: 13px;
            position: relative;
            bottom: 21px;
            /* right: 42px; */
            width: 147% !important;
        }

        .dataTables_wrapper .dataTables_filter input {
            width: 100px;
            padding-right: 30px;
            /* Add space for the search icon */
            background-image: url('https://cdn3.iconfinder.com/data/icons/feather-5/24/search-512.png');
            background-repeat: no-repeat;
            /* background-position: 247px; */
            background-position: right 10px center;
            background-size: 16px 16px;
        }


        .dataTables_filter input[type="search"]::-webkit-search-cancel-button,
        .dataTables_filter input[type="search"]::-webkit-search-decoration {
            -webkit-appearance: none;
            appearance: none;
            display: none;
        }

        div.dataTables_wrapper {
            width: 98% !important;
            margin: 0 auto;
        }

        /* .dataTables_wrapper{
              margin: 0 32p;
           } */
        div#sitetable_wrapper {
            /* margin: 0 15px; */
        }

        element.style {
            position: sticky;
            top: 0;
            background: red;
        }





        /* .searchIn{
               background:url(https://cdn0.iconfinder.com/data/icons/basic-website/512/search-website-512.png) no-repeat scroll left center / 15px auto;
             } */

        .searchOut {
            background: none;
        }

        .config_table_3.table.dataTable {
            /* margin:0 0; */
            /* margin-right: -44px !important; */
            margin-left: -44px !important;
            /* border-spacing: 0; */
        }

        /* #sitetable2_filter{
           padding-left: 20px;
          background-image: url('public/assets/images/search-icon.png');
          background-repeat: no-repeat;
          background-position: left center;
        } */
        .navs {
            position: relative;
            left: 39px;


        }

        .hovbutton:hover {
            color: black !important;

        }

        .hovbutton {
            color: #808080 !important;
        }

        .navs .nav-link.active {
            text-decoration: underline;
        }

        .dataTables_info {
            display: none !important;
        }

        .modwidth {
            max-width: 80% !important;
        }

        #sitetable3 {
            width: 107% !important;
        }

        /* .hl{
           color: #808080;
        }

        .hl:hover {
         color: black;
        } */



        .hl.active {
            background-color: #EBEFF2 !important;
            color: black !important;
            font-weight: bolder !important;

        }

        .hl {
            color: gray !important;
            border-radius: 0 !important;
        }

        /* #atr_fixed_list_of_values{
           display: none !important;
        } */

        @media only screen and (max-width: 550px) {
            .config_table_3.table.dataTable {

                margin-left: 0 !important;

            }

            #sitetable3_filter {
                position: static;
            }

            .sitedynamicsearch {
                right: 0;
            }

            div.dataTables_wrapper div.dataTables_filter input {

                width: 100% !important;
            }
        }

        @media only screen and (max-width: 830px) {
            .sitedynamicsearch {
                right: 0;
            }

            .config_table_3.table.dataTable {

                margin-left: 0 !important;

            }

            #sitetable3_wrapper {
                margin: 0;
            }
        }

        .sitedynamicsearch {
            right: 0;
        }

        .config_table_3.table.dataTable {

            margin-left: 0 !important;

        }
    </style>
    <script>
        @if (session('status'))
            toastr.success('{{ session('status') }}');
        @endif
    </script>

    <div class="card col-12 mt-2">
        <div class="card-header ">
            <b>
                <h4>Configuration Management</h4>
            </b>
        </div>
    </div>


    <nav>
        <div class="nav nav-tabs configbutton mx-3" id="nav-tab" role="tablist">
            <button class="nav-link active button1" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-asset"
                type="button" role="tab" aria-controls="nav-home" aria-selected="true">Asset</button>
            <button class="nav-link button1" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-site"
                type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Site</button>
            <!--<button class="nav-link button1" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-reason" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Reason</button>-->
        </div>
    </nav>
    <div class="tab-content mx-5" id="nav-tabContent">
        {{-- Asset --}}
        <div class="tab-pane fade active show mx-3" id="nav-asset" role="tabpanel" aria-labelledby="nav-profile-tab">
            <nav>
                <div class="nav nav-tabs configsubbutton" id="nav-tab" role="tablist">
                    <button class="nav-link active button1" id="nav-home-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-asset_type" type="button" role="tab" aria-controls="nav-home"
                        aria-selected="true">Asset Type</button>
                    <button class="nav-link button1" id="nav-profile-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-asset_attribute" type="button" role="tab" aria-controls="nav-profile"
                        aria-selected="false">Attribute</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                {{-- Asset Type table --}}

                <div class="tab-pane fade show active locationsite" id="nav-asset_type" role="tabpanel"
                    aria-labelledby="nav-home-tab">
                    <div class="table_card_config">
                        <button type="button" class="btn btn-primary btn-sm point" data-bs-toggle="modal"
                            data-bs-target="#exampleModal" onclick="assetconfig_add(this)">Add Asset Type</button>

                        <table id="sitetable1"
                            class="table table-striped table-bordered my-table cell-border border table_config">
                            <thead class="thead_names" style="background:#DEEBF6;">
                                <tr>
                                    <th>ID</th>
                                    <th>Type Name</th>
                                    <th>Description</th>
                                    <th>Parent Asset Type</th>
                                    <th>Category </th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: small;">
                                <?php
                                $i = 1;
                                $y = 0;
                                ?>
                                @foreach ($assettype_details as $asttypedetails)
                                    <tr class="dataTbltdhight">
                                        <td>{{ $asttypedetails->at_asset_type_id }}</td>
                                        <td> {{ $asttypedetails->at_asset_type_name }}</td>
                                        <td>{{ $asttypedetails->at_asset_type_description }}</td>
                                        <td style="text-align: left">
                                            @if (!empty($asttypedetails->parents) && count($asttypedetails->parents) > 0)
                                                @include('parent_asset_type_text', [
                                                    'parents' => $asttypedetails->parents,
                                                    'parent_name' => $asttypedetails->at_asset_type_name,
                                                ])
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $asttypedetails->at_asset_type_category }}</td>
                                        <td>{{ $asttypedetails->at_asset_type_status }}</td>
                                        <td>

                                            <button type="button" class="edit"
                                                style="border-radius: 0;
                                 background-color: #202C55;width: 76px;"
                                                data-bs-toggle="modal" data-bs-target="#editmodal"
                                                onclick="asttypedetails(this)"
                                                data-id="{{ $asttypedetails->at_asset_type_id }}">Edit</button>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
                {{-- Asser Attribute navbar --}}
                <div class="tab-pane fade" id="nav-asset_attribute" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <nav>
                        <div class="nav nav-tabs congifbuttonasset " id="nav-tab" role="tablist">
                            <button class="nav-link active button1" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-asset_fixed" type="button" role="tab" aria-controls="nav-home"
                                aria-selected="true">Fixed</button>
                            <button class="nav-link button1" id="nav-profile-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-asset_dynamic" type="button" role="tab"
                                aria-controls="nav-profile" aria-selected="false">Dynamic</button>
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        {{-- Asset Fixed table --}}
                        <div class="tab-pane fade active show congigfixasset" id="nav-asset_fixed" role="tabpanel"
                            aria-labelledby="nav-contact-tab">
                            <div class="table_card_config">
                                <button type="button" class="btn btn-primary btn-sm point" data-bs-toggle="modal"
                                    data-bs-target="#fixedattribute" onclick="assetatrrifix_button(this)">Add
                                    Attribute</button>
                                <table id="sitetable10"
                                    class="table table-striped table-bordered my-table1 table_config cell-border"
                                    style="width:100%">
                                    <thead class="thead_names" style="background: #DEEBF6; ">
                                        <tr>
                                            <th>ID </th>
                                            <th>Attribute</th>
                                            <th>Description</th>
                                            <th>Data Type</th>
                                            <th>Fixed List of Values</th>
                                            <th>Mandatory</th>
                                            <th>Defaults Values</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="asset_type_fixed_table" style="font-size: small;">

                                        @foreach ($assetfixed_details as $assetfixed)
                                            <tr id='tr_astfix{{ $assetfixed->ata_asset_type_attribute_id }}'
                                                class="dataTbltdhight  ">
                                                <td>{{ $assetfixed->ata_asset_type_attribute_id }}</td>
                                                <td>{{ $assetfixed->ata_asset_type_attribute_name }}</td>
                                                <td>{{ $assetfixed->ata_asset_type_attribute_description }}</td>
                                                <td>{{ $assetfixed->ata_asset_type_attribute_datatype }}</td>
                                                <td>{{ $assetfixed->ata_flov }}</td>
                                                <td>{{ $assetfixed->ata_field_requiered_not_required_flag }}</td>
                                                <td>{{ $assetfixed->ata_asset_type_attribute_default_value }}</td>
                                                <td>{{ $assetfixed->ata_status }}</td>
                                                <td><button type="button" class="edit"
                                                        style="border-radius: 0;
                                    background-color: #202C55;width: 76px;"data-bs-toggle="modal"
                                                        data-bs-target="#fixedattributeedit" onclick="fixededit(this)"
                                                        data-id="{{ $assetfixed->ata_asset_type_attribute_id }}">Edit</button>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        {{-- Asset dynamic table --}}
                        <div class="tab-pane fade congigdynamicasset " id="nav-asset_dynamic" role="tabpanel"
                            aria-labelledby="nav-contact-tab">
                            <div class="table_card_cnfdyasst">
                                <button type="button" class="btn btn-primary btn-sm point"
                                    data-bs-target="#asset_attribute_dynamic" data-bs-toggle="modal"
                                    onclick="asstdynamic_button(this)">Add Attribute</button>
                                <table id="sitetable2"
                                    class="table table-striped table-bordered my-table2 cell-border table_config"
                                    style="width:100%">
                                    <thead class="thead_names" style="background: #DEEBF6;">
                                        <tr>
                                            <th>ID</th>
                                            <th>Asset Type Name</th>
                                            <th>Attribute Name</th>
                                            <th>Description</th>
                                            <th>Data Type</th>
                                            <th>Fixed List of Values</th>
                                            <th>Mandatory</th>
                                            <th>Defaults Values</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="assttypedynamic" style="font-size: small">

                                        @foreach ($asset_att_dynamic as $assetatt_dynamic)
                                            <?php
                                            $ata_asset_type_id = $assetatt_dynamic->ata_asset_type_id;
                                            if ($ata_asset_type_id == '') {
                                                $ata_asset_type_name = '';
                                            } else {
                                                $ata_asset_type_name = DB::connection('pgsql')
                                                    ->table('product.t_asset_type_master')
                                                    ->select('at_asset_type_name')
                                                    ->where('at_asset_type_id', $ata_asset_type_id)
                                                    ->first();
                                                //dd($ata_asset_type_name);
                                                $ata_asset_type_name = $ata_asset_type_name->at_asset_type_name;
                                            }
                                            
                                            ?>
                                            <tr id='tr_astdyna{{ $assetatt_dynamic->ata_asset_type_attribute_id }}'
                                                class="dataTbltdhight">
                                                <td>{{ $assetatt_dynamic->ata_asset_type_attribute_id }}</td>
                                                <td>{{ $ata_asset_type_name }}</td>
                                                <td>{{ $assetatt_dynamic->ata_asset_type_attribute_name }}</td>
                                                <td>{{ $assetatt_dynamic->ata_asset_type_attribute_description }}</td>
                                                <td>{{ $assetatt_dynamic->ata_asset_type_attribute_datatype }}</td>
                                                <td>{{ $assetatt_dynamic->ata_flov }}</td>
                                                <td>{{ $assetatt_dynamic->ata_field_requiered_not_required_flag }}</td>

                                                <td>{{ $assetatt_dynamic->ata_asset_type_attribute_default_value }}</td>
                                                <td>{{ $assetatt_dynamic->ata_status }}</td>

                                                <td> <button type="button" class="edit"
                                                        style="border-radius: 0;
                                    background-color: #202C55;width: 76px; "data-bs-target="#dynamic_edit_att"
                                                        data-bs-toggle="modal" onclick="dynamicedit(this)"
                                                        data-id="{{ $assetatt_dynamic->ata_asset_type_attribute_id }}">Edit</button>
                                                </td>

                                            </tr>
                                            <?php $i++;
                                            $y++; ?>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{-- site --}}
        <div class="tab-pane fade" id="nav-site" role="tabpanel" aria-labelledby="nav-profile-tab">
            <nav>
                <div class="nav nav-tabs congifbuttonsite" id="nav-tab" role="tablist">
                    <button class="nav-link active hl" style="background-color:transparent" id="nav-home-tab"
                        data-bs-toggle="tab" data-bs-target="#nav-site_nav" type="button" role="tab"
                        aria-controls="nav-home" aria-selected="true">Site Type</button>
                    <button class="nav-link hl" style="background-color:transparent" id="nav-profile-tab"
                        data-bs-toggle="tab" data-bs-target="#nav-site_attribute" type="button" role="tab"
                        aria-controls="nav-profile" aria-selected="false">Attribute</button>
                    <button class="nav-link hl" style="background-color:transparent" id="nav-home-tab"
                        data-bs-toggle="tab" data-bs-target="#nav-site_location" type="button" role="tab"
                        aria-controls="nav-home" aria-selected="true">Site</button>

                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                {{-- site Type table --}}
                <div class="tab-pane fade show active " id="nav-site_nav" role="tabpanel"
                    aria-labelledby="nav-home-tab">
                    <div class="table_card_site">
                        <button type="button" class="btn btn-primary btn-sm point" data-bs-toggle="modal"
                            id="addsitetype" data-bs-target="#site_add"onclick="addsite_type(this)">Add Site Type</button>

                        <table id="sitetable9"
                            class="table table-striped table-bordered config_table1 cell-border table_config"style="margin-left:0px">

                            <thead class="thead_names" style="background:#DEEBF6">

                                <tr>
                                    <th>Id</th>

                                    <th>Site Type</th>

                                    <th>Site Type Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="siteonly" style="font-size: small;">

                                @foreach ($configLocation as $sitedetails)
                                    <tr id='tr_onlysite{{ $sitedetails->lt_location_type_id }}' class="dataTbltdhight">
                                        <td>{{ $sitedetails->lt_location_type_id }}</td>

                                        <td>{{ $sitedetails->lt_location_type }}</td>
                                        <td>{{ $sitedetails->lt_location_type_status }}</td>


                                        <td>
                                            <button type="button" class="edit edtbtn"
                                                style="border-radius: 0;
                                 background-color: #202C55;width: 76px;"
                                                data-bs-toggle="modal" data-bs-target="#site_edit"
                                                onclick="siteDetails(this)"
                                                data-id="{{ $sitedetails->lt_location_type_id }}">Edit</button>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
                {{-- Site  Table --}}
                <div class="tab-pane fade show" id="nav-site_location" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="add_site_div">
                        {{-- <button type="button" id="add_site" class="btn btn-primary btn-sm point" data-bs-toggle="modal" data-bs-target="#site_add_location"onclick="addsitelocation(this)">Add Site</button> --}}

                        <button type="button" class="btn btn-primary btn-sm point" data-bs-toggle="modal"
                            id="add_site" data-bs-target="#site_add_location"onclick="addsitelocation(this)">Add
                            Site</button>


                        <table id="sitetable5"
                            class="table table-striped cell-border table-bordered config_table table_config">



                            <thead class="thead_names" style="background: #DEEBF6;">
                                <tr>
                                    <th>ID</th>
                                    <th>Site Type</th>
                                    <th>Site Code</th>
                                    <th>Name</th>
                                    <th>Site Address</th>
                                    <th>Creation Date</th>
                                    <th>Created By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="sitetypelo" style="font-size: small;">
                                @foreach ($configsite as $sitedetails)
                                    <tr id='tr_sitetype{{ $sitedetails->tl_location_id }}' class="dataTbltdhight">
                                        <td>{{ $sitedetails->tl_location_id }}</td>
                                        <td>{{ $sitedetails->tl_location_type }}</td>
                                        <td>{{ $sitedetails->tl_location_code }}</td>
                                        <td>{{ $sitedetails->tl_location_name }}</td>

                                        <td>{{ $sitedetails->tl_location_address }}</td>
                                        <td>{{ $sitedetails->created_at }}</td>
                                        <td>{{ $sitedetails->tl_created_by != null ? $sitedetails->tl_created_by : 'Administrator' }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm edtbtn"
                                                style="border-radius: 0;
                                    background-color: #202C55;width: 76px;"
                                                data-bs-toggle="modal" data-bs-target="#site_location"
                                                onclick="sitelocationDetails(this)"
                                                data-id="{{ $sitedetails->tl_location_id }}">Edit</button>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Site Attribute navbar --}}
                <div class="tab-pane fade" id="nav-site_attribute" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <nav>
                        <div class="nav nav-tabs congifbuttonasset" id="nav-tab" role="tablist"
                            style="margin-left: -32px">
                            <button class="nav-link active hl" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-sit_fixed" type="button" role="tab" aria-controls="nav-home"
                                aria-selected="true">Fixed</button>
                            <button class="nav-link hl" id="nav-profile-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-sit_dynamic" type="button" role="tab"
                                aria-controls="nav-profile" aria-selected="false">Dynamic</button>
                        </div>
                    </nav>
                    <div class="tab-content " id="nav-tabContent">
                        {{-- Attribute Fixed table --}}
                        <div class="tab-pane fade active show sitefixtable" id="nav-sit_fixed" role="tabpanel"
                            aria-labelledby="nav-contact-tab">
                            <div class="table_card_site">
                                <button type="button" class="btn btn-primary btn-sm point" id="addfixatr1"
                                    data-bs-toggle="modal" data-bs-target="#atr_add" onclick="addfixatr(this)">Add
                                    Attribute</button>
                                <table id="sitetable4"
                                    class="table table-striped table-bordered cell-border config_table_2 table_config"
                                    style="width:100%">
                                    <thead class="thead_names" style="background:#DEEBF6">
                                        <tr>
                                            <th>ID</th>
                                            <th>Attribute</th>
                                            <th>Description</th>
                                            <th>Data Type</th>
                                            <th>Fixed List of Values</th>
                                            <th>Mandatory</th>
                                            <th>Default Value</th>
                                            <th>Display</th>
                                            <th>Editable</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody id="sitefixedtable" style="font-size: small;">
                                        <?php
                                        $y = 0;
                                        ?>
                                        @foreach ($config_fixed_attribute as $fixed_attr)
                                            <tr id='tr_sitefix{{ $fixed_attr->la_location_attribute_id }}'
                                                class="dataTbltdhight">
                                                <td>{{ $fixed_attr->la_location_attribute_id }}</td>
                                                <td>{{ $fixed_attr->la_location_attribute_name }}</td>
                                                <td>{{ $fixed_attr->la_location_attribute_description }}</td>
                                                <td>{{ $fixed_attr->la_location_attribute_datatype }}</td>
                                                <td>{{ $fixed_attr->la_flov }}</td>
                                                <td>{{ $fixed_attr->la_requiered_not_required_flag }}</td>
                                                <td>{{ $fixed_attr->la_location_attribute_default_value }}</td>
                                                <td>{{ $fixed_attr->la_display }}</td>
                                                <td>{{ $fixed_attr->la_editable }}</td>
                                                <td>{{ $fixed_attr->la_status }}</td>



                                                <td>
                                                    <button type="button" class="edit"
                                                        style="border-radius: 0;
                                       background-color: #202C55;width: 76px;"
                                                        data-bs-toggle="modal" data-bs-target="#atr_edit"
                                                        data-id="{{ $fixed_attr->la_location_attribute_id }}"
                                                        onclick="fixed_attr(this)">Edit</button>

                                                </td>
                                            </tr>
                                            <?php
                                            $y++;
                                            ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        {{-- Site dynamic table --}}
                        <div class="tab-pane fade sitedynamictable " id="nav-sit_dynamic" role="tabpanel"
                            aria-labelledby="nav-contact-tab">
                            <div class="add_dynamic">
                                <button type="button" class="btn btn-primary btn-sm point" data-bs-toggle="modal"
                                    id="adddynaatr_site" data-bs-target="#atr_dynamic" onclick="adddynaatr(this)">Add
                                    Attribute</button>
                                <table id="sitetable3"
                                    class="table table-striped table-bordered cell-border config_table_3 table_config">

                                    <thead class="thead_names" style="background:#DEEBF6">
                                        <tr>
                                            <th>ID</th>
                                            <th>Site Type</th>
                                            <th>Attribute</th>
                                            <th>Description</th>
                                            <th>Data Type</th>
                                            <th>Fixed List of Values</th>
                                            <th>Mandatory</th>
                                            <th>Default Value</th>
                                            <th>Display</th>
                                            <th>Editable</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sitedynamictabledd" style="font-size: small">
                                        <?php
                                        $y = 0;
                                        ?>
                                        @foreach ($config_dynamic_attribute as $dynamic_atr)
                                            <tr id='tr_sitedynamic{{ $dynamic_atr->la_location_attribute_id }}'
                                                class="dataTbltdhight">
                                                <td>{{ $dynamic_atr->la_location_attribute_id }}</td>
                                                <td>{{ $dynamic_atr->la_location_attribute_location_type }}</td>
                                                <td>{{ $dynamic_atr->la_location_attribute_name }}</td>
                                                <td>{{ $dynamic_atr->la_location_attribute_description }}</td>

                                                <td>{{ $dynamic_atr->la_location_attribute_datatype }}</td>
                                                <td>{{ $dynamic_atr->la_flov }}</td>
                                                <td>{{ $dynamic_atr->la_requiered_not_required_flag }}</td>
                                                <td>{{ $dynamic_atr->la_location_attribute_default_value }}</td>
                                                <td>{{ $dynamic_atr->la_display }}</td>
                                                <td>{{ $dynamic_atr->la_editable }}</td>
                                                <td>{{ $dynamic_atr->la_status }}</td>


                                                <td>
                                                    <button type="button" class="edit"
                                                        style="border-radius: 0;
                                          background-color: #202C55;width: 76px;"
                                                        data-bs-toggle="modal" data-bs-target="#dynamicatr_edit"
                                                        data-id="{{ $dynamic_atr->la_location_attribute_id }}"
                                                        onclick="dynamic_attr(this)">Edit</button>

                                                </td>
                                            </tr>
                                            <?php
                                            $y++;
                                            ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        {{-- Reason --}}
        <div class="tab-pane fade" id="nav-reason" role="tabpanel" aria-labelledby="nav-home-tab">

            {{-- <button type="button" class="btn btn-primary btn-sm point" data-bs-toggle="modal" id="add_reason" data-bs-target="#reason_add_model" onclick="reasonadd()" >Add Reason</button> --}}

            {{-- Table --}}
            <table id="reasontable"
                class="table table-striped table-bordered cell-border mx-2 table_reason reasonstyle table_config">
                <thead class="thead_names" style="background:#DEEBF6">
                    <tr>
                        <th>ID Reason</th>
                        <th>Reason Code</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th></th>
                    </tr>

                </thead>
                <?php
                $reasonRow = 1;
                ?>
                {{-- onclick="reasonedit(this)" --}}
                <tbody style="font-size: small">
                    @foreach ($reason_sub_reason as $reasons)
                        <tr class="dataTbltdhight" data-id="{{ $reasons->rm_reason_id }}">
                            <td>{{ $reasons->rm_reason_id }}</td>
                            <td>{{ $reasons->rm_reason_code }}</td>
                            <td style="text-align: center">{{ $reasons->rm_reason_description }}</td>
                            <td>{{ $reasons->rm_reason_status }}</td>
                            <td>

                                <button type="button" style="border-radius: 0; background-color: #202C55;"
                                    class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#reason_add_model_reason" data-id="{{ $reasons->rm_reason_id }}"
                                    onclick="opensubreason(this)">
                                    Sub Reason
                                </button>

                            </td>
                        </tr>
                        <?php
                        $reasonRow++;
                        ?>
                    @endforeach


                </tbody>
            </table>

        </div>

        <!--Add Asset type modal-->
        <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" id="add_asset_modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AddModal">Add Asset Type</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body" style="backdrop-filter: blur(2px)">
                        <form id="asset_type_config">
                            <div class="form-group">
                                <label for="type_code" class="col-form-label">Type Name <strong
                                        class="text-danger">*</strong></label>
                                <input type="text" class="form-control" id="type_code" name="typename">
                            </div>
                            <div class="form-group">
                                <label for="type_description" class="col-form-label">Description</label>
                                <input type="text" class="form-control" id="type_description_add_ass"
                                    name="description">
                            </div>
                            <div class="form-group">
                                <label for="parent_asset_type" class="col-form-label">Parent Asset Type <strong
                                        class="text-danger">*</strong></label>

                                {{-- <input type="text" class="form-control" id="parent_asset_type"  --}}
                                <select class="form-select" id="parent_asset_type" name="passttype">

                                    <option value=' '>NA</option>

                                    @foreach ($parenttype_details as $asttypedetails)
                                        <option value='{{ $asttypedetails->at_asset_type_id }}'>
                                            {{ $asttypedetails->at_asset_type_name }}</option>

                                        @if (count($asttypedetails->childs))
                                            @include('child_asset_type', [
                                                'childs' => $asttypedetails->childs,
                                                'parent_name' => $asttypedetails->at_asset_type_name,
                                            ])
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category" class="col-form-label"> Category <strong
                                        class="text-danger">*</strong></label>

                                <select data-container="body" class="form-select" id="category" name="catagory">
                                    <option></option>
                                    <option value="Active">Active</option>
                                    <option value="Passive">Passive</option>
                                </select>
                                <span id="select_span"></span>
                            </div>
                            <div class="form-group">
                                <label for="asset_status" class="col-form-label">Status<strong
                                        class="text-danger">*</strong></label>
                                <select data-container="body" class="form-select"id="asset_statusadd" name="status">
                                    <option> </option>
                                    <option value="Valid">Valid</option>
                                    <option value="Invalid">Invalid</option>
                                </select>
                            </div>



                    </div>
                    <div class="modal-footer">
                        <p id="assettype_add_msg"></p>
                        <button type="button" id="submitButton" class="btn btn-primary save_one"
                            onclick="saveaddbutton()">Save</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>

                    </div>
                </div>
                </form>
            </div>
        </div>
        <!-- Edit modal of assettype-->
        <div class="modal fade" id="editmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="editmodallLabel" aria-hidden="true">
            <div class="modal-dialog" id="edit_asset_modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editmodal">Modify Asset Type</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>
                        <form>
                            <div class="form-group">
                                <label for="type_code" class="col-form-label">Type Name <strong
                                        class="text-danger">*</strong></label>
                                <input type="text" class="form-control" id="type_code" name='typename' required>
                            </div>
                            <div class="form-group">
                                <label for="type_description" class="col-form-label">Type Description </label>
                                <input type="text" class="form-control" id="type_description" name="description">
                            </div>
                            <div class="form-group">
                                <label for="parent_asset_type" class="col-form-label">Parent Asset Type <strong
                                        class="text-danger">*</strong></label>

                                <select class="form-select" id="parent_asset_type" name="passttype" required>

                                    <option value=' '>NA</option>
                                    {{-- @foreach ($parenttype_details as $asttypedetails)
                     <option value='{{$asttypedetails->at_asset_type_id}}'>{{$asttypedetails->at_asset_type_name}}</option>
                  @endforeach                      --}}

                                    @foreach ($parenttype_details as $asttypedetails)
                                        <option value='{{ $asttypedetails->at_asset_type_id }}'>
                                            {{ $asttypedetails->at_asset_type_name }}</option>

                                        @if (count($asttypedetails->childs))
                                            @include('child_asset_type', [
                                                'childs' => $asttypedetails->childs,
                                                'parent_name' => $asttypedetails->at_asset_type_name,
                                            ])
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="category" class="col-form-label">Category <strong
                                        class="text-danger">*</strong></label>
                                <select data-container="body" class="form-select" id="category" name="catagory" required>
                                    <option value="Active">Active</option>
                                    <option value="Passive">Passive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="asset_status" class="col-form-label">Status <strong
                                        class="text-danger">*</strong></label>
                                <select data-container="body" class="form-select" id="asset_status" name="status" required>
                                    <option value="Valid">Valid</option>
                                    <option value="Invalid">Invalid</option>
                                </select>
                                <input type="hidden" class="form-control" id="id">
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="savebtn()">Update</button>

                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Add Asset type modal of fixed attribute-->
    <div class="modal fade" id="fixedattribute" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddModal">Fixed Attribute</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">

                    <form id="fixed_attribute_validation">


                        <div class="row">
                            <div class="col-md-6">


                                <div class="form-group">
                                    <label for="fixedatt_name" class="col-form-label">Attribute Name <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" name="attribute_attname" class="form-control"
                                        id="fixedatt_name" data-required="true" required>
                                </div>
                                <div class="form-group">
                                    <label for="description_fixed" class="col-form-label">Description</label>
                                    <input type="text" name="attribute_fixdescription" class="form-control"
                                        id="description_fixed" data-required="true">
                                </div>
                                <div class="form-group">
                                    <label for="fixed_data_type" class="col-form-label"> Data Type <strong
                                            class="text-danger">*</strong></label>

                                    <select data-container="body" class="form-select" id="fixedstatus_data_type"
                                        name='datatypes' required data-required="true" required>
                                        <option value="" selected>---Select---</option>
                                        @foreach ($datatypes as $datatype)
                                            <option value="{{ $datatype->typeName }}">{{ $datatype->typeName }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group" id="fixedlistvl_data_type1">
                                    <label for="fixedlistvl_data_type" class="col-form-label"> Fixed List Of Values
                                    </label>
                                    <input type="text" name="fixflov" class="form-control" id="fixedlistvl_data_type"
                                        required data-required="false">
                                </div>
                                <div class="form-group">
                                    <label for="fixed_mandatory_flag_fixw" class="col-form-label">Mandatory Flag<strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select" id="fix_man_flag"
                                        name='required_notrequired' required data-required="true">
                                        <option value="">---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                {{-- <div class="form-group">
                           <label for="dynamic_asset_type_name" class="col-form-label">Asset Type Name<strong class="text-danger">*</strong></label>
                           <select class="form-select" id="fixed_asset_type_name" name="asset_name" >
                              <option value=' '>--Select--</option>
                            
                              @foreach ($asset_name as $asttypedetails)
                                 <option value='{{$asttypedetails->at_asset_type_id}}'>{{$asttypedetails->at_asset_type_name}}</option>
                              @endforeach                     
                            </select>
                         </div> --}}
                                {{-- <input type="hidden" name="assettypeid"  id="asst_ty_id"> --}}
                            </div>



                            <div class="col-md-6">


                                <input type="hidden" name="attribute_fixflag" class="form-control"
                                    id="fixed_mandatory_flag" value=0>


                                <div class="form-group">
                                    <label for="fixed_default" class="col-form-label">Default Value</label>
                                    <input type="text" class="form-control" id="fixed_default" data-required="false"
                                        name="attribute_fixdefault">
                                </div>
                                <div class="form-group">
                                    <label for="fixed_display" class="col-form-label"> Display<strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select" id="fix_disp_button"
                                        name='fixdisplay' required data-required="true">
                                        <option value=" ">---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fixed_edit" class="col-form-label"> Editable<strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select" id="fix_edit_button"
                                        name='fixedit' required data-required="true">
                                        <option value=" ">---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fixedstatus" class="col-form-label"> Status <strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select" id="fixedstatus" name='fixstatus'
                                        required data-required="true">
                                        <option value=" ">---Select---</option>
                                        <option value="Valid">Valid</option>
                                        <option value="Invalid">Invalid</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="saveattfix">Save</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!--Edit modal of fixed attribute-->
    <div class="modal fade" id="fixedattributeedit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddModal">Fixed Attribute</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6"></div>
                        <div class=""></div>
                    </div>
                    <form>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="fixedatt_name" class="col-form-label">Attribute Name <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" name="attribute_attname" class="form-control"
                                        id="Dynedit_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="description_fixed" class="col-form-label">Description</label>
                                    <input type="text" name="attribute_fixdescription" class="form-control"
                                        id="description_dynamic">
                                </div>
                                <div class="form-group">
                                    <label for="fixed_data_type" class="col-form-label">Data Type <strong
                                            class="text-danger">*</strong></label>

                                    <select data-container="body" class="form-select" id="fixed_data_type_edit"
                                        name='datatypes'>
                                        <option value="" selected>Select</option>
                                        @foreach ($datatypes as $datatype)
                                            <option value="{{ $datatype->typeName }}">{{ $datatype->typeName }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group" id="fixedlistvl_data_type_edit_1">
                                    <label for="fixedlistvl_data_type_edit" class="col-form-label"> FLoV <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" name="fixflov" class="form-control"
                                        id="fixedlistvl_data_type_edit">
                                    <input type="hidden" class="form-control" id="asset_type_edit_id">
                                </div>
                                {{-- <div class="form-group">
                           <label for="dynamic_asset_type_name" class="col-form-label">Asset Type Name<strong class="text-danger">*</strong></label>
                           <select class="form-select" id="fixed_asset_type_name_edit" name="asset_name" >
                              <option value=' '>--Select--</option>
                            
                              @foreach ($asset_name as $asttypedetails)
                                 <option value='{{$asttypedetails->at_asset_type_id}}'>{{$asttypedetails->at_asset_type_name}}</option>
                              @endforeach                     
                            </select>
                         </div> --}}

                                <div class="form-group">
                                    <label for="fixed_mandatory_flag" class="col-form-label">Mandatory Flag <strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select" id="fix_man_flag_edit"
                                        name='required_notrequired' data-required="true">
                                        <option>---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                            </div>




                            <div class="col-md-6">


                                <input type="hidden" name="attribute_fixflag" class="form-control"
                                    id="fixed_mandatory_flag_edit" value=0>


                                <div class="form-group">
                                    <label for="fixed_default_val" class="col-form-label">Default Value</label>
                                    <input type="text" class="form-control" id="fixed_default_val">
                                </div>
                                <div class="form-group">
                                    <label for="fixed_display" class="col-form-label"> Display<strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select" id="fix_disp_button_edit"
                                        name='fixdisplay' data-required="true">
                                        <option>---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fixed_edit" class="col-form-label"> Editable<strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select" id="fix_edit_button_edit"
                                        name='fixedit' data-required="true">
                                        <option>---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fixedstatusedit" class="col-form-label"> Status <strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select" id="fixedstatusedit"
                                        name='fixstatus'>
                                        <option>---Select---</option>
                                        <option value="Valid">Valid</option>
                                        <option value="Invalid">Invalid</option>
                                    </select>


                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="updatefix() ">Update</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                </div>

                </form>
            </div>
        </div>
    </div>

    <!-- {{-- Add modal of asset dynamic attribute --}} -->

    <div class="modal fade" id="asset_attribute_dynamic" data-bs-backdrop="static" data-bs-keyboard="false"tabindex="-1"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddModal">Dynamic Attribute</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <form id="dynamic_attribute">


                        <div class="row">
                            <div class="col-md-6">
                                {{-- <div class="form-group">
                     <label for="dynamic_att_code" class="col-form-label">Attribute Code<strong class="text-danger">*</strong></label>
                     <input type="text" name="attribute_code"class="form-control" id="dynamic_att_code">
                   </div> --}}
                                <div class="form-group">
                                    <label for="dynamic_at_name" class="col-form-label">Attribute Name<strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" name="attribute_attname" class="form-control"
                                        id="dynamic_at_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="asset_description_dynamic" class="col-form-label">Description</label>
                                    <input type="text" name="attribute_fixdescription" class="form-control"
                                        id="asset_description_dynamic">
                                </div>
                                <div class="form-group">
                                    <label for="dynamic_att_data_type" class="col-form-label">Data Type<strong
                                            class="text-danger">*</strong></label>
                                    {{-- <input type="text" name="attribute_fixdata" class="form-control" id="dynamic_att_data_type"> --}}
                                    <select data-container="body" class="form-select" id="dynamic_att_data_type"
                                        name='datatypes' required>
                                        <option value="" selected>--Select--</option>
                                        @foreach ($datatypes as $datatype)
                                            <option value='{{ $datatype->typeName }}'>{{ $datatype->typeName }}</option>
                                        @endforeach


                                    </select>
                                </div>
                                <div class="form-group" id="dynamiclistvl_data_type1">
                                    <label for="dynamiclistvl_data_type" class="col-form-label"> Fixed List Of Values
                                    </label>
                                    <input type="text" name="fixflov" class="form-control"
                                        id="dynamiclistvl_data_type">
                                </div>
                                <div class="form-group">
                                    <label for="dynamic_asset_type_name" class="col-form-label">Asset Type Name<strong
                                            class="text-danger">*</strong></label>
                                    <select class="form-select" id="dynamic_asset_type_name" name="asset_name">
                                        <option value=' '>--Select--</option>

                                        @foreach ($asset_name as $asttypedetails)
                                            <option value='{{ $asttypedetails->at_asset_type_id }}'>
                                                {{ $asttypedetails->at_asset_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="dynamic_mandatory_flag" class="col-form-label">Mandatory Flag<strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select" id="dynamic_required_notrequired"
                                        name='required_notrequired' data-required="true">
                                        <option value=" ">---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>


                            </div>

                            <div class="col-md-6">

                                <input type="hidden" name="attribute_fixflag" class="form-control"
                                    id="dynamic_mandatory_flag" value=1>




                                <div class="form-group">
                                    <label for="dynamic_default_val" class="col-form-label">Default Value </label>
                                    <input type="text" class="form-control" id="dynamic_default_val"
                                        name="attribute_fixdefault">
                                </div>
                                <div class="form-group">
                                    <label for="dynamic_display" class="col-form-label"> Display<strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select" id="dynamic_disp_button"
                                        name='fixdisplay' required ="true">
                                        <option value=" ">---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="dynamic_edit" class="col-form-label"> Editable<strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select" id="fixedit" name='fixedit'
                                        data-required="true">
                                        <option>---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="dynamicstatus" class="col-form-label"> Status<strong
                                            class="text-danger">*</strong></label>
                                    {{-- <input type="text" name="fixstatus" class="form-control" id="dynamicstatus" > --}}
                                    <select data-container="body" class="form-select" id="dynamicstatus"
                                        name='fixstatus'>
                                        <option value=" ">---Select---</option>
                                        <option value="Valid">Valid</option>
                                        <option value="Invalid">Invalid</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="quickform">Save</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--Edit modal of dynamic attribute-->
    <div class="modal fade" id="dynamic_edit_att" data-bs-backdrop="static" data-bs-keyboard="false"tabindex="-1"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddModal">Dynamic Attribute </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">

                        </div>
                        <div class="">

                        </div>
                    </div>
                    <form>

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="dynamic_edit_name" class="col-form-label">Attribute Name <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" name="attribute_attname" class="form-control"
                                        id="dynamic_edit_name">
                                </div>
                                <div class="form-group">
                                    <label for="description_dynamic_edit" class="col-form-label">Description</label>
                                    <input type="text" name="attribute_fixdescription" class="form-control"
                                        id="description_dynamic_edit">
                                </div>
                                <div class="form-group">
                                    <label for="dynamic_edit_data_type" class="col-form-label">Data Type <strong
                                            class="text-danger">*</strong></label>
                                    {{-- <input type="text" name="attribute_fixdata" class="form-control" id="dynamic_edit_data_type" disabled> --}}
                                    <select data-container="body" class="form-select" id="dynamic_edit_data_type"
                                        name='datatypes'>
                                        <option value="" selected>--Select--</option>
                                        @foreach ($datatypes as $datatype)
                                            <option value="{{ $datatype->typeName }}">{{ $datatype->typeName }}</option>
                                        @endforeach



                                    </select>
                                </div>
                                <div class="form-group" id="dy_dis_edit">
                                    <label for="dynamiclistvl_data_type" class="col-form-label"> FLoV <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" name="fixflov" class="form-control"
                                        id="dynamiclistvl_data_type">
                                </div>
                                <div class="form-group">
                                    <label for="asset_type_name_dynamicedit" class="col-form-label">Asset Type Name<strong
                                            class="text-danger">*</strong></label>
                                    <select class="form-select" id="asset_type_name_dynamicedit" name="asset_name">
                                        <option value=' '>--Select--</option>
                                        @foreach ($asset_name as $asttypedetails)
                                            <option value='{{ $asttypedetails->at_asset_type_id }}'>
                                                {{ $asttypedetails->at_asset_type_name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" class="form-control" id="dynamic_type_edit_id">
                                </div>
                                <div class="form-group">
                                    <label for="dynamicedit_mandatory_flag_edit" class="col-form-label">Mandatory Flag
                                        <strong class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select"
                                        id="dynamicedit_mandatory_flag_edit" name='required_notrequired'>
                                        <option value=" ">---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>


                            </div>

                            <div class="col-md-6">


                                <input type="hidden" name="attribute_fixflag" class="form-control"
                                    id="dynamic_mandatory_flag_edit" value=1>
                                <div class="form-group">
                                    <label for="dynamicedit_default_val" class="col-form-label">Default Value</label>
                                    <input type="text" class="form-control" id="dynamicedit_default_val">
                                </div>
                                <div class="form-group">
                                    <label for="dynamic_display" class="col-form-label"> Display<strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select" id="dynamic_disp_button_edit"
                                        name='fixdisplay' data-required="true">
                                        <option value=" ">---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="dynamic_edit" class="col-form-label"> Editable<strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select" id="dynamic_editable_edit"
                                        name='fixedit' required data-required="true">
                                        <option value=" ">---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="dynamicstatus" class="col-form-label"> Status<strong
                                            class="text-danger">*</strong></label>
                                    {{-- <input type="text" name="fixstatus" class="form-control" id="dynamicstatus" > --}}
                                    <select data-container="body" class="form-select" id="dynamicstatus_edit"
                                        name='fixstatus'>
                                        <option value=" ">----Select----</option>
                                        <option value="Valid">Valid</option>
                                        <option value="Invalid">Invalid</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="dynamic_edit() ">Update</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- reason table -->

    {{-- sub-reason --}}
    <div class="modal fade" id="reason_add_model_reason" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 75% !important;">
            <div class="modal-content">
                <div class="modal-header col-12">
                    <div class="col-4"></div>
                    <div class="col-3">
                        <h5 class="modal-title addreason" id="AddModal">Add Sub Reason</h5>
                    </div>
                    <div id="Add_Sub_Rea_Bttn" class="col-3">
                        {{-- <button type="button" class="btn btn-primary" id="openModalButton">
                       Add Sub Reason
                   </button> --}}
                    </div>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="close">&times;</button>
                </div>
                <div class="modal-body" style="backdrop-filter: blur(2px)">
                    <div class="table-responsive">
                        <table id="subresntable"
                            class="table table-striped table-bordered cell-border mx-2 table_sub_reason reasonstyle table_config">
                            <thead class="thead_names" style="background:#DEEBF6">
                                <tr>
                                    <th>ID Reason</th>
                                    <th>Reason Code</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="sub-reason-table"style="font-size: small">
                                <!-- Add rows dynamically based on AJAX response -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}
    {{-- Add  Sub Reason --}}
    <div class="modal fade" id="democancel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Sub Reason</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    <form action="{{ url('reason_add') }}" method="POST" id="reson_add_sub_reason">
                        @csrf
                        <div class="form-group">
                            <label for="type_code" class="col-form-label">Reason Code<strong
                                    class="text-danger">*</strong></label>
                            <input type="text" class="form-control" id="reason_code_1" name="reason_code"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="type_description" class="col-form-label">Description</label>
                            <input type="text" class="form-control" id="reason_description_1"
                                name="reason_description">
                        </div>
                        <input type="hidden" class="form-control" id="reason_sub_reason_1"
                            name="rm_reason_parent_id">

                        {{-- <input type="hidden" id="edit_row_id" name="editrow_id"> --}}

                        <div class="form-group">
                            <label for="asset_status" class="col-form-label">Status<strong
                                    class="text-danger">*</strong></label>
                            <select data-container="body" class="form-select"id="reason_status_1" name="reason_status"
                                data-required="true" required>
                                <option> </option>
                                <option value="ACTIVE">ACTIVE</option>
                                <option value="INACTIVE">INACTIVE</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick=reasonmodal()>Close</button>
                            <button type="button" class="btn btn-primary" onclick=saveaddreason()>Save changes</button>
                        </div>
                </div>
            </div>
            </form>
        </div>

    </div>
    </div>
    </div>
    {{-- Edit Sub Reason Modal --}}
    <div class="modal fade" id="editsubreasonmodal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Sub Reason</h5>

                </div>
                <div class="modal-body">
                    <form action="{{ url('reason_add') }}" method="POST" id="reson_add_sub_reason_edit">
                        @csrf
                        <div class="form-group">
                            <label for="type_code" class="col-form-label">Reason Code</label>
                            <input type="text" class="form-control" id="reason_code_1_edit" name="reason_code">
                        </div>
                        <div class="form-group">
                            <label for="type_description" class="col-form-label">Description</label>
                            <input type="text" class="form-control" id="reason_description_1_edit"
                                name="reason_description">
                        </div>
                        <input type="hidden" class="form-control" id="reason_sub_reason_1_edit"
                            name="rm_reason_parent_id">

                        <input type="hidden" id="master_id_edit" name="rm_reason_id">

                        <div class="form-group">
                            <label for="asset_status" class="col-form-label">Status</label>
                            <select data-container="body" class="form-select" id="reason_status_1_edit"
                                name="reason_status">
                                <option> </option>
                                <option value="ACTIVE">ACTIVE</option>
                                <option value="INACTIVE">INACTIVE</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick=editrsnmdlcancel()>Close</button>
                            <button type="button" class="btn btn-primary" onclick=editaddmdledirsn()>Save
                                changes</button>
                        </div>
                </div>
            </div>
            </form>
        </div>

    </div>
    </div>
    </div>
    {{-- SITE MODAL AND SCRIPT --}}
    {{-- Site type Modal Start --}}

    <div class="modal fade" id="site_add" data-bs-backdrop="static" data-bs-keyboard="false"tabindex="-1"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modwidth" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddModal">Add Site Type</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('congiguration_add_site') }}" method="POST" id="myform">
                        <div class="row">
                            <div class="col-md-6">



                                <div class="form-group">
                                    <label for="site_name" class="col-form-label">Site Type<strong
                                            class="text-danger">*</strong></label>
                                    <input type="site_name" class="form-control" id="site_name"
                                        name="location_type">
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="site_status" class="col-form-label">Site Type Status <strong
                                            class="text-danger">*</strong></label>

                                    <select name="location_type_status" class="form-select" id="site_status">
                                        <option value="" selected>Select</option>
                                        <option value="Valid">Valid</option>
                                        <option value="Invalid">Invalid</option>
                                    </select>
                                </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveadd()" id="save_site">Save</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="resetBtn"
                        value="Reset">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>






    {{-- Site type Edit Modal Start --}}

    <div class="modal fade" id="site_edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="sitemodallLabel" aria-hidden="true">
        <div class="modal-dialog modwidth" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="site_edit2">Update Site</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('congiguration_update_site') }}" method="POST" id="myform2">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="site_editid" class="col-form-label">Site Type <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" id="site_type_edit"
                                        name="location_type">
                                </div>



                            </div>
                            <div class="col-md-6">

                                <input type="hidden" class="form-control" id="site_edit_id">
                                <div class="form-group">
                                    <label for="site_status" class="col-form-label">Site Type Status <strong
                                            class="text-danger">*</strong></label>
                                    {{-- <input type="text" class="form-control" id="site_status" name="site_status">  
                   --}}
                                    <select name="location_type_status" class="form-select" id="site_status_edit">
                                        <option value="" selected>Select</option>
                                        <option value="Valid">Valid</option>
                                        <option value="Invalid">Invalid</option>
                                    </select>
                                </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="update_site()"
                        id="updt_site">Update</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    {{-- fggfhghg --}}
    <div class="modal fade" id="reason_add_model" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog"style="max-width: 40% !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title addreason" id="AddModal">Add Reason</h5>

                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
                        &times;
                    </button>
                </div>
                <div class="modal-body" style="backdrop-filter: blur(2px)">
                    <form action="{{ url('reason_add') }}" method="POST" id="reson_add_sub_reason">
                        @csrf
                        <div class="form-group">
                            <label for="type_code" class="col-form-label">Reason Code<strong
                                    class="text-danger">*</strong></label>
                            <input type="text" class="form-control" id="reason_code_1" name="reason_code">
                        </div>
                        <div class="form-group">
                            <label for="type_description" class="col-form-label">Description</label>
                            <input type="text" class="form-control" id="reason_description_1"
                                name="reason_description">
                        </div>
                        <input type="hidden" class="form-control" id="reason_sub_reason_1" name="rm_reason_id"
                            value="0">
                        <div class="form-group">
                            <label for="parent_asset_type" class="col-form-label">Master Reason<strong
                                    class="text-danger">*</strong></label>


                            <select class="form-select" id="master_reason_1" name="rm_reason_parent_id">

                                <option value='0'>NA</option>

                                @foreach ($reason_sub_reason as $reasons)
                                    <option value='{{ $reasons->rm_reason_id }}'>{{ $reasons->rm_reason_description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" id="edit_row_id" name="editrow_id">

                        <div class="form-group">
                            <label for="asset_status" class="col-form-label">Status<strong
                                    class="text-danger">*</strong></label>
                            <select data-container="body" class="form-select"id="reason_status_1"
                                name="reason_status">
                                <option> </option>
                                <option value="ACTIVE">ACTIVE</option>
                                <option value="INACTIVE">INACTIVE</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <p id="assettype_add_msg"></p>
                    <button type="button" id="submitButton" class="btn btn-primary save_one"
                        onclick="saveaddreason()">Save</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>

                </div>
            </div>
            </form>
        </div>
    </div>


    {{-- </div>  --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script>
        function rea_sub_button(e) {
            var parentreasonid = $(e).data("id");
            //alert(parentreasonid);
            $("#openModalButton").click(function() {

                $("#reason_add_model_reason").modal('toggle');
                $("#reason_sub_reason_1").val(parentreasonid);
                $("#democancel").modal('show');
            });
        }

        function reasonmodal() {
            $("#democancel").modal('toggle');
            $("#reason_add_model_reason").modal('toggle');

        }

        function editrsnmdlcancel() {
            $("#editsubreasonmodal").modal('toggle');
            $("#reason_add_model_reason").modal('toggle');
        }
        // function editsubreamod(){

        // }

        function opensubreason(e) {
            var table11 = $('.table_sub_reason').DataTable();
            table11.destroy();
            $('#sub-reason-table').empty();
            $('#Add_Sub_Rea_Bttn').empty();
            $.ajax({

                type: "GET",
                //url: 'http://3.111.113.246/umprojnew/public/index.php/locationdb',
                url: "{{ url('sub_reasons') }}",
                data: {
                    'reamastrid': $(e).data("id"),
                },

                success: function(result) {
                    $('#Add_Sub_Rea_Bttn').append(
                        '<button   type="button" class="btn btn-primary reasonbutton" data-id="' + $(e)
                        .data("id") +
                        '" id="openModalButton" onclick="rea_sub_button(this)">Add Sub Reason</button>');


                    $.each(result.subreason, function(key, val) {

                        console.log(result.subreason);
                        //.log(result.subreason['rm_reason_code']);


                        if (result.subreason != null) {

                            if (val['rm_reason_description'] == null) {
                                val['rm_reason_description'] = "";
                            }

                            $('#sub-reason-table').append('<tr  id="tr_subreason' + val[
                                    'rm_reason_id'] +
                                '" class="dataTbltdhight"><td class="sorting_1">' + val[
                                    'rm_reason_id'] + '</td><td>' + val['rm_reason_code'] +
                                '</td><td>' + val['rm_reason_description'] + '</td><td>' + val[
                                    'rm_reason_status'] +
                                '</td><td> <button type="button" class="edit edtbtn" style="border-radius: 0; background-color: #202C55;width: 76px;"  onclick="editsubreasopn(this)" data-id="' +
                                val['rm_reason_id'] + '">Edit</button></tr>');
                        }

                    })
                    $('.table_sub_reason').DataTable({
                        paging: false,
                        language: {
                            search: '',
                            searchPlaceholder: "Sub Reasons"
                        },
                        info: false,

                    });

                    $('#subresntable_filter input').addClass('subreasonsearch');
                    $('.dataTables_wrapper .dataTables_filter input').on('input', function() {
                        if ($(this).val().trim() === '') {
                            $(this).css('background-image',
                                'url("https://cdn3.iconfinder.com/data/icons/feather-5/24/search-512.png")'
                            );
                        } else {
                            $(this).css('background-image', 'none');
                        }
                    });

                    // Show the modal
                    // $('#subresntable').DataTable().ajax.reload();
                    $('#reason_add_model_reason').modal('show');
                }


            })

        }
        const typeDescriptionInput = document.getElementById('type_description');
        const parentAssetTypeSelect = document.getElementById('parent_asset_type');
        const categorySelect = document.getElementById('category');
        const assetStatusSelect = document.getElementById('asset_statusadd');
        const submitButton = document.getElementById('submitButton');

        // Add event listeners to form elements//

        typeDescriptionInput.addEventListener('input', checkFormAsset);
        parentAssetTypeSelect.addEventListener('change', checkFormAsset);
        categorySelect.addEventListener('change', checkFormAsset);
        assetStatusSelect.addEventListener('change', checkFormAsset);

        // Function to check if all fields are filled
        function checkFormAsset() {
            // Check if all fields have values
            if (

                typeDescriptionInput.value.trim() !== '' &&
                //  parentAssetTypeSelect.value.trim() !== '' &&
                categorySelect.value.trim() !== '' &&
                assetStatusSelect.value.trim() !== ''
            ) {
                submitButton.classList.add('active');
            } else {
                submitButton.classList.remove('active');
            }
        }
        // COLOR CHANGE OF BUTTON
        $(document).ready(function() {
            // Add event listeners to form elements
            $('#dynamic_at_name,#dynamic_att_data_type, #dynamic_asset_type_name, #dynamiclistvl_data_type, #dynamic_mandatory_flag, #dynamic_default_val, #dynamicstatus')
                .on('input change', checkFormdynamic);
        });

        // Function to check if all fields are filled
        function checkFormdynamic() {
            var allFieldsFilled = true;
            // Check if all fields have values
            $('#dynamic_attribute input[type="text"], #dynamic_attribute select').not(
                '#dynamiclistvl_data_type, #dynamic_default_val').each(function() {
                if ($(this).val().trim() === '') {
                    allFieldsFilled = false;
                    return false; // Exit the loop if any field is empty
                }
            });

            // Change button color based on field values
            if (allFieldsFilled) {
                $('#quickform').removeClass('btn-primary').addClass('btn-primary');
            } else {
                $('#quickform').removeClass('btn-primary').addClass('btn-primary');
            }
        }


        $(document).ready(function() {
            // Add event listeners to form elements
            $('#fixedatt_name,#fixedstatus_data_type, #fixedlistvl_data_type, #fix_man_flag,#fixedstatus,#fix_edit_button,#fix_disp_button')
                .on('input change', checkForm);
        });

        // Function to check if all fields are filled
        function checkForm() {
            var allFieldsFilled = true;
            // Check if all fields have values
            $('#fixed_attribute_validation input[type="text"], #fixed_attribute_validation select').not(
                '#fixed_default, #fixedlistvl_data_type').each(function() {
                //var isRequired = $(this).data('required');
                if ($(this).val().trim() == '') {
                    allFieldsFilled = false;
                    return false; // Exit the loop if any field is empty
                }
            });

            // Change button color based on field values
            if (allFieldsFilled) {

                $('#saveattfix').removeClass('btn-primary').addClass('btn-primary');
            } else {
                $('#saveattfix').removeClass('btn-primary').addClass('btn-primary');
            }
        }


        function asttypedetails(e) {
            // $('#editmodal #parent_asset_type').empty();
            //alert($(e).data("id"));
            $.ajax({

                type: "GET",
                //url: 'http://3.111.113.246/umprojnew/public/index.php/locationdb',
                url: "{{ url('congiguration_asset') }}",
                data: {
                    'assttype_id': $(e).data("id"),
                },
                beforeSend: function() {
                    $('#loader').removeClass('hidden');
                    $("#loading").show();
                },
                complete: function() {
                    $("#loading").hide();
                },
                success: function(result) {

                    $('#loader').addClass('hidden');

                    if (result.status == 'success') {
                        // console.log(result.config_assetadd);
                        //console.log(result.config_assetadd[0]['at_asset_type_name']);
                        $("#editmodal #type_code").val(result.config_assetadd[0]['at_asset_type_name']);



                        //console.log(result.config_assetadd[0]['at_asset_type_description']);
                        $("#editmodal #type_description").val(result.config_assetadd[0][
                            'at_asset_type_description'
                        ]);


                        console.log(result.config_assetadd[0]['at_parent_asset_type_id']);
                        if (result.config_assetadd[0]['at_parent_asset_type_id'] == null) {
                            //alert("fjgygu");
                            $('#editmodal #parent_asset_type').prop('selectedIndex', 0);
                        } else {
                            $('#editmodal #parent_asset_type option[value="' + result.config_assetadd[0][
                                'at_parent_asset_type_id'
                            ] + '"]').prop('selected', true);
                            $("#editmodal #parent_asset_type").change();
                        }
                        console.log(result.config_assetadd[0]['at_asset_type_category']);
                        $('#editmodal #category optionparent_asset_type[value="' + result.config_assetadd[0][
                            'at_asset_type_category'
                        ] + '"]').prop('selected', true);

                        console.log(result.config_assetadd[0]['at_asset_type_status']);
                        $('#editmodal #asset_status option[value="' + result.config_assetadd[0][
                            'at_asset_type_status'
                        ] + '"]').prop('selected', true);

                        console.log(result.config_assetadd[0]);
                        $("#editmodal #id").val(result.config_assetadd[0]['at_asset_type_id']);

                    }
                    $("#parent_asset_type option[value='" + result.config_assetadd[0]['at_asset_type_id'] +
                        "']").remove();

                }


            })
        }

        function savebtn() {

            $("#editmodal").find(".error").removeClass("error");
            $("#editmodal").find("span").remove();

            var id = $("#editmodal #id").val().trim();
            var type_name = $("#editmodal #type_code").val().trim();

            var description = $("#editmodal #type_description").val().trim();
            var passttype = $("#editmodal #parent_asset_type").val().trim();
            var catagory = $("#editmodal #category").val().trim();
            var status = $("#editmodal #asset_status").val().trim();
            var csrfToken = '{{ csrf_token() }}';


            // if (id ==  "") {
            //    $("#editmodal #id").focus();
            //    $("#editmodal #id").addClass("error");
            //    $("#editmodal #id").after("<span>Required</span>");
            //    return false;          
            // }

            if (type_name == "") {
                $("#type_code").focus();
                $("#type_code").addClass("error");
                $("#type_code").after("<span>Required</span>");
                return false;
            }


            // if (passttype ==  "") {
            //    $("#editmodal #parent_asset_type").focus();
            //    $("#editmodal #parent_asset_type").addClass("error");
            //    $("#editmodal #parent_asset_type").after("<span>Required</span>");
            //    return false;          
            // }

            if (catagory == "") {
                $("#editmodal #category").focus();
                $("#editmodal #category").addClass("error");
                $("#editmodal #category").after("<span>Required</span>");
                return false;
            }

            if (status == "") {
                $("#editmodal #asset_statusadd").focus();
                $("#editmodal #asset_statusadd").addClass("error");
                $("#editmodal #asset_statusadd").after("<span>Required</span>");
                return false;
            }


            $.ajax({
                method: "POST",
                url: "{{ url('congiguration_asset_update') }}",
                data: {
                    'id': id,
                    '_token': csrfToken,
                    'typename': type_name,
                    'description': description,
                    'passttype': passttype,
                    'catagory': catagory,
                    'status': status,
                },

                success: function(data) {
                    $('#editmodal').modal('hide');

                    showToast("Asset Type Updated Successfully!", "success");

                    $(document).ajaxStop(function() {
                        window.location.reload();
                    });
                }

            })
        }

        function assetconfig_add() {
            // $('#asset_type_config')[0].reset();
            // $("#submitButton").removeClass("active");
            // $("#exampleModal").find(".error").removeClass("error");
            // $("#exampleModal").find("span").remove();
            $("#exampleModal").show();

        }

        function assetatrrifix_button() {
            $('#fixed_attribute_validation')[0].reset();
            $("#saveattfix").removeClass("active");
            $("#fixed_attribute_validation").find(".error").removeClass("error");
            $("#fixed_attribute_validation").find("span").remove();

        }

        function asstdynamic_button() {
            $('#dynamic_attribute')[0].reset();
            $("#quickform").removeClass("active");
            $("#dynamic_attribute").find(".error").removeClass("error");
            $("#dynamic_attribute").find("span").remove();

        }



        function saveaddbutton() {

            $('#exampleModal').on('hidden.bs.modal', function() {
                $('#exampleModal form')[0].reset();
            });
            $("#exampleModal").find(".error").removeClass("error");
            $("#exampleModal").find("span").remove();
            var type_name = $("#exampleModal #type_code").val().trim();
            console.log()
            var description = $("#exampleModal #type_description_add_ass").val().trim();
            var passttype = $("#exampleModal #parent_asset_type").val().trim();
            var catagory = $("#exampleModal #category").val().trim();
            var status = $("#asset_statusadd").val().trim();
            var csrfToken = '{{ csrf_token() }}';
            if (type_name == "") {
                $("#type_code").focus();
                $("#type_code").addClass("error");
                $("#type_code").after("<span>Required</span>");
                return false;
            }


            if (catagory == "") {
                $("#category").focus();
                $("#category").addClass("error");
                $("#category").after("<span>Required</span>");
                return false;
            }

            if (status == "") {
                $("#asset_statusadd").focus();
                $("#asset_statusadd").addClass("error");
                $("#asset_statusadd").after("<span>Required</span>");
                return false;
            }

            $.ajax({
                method: "POST",
                url: "{{ url('congiguration_assettype') }}",
                data: {
                    '_token': csrfToken,
                    'typename': type_name,
                    'description': description,
                    'passttype': passttype,
                    'catagory': catagory,
                    'status': status,
                },
                success: function(data) {
                    //console.log(data);s

                    $('#exampleModal').modal('hide');
                    $('#exampleModal').on('hidden.bs.modal', function() {
                        $('#exampleModal form')[0].reset();
                    });
                    showToast("Asset Type Added Successfully!", "success");
                    window.location.reload();

                },
                error: function(jqXHR, exception) {
                    console.log(jqXHR.responseText);
                }

            })
        }

        function savefix() {
            $(".dataTables_empty").parent().remove();

            var fixedname = $("#fixedattribute #fixedatt_name").val().trim();
            var fixdescrib = $("#fixedattribute #description_fixed").val().trim();
            var fixdatype = $("#fixedattribute #fixedstatus_data_type").val().trim();
            var fixflov = $("#fixedattribute #fixedlistvl_data_type").val().trim();
            var fixmandatory = $("#fixedattribute #fixed_mandatory_flag").val().trim();
            var fixdefault = $("#fixedattribute #fixed_default").val().trim();
            var fixdisplay = $("#fixedattribute #fix_disp_button").val().trim();
            var fixedit = $("#fixedattribute #fix_edit_button").val().trim();
            var fixstatus = $("#fixedattribute #fixedstatus").val().trim();
            var fixedmand = $("#fixedattribute #fix_man_flag").val().trim();
            var fixassttype = 0;


            var csrfToken = '{{ csrf_token() }}';



            $.ajax({
                method: "POST",
                url: "{{ url('configuration_fixedasstadd') }}",
                data: {

                    '_token': csrfToken,

                    'attribute_attname': fixedname,
                    'attribute_fixdescription': fixdescrib,
                    'datatypes': fixdatype,
                    'fixflov': fixflov,
                    'attribute_fixdefault': fixdefault,
                    'attribute_fixflag': fixmandatory,
                    'fixstatus': fixstatus,
                    'required_notrequired': fixedmand,
                    'fixedit': fixedit,
                    'fixdisplay': fixdisplay,
                    'asset_name': fixassttype,


                },

                success: function(data) {
                    //console.log(data);

                    $('#asset_type_fixed_table').append('<tr id="tr_astfix' + data +
                        '" class="dataTbltdhight "><td>' + data + '</td><td>' + fixedname + '</td><td>' +
                        fixdescrib + '</td><td>' + fixdatype + '</td><td>' + fixflov + '</td><td>' +
                        fixedmand + '</td><td>' + fixdefault + '</td><td>' + fixstatus +
                        '</td><td><button type="button" class="edit" style="border-radius:background-color: #202C55;width: 76px;" data-bs-toggle="modal"   data-bs-target="#fixedattributeedit" onclick="fixededit(this)" data-id="' +
                        data + '" >Edit</button></td></tr>');

                    $('#fixedattribute .close').click();

                    showToast("Asset Type Fixed Attribute Added Successfully!", "success");


                }

            })
        }


        function fixededit(e) {
            //alert($(e).data("id"));
            $.ajax({
                type: "GET",
                //url: 'http://3.111.113.246/umprojnew/public/index.php/locationdb',
                url: "{{ url('configuration_editfixfetch') }}",
                data: {
                    'fixatt_id': $(e).data("id"),
                },
                beforeSend: function() {
                    $('#loader').removeClass('hidden');
                    $("#loading").show();
                },
                complete: function() {
                    $("#loading").hide();
                },

                success: function(result) {

                    $('#loader').addClass('hidden');


                    if (result.status == 'success') {
                        $("#fixedattributeedit #Dynedit_name").val(result.fetchfixattr[0][
                            'ata_asset_type_attribute_name'
                        ]);
                    }

                    if (result.status == 'success') {

                        $("#fixedattributeedit #description_dynamic").val(result.fetchfixattr[0][
                            'ata_asset_type_attribute_description'
                        ]);
                        $("#fixedattributeedit #fixed_asset_type_name_edit").val(result.fetchfixattr[0][
                            'ata_asset_type_id'
                        ]);

                    }
                    if (result.status == 'success') {

                        $("#fixedattributeedit #fixed_data_type_edit").val(result.fetchfixattr[0][
                            'ata_asset_type_attribute_datatype'
                        ]);
                        if (result.fetchfixattr[0]['ata_asset_type_attribute_datatype'] == "FLoV") {
                            $('#fixedlistvl_data_type_edit_1').show();
                        } else {
                            $('#fixedlistvl_data_type_edit_1').hide();
                        }

                    }
                    if (result.status == 'success') {
                        $("#fixedattributeedit #fixed_mandatory_flag_edit").val(result.fetchfixattr[0][
                            'attribute_catagory'
                        ]);
                    }

                    if (result.status == 'success') {
                        $("#fixedattributeedit #fixedstatusedit").val(result.fetchfixattr[0]['ata_status']);
                    }
                    if (result.status == 'success') {
                        $("#fixedattributeedit #fixedlistvl_data_type_edit").val(result.fetchfixattr[0][
                            'ata_flov'
                        ]).prop('selected', true);
                    }
                    //console.log(result.fetchfixattr[0]);

                    // if(result.status == 'success'){
                    //  $("#fixedattributeedit #asset_type_name").val(result.fetchfixattr[0]['ata_asset_type_id']);          

                    // }
                    if (result.status == 'success') {

                        //console.log(result.fetchfixattr[0]);
                        $("#fixedattributeedit #fixed_default_val").val(result.fetchfixattr[0][
                            'ata_asset_type_attribute_default_value'
                        ]);

                    }

                    if (result.status == 'success') {
                        $("#fixedattributeedit #fix_man_flag_edit").val(result.fetchfixattr[0][
                            'ata_field_requiered_not_required_flag'
                        ]);
                    }
                    if (result.status == 'success') {
                        $("#fixedattributeedit #fix_edit_button_edit").val(result.fetchfixattr[0][
                            'ata_field_editable_non_editable_flag'
                        ]);
                    }
                    if (result.status == 'success') {
                        $("#fixedattributeedit #fix_disp_button_edit").val(result.fetchfixattr[0][
                            'ata_display'
                        ]);
                    }




                    if (result.status == 'success') {
                        //console.log(result.fetchfixattr[0]);
                        $("#fixedattributeedit #asset_type_edit_id").val(result.fetchfixattr[0][
                            'ata_asset_type_attribute_id'
                        ]);

                    }




                }


            })
        }

        function updatefix() {
            //alert("mm");
            var id = $("#fixedattributeedit #asset_type_edit_id").val();

            var madatory_id = $("#fixedattributeedit #fixed_mandatory_flag_edit").val();



            var fixname = $("#fixedattributeedit #Dynedit_name").val();

            var fixdes = $("#fixedattributeedit #description_dynamic").val();

            var fixdata = $("#fixedattributeedit #fixed_data_type_edit").val();

            var fixdefault = $("#fixedattributeedit #fixed_default_val").val();

            var fixvalues = $("#fixedattributeedit #fixedlistvl_data_type_edit").val();
            var fixsta = $("#fixedattributeedit #fixedstatusedit").val();
            var fixmandatoryeditable = $("#fixedattributeedit #fix_man_flag_edit").val();
            var fixdisplayeditable = $("#fixedattributeedit #fix_disp_button_edit").val();
            var fixeseditable = $("#fixedattributeedit #fix_edit_button_edit").val();


            var csrfToken = '{{ csrf_token() }}';
            //return false;
            // if (typecode ==  "") {
            //    $("#type_code").focus();
            //    $("#type_code").addClass("error");
            //    $("#type_code").after("<span>Required</span>");
            //    return false;          
            // }

            $.ajax({
                method: "POST",
                url: "{{ url('configuration_updfixfetch') }}",
                data: {
                    'id': id,
                    '_token': csrfToken,

                    'attribute_attname': fixname,
                    'attribute_fixdescription': fixdes,
                    'datatypes': fixdata,

                    'attribute_fixdefault': fixdefault,

                    'fixstatus': fixsta,
                    'fixflov': fixvalues,
                    'attribute_fixflag': madatory_id,
                    'required_notrequired': fixmandatoryeditable,
                    'fixedit': fixeseditable,
                    'fixdisplay': fixdisplayeditable,


                },

                success: function(data) {
                    $('#tr_astfix' + id).html('<td>' + id + '</td><td>' + fixname + '</td><td>' + fixdes +
                        '</td><td>' + fixdata + '</td><td>' + fixvalues + '</td><td>' +
                        fixmandatoryeditable + '</td><td>' + fixdefault + '</td><td>' + fixsta +
                        '</td><td><button type="button" class="edit" style="border-radius:background-color: #202C55;width: 76px;" data-bs-toggle="modal"   data-bs-target="#fixedattributeedit" onclick="fixededit(this)" data-id="' +
                        id + '" >Edit</button></td>');

                    $('#fixedattributeedit .close').click();

                    showToast("Asset Type Fixed Attribute Updated Successfully!", "success");

                }

            })
        }

        function dynamicsave() {
            $(".dataTables_empty").parent().remove();

            var dynedname = $("#asset_attribute_dynamic #dynamic_at_name").val();
            var dyndescrib = $("#asset_attribute_dynamic #asset_description_dynamic").val();
            var dyndatype = $("#asset_attribute_dynamic #dynamic_att_data_type").val();
            var dynflov = $("#asset_attribute_dynamic #dynamiclistvl_data_type").val();
            var dynmandatory = $("#asset_attribute_dynamic #dynamic_mandatory_flag").val();
            var dynasstype = $("#asset_attribute_dynamic #dynamic_asset_type_name").val();
            var dyndefault = $("#asset_attribute_dynamic #dynamic_default_val").val();
            var dyndisplay = $("#asset_attribute_dynamic #dynamic_disp_button").val();
            var dynedit = $("#asset_attribute_dynamic #fixedit").val();
            var dynstatus = $("#asset_attribute_dynamic #dynamicstatus").val();
            var dynedmand = $("#asset_attribute_dynamic #dynamic_required_notrequired").val();

            var csrfToken = '{{ csrf_token() }}';
            $.ajax({
                method: "POST",
                url: "{{ url('configuration_dynamicattribute') }}",
                data: {

                    '_token': csrfToken,

                    'attribute_attname': dynedname,
                    'attribute_fixdescription': dyndescrib,
                    'datatypes': dyndatype,
                    'fixflov': dynflov,
                    'attribute_fixdefault': dyndefault,
                    'attribute_fixflag': dynmandatory,
                    'asset_name': dynasstype,
                    'fixstatus': dynstatus,
                    'required_notrequired': dynedmand,
                    'fixedit': dynedit,
                    'fixdisplay': dyndisplay,


                },

                success: function(data) {
                    dynasstype = $("#asset_attribute_dynamic #dynamic_asset_type_name option:selected").text();
                    $('#assttypedynamic').append('<tr id="tr_astdyna' + data +
                        '" class="dataTbltdhight" ><td>' + data + '</td><td>' + dynasstype + '</td><td>' +
                        dynedname + '</td><td>' + dyndescrib + '</td><td>' + dyndatype + '</td><td>' +
                        dynflov + '</td><td>' + dynedmand + '</td><td>' + dyndefault + '</td><td>' +
                        dynstatus +
                        '</td><td><button type="button" class="edit" style="border-radius: 0;background-color: #202C55;width: 76px; "data-bs-target="#dynamic_edit_att" data-bs-toggle="modal" onclick="dynamicedit(this)" data-id="' +
                        data + '">Edit</button></td></tr>');

                    $('#asset_attribute_dynamic .close').click();
                    showToast("Asset Type Dynamic Attribute Added Successfully!", "success");

                }

            })

        }

        function dynamicedit(e)

        {
            $.ajax({
                type: "GET",
                //url: 'http://3.111.113.246/umprojnew/public/index.php/locationdb',
                url: "{{ url('configuration_editdynamic') }}",
                data: {
                    'dynamic_id': $(e).data("id"),
                },
                success: function(result) {


                    if (result.status == 'success') {
                        $("#dynamic_edit_att #dynamic_edit_name").val(result.fetchdynamicatt[0][
                            'ata_asset_type_attribute_name'
                        ]);
                    }

                    if (result.status == 'success') {
                        $("#dynamic_edit_att #description_dynamic_edit").val(result.fetchdynamicatt[0][
                            'ata_asset_type_attribute_description'
                        ]);
                    }


                    if (result.status == 'success') {
                        $("#dynamic_edit_att #dynamic_edit_data_type").val(result.fetchdynamicatt[0][
                            'ata_asset_type_attribute_datatype'
                        ]);
                        if (result.fetchdynamicatt[0]['ata_asset_type_attribute_datatype'] == "FLoV") {
                            $('#dy_dis_edit').show();
                        } else {
                            $('#dy_dis_edit').hide();
                        }
                    }

                    if (result.status == 'success') {
                        $("#dynamic_edit_att #asset_type_name_dynamicedit").val(result.fetchdynamicatt[0][
                            'ata_asset_type_id'
                        ]);
                    }

                    if (result.status == 'success') {

                        $("#dynamic_edit_att #dynamic_mandatory_flag_edit").val(result.fetchdynamicatt[0][
                            'attribute_catagory'
                        ]);
                    }

                    if (result.status == 'success') {
                        $("#dynamic_edit_att #dynamicedit_default_val").val(result.fetchdynamicatt[0][
                            'ata_asset_type_attribute_default_value'
                        ]);
                    }
                    if (result.status == 'success') {
                        $("#dynamic_edit_att #dynamicstatus_edit").val(result.fetchdynamicatt[0]['ata_status']);
                    }
                    if (result.status == 'success') {
                        $("#dynamic_edit_att #dynamiclistvl_data_type").val(result.fetchdynamicatt[0][
                            'ata_flov'
                        ]);
                    }
                    if (result.status == 'success') {

                        $("#dynamic_edit_att #dynamicedit_mandatory_flag_edit").val(result.fetchdynamicatt[0][
                            'ata_field_requiered_not_required_flag'
                        ]);
                    }
                    if (result.status == 'success') {
                        $("#dynamic_edit_att #dynamic_editable_edit").val(result.fetchdynamicatt[0][
                            'ata_field_editable_non_editable_flag'
                        ]);
                    }

                    if (result.status == 'success') {
                        $("#dynamic_edit_att #dynamic_disp_button_edit").val(result.fetchdynamicatt[0][
                            'ata_display'
                        ]);
                    }
                    if (result.status == 'success') {
                        console.log(result.fetchdynamicatt[0]);
                        $("#dynamic_edit_att #dynamic_type_edit_id").val(result.fetchdynamicatt[0][
                            'ata_asset_type_attribute_id'
                        ]);

                    }

                }
            })
        }

        function dynamic_edit() {
            //alert("mm");
            var id = $("#dynamic_edit_att #dynamic_type_edit_id").val();
            console.log(id);
            //alert(id);             

            //console.log(fixcode);
            var dynamicname = $("#dynamic_edit_att #dynamic_edit_name").val();
            var dynamicdes = $("#dynamic_edit_att #description_dynamic_edit").val();
            var dynamicdata = $("#dynamic_edit_att #dynamic_edit_data_type").val();
            var dynamicastname = $("#dynamic_edit_att #asset_type_name_dynamicedit").val();
            var dynamicdefault = $("#dynamic_edit_att #dynamicedit_default_val").val();
            var dynamicmandflag = $("#dynamic_edit_att #dynamic_mandatory_flag_edit").val();
            var dymic_status = $("#dynamic_edit_att #dynamicstatus_edit").val();
            var dynamic_flov = $("#dynamic_edit_att #dynamiclistvl_data_type").val();
            var dynamic_mandatory_edit = $("#dynamic_edit_att #dynamicedit_mandatory_flag_edit").val();
            var dynamic_display_edit = $("#dynamic_edit_att #dynamic_disp_button_edit").val();
            var dynamic_editcol_edit = $("#dynamic_edit_att #dynamic_editable_edit").val();

            var csrfToken = '{{ csrf_token() }}';
            //return false;
            $.ajax({
                method: "POST",
                url: "{{ url('configuration_updatedynamic') }}",
                data: {
                    'id': id,
                    '_token': csrfToken,

                    'attribute_attname': dynamicname,
                    'attribute_fixdescription': dynamicdes,
                    'datatypes': dynamicdata,
                    'asset_name': dynamicastname,
                    'attribute_fixdefault': dynamicdefault,
                    'attribute_fixflag': dynamicmandflag,
                    'fixstatus': dymic_status,
                    'fixflov': dynamic_flov,
                    'required_notrequired': dynamic_mandatory_edit,
                    'fixedit': dynamic_editcol_edit,
                    'fixdisplay': dynamic_display_edit,



                },

                success: function(data) {

                    dynamicastname = $("#dynamic_edit_att #asset_type_name_dynamicedit option:selected").text();
                    $('#tr_astdyna' + id).html('<td>' + id + '</td><td>' + dynamicastname + '</td><td>' +
                        dynamicname + '</td><td>' + dynamicdes + '</td><td>' + dynamicdata + '</td><td>' +
                        dynamic_flov + '</td><td>' + dynamic_mandatory_edit + '</td><td>' + dynamicdefault +
                        '</td><td>' + dymic_status +
                        '</td><td><button type="button" class="edit" style="border-radius: 0;background-color: #202C55;width: 76px; "data-bs-target="#dynamic_edit_att" data-bs-toggle="modal" onclick="dynamicedit(this)" data-id="' +
                        id + '">Edit</button></td>');

                    $('#dynamic_edit_att .close').click();
                    showToast("Asset Type Fixed Attribute Updated Successfully!", "success");

                }




            })
        }

        function configasst() {



            $('.noactive').toggle();
            if ($(".locationsite i").hasClass('fa-angle-down')) {
                $(".locationsite i").removeClass('fa-angle-down').addClass('fa-angle-up');
            } else {
                $(".locationsite i").removeClass('fa-angle-up').addClass('fa-angle-down');
            }

        }

        function configfixasst() {



            $('.fixconfigass').toggle();
            if ($(".congigfixasset i").hasClass('fa-angle-down')) {
                $(".congigfixasset i").removeClass('fa-angle-down').addClass('fa-angle-up');
            } else {
                $(".congigfixasset i").removeClass('fa-angle-up').addClass('fa-angle-down');
            }

        }

        function configdynamicasst() {



            $('.dynamicconfigass').toggle();
            if ($(".congigdynamicasset i").hasClass('fa-angle-down')) {
                $(".congigdynamicasset i").removeClass('fa-angle-down').addClass('fa-angle-up');
            } else {
                $(".congigdynamicasset i").removeClass('fa-angle-up').addClass('fa-angle-down');
            }

        }



        $("#quickform").click(function(e) {
            e.preventDefault();
            $("#asset_attribute_dynamic").find(".error").removeClass("error");
            $("#asset_attribute_dynamic").find("span").remove();


            var dynamicname = $("#dynamic_at_name").val().trim();
            if (dynamicname == "") {
                $("#dynamic_at_name").focus();
                $("#dynamic_at_name").addClass("error");
                $("#dynamic_at_name").after("<span>Required</span>");
                return false;
            }

            // var dyndescrib= $("#asset_description_dynamic").val().trim(); 
            // if (dyndescrib ==  "") {
            //    $("#asset_description_dynamic").focus();
            //    $("#asset_description_dynamic").addClass("error");
            //    $("#asset_description_dynamic").after("<span>Required</span>");
            //    return false;          
            // }


            var dyndatype = $("#dynamic_att_data_type").val().trim();
            if (dyndatype == "") {
                $("#dynamic_att_data_type").focus();
                $("#dynamic_att_data_type").addClass("error");
                $("#dynamic_att_data_type").after("<span>Required</span>");
                return false;
            }

            // var dynamicfixlistval= $("#dynamiclistvl_data_type").val().trim(); 
            // if (dynamicfixlistval ==  "") {
            //    $("#dynamiclistvl_data_type").focus();
            //    $("#dynamiclistvl_data_type").addClass("error");
            //    $("#dynamiclistvl_data_type").after("<span>Required</span>");
            //    return false;          
            // }

            var dynamicassetname = $("#dynamic_asset_type_name").val().trim();
            if (dynamicassetname == "") {
                $("#dynamic_asset_type_name").focus();
                $("#dynamic_asset_type_name").addClass("error");
                $("#dynamic_asset_type_name").after("<span>Required</span>");
                return false;
            }

            var dynedmand = $("#dynamic_required_notrequired").val().trim();
            if (dynedmand == "") {
                $("#dynamic_required_notrequired").focus();
                $("#dynamic_required_notrequired").addClass("error");
                $("#dynamic_required_notrequired").after("<span>Required</span>");
                return false;
            }


            var dyndisplay = $("#dynamic_disp_button").val().trim();
            if (dyndisplay == "") {
                $("#dynamic_disp_button").focus();
                $("#dynamic_disp_button").addClass("error");
                $("#dynamic_disp_button").after("<span>Required</span>");
                return false;
            }
            var dynedit = $("#asset_attribute_dynamic #fixedit").val().trim();
            if (dynedit == "") {
                $("#asset_attribute_dynamic #fixedit").focus();
                $("#asset_attribute_dynamic #fixedit").addClass("error");
                $("#asset_attribute_dynamic #fixedit").after("<span>Required</span>");
                return false;
            }

            // var dynamicdeafultvalue= $("#dynamic_default_val").val().trim(); 
            // if (dynamicdeafultvalue ==  "") {
            //    $("#dynamic_default_val").focus();
            //    $("#dynamic_default_val").addClass("error");
            //    $("#dynamic_default_val").after("<span>Required</span>");
            //    return false;          
            // }

            var dynamicstatus = $("#dynamicstatus").val().trim();
            if (dynamicstatus == "") {
                $("#dynamicstatus").focus();
                $("#dynamicstatus").addClass("error");
                $("#dynamicstatus").after("<span>Required</span>");
                return false;
            }
            dynamicsave();
            //$("#dynamic_attribute").submit();
        });



        $("#saveattfix").click(function(e) {
            e.preventDefault();
            $("#fixedattribute").find(".error").removeClass("error");
            $("#fixedattribute").find("span").remove();



            var fixname = $("#fixedatt_name").val().trim();

            if (fixname == "") {
                //alert("fixname");
                $("#fixedatt_name").focus();
                $("#fixedatt_name").addClass("error");
                $("#fixedatt_name").after("<span>Required</span>");
                return false;
            }

            // var fixdescription= $("#description_fixed").val().trim(); 
            // if (fixdescription ==  "") {
            //    $("#description_fixed").focus();
            //    $("#description_fixed").addClass("error");
            //    $("#description_fixed").after("<span>Required</span>");
            //    return false;          
            // }


            var fixdatatype = $("#fixedstatus_data_type").val().trim();

            if (fixdatatype == "") {
                //alert("fixdatatype"); 
                $("#fixedstatus_data_type").focus();
                $("#fixedstatus_data_type").addClass("error");
                $("#fixedstatus_data_type").after("<span>Required</span>");
                return false;
            }





            var fixedmand = $("#fix_man_flag").val().trim();

            if (fixedmand == "") {
                //alert("fixedmand");

                $("#fix_man_flag").focus();
                $("#fix_man_flag").addClass("error");
                $("#fix_man_flag").after("<span>Required</span>");
                return false;
            }

            // var fixeddeafultvalue= $("#fixed_default").val().trim(); 
            // // alert(fixeddeafultvalue);
            // if (fixeddeafultvalue ==  "") {
            //    $("#fixed_default").focus();
            //    $("#fixed_default").addClass("error");
            //    $("#fixed_default").after("<span>Required</span>");
            //    return false;          
            // }

            var fixedstatusvalue = $("#fixedstatus_data_type").val().trim();
            if (fixedstatusvalue == "") {
                $("#fixedstatus_data_type").focus();
                $("#fixedstatus_data_type").addClass("error");
                $("#fixedstatus_data_type").after("<span>Required</span>");
                return false;
            }
            var fixdisplay = $("#fix_disp_button").val().trim();
            // alert(fixdisplay);
            if (fixdisplay == "") {

                $("#fix_disp_button").focus();
                $("#fix_disp_button").addClass("error");
                $("#fix_disp_button").after("<span>Required</span>");
                return false;
            }


            var fixededit = $("#fix_edit_button").val().trim();
            // alert(fixededit);
            if (fixededit == "") {

                $("#fix_edit_button").focus();
                $("#fix_edit_button").addClass("error");
                $("#fix_edit_button").after("<span>Required</span>");
                return false;
            }


            var fixedstatus = $("#fixedstatus").val().trim();
            //alert(fixedstatus);
            if (fixedstatus == "") {

                $("#fixedstatus").focus();
                $("#fixedstatus").addClass("error");
                $("#fixedstatus").after("<span>Required</span>");
                return false;
            }
            //$("#fixed_attribute_validation").submit();

            savefix();
        });
    </script>
    {{-- SITE MODAL AND SCRIPT --}}
    {{-- Site type Modal Start --}}

    <div class="modal fade" id="site_add" data-bs-backdrop="static" data-bs-keyboard="false"tabindex="-1"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modwidth" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddModal">Add Site Type</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('congiguration_add_site') }}" method="POST" id="myform">
                        <div class="row">
                            <div class="col-md-6">



                                <div class="form-group">
                                    <label for="site_name" class="col-form-label">Site Type<strong
                                            class="text-danger">*</strong></label>
                                    <input type="site_name" class="form-control" id="site_name"
                                        name="location_type">
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="site_status" class="col-form-label">Site Type Status <strong
                                            class="text-danger">*</strong></label>

                                    <select name="location_type_status" class="form-select" id="site_status">
                                        <option value="" selected>Select</option>
                                        <option value="Valid">Valid</option>
                                        <option value="Invalid">Invalid</option>
                                    </select>
                                </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveadd()" id="save_site">Save</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="resetBtn"
                        value="Reset">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>






    {{-- Site type Edit Modal Start --}}

    <div class="modal fade" id="site_edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="sitemodallLabel" aria-hidden="true">
        <div class="modal-dialog modwidth" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="site_edit2">Update Site</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('congiguration_update_site') }}" method="POST" id="myform2">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="site_editid" class="col-form-label">Site Type <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" id="site_type_edit"
                                        name="location_type">
                                </div>



                            </div>
                            <div class="col-md-6">

                                <input type="hidden" class="form-control" id="site_edit_id">
                                <div class="form-group">
                                    <label for="site_status" class="col-form-label">Site Type Status <strong
                                            class="text-danger">*</strong></label>
                                    {{-- <input type="text" class="form-control" id="site_status" name="site_status">  
                   --}}
                                    <select name="location_type_status" class="form-select" id="site_status_edit">
                                        <option value="" selected>Select</option>
                                        <option value="Valid">Valid</option>
                                        <option value="Invalid">Invalid</option>
                                    </select>
                                </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="update_site()"
                        id="updt_site">Update</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>


    {{-- End --}}
    {{-- site add modal --}}
    <div class="modal fade" id="site_add_location" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modwidth" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddModal">Add Site</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('location_add_site') }}" method="POST" id="locationdetails">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="site_type" id="site_type" class="col-form-label">Site Type <strong
                                            class="text-danger">*</strong></label>


                                    <select name="lt_location_type_masterid" class="form-select random"
                                        id="sitelocation_type" onchange="sitetypefunction(this.value)">
                                        {{-- onclick="sitetypefech(this.value)"  --}}
                                        <option value="" selected>Select</option>
                                        @foreach ($sitetype as $location_site)
                                            <option value="{{ $location_site->lt_location_type_id }}">
                                                {{ $location_site->lt_location_type }}</option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Sitelocation_name" class="col-form-label">Site Name <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" id="sitelocation_name"
                                        name="location_name">
                                </div>



                            </div>
                        </div>
                        <div class="row" id="site_dynamic_form">



                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveaddlocation()"
                        id="save_site">Save</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="resetBtn"
                        value="Reset">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    {{--  site edit modal --}}

    <div class="modal fade" id="site_location" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="sitemodallLabel" aria-hidden="true">
        <div class="modal-dialog modwidth" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="site_edit3">Update Site</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('location_update_site') }}" method="POST" id="myform7">

                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="site_type" class="col-form-label">Site Type <strong
                                            class="text-danger">*</strong></label>

                                    <select name="lt_location_type_masterid" class="form-select random"
                                        id="sitelocation_type_edit" onchange="sitetypefunction(this.value)">

                                        <option value="" selected>Select</option>
                                        @foreach ($sitetype as $location_site)
                                            <option value="{{ $location_site->lt_location_type_id }}">
                                                {{ $location_site->lt_location_type }}</option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Sitelocation_name" class="col-form-label">Site Name <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" id="sitelocation_name_edit"
                                        name="location_name">
                                </div>


                            </div>
                        </div>
                        <div class="row" id="site_dynamic_form_edit">

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="update_location()"
                        id="updt_site">Update</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    </div>



    </div>

    {{-- site_location --}}

    {{-- Site Fixed Attribute modal start --}}

    <div class="modal fade" id="atr_add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modwidth" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_atr">Add Attribute</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('configuration_fixedadd_atr') }}" method="POST" id="myform3">
                        <div class="row">
                            <div class="col-md-6">

                                <input type="hidden" name="sitetype" id="atr_sitetype">

                                <div class="form-group">
                                    <label for="atr_attribute" class="col-form-label">Attribute Name<strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" id="atr_attribute"
                                        name="atr_attribute">


                                </div>
                                <div class="form-group">
                                    <label for="atr_description" class="col-form-label">Description </label>

                                    <input type="text" class="form-control" id="atr_description"
                                        name="atr_description">

                                </div>
                                <div class="form-group">
                                    <label for="atr_datatype" class="col-form-label">Data Type <strong
                                            class="text-danger">*</strong></label>
                                    {{-- <input type="text" class="form-control" id="atr_datatype" name="atr_datatype"> --}}
                                    <select class="form-select" name="datatypes" id="atr_datatype">
                                        <option value="" selected>---Select---</option>
                                        @foreach ($datatypes as $datatype)
                                            <option value="{{ $datatype->typeName }}">{{ $datatype->typeName }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>


                                <div class="form-group" id="atr_fixed_list_of_values_1">
                                    <label for="atr_fixed_list_of_values" class="col-form-label">Fixed List of
                                        Values</label>
                                    <input type="text" class="form-control" id="atr_fixed_list_of_values"
                                        name="atr_fixed_list_of_values">
                                </div>
                                <div class="form-group">
                                    <label for="atr_default_value" class="col-form-label">Default Value</label>
                                    <input type="text" class="form-control" id="atr_default_value"
                                        name="atr_default_value">
                                </div>

                            </div>

                            <div class="col-md-6">


                                <div class="form-group">
                                    <label for="atr_display" class="col-form-label"> Display<strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select" id="atr_display"
                                        name="atr_display">
                                        <option value="">---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="atr_editable" class="col-form-label"> Editable<strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select" id="atr_editable"
                                        name="atr_editable">
                                        <option value="">---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="atr_status" class="col-form-label">Status <strong
                                            class="text-danger">*</strong></label>
                                    {{-- <input type="text" class="form-control" id="atr_status" name="atr_status"> --}}
                                    <select name="atr_status" class="form-select" id="atr_status">
                                        <option value="" selected>--Select--</option>
                                        <option value="Valid">Valid</option>
                                        <option value="Invalid">Invalid</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fixed_mandatory_flag" class="col-form-label">Mandatory Flag<strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select" id="fix_manflg_site"
                                        name='fixed_required' required data-required="true">
                                        <option value=" ">---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="add_fix_attribute()"
                        id="sitefixat">Save</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>


    {{-- End Attribute Fixed Add Attribute Modal --}}

    {{-- Site  Fixed Attribute edit modal start --}}



    <div class="modal fade" id="atr_edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modwidth" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_atr">Update Attribute</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('configuration_fixedupdate_atr') }}" method="POST" id="myform4">


                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group d-none">
                                    <label for="editatr_id" class="col-form-label">Id</label>
                                    <input type="text" class="form-control" id="editatr_id" name="editatr_id">
                                </div>

                                <div class="form-group">
                                    <label for="editatr_attribute" class="col-form-label">Attribute <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" id="editatr_attribute"
                                        name="editatr_attribute">

                                </div>
                                <div class="form-group">
                                    <label for="editatr_description" class="col-form-label">Description</label>

                                    <input type="text" class="form-control" id="editatr_description"
                                        name="editatr_description">

                                </div>
                                <div class="form-group">
                                    <label for="editatr_datatype" class="col-form-label">Data Type <strong
                                            class="text-danger">*</strong></label>
                                    {{-- <input type="text" class="form-control" id="editatr_datatype" name="editatr_datatype"> --}}
                                    <select class="form-select" name="datatypes" id="editatr_datatype">
                                        <option value="" selected>Select</option>
                                        @foreach ($datatypes as $datatype)
                                            <option value="{{ $datatype->typeName }}">{{ $datatype->typeName }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group" id="editatr_fixed_list_of_values_1">
                                    <label for="editatr_fixed_list_of_values" class="col-form-label">Fixed List of
                                        Values <strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" id="editatr_fixed_list_of_values"
                                        name="editatr_fixed_list_of_values">
                                </div>

                                <div class="form-group">
                                    <label for="editatr_default_value" class="col-form-label">Default Value</label>
                                    <input type="text" class="form-control" id="editatr_default_value"
                                        name="editatr_default_value">
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group d-none">
                                    <label for="editatr_mandatory_flag" class="col-form-label">Mandatory Flag <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" id="editatr_mandatory_flag"
                                        name="editatr_mandatory_flag">
                                </div>

                                <div class="form-group">
                                    <label for="editatr_display" class="col-form-label"> Display<strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body"class="form-select" id="editatr_display"
                                        name="editatr_display">
                                        <option value="">---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="editatr_editable" class="col-form-label"> Editable<strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body"class="form-select" id="editatr_editable"
                                        name="editatr_editable">
                                        <option value="">---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>



                                </div>
                                <div class="form-group">
                                    <label for="editatr_status" class="col-form-label">Status <strong
                                            class="text-danger">*</strong></label>
                                    {{-- <input type="text" class="form-control" id="editatr_status" name="editatr_status"> --}}

                                    <select name="editatr_status" class="form-select" id="editatr_status">
                                        <option value="" selected>--Select--</option>
                                        <option value="Valid">Valid</option>
                                        <option value="Invalid">Invalid</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fixed_mandatory_flag" class="col-form-label">Mandatory Flag<strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select" id="fix_manflg_site_edite"
                                        name='fixed_required' data-required="true">
                                        <option>---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                {{-- <div class="form-group">
                   <label for="message-text" class="col-form-label">Message:</label>
                   <textarea class="form-control" id="message-text"></textarea>
                 </div> --}}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="fixed_atr_updt()"
                        id="updt_fixesite">Update</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>




    {{-- Site Attribute dynamic modal --}}

    <div class="modal fade" id="atr_dynamic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modwidth" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dynamic_add">Add Attribute</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('configuration_dynamicadd_atr') }}" method="POST" id="myform5">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="dynamicatr_datatype" class="col-form-label">Site Type<strong
                                            class="text-danger">*</strong></label>
                                    {{-- <input type="text" class="form-control" id="dynamicatr_datatype" name="dynamicatr_datatype"> --}}
                                    <select class="form-select" name="sitetype" id="dynamicatr_sitetype">
                                        <option value="" selected>Select</option>
                                        @foreach ($dynamicatrsitetype as $dynamic_site)
                                            <option value="{{ $dynamic_site->lt_location_type_id }}">
                                                {{ $dynamic_site->lt_location_type }}</option>
                                        @endforeach
                                    </select>


                                </div>
                                <div class="form-group">
                                    <label for="dynamicatr_attribute" class="col-form-label">Attribute <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" id="dynamicatr_attribute"
                                        name="dynamicatr_attribute">



                                </div>
                                <div class="form-group">
                                    <label for="dynamicatr_description" class="col-form-label">Description </label>

                                    <input type="text" class="form-control" id="dynamicatr_description"
                                        name="dynamicatr_description">

                                </div>

                                <div class="form-group">
                                    <label for="dynamicatr_sitetype" class="col-form-label">Data Type <strong
                                            class="text-danger">*</strong></label>

                                    {{-- <select name="dynamicatr_sitetype" class="form-select" id="dynamicatr_sitetype"> --}}
                                    {{-- <option value="SITES">SITES</option>
                   <option value="WAREHOUSE">WAREHOUSE</option> --}}
                                    {{-- </select> --}}

                                    <select name="datatypes" class="form-select" id="dynamicatr_datatype">

                                        <option value="" selected>Select</option>
                                        @foreach ($datatypes as $datatype)
                                            <option value="{{ $datatype->typeName }}">{{ $datatype->typeName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="dynamicatr_fixedlist_1">
                                    <label for="dynamicatr_fixedlist" class="col-form-label">Fixed List of Values
                                        <strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" id="dynamicatr_fixedlist"
                                        name="dynamicatr_fixedlist">
                                </div>
                                <div class="form-group">
                                    <label for="fixed_mandatory_flag" class="col-form-label">Mandatory Flag<strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select" id="dynamic_manflg_site"
                                        name='fixed_required' required data-required="true">
                                        <option value=" ">---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>




                            </div>
                            <div class="col-md-6">



                                {{-- <div class="form-group">
                  <label for="dynamicatr_mandatory_flag" class="col-form-label">Mandatory Flag <strong class="text-danger">*</strong></label>
                  <input type="text" class="form-control" id="dynamicatr_mandatory_flag" name="dynamicatr_mandatory_flag">
                </div> --}}
                                <div class="form-group">
                                    <label for="dynamicatr_default_value" class="col-form-label">Default Value</label>
                                    <input type="text" class="form-control" id="dynamicatr_default_value"
                                        name="dynamicatr_default_value">
                                </div>
                                <div class="form-group">

                                    <label for="dynamicatr_display" class="col-form-label"> Display<strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select" id="dynamicatr_display"
                                        name="dynamicatr_display">
                                        <option value="">---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>


                                </div>
                                <div class="form-group">

                                    <label for="dynamicatr_editable" class="col-form-label"> Editable<strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select" id="dynamicatr_editable"
                                        name="dynamicatr_editable">
                                        <option value="">---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label for="dynamicatr_status" class="col-form-label">Status <strong
                                            class="text-danger">*</strong></label>
                                    {{-- <input type="text" class="form-control" id="dynamicatr_status" name="dynamicatr_status"> --}}
                                    <select name="dynamicatr_status" class="form-select" id="dynamicatr_status">
                                        <option value="" selected>Select</option>
                                        <option value="Valid">Valid</option>
                                        <option value="Invalid">Invalid</option>
                                    </select>
                                </div>
                                {{-- <div class="form-group">
                   <label for="message-text" class="col-form-label">Message:</label>
                   <textarea class="form-control" id="message-text"></textarea>
                 </div> --}}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="add_dynamic_attribute()"
                        id="savedyna">Save</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>



    {{-- Dynamic Attribute edit modal --}}

    <div class="modal fade" id="dynamicatr_edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modwidth" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dynamicmodify_atr">Update Attribute</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ url('configuration_dynamicupdate_atr') }}" method="POST" id="myform6">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group d-none">
                                    <label for="dynamiceditatr_id" class="col-form-label">Id</label>
                                    <input type="text" class="form-control" id="dynamiceditatr_id"
                                        name="dynamiceditatr_id" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="dynamicatr_sitetype" class="col-form-label">Site Type<strong
                                            class="text-danger">*</strong></label>

                                    {{-- <select name="dynamicatr_sitetype" class="form-select" id="dynamicatr_sitetype"> --}}
                                    {{-- <option value="SITES">SITES</option>
                   <option value="WAREHOUSE">WAREHOUSE</option> --}}
                                    {{-- </select> --}}

                                    <select name="sitetype" class="form-select" id="dynamiceditatr_sitetype">

                                        <option value="" selected>Select</option>
                                        @foreach ($dynamicatrsitetype as $dynamic_site)
                                            <option value="{{ $dynamic_site->lt_location_type_id }}">
                                                {{ $dynamic_site->lt_location_type }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="dynamiceditatr_attribute" class="col-form-label">Attribute <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" id="dynamiceditatr_attribute"
                                        name="dynamiceditatr_attribute">
                                    {{-- <select name="dynamiceditatr_attribute" class="form-select" id="dynamiceditatr_attribute">
                    <option value="SITES">SITES</option>
                    <option value="WAREHOUSE">WAREHOUSE</option>
                    <option value="CITY">CITY</option>
                    
                  </select> --}}

                                </div>
                                <div class="form-group">
                                    <label for="dynamiceditatr_description" class="col-form-label">Description</label>

                                    <input type="text" class="form-control" id="dynamiceditatr_description"
                                        name="dynamiceditatr_description">

                                </div>
                                <div class="form-group">
                                    <label for="dynamiceditatr_datatype" class="col-form-label">Data Type <strong
                                            class="text-danger">*</strong></label>
                                    {{-- <input type="text" class="form-control" id="dynamiceditatr_datatype" name="dynamiceditatr_datatype"> --}}

                                    <select class="form-select" name="datatypes" id="dynamiceditatr_datatype">
                                        <option value="" selected>Select</option>
                                        @foreach ($datatypes as $datatype)
                                            <option value="{{ $datatype->typeName }}">{{ $datatype->typeName }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group" id="dynamic_site_flov_edit">
                                    <label for="dynamiceditatr_fixed_list_of_values" class="col-form-label">Fixed List
                                        of Values <strong class="text-danger">*</strong></label>
                                    <input type="text" class="form-control"
                                        id="dynamiceditatr_fixed_list_of_values"
                                        name="dynamiceditatr_fixed_list_of_values">
                                </div>
                                <div class="form-group">
                                    <label for="fixed_mandatory_flag" class="col-form-label">Mandatory Flag<strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select" id="dynamic_manflg_site_edit"
                                        name='fixed_required' data-required="true">
                                        <option>---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-6">

                                {{-- <div class="form-group d-none">
                 
                  <label for="dynamiceditatr_mandatory_flag" class="col-form-label"> Mandatory Flag<strong class="text-danger">*</strong></label>
                  <select data-container="body"  class="form-select" id="dynamiceditatr_mandatory_flag" name="dynamiceditatr_mandatory_flag">
                     
                     <option value="NOT REQUIRED">NOT REQUIRED</option>
                         
                  </select> 
                </div> --}}
                                <div>
                                    <input type="hidden"name="dynamiceditatr_mandatory_flag"
                                        class="form-control"id="dynamiceditatr_mandatory_flag" value="REQUIRED">
                                </div>
                                <div class="form-group">
                                    <label for="dynamiceditatr_default_value" class="col-form-label">Default
                                        Value</label>
                                    <input type="text" class="form-control" id="dynamiceditatr_default_value"
                                        name="dynamiceditatr_default_value">
                                </div>
                                <div class="form-group">

                                    <label for="dynamiceditatr_display" class="col-form-label"> Display<strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body" class="form-select" id="dynamiceditatr_display"
                                        name="dynamiceditatr_display" data-required="true">
                                        <option>---Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>


                                </div>
                                <div class="form-group">
                                    <label for="dynamiceditatr_editable" class="col-form-label"> Editable<strong
                                            class="text-danger">*</strong></label>
                                    <select data-container="body"class="form-select" id="dynamiceditatr_editable"
                                        name="dynamiceditatr_editable" data-required="true">
                                        <option>--Select--</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="dynamiceditatr_status" class="col-form-label">Status <strong
                                            class="text-danger">*</strong></label>
                                    {{-- <input type="text" class="form-control" id="dynamiceditatr_default_value" name="dynamiceditatr_default_value"> --}}
                                    <select name="dynamiceditatr_status" class="form-select"
                                        id="dynamiceditatr_status">
                                        <option value="" selected>Select</option>
                                        <option value="Valid">Valid</option>
                                        <option value="Inalid">Inalid</option>
                                    </select>
                                </div>
                                {{-- <div class="form-group">
                   <label for="message-text" class="col-form-label">Message:</label>
                   <textarea class="form-control" id="message-text"></textarea>
                 </div> --}}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="dynamic_atr_updt()"
                        id="updtdyna">Update</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>








    {{-- </div>  --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            // Add event listeners to form elements
            // $('#site_name,#site_status').on('input change', checkFormSite);
        });


        // Function to check if all fields are filled
        function checkFormSite() {
            var allFieldsFilled = true;
            // Check if all fields have values
            $('#myform input[type="text"],#myform select').each(function() {
                if ($(this).val().trim() == '') {
                    allFieldsFilled = false;
                    return false; // Exit the loop if any field is empty
                }
            });

            // Change button color based on field values
            if (allFieldsFilled) {

                $('#save_site').removeClass('btn-primary').addClass('btn-primary');
            } else {
                $('#save_site').removeClass('btn-primary').addClass('btn-primary ');
            }
        }

        // site fixed attribute
        $(document).ready(function() {
            // Add event listeners to form elements
            $('#atr_attribute,#atr_datatype, #atr_fixed_list_of_values, #atr_default_value, #atr_display, #atr_editable, #atr_status,#fix_manflg_site')
                .on('input change', checkFormSitefix);
        });

        // Function to check if all fields are filled
        function checkFormSitefix() {
            var allFieldsFilled = true;
            // Check if all fields have values
            $('#myform3 input[type="text"],#myform3 select').not(
                "#atr_fixed_list_of_values, #atr_default_value, #atr_display, #atr_editable").each(function() {
                if ($(this).val().trim() == '') {
                    allFieldsFilled = false;
                    // alert("asd");
                    return false; // Exit the loop if any field is empty
                }
            });
            console.log(allFieldsFilled);

            // Change button color based on field values
            if (allFieldsFilled) {
                $('#sitefixat').removeClass('btn-primary').addClass('btn-primary');
            } else {
                $('#sitefixat').removeClass('btn-primary').addClass('btn-primary');
            }
        }



        $(document).ready(function() {
            // Add event listeners to form elements
            $('#dynamicatr_sitetype,#dynamicatr_attribute, #dynamicatr_display,#dynamicatr_editable, #dynamicatr_datatype, #dynamicatr_status, #dynamicatr_fixedlist')
                .on('input change', checkFormSitedynamicadd);
        });

        // Function to check if all fields are filled
        function checkFormSitedynamicadd() {
            var allFieldsFilled = true;
            // Check if all fields have values
            $('#myform5 input[type="text"],#myform5 select').not(
                "#dynamicatr_display, #dynamicatr_editable, #dynamicatr_fixedlist").each(function() {
                if ($(this).val().trim() == '') {
                    allFieldsFilled = false;
                    // alert("asd");
                    return false; // Exit the loop if any field is empty
                }
            });

            //console.log(allFieldsFilled);

            // Change button color based on field values
            if (allFieldsFilled) {
                $('#savedyna').removeClass('btn-primary').addClass('btn-primary');
            } else {
                $('#savedyna').removeClass('btn-primary').addClass('btn-primary');
            }
        }

        $(document).ready(function() {
            $(".edtbtn").click(function() {
                $("#site_editid").val($(this).attr('data-id'));
            });
            $(".searchIn").keypress(function() {
                $(this).removeClass().addClass("searchOut")
            })

            $(".searchIn").click(function() {
                if (!$(this).hasClass("searchOut"))
                    $(this).addClass("searchIn")
            })

            $(document).on("keyup", ".searchOut", function() {
                if (($(this).val().length) == 0)
                    $(this).removeClass().addClass("searchIn")
            })
        })

        // site_type //



        function saveadd() {
            //alert("mm");
            // if ($("#site_type").val() === '') {
            //     event.preventDefault(); 
            $(".dataTables_empty").parent().remove();
            //   }
            $('#site_add').on('hidden.bs.modal', function() {
                $('#site_add form')[0].reset();
            });
            $("#site_add").find(".error").removeClass("error");
            $("#site_add").find("span").remove();

            var sitename = $("#site_name").val().trim();

            var sitestatus = $("#site_status").val().trim();

            var csrfToken = '{{ csrf_token() }}';



            if (sitename == "") {
                $("#site_name").focus();
                $("#site_name").addClass("error");
                $("#site_name").after("<span>Required</span>");
                return false;
            }


            if (sitestatus == "") {
                $("#site_status").focus();
                $("#site_status").addClass("error");
                $("#site_status").after("<span>Required</span>");
                return false;
            }


            $.ajax({
                method: "POST",
                url: "{{ url('congiguration_add_site') }}",
                data: {
                    '_token': csrfToken,

                    'location_type': sitename,

                    'location_type_status': sitestatus,
                },

                success: function(data) {
                    //   console.log(data);
                    //    $('#siteonly').row.add([data.lt_location_type_id,data.sitename,data.sitestatus
                    // ]).draw();

                    $('#siteonly').append('<tr id="tr_onlysite' + data +
                        '" class="dataTbltdhight"><td class="sorting_1">' + data + '</td><td>' + sitename +
                        '</td><td>' + sitestatus +
                        '</td><td> <button type="button" class="edit edtbtn" style="border-radius: 0; background-color: #202C55;width: 76px;" data-bs-toggle="modal" data-bs-target="#site_edit" onclick="siteDetails(this)" data-id="' +
                        data + '">Edit</button></tr>');

                    $('#site_add .close').click();

                    showToast("Site Type Added Successfully!", "success");

                }

            });


        }

        function isValueExists() {
            $("#site_id").removeClass("error");
            $("#site_id").parent().find("span").remove();
            var locationcode = $('#site_id').val();
            var csrfToken = '{{ csrf_token() }}';
            var submitButton = $("#submit_button");
            $.ajax({
                method: "POST",
                url: "{{ url('congiguration_check_site') }}",
                data: {
                    '_token': csrfToken,
                    'location_code': locationcode
                },
                success: function(data) {
                    if (data['sitecheck'] != "") {
                        $("#site_id").focus();
                        $("#site_id").addClass("error");
                        $("#site_id").after("<span>Site Code already exists</span>");
                        submitButton.prop("disabled", true); // Disable the submit button
                        // return false;
                    } else {
                        submitButton.prop("disabled", false); // Enable the submit button
                    }
                }

            });
        }

        // alert($(e).data("id"));
        function siteDetails(e) {
            $.ajax({
                type: "GET",
                //   url: 'http://3.111.113.246/umprojnew/public/index.php/',
                url: "{{ url('congiguration_edit_site') }}",
                data: {
                    'location_type_id': $(e).data("id"),
                },
                beforeSend: function() {
                    $('#loader').removeClass('hidden');
                    $("#loading").show();
                },
                complete: function() {
                    $("#loading").hide();
                },
                success: function(result) {
                    console.log(result);
                    $('#loader').addClass('hidden');

                    if (result.status == 'success') {

                        $("#site_edit #site_type_edit").val(result.fetch_site_details[0]['lt_location_type'])
                    }
                    if (result.status == 'success') {
                        $("#site_edit #site_address_edit").val(result.fetch_site_details[0][
                            'lt_location_type_address'
                        ])
                    }
                    if (result.status == 'success') {
                        $("#site_edit #site_type_name_edit").val(result.fetch_site_details[0][
                            'lt_location_type_name'
                        ])

                    }

                    if (result.status == 'success') {

                        $("#site_edit #site_status_edit").val(result.fetch_site_details[0][
                            'lt_location_type_status'
                        ]).prop('selected', true);

                    }
                    if (result.status == 'success') {

                        $("#site_edit #site_edit_id").val(result.fetch_site_details[0]['lt_location_type_id'])

                    }
                }


            });
        }
        $("#site_edit").find(".error").removeClass("error");
        $("#site_edit").find("span").remove();



        function update_site() {
            //alert("mm");

            $("#site_edit").find(".error").removeClass("error");
            $("#site_edit").find("span").remove();

            var locationtypeedit = $("#site_edit #site_type_edit").val();
            var loc_typ_nam_edit = $("#site_edit #site_type_name_edit").val();
            //  console.log(sitetype);
            var loc_typ_address_edit = $("#site_edit #site_address_edit").val();
            var loc_typ_status_edit = $("#site_edit #site_status_edit").val();

            var loc_typ_id_edit = $("#site_edit #site_edit_id").val();

            var csrfToken = '{{ csrf_token() }}';

            if (locationtypeedit == "") {
                $("#site_type_edit").focus();
                $("#site_type_edit").addClass("error");
                $("#site_type_edit").after("<span>Required</span>");
                return false;
            }

            if (loc_typ_status_edit == "") {
                $("#site_status_edit").focus();
                $("#site_status_edit").addClass("error");
                $("#site_status_edit").after("<span>Required</span>");
                return false;
            }
            //alert("mm");
            $.ajax({
                method: "POST",
                url: "{{ url('congiguration_update_site') }}",
                data: {
                    '_token': csrfToken,
                    'location_type': locationtypeedit,
                    'location_type_address': loc_typ_address_edit,
                    'location_type_status': loc_typ_status_edit,
                    'location_type_name': loc_typ_nam_edit,
                    'lt_location_type_id': loc_typ_id_edit,


                },

                success: function(data) {
                    //alert("mm");
                    $('#tr_onlysite' + loc_typ_id_edit).html('<td>' + loc_typ_id_edit + '</td><td>' +
                        locationtypeedit + '</td><td>' + loc_typ_status_edit +
                        '</td><td><button type="button" class="edit edtbtn" style="border-radius: 0;background-color: #202C55;width: 76px;" data-bs-toggle="modal" data-bs-target="#site_edit" onclick="siteDetails(this)" data-id="' +
                        loc_typ_id_edit + '">Edit</button></td>');

                    $('#site_edit .close').click();

                    showToast("Site Type Updated Successfully!", "success");

                }



            });

        }

        function add_fix_attribute() {
            $(".dataTables_empty").parent().remove();

            $(document).ready(function() {
                $('#atr_datatype').on('change', function() {


                    if (selectedOption === 'FLoV') {
                        $atrfixedlistofvalues.show(); // Show the input field if Option 2 is selected
                        $atrfixedlistofvalues.prop('disabled', false); // Enable the input field
                    } else {
                        $atrfixedlistofvalues.hide(); // Hide the input field for other options
                        $atrfixedlistofvalues.prop('disabled', true); // Disable the input field
                    }
                });
            });


            $('#atr_add').on('hidden.bs.modal', function() {
                $('#atr_add form')[0].reset();
            });
            $("#atr_add").find(".error").removeClass("error");
            $("#atr_add").find("span").remove();


            var atrtype = $("#atr_add #atr_attribute").val().trim();
            var atrdescription = $("#atr_add #atr_description").val().trim();
            var atrdatatype = $("#atr_add #atr_datatype").val().trim();
            var atrfixedlistofvalues = $("#atr_add #atr_fixed_list_of_values").val().trim();
            var atrmandatoryflag = "REQUIRED".trim();
            var atrdefaultvalue = $("#atr_add #atr_default_value").val().trim();
            var atrdisplay = $("#atr_add #atr_display").val().trim();
            var atreditable = $("#atr_add #atr_editable").val().trim();
            var atrstatus = $("#atr_add #atr_status").val().trim();
            var atrsitetypes = "0";
            var fix_mandatory = $("#atr_add #fix_manflg_site").val().trim();



            var csrfToken = '{{ csrf_token() }}';

            if (atrtype == "") {
                $("#atr_attribute").focus();
                $("#atr_attribute").addClass("error");
                $("#atr_attribute").after("<span>Required</span>");
                return false;
            }
            // if (atrdescription ==  "") {
            //    $("#atr_description").focus();
            //    $("#atr_description").addClass("error");
            //    $("#atr_description").after("<span>Required</span>");
            //    return false;          
            // }

            if (atrdatatype == "") {
                $("#atr_datatype").focus();
                $("#atr_datatype").addClass("error");
                $("#atr_datatype").after("<span>Required</span>");
                return false;
            }

            if (atrdisplay == "") {
                $("#atr_display").focus();
                $("#atr_display").addClass("error");
                $("#atr_display").after("<span>Required</span>");
                return false;
            }

            if (atreditable == "") {
                $("#atr_editable").focus();
                $("#atr_editable").addClass("error");
                $("#atr_editable").after("<span>Required</span>");
                return false;
            }


            if (atrstatus == "") {
                $("#atr_status").focus();
                $("#atr_status").addClass("error");
                $("#atr_status").after("<span>Required</span>");
                return false;
            }
            if (fix_mandatory == "") {
                $("#fix_manflg_site").focus();
                $("#fix_manflg_site").addClass("error");
                $("#fix_manflg_site").after("<span>Required</span>");
                return false;
            }

            $.ajax({
                method: "POST",
                url: "{{ url('configuration_fixedadd_atr') }}",
                data: {
                    '_token': csrfToken,
                    'la_location_attribute_location_type': atrtype,
                    'la_location_attribute_name': atrtype,
                    'la_location_attribute_description': atrdescription,
                    'datatypes': atrdatatype,
                    'la_flov': atrfixedlistofvalues,

                    'la_location_attribute_mandatory_flag': atrmandatoryflag,
                    'la_location_attribute_default_value': atrdefaultvalue,
                    'la_display': atrdisplay,
                    'la_editable': atreditable,
                    'la_status': atrstatus,
                    'sitetype': atrsitetypes,
                    'fixed_required': fix_mandatory,


                },
                success: function(data) {
                    $('#sitefixedtable').append('<tr id="tr_sitefix' + data + '" class="dataTbltdhight"><td>' +
                        data + '</td><td>' + atrtype + '</td><td>' + atrdescription + '</td><td>' +
                        atrdatatype + '</td><td>' + atrfixedlistofvalues + '</td><td>' + fix_mandatory +
                        '</td><td>' + atrdefaultvalue + '</td><td>' + atrdisplay + '</td><td>' +
                        atreditable + '</td><td>' + atrstatus +
                        '</td><td><button type="button" class="edit" style="border-radius: 0;background-color: #202C55;width: 76px;" data-bs-toggle="modal" data-bs-target="#atr_edit" data-id="' +
                        data + '" onclick="fixed_attr(this)">Edit</button></td></tr>');

                    $('#atr_add .close').click();
                    showToast("Site Fixed Attribute Added Successfully!", "success");

                }



            })



        }

        function fixed_attr(e) {
            //alert($(e).data("id"));
            //$('#editatr_fixed_list_of_values').prop('disabled', true);
            if ($('#updt_fixesite').hasClass("btn-primary")) {
                $('#updt_fixesite').removeClass("btn-primary")
                $('#updt_fixesite').addClass("btn-primary")
            }
            $.ajax({
                type: "GET",
                //url: 'http://3.111.113.246/umprojnew/public/index.php/locationdb',
                url: "{{ url('configuration_fixedfetch_atr') }}",
                data: {
                    'fixedatr_id': $(e).data("id"),
                },
                beforeSend: function() {
                    $('#loader').removeClass('hidden');
                    $("#loading").show();
                },
                complete: function() {
                    $("#loading").hide();
                },
                success: function(result) {
                    console.log(result);

                    $('#loader').addClass('hidden');

                    if (result.status == 'success') {
                        //console.log(result.fetchfixattr[0]['ata_asset_type_attribute_code']);
                        $("#atr_edit #editatr_id").val(result.fixed_atr_fetch_edit[0][
                            'la_location_attribute_id'
                        ]);
                    }
                    if (result.status == 'success') {
                        $("#atr_edit #editatr_attribute").val(result.fixed_atr_fetch_edit[0][
                            'la_location_attribute_name'
                        ]);
                        $("#atr_edit #fix_manflg_site_edite").val(result.fixed_atr_fetch_edit[0][
                            'la_requiered_not_required_flag'
                        ]);
                    }

                    if (result.status == 'success') {

                        $("#atr_edit #editatr_description").val(result.fixed_atr_fetch_edit[0][
                            'la_location_attribute_description'
                        ]);

                    }
                    if (result.status == 'success') {
                        // console.log(result.fixed_atr_fetch_edit[0]['la_location_attribute_datatype']);
                        $("#atr_edit #editatr_datatype").val(result.fixed_atr_fetch_edit[0][
                            'la_location_attribute_datatype'
                        ]);
                        //console.log(result.fixed_atr_fetch_edit[0]);
                        if (result.fixed_atr_fetch_edit[0]['la_location_attribute_datatype'] == "FLoV") {
                            $('#editatr_fixed_list_of_values_1').show();
                        } else {
                            $('#editatr_fixed_list_of_values_1').hide();
                        }

                    }
                    if (result.status == 'success') {

                        $("#atr_edit #editatr_fixed_list_of_values").val(result.fixed_atr_fetch_edit[0][
                            'la_flov'
                        ]);

                    }
                    if (result.status == 'success') {
                        $("#atr_edit #editatr_mandatory_flag").val(result.fixed_atr_fetch_edit[0][
                            'la_location_attribute_mandatory_flag'
                        ]);
                    }

                    if (result.status == 'success') {
                        $("#atr_edit #editatr_default_value").val(result.fixed_atr_fetch_edit[0][
                            'la_location_attribute_default_value'
                        ]);

                    }
                    if (result.status == 'success') {
                        $("#atr_edit #editatr_display").val(result.fixed_atr_fetch_edit[0]['la_display']);

                    }
                    if (result.status == 'success') {
                        $("#atr_edit #editatr_editable").val(result.fixed_atr_fetch_edit[0]['la_editable']);

                    }
                    if (result.status == 'success') {
                        $("#atr_edit #editatr_status").val(result.fixed_atr_fetch_edit[0]['la_status']);

                    }







                }


            })

            $("#atr_edit").find(".error").removeClass("error");
            $("#atr_edit").find("span").remove();


        }


        function fixed_atr_updt() {

            $("#atr_edit").find(".error").removeClass("error");
            $("#atr_edit").find("span").remove();

            var atrfixedid = $("#atr_edit #editatr_id").val();
            var atrfixedatrname = $("#atr_edit #editatr_attribute").val();
            var atrfixeddescription = $("#atr_edit #editatr_description").val();
            var atrfixeddatatype = $("#atr_edit #editatr_datatype").val();
            var atrfixedflov = $("#atr_edit #editatr_fixed_list_of_values").val();

            var atrfixedmandflg = $("#atr_edit #editatr_mandatory_flag").val();
            var atrfixeddefaultvalue = $("#atr_edit #editatr_default_value").val();
            var atrfixeddisplay = $("#atr_edit #editatr_display").val();
            var atrfixededitable = $("#atr_edit #editatr_editable").val();
            var atrfixedstatus = $("#atr_edit #editatr_status").val();
            var site_fix_man = $("#atr_edit #fix_manflg_site_edite").val();

            var atrsitetype = "0";

            var csrfToken = '{{ csrf_token() }}';
            //return false;

            if (atrfixedid == "") {
                $("#editatr_id").focus();
                $("#editatr_id").addClass("error");
                $("#editatr_id").after("<span>Required</span>");
                return false;
            }
            if (atrfixedatrname == "") {
                $("#editatr_attribute").focus();
                $("#editatr_attribute").addClass("error");
                $("#editatr_attribute").after("<span>Required</span>");
                return false;
            }

            // if (atrfixeddescription ==  "") {
            //    $("#editatr_description").focus();
            //    $("#editatr_description").addClass("error");
            //    $("#editatr_description").after("<span>Required</span>");
            //    return false;          
            // }
            if (atrfixeddatatype == "") {
                $("#editatr_datatype").focus();
                $("#editatr_datatype").addClass("error");
                $("#editatr_datatype").after("<span>Required</span>");
                return false;
            }
            if (atrfixedflov == "" && atrfixeddatatype == "FLoV") {
                $("#editatr_fixed_list_of_values").focus();
                $("#editatr_fixed_list_of_values").addClass("error");
                $("#editatr_fixed_list_of_values").after("<span>Required</span>");
                return false;
            }




            if (atrfixedmandflg == "") {
                $("#editatr_mandatory_flag").focus();
                $("#editatr_mandatory_flag").addClass("error");
                $("#editatr_mandatory_flag").after("<span>Required</span>");
                return false;
            }
            // if (atrfixeddefaultvalue ==  "") {
            //       $("#editatr_default_value").focus();
            //       $("#editatr_default_value").addClass("error");
            //       $("#editatr_default_value").after("<span>Required</span>");
            //       return false;          
            //    }  

            if (atrfixedstatus == "") {
                $("#editatr_status").focus();
                $("#editatr_status").addClass("error");
                $("#editatr_status").after("<span>Required</span>");
                return false;
            }


            $.ajax({
                method: "POST",
                url: "{{ url('configuration_fixedupdate_atr') }}",
                data: {
                    'la_location_attribute_id': atrfixedid,
                    '_token': csrfToken,
                    'la_location_attribute_location_type': atrfixedatrname,
                    'la_location_attribute_description': atrfixeddescription,
                    'datatypes': atrfixeddatatype,
                    'la_flov': atrfixedflov,
                    'la_location_attribute_mandatory_flag': atrfixedmandflg,
                    'la_location_attribute_default_value': atrfixeddefaultvalue,
                    'la_display': atrfixeddisplay,
                    'la_editable': atrfixededitable,
                    'la_status': atrfixedstatus,
                    'sitetype': atrsitetype,
                    'fixed_required': site_fix_man,

                },
                success: function(data) {
                    //   $('#editatr_fixed_list_of_values').prop('disabled', true);
                    // alert('hii');
                    $('#tr_sitefix' + atrfixedid).html('<td>' + atrfixedid + '</td><td>' + atrfixedatrname +
                        '</td><td>' + atrfixeddescription + '</td><td>' + atrfixeddatatype + '</td><td>' +
                        atrfixedflov + '</td><td>' + site_fix_man + '</td><td>' + atrfixeddefaultvalue +
                        '</td><td>' + atrfixeddisplay + '</td><td>' + atrfixededitable + '</td><td>' +
                        atrfixedstatus +
                        '</td><td><button type="button" class="edit" style="border-radius: 0;background-color: #202C55;width: 76px;" data-bs-toggle="modal" data-bs-target="#atr_edit" data-id="' +
                        atrfixedid + '" onclick="fixed_attr(this)">Edit</button></td></td>');

                    $('#atr_edit .close').click();

                    showToast("Site Fixed Attribute Updated Successfully!", "success");




                },


            })
        }

        function add_dynamic_attribute() {


            // if ($("#dynamicatr_sitetype").val() === '') {
            //     event.preventDefault(); 
            $(".dataTables_empty").parent().remove();
            //   }

            $('#atr_dynamic').on('hidden.bs.modal', function() {
                $('#atr_dynamic form')[0].reset();
            });
            $("#atr_dynamic").find(".error").removeClass("error");
            $("#atr_dynamic").find("span").remove();


            //  var dynamicatrid = $("#atr_dynamic #dynamicatr_id").val();
            var dynamicatrtype = $("#atr_dynamic #dynamicatr_sitetype").val().trim();
            var dynamicatr = $("#dynamicatr_attribute").val().trim();

            var dynamicatrdescription = $("#atr_dynamic #dynamicatr_description").val().trim();
            var dynamicatrdatatype = $("#atr_dynamic #dynamicatr_datatype").val().trim();
            var dynamicatrfixedlistofvalues = $("#atr_dynamic #dynamicatr_fixedlist").val().trim();
            var dynamicatrmandatoryflag = "NOT REQUIRED";
            var dynamicatrdefaultvalue = $("#atr_dynamic #dynamicatr_default_value").val().trim();
            var dynamicatrdisplay = $("#atr_dynamic #dynamicatr_display").val().trim();
            var dynamicatreditable = $("#atr_dynamic #dynamicatr_editable").val().trim();
            var dynamicatrstatus = $("#atr_dynamic #dynamicatr_status").val().trim();
            var dynamicatrmandatory = $("#atr_dynamic #dynamic_manflg_site").val().trim();



            var csrfToken = '{{ csrf_token() }}';

            if (dynamicatrtype == "") {
                $("#dynamicatr_sitetype").focus();
                $("#dynamicatr_sitetype").addClass("error");
                $("#dynamicatr_sitetype").after("<span>Required</span>");
                return false;
            }
            if (dynamicatr == "") {
                $("#dynamicatr_attribute").focus();
                $("#dynamicatr_attribute").addClass("error");
                $("#dynamicatr_attribute").after("<span>Required</span>");
                return false;
            }

            // if (dynamicatrdescription ==  "") {
            //    $("#dynamicatr_description").focus();
            //    $("#dynamicatr_description").addClass("error");
            //    $("#dynamicatr_description").after("<span>Required</span>");
            //    return false;          
            // }

            if (dynamicatrdatatype == "") {
                $("#dynamicatr_datatype").focus();
                $("#dynamicatr_datatype").addClass("error");
                $("#dynamicatr_datatype").after("<span>Required</span>");
                return false;
            }

            if (dynamicatrfixedlistofvalues == "" && dynamicatrdatatype == "FLoV") {
                $("#dynamicatr_fixedlist").focus();
                $("#dynamicatr_fixedlist").addClass("error");
                $("#dynamicatr_fixedlist").after("<span>Required</span>");
                return false;
            }

            if (dynamicatrmandatory == "") {
                $("#dynamic_manflg_site").focus();
                $("#dynamic_manflg_site").addClass("error");
                $("#dynamic_manflg_site").after("<span>Required</span>");
                return false;
            }
            if (dynamicatrdisplay == "") {
                $("#dynamicatr_display").focus();
                $("#dynamicatr_display").addClass("error");
                $("#dynamicatr_display").after("<span>Required</span>");
                return false;
            }
            if (dynamicatreditable == "") {
                $("#dynamicatr_editable").focus();
                $("#dynamicatr_editable").addClass("error");
                $("#dynamicatr_editable").after("<span>Required</span>");
                return false;
            }
            if (dynamicatrstatus == "") {
                $("#dynamicatr_status").focus();
                $("#dynamicatr_status").addClass("error");
                $("#dynamicatr_status").after("<span>Required</span>");
                return false;
            }





            $.ajax({
                method: "POST",
                url: "{{ url('configuration_dynamicadd_atr') }}",
                data: {
                    '_token': csrfToken,
                    //  'la_location_attribute_id':dynamicatrid,
                    'dynamicatrtype': dynamicatrtype,
                    'la_location_attribute_name': dynamicatr,
                    'la_location_attribute_description': dynamicatrdescription,
                    'datatypes': dynamicatrdatatype,
                    'la_flov': dynamicatrfixedlistofvalues,
                    'la_location_attribute_mandatory_flag': dynamicatrmandatoryflag,
                    'la_location_attribute_default_value': dynamicatrdefaultvalue,
                    'la_display': dynamicatrdisplay,
                    'la_editable': dynamicatreditable,
                    'la_status': dynamicatrstatus,
                    'fixed_required': dynamicatrmandatory,


                },
                success: function(data) {
                    dynamicatrtype = $("#atr_dynamic #dynamicatr_sitetype option:selected").text();
                    $('#sitedynamictabledd').append('<tr id="tr_sitedynamic' + data +
                        '" class="dataTbltdhight"><td>' + data + '</td><td>' + dynamicatrtype +
                        '</td><td>' + dynamicatr + '</td><td>' + dynamicatrdescription + '</td><td>' +
                        dynamicatrdatatype + '</td><td>' + dynamicatrfixedlistofvalues + '</td><td>' +
                        dynamicatrmandatory + '</td><td>' + dynamicatrdefaultvalue + '</td><td>' +
                        dynamicatrdisplay + '</td><td>' + dynamicatreditable + '</td><td>' +
                        dynamicatrstatus +
                        '</td><td><button type="button" class="edit" style="border-radius: 0;background-color: #202C55;width: 76px;" data-bs-toggle="modal" data-bs-target="#dynamicatr_edit" data-id="' +
                        data + '" onclick="dynamic_attr(this)">Edit</button></tr>');

                    $('#atr_dynamic .close').click();

                    showToast("Site Dynamic Attribute Added Successfully!", "success");


                },
                error: function(error) {

                }



            })

        }

        function dynamic_attr(e) {
            var csrfToken = '{{ csrf_token() }}';
            if ($('#updtdyna').hasClass("btn-primary")) {
                $('#updtdyna').removeClass("btn-primary")
                $('#updtdyna').addClass("btn-primary")
            }
            $.ajax({
                type: "post",
                //url: 'http://3.111.113.246/umprojnew/public/index.php/locationdb',
                url: "{{ url('configuration_dynamicfetch_atr') }}",
                data: {
                    '_token': csrfToken,
                    'dynamicatr_id': $(e).data("id"),
                },
                beforeSend: function() {
                    $('#loader').removeClass('hidden');
                    $("#loading").show();
                },
                complete: function() {
                    $("#loading").hide();
                },
                success: function(result) {

                    $('#loader').addClass('hidden');

                    if (result.status == 'success') {
                        //console.log(result.fetchfixattr[0]['ata_asset_type_attribute_code']);
                        $("#dynamicatr_edit #dynamiceditatr_id").val(result.dynamic_atr_fetch_edit[0][
                            'la_location_attribute_id'
                        ]);
                        $("#dynamicatr_edit #dynamiceditatr_sitetype").val(result.dynamic_atr_fetch_edit[0][
                            'la_location_type_id'
                        ]);
                        $("#dynamicatr_edit #dynamiceditatr_attribute").val(result.dynamic_atr_fetch_edit[0][
                            'la_location_attribute_name'
                        ]);

                        $("#dynamicatr_edit #dynamiceditatr_description").val(result.dynamic_atr_fetch_edit[0][
                            'la_location_attribute_description'
                        ]);
                        $("#dynamicatr_edit #dynamiceditatr_datatype").val(result.dynamic_atr_fetch_edit[0][
                            'la_location_attribute_datatype'
                        ]);
                        if (result.dynamic_atr_fetch_edit[0]['la_location_attribute_datatype'] == "FLoV") {
                            $('#dynamic_site_flov_edit').show();
                        } else {
                            $('#dynamic_site_flov_edit').hide();
                        }


                        $("#dynamicatr_edit #dynamiceditatr_fixed_list_of_values").val(result
                            .dynamic_atr_fetch_edit[0]['la_flov']);


                        $("#dynamicatr_edit #dynamiceditatr_mandatory_flag").val(result.dynamic_atr_fetch_edit[
                            0]['la_location_attribute_mandatory_flag']);
                        $("#dynamicatr_edit #dynamiceditatr_default_value").val(result.dynamic_atr_fetch_edit[0]
                            ['la_location_attribute_default_value']);

                        $("#dynamicatr_edit #dynamiceditatr_display").val(result.dynamic_atr_fetch_edit[0][
                            'la_display'
                        ]);

                        $("#dynamicatr_edit #dynamiceditatr_editable").val(result.dynamic_atr_fetch_edit[0][
                            'la_editable'
                        ]);

                        $("#dynamicatr_edit #dynamiceditatr_status").val(result.dynamic_atr_fetch_edit[0][
                            'la_status'
                        ]);
                        $("#dynamicatr_edit #dynamic_manflg_site_edit").val(result.dynamic_atr_fetch_edit[0][
                            'la_requiered_not_required_flag'
                        ]);

                    }






                }


            })

            $("#dynamicatr_edit").find(".error").removeClass("error");
            $("#dynamicatr_edit").find("span").remove();


        }

        function dynamic_atr_updt() {

            $("#dynamicatr_edit").find(".error").removeClass("error");
            $("#dynamicatr_edit").find("span").remove();
            var atrdynedid = $("#dynamicatr_edit #dynamiceditatr_id").val();
            var atrdynamictype = $("#dynamicatr_edit #dynamiceditatr_sitetype").val();
            var atrdynedatrname = $("#dynamicatr_edit #dynamiceditatr_attribute").val();
            var atrdyneddescription = $("#dynamicatr_edit #dynamiceditatr_description").val();
            var atrdyneddatatype = $("#dynamicatr_edit #dynamiceditatr_datatype").val();
            var atrdynedlist = $("#dynamicatr_edit #dynamiceditatr_fixed_list_of_values").val();
            var atrdynedmandflg = $("#dynamicatr_edit #dynamiceditatr_mandatory_flag").val();
            var atrdyneddefaultvalue = $("#dynamicatr_edit #dynamiceditatr_default_value").val();
            var atrdyneddisplay = $("#dynamicatr_edit #dynamiceditatr_display").val();
            var atrdynededitable = $("#dynamicatr_edit #dynamiceditatr_editable").val();
            var atrdynedstatus = $("#dynamicatr_edit #dynamiceditatr_status").val();
            var atrdymanda = $("#dynamicatr_edit #dynamic_manflg_site_edit").val();


            var csrfToken = '{{ csrf_token() }}';
            //return false;

            // if (atrfixedid ==  "") {
            //    $("#dynamiceditatr_id").focus();
            //    $("#dynamiceditatr_id").addClass("error");
            //    $("#dynamiceditatr_id").after("<span>Required</span>");
            //    return false;          
            // }
            // if (atrdynamictype ==  "") {
            //    $("#dynamiceditatr_sitetype").focus();
            //    $("#dynamiceditatr_sitetype").addClass("error");
            //    $("#dynamiceditatr_sitetype").after("<span>Required</span>");
            //    return false;          
            // }

            if (atrdynedatrname == "") {
                $("#dynamiceditatr_attribute").focus();
                $("#dynamiceditatr_attribute").addClass("error");
                $("#dynamiceditatr_attribute").after("<span>Required</span>");
                return false;
            }

            // if (atrdyneddescription ==  "") {
            //    $("#dynamiceditatr_description").focus();
            //    $("#dynamiceditatr_description").addClass("error");
            //    $("#dynamiceditatr_description").after("<span>Required</span>");
            //    return false;          
            // }

            // if (atrfixeddatatype ==  "") {
            //    $("#dynamiceditatr_datatype").focus();
            //    $("#dynamiceditatr_datatype").addClass("error");
            //    $("#dynamiceditatr_datatype").after("<span>Required</span>");
            //    return false;          
            // } 
            // // if (atrfixedlist ==  "") {
            //    $("#dynamiceditatr_fixed_list_of_values").focus();
            //    $("#dynamiceditatr_fixed_list_of_values").addClass("error");
            //    $("#dynamiceditatr_fixed_list_of_values").after("<span>Required</span>");
            //    return false;          
            // } 
            // if (atrfixedmandflg ==  "") {
            //       $("#dynamiceditatr_mandatory_flag").focus();
            //       $("#dynamiceditatr_mandatory_flag").addClass("error");
            //       $("#dynamiceditatr_mandatory_flag").after("<span>Required</span>");
            //       return false;          
            //    } 

            // if (atrdyneddefaultvalue ==  "") {
            //    $("#dynamiceditatr_default_value").focus();
            //    $("#dynamiceditatr_default_value").addClass("error");
            //    $("#dynamiceditatr_default_value").after("<span>Required</span>");
            //    return false;          
            // } 
            // if (atrfixeddisplay ==  "") {
            //    $("#dynamiceditatr_display").focus();
            //    $("#dynamiceditatr_display").addClass("error");
            //    $("#dynamiceditatr_display").after("<span>Required</span>");
            //    return false;          
            // } 
            // if (atrfixededitable ==  "") {
            //    $("#dynamiceditatr_editable").focus();
            //    $("#dynamiceditatr_editable").addClass("error");
            //    $("#dynamiceditatr_editable").after("<span>Required</span>");
            //    return false;          
            // } 
            // if (atrfixedstatus ==  "") {
            //    $("#dynamiceditatr_status").focus();
            //    $("#dynamiceditatr_status").addClass("error");
            //    $("#dynamiceditatr_status").after("<span>Required</span>");
            //    return false;          
            // } 



            $.ajax({
                method: "POST",
                url: "{{ url('configuration_dynamicupdate_atr') }}",
                data: {
                    'la_location_attribute_id': atrdynedid,
                    '_token': csrfToken,
                    'dynamicatrtype': atrdynamictype,
                    'la_location_attribute_location_type': atrdynedatrname,
                    'la_location_attribute_description': atrdyneddescription,
                    'datatypes': atrdyneddatatype,
                    'la_flov': atrdynedlist,
                    'la_location_attribute_mandatory_flag': atrdynedmandflg,
                    'la_location_attribute_default_value': atrdyneddefaultvalue,
                    'la_display': atrdyneddisplay,
                    'la_editable': atrdynededitable,
                    'la_status': atrdynedstatus,
                    'fixed_required': atrdymanda,

                },
                success: function(data) {
                    atrdynamictype = $("#dynamicatr_edit #dynamiceditatr_sitetype option:selected").text();

                    $('#tr_sitedynamic' + atrdynedid).html('<td>' + atrdynedid + '</td><td>' + atrdynamictype +
                        '</td><td>' + atrdynedatrname + '</td><td>' + atrdyneddescription + '</td><td>' +
                        atrdyneddatatype + '</td><td>' + atrdynedlist + '</td><td>' + atrdymanda +
                        '</td><td>' + atrdyneddefaultvalue + '</td><td>' + atrdyneddisplay + '</td><td>' +
                        atrdynededitable + '</td><td>' + atrdynedstatus +
                        '</td><td><button type="button" class="edit" style="border-radius: 0;background-color: #202C55;width: 76px;" data-bs-toggle="modal" data-bs-target="#atr_edit" data-id="' +
                        atrdynedid + '" onclick="fixed_attr(this)">Edit</button></td></td>');

                    $('#dynamicatr_edit .close').click();

                    showToast("Site Dynamic Attribute Updated Successfully!", "success");

                }


            })
        }



        function addsite_type() {
            $('#myform')[0].reset();

            $("#site_add").find(".error").removeClass("error");
            $("#site_add").find("span").remove();



        }

        function addfixatr() {
            $('#myform3')[0].reset();

            $("#atr_add").find(".error").removeClass("error");
            $("#atr_add").find("span").remove();
        }


        function adddynaatr() {
            $('#myform5')[0].reset();

            $("#atr_dynamic").find(".error").removeClass("error");
            $("#atr_dynamic").find("span").remove();
        }



        function siteasstdropdown() {

            $('.siteactive').toggle();
            if ($(".siteassetdrp i").hasClass('fa-angle-down')) {
                $(".siteassetdrp i").removeClass('fa-angle-down').addClass('fa-angle-up');
            } else {
                $(".siteassetdrp i").removeClass('fa-angle-up').addClass('fa-angle-down');
            }

        }

        function sitefixeddrpdwn() {

            $('.siteactivefixed').toggle();
            if ($(".sitefixtable i").hasClass('fa-angle-down')) {
                $(".sitefixtable i").removeClass('fa-angle-down').addClass('fa-angle-up');
            } else {
                $(".sitefixtable i").removeClass('fa-angle-up').addClass('fa-angle-down');
            }

        }

        function sitedynamicdrpdwn() {

            $('.siteactivedynamic').toggle();
            if ($(".sitedynamictable i").hasClass('fa-angle-down')) {
                $(".sitedynamictable i").removeClass('fa-angle-down').addClass('fa-angle-up');
            } else {
                $(".sitedynamictable i").removeClass('fa-angle-up').addClass('fa-angle-down');
            }

        }

        // asset fixed attritube flov
        $(function() {
            $('#fixedlistvl_data_type1').hide();
            $('#fixedstatus_data_type').change(function() {
                if ($(this).val() == "FLoV") {
                    $('#fixedlistvl_data_type1').show();
                } else {
                    $('#fixedlistvl_data_type1').hide();
                    $('#fixedlistvl_data_type1').val("");
                }
            });
        });



        // asset edit fixed attritube flov
        $(function() {
            $('#fixedlistvl_data_type_edit_1').hide();
            $('#fixed_data_type_edit').change(function() {
                if ($(this).val() == "FLoV") {
                    $('#fixedlistvl_data_type_edit_1').show();
                } else {
                    $('#fixedlistvl_data_type_edit_1').hide();
                    $('#fixedlistvl_data_type_edit_1').val("");
                }
            });
        });

        // Dynamic attribute FLOV disable and enable
        $(function() {
            $('#dynamiclistvl_data_type1').hide();
            $('#dynamic_att_data_type').change(function() {
                if ($(this).val() == "FLoV") {
                    $('#dynamiclistvl_data_type1').show();
                } else {
                    $('#dynamiclistvl_data_type1').hide();
                    $('#dynamiclistvl_data_type1').val("");
                }


            });
        });
        //dynamic edit flov edit

        $(function() {
            $('#dy_dis_edit').hide();
            $('#dynamic_edit_data_type').change(function() {
                if ($(this).val() == "FLoV") {
                    $('#dy_dis_edit').show();
                } else {
                    $('#dy_dis_edit').hide();
                    $('#dy_dis_edit').val("");
                }
            });
        });


        //site fixed add atr FLoV

        $(function() {
            $('#atr_fixed_list_of_values_1').hide();
            $('#atr_datatype').change(function() {
                if ($(this).val() == "FLoV") {
                    $('#atr_fixed_list_of_values_1').show();
                } else {
                    $('#atr_fixed_list_of_values_1').hide();
                    $('#atr_fixed_list_of_values_1').val("");
                }
            });
        });

        //site fixed edit atr FLoV
        $(function() {
            $('#editatr_fixed_list_of_values_1').hide();
            $('#editatr_datatype').change(function() {
                if ($(this).val() == "FLoV") {
                    $('#editatr_fixed_list_of_values_1').show();
                } else {
                    $('#editatr_fixed_list_of_values_1').hide();
                    $('#editatr_fixed_list_of_values_1').val("");
                }
            });
        });

        //site dynamic add atr FLoV
        $(function() {
            $('#dynamicatr_fixedlist_1').hide();
            $('#dynamicatr_datatype').change(function() {
                if ($(this).val() == "FLoV") {
                    $('#dynamicatr_fixedlist_1').show();
                } else {
                    $('#dynamicatr_fixedlist_1').hide();
                    $('#dynamicatr_fixedlist_1').val("");
                }
            });
        });

        //site dynamic edit atr FLoV   
        $(function() {
            $('#dynamic_site_flov_edit').hide();
            $('#dynamiceditatr_datatype').change(function() {
                if ($(this).val() == "FLoV") {
                    $('#dynamic_site_flov_edit').show();
                } else {
                    $('#dynamic_site_flov_edit').hide();
                    $('#dynamic_site_flov_edit').val("");
                }
            });
        });

        $("#addsitetype").click(function() {

            if ($('#save_site').hasClass("btn-primary")) {
                $('#save_site').removeClass("btn-primary");
                $('#save_site').addClass("btn-primary");
            }
        });

        $("#addfixatr1").click(function() {

            if ($('#sitefixat').hasClass("btn-primary")) {
                $('#sitefixat').removeClass("btn-primary");
                $('#sitefixat').addClass("btn-primary");
            }
        });

        $("#adddynaatr_site").click(function() {

            if ($('#savedyna').hasClass("btn-primary")) {
                $('#savedyna').removeClass("btn-primary");
                $('#savedyna').addClass("btn-primary");
            }
        });



        function saveaddlocation() {

            $('#site_add_location').on('hidden.bs.modal', function() {
                $('#site_add_location form')[0].reset();
            });
            $("#locationdetails").find("span").remove();
            $("#locationdetails").find(".error").removeClass("error");

            var sitetype = $("#sitelocation_type").val().trim();
            if (sitetype == "") {
                $("#sitelocation_type").focus();
                $("#sitelocation_type").addClass("error");
                $("#sitelocation_type").after("<span>Required</span>");
                return false;
            }
            var sitename = $("#sitelocation_name").val().trim();
            if (sitename == "") {
                $("#sitelocation_name").focus();
                $("#sitelocation_name").addClass("error");
                $("#sitelocation_name").after("<span>Required</span>");
                return false;
            }



            $.ajax({
                method: "POST",
                url: "{{ url('location_add_site') }}",
                data: $('#locationdetails').serialize(),
                success: function(data) {
                    //console.log(data);
                    $('#sitetypelo').append('<tr class="dataTbltdhight"><td>' + data.tl_location_id +
                        '</td><td>' + data.tl_location_type + '</td><td>' + data.tl_location_code +
                        '</td><td>' + data.tl_location_name + '</td><td>' + data.tl_location_address +
                        '</td><td>' + data.created_at + '</td><td>' + data.tl_created_by +
                        '</td><td><button type="button" class="btn btn-primary btn-sm edtbtn" style="border-radius: 0;background-color: #202C55;width: 76px;" data-bs-toggle="modal" data-bs-target="#site_location" onclick="sitelocationDetails(this)" data-id="' +
                        data.tl_location_id + '">Edit</button></td></tr>');



                    $('#site_add_location .close').click();



                    showToast("Site Added Successfully!", "success");




                }

            })
        }

        function sitelocationDetails(e) {

            $.ajax({
                type: "GET",
                //url: 'http://3.111.113.246/umprojnew/public/index.php/locationdb',
                url: "{{ url('location_edit_site') }}",
                data: {
                    'location_id': $(e).data("id"),
                },


                success: function(data) {
                    console.log(data.fetch_site_details.tl_location_code);
                    var column1 = '<input type="hidden" name="location_id" id="location_id" value="' + $(e)
                        .data("id") +
                        '"><div class="col-md-6"><div class="form-group"><label for="site_id" class="col-form-label">Site Code<strong class="text-danger">*</strong></label><input type="text" class="form-control" id="sitelocation_id_edit" value="' +
                        data.fetch_site_details.tl_location_code +
                        '" name="location_code" required></div></div>';
                    var column = '<input type="hidden" name="location_id" id="location_id" value="' + $(e).data(
                            "id") +
                        '"><div class="col-md-6"><div class="form-group"><label for="site_id" class="col-form-label">Site Address<strong class="text-danger">*</strong></label><input type="text" class="form-control" id="siteadress_edit" value="' +
                        data.fetch_site_details.tl_location_address +
                        '" name="location_address" required></div></div>';
                    $("#site_location #sitelocation_type_edit").val(data.fetch_site_details
                        .tl_location_type_master_id);
                    $('#site_location #sitelocation_name_edit').val(data.fetch_site_details.tl_location_name);
                    console.log(data.fetch_site_details.attributes);
                    $("#site_dynamic_form_edit").empty();
                    $.each(data.fetch_site_details.attributes, function(key, val) {
                        $data_type = val['la_location_attribute_datatype'];

                        var attr_required = '';
                        var asterisk = '';
                        var input_control = '';
                        if (val['la_location_attribute_mandatory_flag'] == 'REQUIRED') {
                            attr_required = ' Required ';
                            asterisk = '<strong class="text-danger">*</strong>';
                        }
                        switch ($data_type) {
                            case 'Alphanumeric':
                                input_control = '<input type="text" value="' + val[
                                        'tla_location_attribute_value_text'] +
                                    '" class="form-control" ' + attr_required + ' id="sitelocation_' +
                                    val['la_location_attribute_id'] + '" name="attr[' + val[
                                        'la_location_attribute_name'] + '_' + val[
                                        'la_location_attribute_id'] + ']">';
                                break;
                            case 'Free-flow':
                                input_control = '<input type="text" value="' + val[
                                        'tla_location_attribute_value_text'] +
                                    '" class="form-control" ' + attr_required + ' id="sitelocation_' +
                                    val['la_location_attribute_id'] + '" name="attr[' + val[
                                        'la_location_attribute_name'] + '_' + val[
                                        'la_location_attribute_id'] + ']">';
                                break;

                            case 'FLoV':
                                input_control =
                                    '<select class="form-select" id="parent_asset_type" name="attr[' +
                                    val['la_location_attribute_name'] + '_' + val[
                                        'la_location_attribute_id'] +
                                    ']"><option value="" >NA</option>';
                                if (val['la_flov'] != null) {
                                    flov_split = val['la_flov'].split(",");
                                    $.each(flov_split, function(key1, val1) {
                                        valsected = '';
                                        if (val1 == val['tla_location_attribute_value_text']) {
                                            valsected = ' Selected ';
                                        }
                                        input_control += '<option ' + valsected + ' value=' +
                                            val1 + '>' + val1 + '</option>';
                                    });
                                }
                                input_control += '</select>';
                                break;

                            case 'Date':
                                input_control = '<input type="date" value="' + val[
                                        'tla_location_attribute_value_text'] +
                                    '" class="form-control" ' + attr_required + ' id="sitelocation_' +
                                    val['la_location_attribute_id'] + '" name="attr[' + val[
                                        'la_location_attribute_name'] + '_' + val[
                                        'la_location_attribute_id'] + ']">';
                                break;

                            case 'Numeric':
                                input_control = '<input type="number" value="' + val[
                                        'tla_location_attribute_value_text'] +
                                    '" class="form-control" ' + attr_required + ' id="sitelocation_' +
                                    val['la_location_attribute_id'] + '" name="attr[' + val[
                                        'la_location_attribute_name'] + '_' + val[
                                        'la_location_attribute_id'] + ']">';
                                break;
                        }
                        column +=
                            '<div class="col-md-6"><div class="form-group"><label for="Sitelocation_name" class="col-form-label">' +
                            val['la_location_attribute_name'] + asterisk + '</label> ' + input_control +
                            ' </div></div>';
                    });
                    $('#site_dynamic_form_edit').append(column1 + column);



                }



            })

        }

        function update_location() {



            $.ajax({
                method: "POST",
                url: "{{ url('location_update_site') }}",
                data: $('#myform7').serialize(),

                success: function(data) {

                    console.log(data.detail);
                    $('#tr_sitetype' + data.detail.tl_location_id).html('<td>' + data.detail.tl_location_id +
                        '</td><td>' + data.detail.tl_location_type + '</td><td>' + data.detail
                        .tl_location_code + '</td><td>' + data.detail.tl_location_name + '</td><td>' + data
                        .detail.tl_location_address + '</td><td>' + data.detail.created_at + '</td><td>' +
                        data.detail.tl_created_by +
                        '</td><td><button type="button" class="btn btn-primary btn-sm edtbtn" style="border-radius: 0;background-color: #202C55;width: 76px;" data-bs-toggle="modal" data-bs-target="#site_location" onclick="sitelocationDetails(this)" data-id="' +
                        data.detail.tl_location_id + '">Edit</button></td>');

                    $('#site_location .close').click();


                    showToast("Site Updated Successfully!", "success");


                }

            })
        }

        function sitetypefunction(locationId) {

            $.ajax({
                type: "GET",
                //url: 'http://3.111.113.246/umprojnew/public/index.php/locationdb',
                url: "{{ url('site_fetch_attribute') }}",
                data: {
                    'la_location_type_id': locationId,
                },
                success: function(data) {
                    //alert("c ");
                    var column1 =
                        '<div class="col-md-6"><div class="form-group"><label for="site_id" class="col-form-label">Site Code<strong class="text-danger">*</strong></label><input type="text" class="form-control" id="sitelocation_id" name="location_code" required></div></div>';
                    var column =
                        '<div class="col-md-6"><div class="form-group"><label for="site_id" class="col-form-label">Site Address<strong class="text-danger">*</strong></label><input type="text" class="form-control" id="siteaddress_id" name="location_address" required></div></div>';

                    $("#site_dynamic_form").empty();
                    $.each(data.fetch_site_attributes, function(key, val) {
                            //alert("c1 ");
                            $data_type = val['la_location_attribute_datatype'];

                            var attr_required = '';
                            var asterisk = '';
                            var input_control = '';
                            if (val['la_location_attribute_mandatory_flag'] == 'REQUIRED') {
                                attr_required = ' Required ';
                                asterisk = '<strong class="text-danger">*</strong>';
                            }
                            switch ($data_type) {
                                case 'Alphanumeric':
                                    input_control = '<input type="text" class="form-control" ' +
                                        attr_required + ' id="sitelocation_' + val[
                                            'la_location_attribute_id'] + '" name="attr[' + val[
                                            'la_location_attribute_name'] + '_' + val[
                                            'la_location_attribute_id'] + ']">';
                                    break;
                                case 'Free-flow':
                                    input_control = '<input type="text" class="form-control" ' +
                                        attr_required + ' id="sitelocation_' + val[
                                            'la_location_attribute_id'] + '" name="attr[' + val[
                                            'la_location_attribute_name'] + '_' + val[
                                            'la_location_attribute_id'] + ']">';
                                    break;

                                case 'FLoV':
                                    input_control =
                                        '<select class="form-select" id="parent_asset_type" name="attr[' +
                                        val['la_location_attribute_name'] + '_' + val[
                                            'la_location_attribute_id'] +
                                        ']"><option value="" >NA</option>';
                                    if (val['la_flov'] != null) {
                                        flov_split = val['la_flov'].split(",");
                                        $.each(flov_split, function(key1, val1) {
                                            input_control += '<option value=' + val1 + '>' + val1 +
                                                '</option>';
                                        });
                                    }
                                    input_control += '</select>';
                                    break;

                                case 'Date':
                                    input_control = '<input type="date" class="form-control" ' +
                                        attr_required + ' id="sitelocation_' + val[
                                            'la_location_attribute_id'] + '" name="attr[' + val[
                                            'la_location_attribute_name'] + '_' + val[
                                            'la_location_attribute_id'] + ']">';
                                    break;

                                case 'Numeric':
                                    input_control = '<input type="number" class="form-control" ' +
                                        attr_required + ' id="sitelocation_' + val[
                                            'la_location_attribute_id'] + '" name="attr[' + val[
                                            'la_location_attribute_name'] + '_' + val[
                                            'la_location_attribute_id'] + ']">';
                                    break;
                            }
                            column +=
                                ' <div class="col-md-6"><div class="form-group"><label for="Sitelocation_name" class="col-form-label">' +
                                val['la_location_attribute_name'] + asterisk + '</label> ' + input_control +
                                ' </div></div>';
                        }),
                        $('#site_dynamic_form').append(column1 + column);

                }
            })
        }

        function addsitelocation() {
            $("#locationdetails")[0].reset();
            $("#site_dynamic_form").empty();

        }
        //  Reason
        // Add and Update
        function saveaddreason() {
            var reasoncode = $("#reason_code_1").val().trim();
            var reasonstatus = $("#reason_status_1").val().trim();
            if (reasoncode == "") {
                $("#reason_code_1").focus();
                $("#reason_code_1").addClass("error");
                $("#reason_code_1").after("<span>Required</span>");
                return false;
            }
            if (reasonstatus == "") {
                $("#reason_status_1").focus();
                $("#reason_status_1").addClass("error");
                $("#reason_status_1").after("<span>Required</span>");
                return false;
            }

            $.ajax({
                type: "POST",
                url: "{{ url('reason_add') }}",
                data: $('#reson_add_sub_reason').serialize(),
                success: function(data) {
                    if (data.reason.rm_reason_description == null) {
                        data.reason.rm_reason_description = "";
                    }

                    $('#sub-reason-table').append('<tr id="tr_subreason' + data.reason.rm_reason_id +
                        '" class="dataTbltdhight"><td class="sorting_1">' + data.reason.rm_reason_id +
                        '</td><td>' + data.reason.rm_reason_code + '</td><td>' + data.reason
                        .rm_reason_description + '</td><td>' + data.reason.rm_reason_status +
                        '</td><td> <button type="button" class="edit edtbtn" style="border-radius: 0; background-color: #202C55;width: 76px;" onclick="editsubreasopn(this)"  data-id="' +
                        data.reason.rm_reason_id + '">Edit</button></tr>');



                    $("#democancel").modal('toggle');
                    $("#reason_add_model_reason").modal('toggle');
                    $('#reason_add_model .close').click();
                },
                error: function(jqXHR, exception) {
                    console.log(jqXHR.responseText);
                }

            })

        }

        function editsubreasopn(e) {
            //console.log(e);
            $("#reason_add_model_reason").modal('toggle');
            //   var  parent_id_reason=$("#reason_sub_reason_1_edit").val(parentreasonid);
            $("#editsubreasonmodal").modal('show');



            //alert($('#reasontable').DataTable().row($(this).closest('tr')).data());
            $.ajax({
                type: "get",
                //url: 'http://3.111.113.246/umprojnew/public/index.php/locationdb',
                url: "{{ url('reason_fetch') }}",
                data: {
                    'resn_id': $(e).data("id"),
                },
                success: function(result) {
                    if (result.status == 'success') {
                        console.log(result.fetchreason['rm_reason_id']);
                        // console.log(result.fetchreason);
                        $("#reason_code_1_edit").val(result.fetchreason['rm_reason_code']);
                        $("#reason_description_1_edit").val(result.fetchreason['rm_reason_description']);
                        $("#master_id_edit").val(result.fetchreason['rm_reason_id']);
                        $("#reason_sub_reason_1_edit").val(result.fetchreason['rm_reason_parent_id']);
                        $("#reason_status_1_edit").val(result.fetchreason['rm_reason_status']);

                    }
                }
            })

        }

        function editaddmdledirsn() {
            $.ajax({
                type: "POST",
                //url: 'http://3.111.113.246/umprojnew/public/index.php/locationdb',
                url: "{{ url('reason_add') }}",
                data: $('#reson_add_sub_reason_edit').serialize(),
                success: function(data) {

                    console.log(data.reason.rm_reason_id);
                    id = data.reason.rm_reason_id;
                    if (data.reason.rm_reason_description == null) {
                        data.reason.rm_reason_description = "";
                    }
                    $('#tr_subreason' + id).html('<td class="sorting_1">' + data.reason.rm_reason_id +
                        '</td><td>' + data.reason.rm_reason_code + '</td><td>' + data.reason
                        .rm_reason_description + '</td><td>' + data.reason.rm_reason_status +
                        '</td><td> <button type="button" class="edit edtbtn" style="border-radius: 0; background-color: #202C55;width: 76px;" onclick="editsubreasopn(this)"  data-id="' +
                        id + '">Edit</button></td>');



                    $("#editsubreasonmodal").modal('toggle');
                    $("#reason_add_model_reason").modal('toggle');
                    $('#reason_add_model_edit .close').click();
                },
                error: function(jqXHR, exception) {
                    console.log(jqXHR.responseText);
                }

            })


        }

        function reasonadd() {
            $("#reson_add_sub_reason")[0].reset();
            $("#reason_sub_reason_1").val(null);


        }
        //showtoast

        function showToast(message, type) {
            const toastrClasses = {
                success: "bg-success text-white",
                error: "bg-danger text-white"
            };

            const toastrContainer = document.createElement("div");
            toastrContainer.className = "toast show " + toastrClasses[type];
            toastrContainer.style.position = "fixed";
            toastrContainer.style.top = "20px";
            toastrContainer.style.right = "20px"; // Adjust the right spacing as needed
            toastrContainer.style.zIndex = "1000"; // To make sure it's above other elements
            toastrContainer.innerHTML = `
        <div class="toast-body">${message}</div>
    `;

            document.body.appendChild(toastrContainer);

            setTimeout(() => {
                toastrContainer.remove();
            }, 2000); // Adjust the duration as needed (in milliseconds)
        }

        $("#site_name").on('blur', isValueExists);

        function isValueExists() {
            $("#site_name").removeClass("error");
            $("#site_name").parent().find("span").remove();
            var locationcode = $('#site_name').val();
            var csrfToken = '{{ csrf_token() }}';
            var submitButton = $("#submit_button");
            $.ajax({
                method: "POST",
                url: '<?php echo env('APP_URL') . 'congiguration_check_site'; ?>',
                data: {
                    '_token': csrfToken,
                    'location_code': locationcode
                },
                success: function(data) {
                    if (data['sitecheck'] != "") {
                        $("#site_name").focus();
                        $("#site_name").addClass("error");
                        $("#site_name").after("<span>Location Code already exists</span>");
                        submitButton.prop("disabled", true);

                    } else {
                        submitButton.prop("disabled", false);
                    }
                }

            });
        }
    </script>
@endsection
