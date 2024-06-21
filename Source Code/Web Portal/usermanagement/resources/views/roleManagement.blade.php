@extends('layouts.masterLayout')

@section('content')
@section('title', 'Role Management')

<head>

</head>
<style>
    @media only screen and (max-width: 550px) {
        .searchlabel {
            margin: auto;
            display: block;
            width: 250px;
        }

        .addUserbutton button {

            margin: auto;
        }

        .role_manage {
            float: none;
        }
        
    }
    .moduletable2{
      position: relative;
    top: 0px;

    }
    .module_search{
  background-image: url("{{url('/build/assets/img/searchicon.jpeg')}}"); 
    background-size: 20px; 
    background-position: 10px center; 
    background-repeat: no-repeat;
    padding-left: 20px;
}

</style>
<main id="main">
    <section class="inner-page my-4" style="overflow: hidden">
        <div class="container" style="padding: 0;">
            <div class="row">
                <div class="col-sm-12 col-md-6 page-heading">
                    <div class="module-logo">
                        <img src="{{url('/build/assets/img/role-management-logo.png')}}">
                    </div>
                    <h4>Role Management</h4>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 search-field2">
                    <div id="example_filter" class="dataTables_filter role_manage my-2">
                        <label class='searchlabel'>
                            <input type="search" class="form-control form-control-sm module_search" id="roleSearch" placeholder="Search Role" aria-controls="example" style="padding-left: 34px;">
                        </label>
                        {{-- <img src="{{url('/build/assets/img/searchicon.jpeg')}}"> --}}
                        {{-- <ul id="suggestionsList"></ul> --}}
                    </div>
                </div>

                <div class="col-sm-12 col-md-2 col-lg-2 addUserbutton">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" onclick="emplyMdal()">
                        Add Role
                    </button>
                </div>

                @if(session('error'))
                <div class="alert alert-danger" id="useraddmessage">
                    {{ session('error') }}
                </div>
                @endif
                @if(session('Status'))
                <div class="alert alert-success" id="useraddmessage">
                    {{ session('Status') }}
                </div>
                @endif
                <div class="table-responsive rolemanage_div" style="overflow: hidden">
                    <table id="rolemanage_table" class="table moduletable3">
                        <thead class="module-back">
                            <tr>
                                <th class="table-head-role">Edit</th>
                                <th>Role Name</th>
                                <th style="width: 26%;">Module Name</th>
                                <th style="width: 30%;">Available Function</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="background-color: #ffffff;">
                                <td colspan="5" style="border-bottom: none;">
                                    <div class="tab-sec">
                                        <div class="d-flex align-items-start row moduletable2">
                                            <div class="col-2 edit-buttons" id="removeEdit">
                                                @foreach($roleData as $editrole)
                                                <div class="edit-button">
                                                    <button class="btn" style="margin-top: 2px;" onclick="editDetails(this)" data-id="{{$editrole->id}}" data-bs-toggle="modal" data-bs-target="#editModal">
                                                        <img src="{{url('/build/assets/img/edit-icon.svg')}}">
                                                    </button>
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="col-2 nav flex-column nav-pills left-tab" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="width: 21%;">
                                                <div id="roleSearchResult" style="position: relative;left: 13px;">
                                                    <?php $i = 0;
                                                    foreach ($roleData as $databutton) { ?>
                                                        <button class="nav-link" id="v-pills-home-tab" data-bs-target="#v-pills-home" data-rid="{{$databutton->id}}" onclick="getdetails(this)" data-bs-toggle="pill" aria-selected="true">
                                                            {{$databutton->role_name}}
                                                            <img src="{{url('/build/assets/img/active-arrow.png')}}" class="arrow-active">
                                                        </button>
                                                    <?php $i++;
                                                    } ?>
                                                </div>
                                            </div>
                                            <div class="col-3 left-tab cus_table" id="v-pills-tab">
                                                <div class="tab-pane fade show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                    <div id="moduleNa"></div>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                                    <!-- ... -->
                                                </div>
                                            </div>
                                            <div class="col-5" id="functionData" style="">
                                                <!-- Function switches will be appended here -->
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Modal -->
                <form method="POST" action="{{ url('roleManagement') }}" id="epmtymodal">
                    @csrf
                    <div class="modal fade " id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Role</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="rolename">
                                        <label for="role_name">Role Name</label>
                                        <input type="text" id="role_name" name="role_name" placeholder="Enter Role Name" onblur="checkDuplicate()" required>
                                    </div>
                                    <div class="rolename">
                                        <label for="role_description">Description</label>
                                        <input type="text" style="border: 1px solid #03165B;" id="role_description" name="role_description" placeholder="Enter Your Role Description">
                                    </div>
                                    <div class="modal-footer-button" style="margin-top: 20px;">
                                        {{-- <input type="submit" value="Submit"class="btn save-button"> --}}
                                        {{-- <a href="{{url('roleManagement')}}" class="btn save-button">Save</a> --}}
                                        <button type="submit" class="btn save-button">Save</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            {{-- edit modal --}}
            <form method="POST" action="{{ url('roleManagement') }}">
                @csrf
                <div class="modal fade " id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <input type="hidden" name="id" id="rolehiddenId">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
                            </div>
                            <div class="modal-body">
                                <div class="rolename">
                                    <label for="role_name">Role Name</label>
                                    <input type="text" id="role_name_index" name="role_name" placeholder="Enter Role Name" onblur="checkDuplicateRoleEdit()" required>
                                </div>
                                <div class="rolename">
                                    <label for="role_description">Description</label>
                                    <input type="text" style="border: 1px solid #03165B;" id="role_description_index" name="role_description" placeholder="Enter Your Role Description">
                                </div>
                                <div class="modal-footer-button" style="margin-top: 20px;">
                                    {{-- <input type="submit" value="Submit"class="btn save-button"> --}}
                                    {{-- <a href="{{url('roleManagement')}}" class="btn save-button">Save</a> --}}
                                    <button type="submit" class="btn save-button">Save</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
            <form method="POST" action="{{ url('functionStatus') }}" id="switchstatusForm" name="switchstatus">@csrf
                <input type="hidden" name="id" value="" id="id">
                <input type="hidden" name="status" value="" id="selstatus">
            </form>
        </div>
    </section>
