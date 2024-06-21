@extends('layouts.masterLayout')

@section('content')
@section('title', 'User Role Mapping')
<style>
  @media only screen and (max-width: 550px) {
    .statusbar {
      flex: 0 0 auto !important;
      width: 33.33333333% !important;
      margin-right: 0.5rem !important;
      margin-left: 0.5rem !important;
    }
    
  }

  .module_search {
    background-image: url("{{url('/build/assets/img/searchicon.jpeg')}}");
    background-size: 20px;
    background-position: 10px center;
    background-repeat: no-repeat;
    padding-left: 20px;
  }
  .userroledata{
      position: relative;
    top: 0px;

    }
</style>
<main id="main">
  <section class="inner-page my-4" style="overflow: hidden">
    <div class="container" style="padding: 0;">
      <div class="row">
        <div class="col-sm-12 col-md-6 page-heading">
          <div class="module-logo">
            <img src="{{url('/build/assets/img/dash-card-2.svg')}}">
          </div>

          <h4>User Role Association</h4>
        </div>


        <div class="col-sm-12 col-md-6 search-field">
          {{-- <input type="hidden" name="moduleid" value="" id="moduleid"> --}}
          <div id="example_filter" class="dataTables_filter userrole_filter">
            <label class="userrole_label">
              <input type="search" id="userSearch" class="form-control form-control-sm usrrolesearchcss module_search" placeholder="Search Name" aria-controls="example" style="padding-left: 34px;">

            </label>
            {{-- <img src="{{url('/build/assets/img/searchicon.jpeg')}}"> --}}
          </div>
        </div>
      </div>

      {{-- <div class="col-md-6">
            <div id="userSearchResult" class="row">
                <!-- Search results will be displayed here -->
            </div>
        </div>
        
        
        <div class="col-md-6" id="userSearchResult">
            <div class="row">
                <!-- Search results will be displayed here -->
            </div>
        </div> --}}


      {{-- <div class="col-sm-12 col-md-2 addUserbutton">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Role</button>
          </div> --}}
      <div class="userrole_div my-2">
        <table id="example" class="table moduletable3 userrole_table">

          <thead class="module-back">
            <tr>
              <th style="width: 21%;padding-left: 16px;">Name</th>
              <th style="padding-left: 6px;width: 30%;text-align:left">Email</th>
              <th class="th_role">Roles</th>
              <th style="width: 12%;padding-left: 42px;">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="5" style="border-bottom: none;">
                <div class="row">
                  <div class="tab-sec col-8" id="userSearchResult">

                    @forEach($allUser as $usersDetails)
                    <div class="row" style="display: flex;">

                      <div class="col-10 row">

                        <div class="col-6 userroledata" style="display: inline-grid; padding-left: 22px;">
                          <button id="userbutton" data-email="{{ $usersDetails->email }}" style="background-color: transparent; border: none; text-align: left; padding-bottom: 15px; " class="user-button w3-bar-item tablink {{$usersDetails->isSelected ? 'w3-red' : ''}}" aria-selected="{{$usersDetails->isSelected ? 'true' : 'false'}}" data-uid="{{$usersDetails->id}}" onclick="getdetails(this)">{{$usersDetails->name}}</button>
                        </div>
                        <div class="col-6 userroledata" style="display: inline-grid;">

                          <div id="London" class="city col-12" style="justify-content: space-around;">
                            <div class="" style="display: grid;">
                              <button id="emailbutton" class="user-button tablink w3-bar-item {{$usersDetails->isSelected ? 'w3-red' : ''}}" aria-selected="{{$usersDetails->isSelected ? 'true' : 'false'}}" data-toggle="tooltip" data-placement="bottom" title="{{$usersDetails->email}}" style="background-color: transparent; border: none; text-align: left; padding-bottom: 15px; " data-uid="{{$usersDetails->id}}">{{$usersDetails->email}}</button>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach

                  </div>

                  {{-- appened --}}
                  <div class="col-4 userroledata" id="allData">

                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>


      </div>



  </section>

</main><!-- End #main -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
  function getdetails(e) {
    var userId = $(e).data("uid");
    var email = $(e).data("email");
    // Remove the 'w3-red' class from all elements with the 'user-button' class
    $('.user-button').removeClass('w3-red');
    // Add the 'w3-red' class to the clicked user
    $(e).addClass('w3-red');

    // Find the email button corresponding to the clicked name and highlight it
    $('.user-button[data-uid="' + userId + '"]').addClass('w3-red');
    $('#allData').empty();
    $.ajax({
      type: "GET",
      url: '{{ url("roleAllName") }}',
      data: {
        'User_id': userId,
      },
      success: function(result) {
        if (result.status === 'success') {
          // Clear the existing content
          console.log(result);
          result.roleModule.forEach(function(val) {
            var isChecked = val.functionStatus ? 'checked' : '';
            var listItem = '<div class="col-6"><div id="London3" class="w3-container w3-border city3"><h2>' + val.role_name + '</h2></div></div>';
            var switchElement = '<div class="col-6 statusbar"><ul><li><label class="switch"><input id="checkbox_' + val.id + '" type="checkbox" data-rid="' + val.id + '" data-uid="' + userId + '" ' + isChecked + ' onchange="reply_click(this)"><span class="slider round"></span></label></li></ul></div>';
            var row = '<div class="row">' + listItem + switchElement + '</div>';
            $('#allData').append(row);
          });
        }
      }

    });
  }

  function reply_click(e) {
    var checkbox = e;
    var userId = $(e).data('uid');
    var roleId = $(e).data("rid");
    var slider = $(checkbox).siblings('.slider');
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var isChecked = checkbox.checked;
    //alert(userId);
    $.ajax({
      type: "POST",
      url: '{{ url("roleUserMap")}}',
      data: {
        'role_id': roleId,
        'user_id': userId,
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


  //code for search
  var route = "{{ url('searchUser') }}";

  $('#userSearch').autocomplete({
    source: function(request, response) {
      $.ajax({
        url: route, // Replace with the actual route
        dataType: "json",
        data: {
          search: request.term
        },
        success: function(data) {
          if (data.length === 0) {
            response([{
              label: 'No data found',
              value: ''
            }]);
          } else {
            response(data);
          }
        }
      });
    },
    select: function(event, ui) {
      var selectedUser = ui.item;
      $("#userSearchResult").empty(); // Clear previous search results
      $("#allData").empty();
      $("#alltheData").empty();

      if (selectedUser.label === 'No data found') {
        // Handle the case when no users are found
      } else {
        // Generate and append the selected user's information
        var userButton = '<button id="userbutton" data-email="' + selectedUser.email + '" style="background-color: transparent; border: none; text-align: left; " class="user-button w3-bar-item tablink ' + (selectedUser.isSelected ? 'w3-red' : '') + '" aria-selected="' + (selectedUser.isSelected ? 'true' : 'false') + '" data-uid="' + selectedUser.userId + '" onclick="getdetails(this)">' + selectedUser.value + '</button>';
        var emailButton = '<button id="emailbutton" class="user-button tablink w3-bar-item ' + (selectedUser.isSelected ? 'w3-red' : '') + '" aria-selected="' + (selectedUser.isSelected ? 'true' : 'false') + '" data-toggle="tooltip" data-placement="bottom" title="' + selectedUser.email + '" style="background-color: transparent; border: none; text-align: left; padding-bottom: 15px; " data-uid="' + selectedUser.userId + '">' + selectedUser.email + '</button';

        // Create a row to hold the user details
        var resultRow = '<div class="col-10 row" id="userDetails-' + selectedUser.userId + '">' +
          '<div class="col-6 userroledata" style="display: inline-grid; padding-left: 22px;">' + userButton + '</div>' +
          '<div class="col-6 userroledata" style="display: inline-grid;">' +
          '<div id="London" class="city col-12" style="justify-content: space-around;">' +
          '<div class="" style="display: grid;">' + emailButton + '</div>' +
          '</div>' +
          '</div>' +
          '</div>';

        // Append the user details row to the result container
        $("#userSearchResult").append(resultRow);
        console.log("Selected: " + selectedUser.value);
      }

      event.preventDefault();
    }
  });

  // Event listener for keyup to detect when input is empty
  $('#userSearch').on('keyup', function() {
    var inputVal = $(this).val();
    if (inputVal === '') {
      // Make an Ajax request to populate all user details when the input is empty
      $.ajax({
        type: 'GET',
        url: "{{url('removeUserSearch')}}", // Replace with the actual route
        success: function(result) {
          // Clear the previous search results when the input is empty
          $('#userSearchResult').empty();

          $.each(result, function(index, val) {
            // Create buttons with user details
            var userButton = '<button id="userbutton" data-email="' + val.email + '" style="background-color: transparent; border: none; text-align: left; padding-bottom: 15px; " class="user-button w3-bar-item tablink ' + (val.isSelected ? 'w3-red' : '') + '" aria-selected="' + (val.isSelected ? 'true' : 'false') + '" data-uid="' + val.id + '" onclick="getdetails(this)">' + val.name + '</button>';
            var emailButton = '<button id="emailbutton" class="user-button tablink w3-bar-item ' + (val.isSelected ? 'w3-red' : '') + '" aria-selected="' + (val.isSelected ? 'true' : 'false') + '" data-toggle="tooltip" data-placement="bottom" title="' + val.email + '" style="background-color: transparent; border: none; text-align: left; padding-bottom: 15px; " data-uid="' + val.id + '">' + val.email + '</button>';

            // Create a row to hold the user details
            var resultRow = '<div class="col-10 row" id="userDetails-' + val.id + '">' +
              '<div class="col-6 userroledata" style="display: inline-grid; padding-left: 22px;">' + userButton + '</div>' +
              '<div class="col-6 userroledata" style="display: inline-grid;">' +
              '<div id="London" class="city col-12" style="justify-content: space-around;">' +
              '<div class="" style="display: grid;">' + emailButton + '</div>' +
              '</div>' +
              '</div>' +
              '</div>';

            // Append the user details row to the result container
            $("#userSearchResult").append(resultRow);
          });
        }
      });
    }
  });
</script>

@endsection