</main>
<!-- End #main --><!-- End #main -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
    function getdetails(e) {
        var roleId = $(e).data("rid");
        //alert(roleId);
        $.ajax({
            type: "GET",
            url: '{{ url("moduleName") }}',
            data: {
                'Role_id': roleId,
            },
            success: function(result) {
                $('#moduleNa').empty();
                $('#functionData').empty();
                console.log(result);
                result.roleModule.forEach(function(val) {
                    var imgUrl = "{{url('/build/assets/img/active-arrow.png')}}"
                    $('#moduleNa').append('<ul class="right-list"><div class="row"><div class="col-8"><button class="nav-link " data-mid="' + val['id'] + '" data-rid="' + roleId + '" onclick="getassetdetails(this)" id="v-pills-' + val.id + '-tab" data-bs-toggle="pill" data-bs-target="#v-pills-' + val.id + '" type="button" role="tab" aria-controls="v-pills-' + val.id + '" aria-selected="true">' + val.module_name + '</button></div><div class="col-4"><img src="' + imgUrl + '" class="arrow-active"></div></div></ul>');
                });
            }
        });
    }

    function getassetdetails(e) {
        //alert('hi');
        var moduleId = $(e).data("mid");
        var roleId = $(e).data("rid");
        $('.right-list button').removeClass('w3-red');
        //  .arrow-active
        $('.right-list .nav-link.active').removeClass('active');
        // Add the "active" class to the clicked module
        $(e).addClass('w3-red');
        $(e).addClass('active');
        //alert(moduleId);
        $.ajax({
            type: "GET",
            url: '{{ url("functionName") }}',
            data: {
                'Module_id': moduleId,
                'role_id': roleId,

            },
            success: function(result) {
                if (result.status === 'success') {
                    // Clear the existing content

                    $('#functionData').empty();
                    console.log(result);
                    // Append the new module names
                    result.moduleDataAjax.functions.forEach(function(val) {
                        var isChecked = val.functionStatus ? " Checked " : "";

                        // Create a Bootstrap row
                        var functionSwitchRow = '<div class="row function-switch-container" style="padding-top: 4px;">';

                        // Add a Bootstrap column for function name
                        var functionName = '<div class="col-6 function-name"style="padding-bottom: 20px;">' + val.function_name + '</div>';

                        // Add a Bootstrap column for the switch element
                        var functionSwitch = '<div class="col-6 function-switch"style="">' +
                            '<label class="switch">' +
                            '<input id="checkbox_' + val.id + '" data-fid="' + val.id + '" data-mid="' + moduleId + '" data-rid="' + roleId + '"' + isChecked + ' type="checkbox" onchange="reply_click(this)">' +
                            '<span class="slider round"></span>' +
                            '</label>' +
                            '</div>';

                        // Close the Bootstrap row
                        functionSwitchRow += functionName + functionSwitch + '</div>';

                        // Append the function-switch row to your functionData container
                        $('#functionData').append(functionSwitchRow);
                    });




                }
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    function reply_click(e) {
        //   var checkboxId = e.id;
        //   var isChecked = e.checked;
        var checkbox = e;
        var dataId = $(e).data('fid');
        var moduleId = $(e).data("mid");
        var roleId = $(e).data("rid");
        //alert(moduleId);
        var slider = $(checkbox).siblings('.slider');

        // Get the CSRF token from a meta tag (assuming it's available in your HTML)
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var isChecked = checkbox.checked;
        // Use AJAX to submit the form
        $.ajax({
            type: "POST",
            url: '{{ url("roleModuleFunctionMap")}}',
            data: {
                'module_id': moduleId,
                'role_id': roleId,
                'data_id': dataId,
                'status': isChecked
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
            },
            success: function(response) {
                console.log("Form submitted successfully!");
            },
            error: function(error) {
                console.error("Error submitting form:", error);
            }
        });

    }

    function editDetails(e) {
        $('#emaildupledit').empty();
        var roalEditId = $(e).data("id");
        //alert(roalEditId);
        $.ajax({
            type: "GET",
            url: "{{ url('roleEditview') }}" + '/' + roalEditId,
            success: function(response) {
                if (response.status == 404) {
                    alert(response.message)
                } else {
                    $('#role_name_index').val(response.roleView.role_name);
                    $('#role_description_index').val(response.roleView.role_description);
                    $('#rolehiddenId').val(response.roleView.id);

                }
            }
        });
    }

    //code for search
    // code for search
    var route = "{{ url('searchRole') }}"; // Replace 'searchRole' with your actual route name
    // Initialize the autocomplete once
    $('#roleSearch').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: route,
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function(data) {
                    if (data.length === 0) {
                        response([{
                            label: 'No roles found',
                            value: ''
                        }]);
                    } else {
                        response(data);
                    }
                }
            });
        },
        select: function(event, ui) {
            var selectedValue = ui.item.value;
            var roleId = ui.item.Role_id;

            // Clear the previous search results
            $("#roleSearchResult").empty();
            $('#moduleNa').empty();
            $('#functionData').empty();
            $('#removeEdit').empty();

            if (selectedValue === 'No roles found') {
                // Display a message or take any other action
            } else {
                // Append the selected role name as a button
                $('#roleSearchResult').append('<button class="nav-link" id="v-pills-home-tab" data-bs-target="#v-pills-home" data-rid="' + roleId + '" onclick="getdetails(this)" data-bs-toggle="pill" aria-selected="true">' + selectedValue + '<img src="{{url(' / build / assets / img / active - arrow.png ')}}" class="arrow-active"></button>');

                // Append the "Edit" button for this role
                $('#removeEdit').append('<button class="btn edit-button" data-id="' + roleId + '" data-bs-toggle="modal" data-bs-target="#editModal" onclick="editDetails(this)"><img src="{{ url("/build/assets/img/edit-icon.svg") }}"></button>');
            }

            event.preventDefault();
        }
    });

    // Event listener for keyup to detect when input is empty
    $('#roleSearch').on('keyup', function() {
        var inputVal = $(this).val();
        if (inputVal === '') {
            // Make an Ajax request to populate all role names and edit buttons
            $.ajax({
                type: 'GET',
                url: "{{url('removeRoleSearch')}}", // Replace with the actual route
                success: function(result) {
                    // Clear the previous search results when the input is empty
                    $('#roleSearchResult').empty();
                    $('#removeEdit').empty();
                    $('#moduleNa').empty();
                    $('#functionData').empty();

                    $.each(result, function(index, val) {
                        // Append the selected role name as a button
                        $('#roleSearchResult').append('<button class="nav-link" id="v-pills-home-tab" data-bs-target="#v-pills-home" data-rid="' + val.id + '" onclick="getdetails(this)" data-bs-toggle="pill" aria-selected="true">' + val.role_name + '<img src="{{url(' / build / assets / img / active - arrow.png ')}}" class="arrow-active"></button>');

                        // Append the "Edit" button for this role
                        $('#removeEdit').append('<button class="btn edit-button" style="margin-top: 2px;" data-id="' + val.id + '" data-bs-toggle="modal" data-bs-target="#editModal" onclick="editDetails(this)"><img src="{{ url("/build/assets/img/edit-icon.svg") }}"></button>');
                    });
                }
            });
        }
    });



    function emplyMdal() {
        $('#epmtymodal')[0].reset();
        $('#emaildupladd').empty();
    }
    setTimeout(() => {
        $('#useraddmessage').remove();
    }, 3000);


    function checkDuplicate() {
        $("#role_name").removeClass("error");
        $("#role_name").parent().find("span").remove();
        var role_name = $('#role_name').val();
        var csrfToken = '{{ csrf_token() }}';
        var submitButton = $("#submit_button");
        $.ajax({
            method: "POST",
            url: "{{ url('checkexistinRole') }}",

            data: {
                '_token': csrfToken,
                'role_name': role_name
            },
            success: function(data) {
                if (data['roleCheck'] != null) {
                    $("#role_name").focus();
                    $("#role_name").addClass("error");
                    $('#emaildupladd').empty();
                    $("#role_name").after("<span id='emaildupladd' class='emailcolocss'>This Role is already exists</span>");
                    submitButton.prop("disabled", true); // Disable the submit button
                    return false;
                }
                //else {
                //     submitButton.prop("disabled", false); // Enable the submit button
                //  }
            }

        });
    }

    function checkDuplicateRoleEdit() {
        $("#role_name_index").removeClass("error");
        $("#role_name_index").parent().find("span").remove();
        var role_name = $('#role_name_index').val();
        var csrfToken = '{{ csrf_token() }}';
        var submitButton = $("#submit_button");
        $.ajax({
            method: "POST",
            url: "{{ url('checkexistinRole') }}",

            data: {
                '_token': csrfToken,
                'role_name': role_name
            },
            success: function(data) {
                if (data['roleCheck'] != null) {
                    $("#role_name_index").focus();
                    $("#role_name_index").addClass("error");
                    $("#emaildupledit").empty();
                    $("#role_name_index").after("<span id='emaildupledit' class='emailcolocss'>This Role is already exists</span>");
                    submitButton.prop("disabled", true); // Disable the submit button
                    // return false;
                } else {
                    submitButton.prop("disabled", false); // Enable the submit button
                }
            }

        });
    }
</script>


@endsection