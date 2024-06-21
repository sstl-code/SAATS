@extends('layouts.masterLayout')

@section('content')
@section('title', 'User Management')

<head>


</head>
<style>
  .dataTables_filter input {
    background-image: url("{{url('/build/assets/img/searchicon.jpeg')}}");
    background-size: 20px;
    background-position: 5px center;
    background-repeat: no-repeat;
    padding-left: 28px;
  }

  .dataTables_filter input {
    background-image: url("{{url('/build/assets/img/searchicon.jpeg')}}");
    background-size: 20px;
    background-position: 10px center;
    background-repeat: no-repeat;
    padding-left: 32px;

    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.375rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
  }

  .dataTables_filter input:focus {
    color: #212529;
    background-color: #fff;
    border-color: #86b7fe;
    outline: 0;
    box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .25);
  }

  section {
    overflow: auto;
  }

  .sitefixedsearch {
    width: auto !important;
  }
</style>

<main id="main">

  <section class="inner-page">
    <div class="container">
      <!-- Button trigger modal -->
      <!-- Modal -->
      <div class="row">
        <div class="col-sm-12 col-md-6 page-heading">
          <div class="module-logo">
            <img src="{{url('/build/assets/img/usermanagement-icon.svg')}}">
          </div>

          <h4>User Management</h4>
        </div>
        <div class="col-sm-12 col-md-4 search-field">
          <div id="example_filter" class="dataTables_filter">
            {{-- <label><input type="search" class="form-control form-control-sm" placeholder="Search"
            aria-controls="example" style="padding-left: 30px;"></label> --}}
            {{-- <img src="{{url('/build/assets/img/searchicon.jpeg')}}"> --}}
          </div>
        </div>
        {{-- <div class="col-sm-12 col-md-2 addUserbutton">
      {{-- add modal --}}
        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" onclick="emplyMdal()">
        Add User
      </button>
    </div> --}}
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
      {{-- add modal --}}

      <div class="usermanage_div">
        <table id="exampleTable" class="table table-striped moduletable1" style="width:100%">
          <thead class="module-back">
            <tr>
              <th>Name (<span style="color:DodgerBlue;" >*</span> indicates supervisor)</th>
              <th>Edit</th>
              <th>Email</th>
              <th>Status</th>
              {{-- <th>Suspend</th>
                    <th>Resume</th> --}}
              <th>Delete</th>
              <!-- <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th> -->
            </tr>
          </thead>
          <form method="POST" action="{{ url('userStatusUpdate') }}" name="frmstatus">
            @csrf
            <input type="hidden" name="id" value="" id="id">
            <input type="hidden" name="status" value="" id="selstatus">

          </form>
          <tbody>

            @foreach($userData as $dataUser)

            <tr>
              <td> @if($dataUser->is_supervisor === true)
                <span style="color:DodgerBlue;" >*</span> 
                @endif
                {{$dataUser->name}}
               
              </td>
              {{-- edit modal button --}}

              <td>

                <button type="button" class="btn" onclick="editModal(this)" data-id="{{$dataUser->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" style="height:15px; width:15px;"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                    <path d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z" />
                  </svg></button>
              </td>

              <td>{{$dataUser->email}}</td>
              <td><select class="form-select new-select" id="status" onchange="reply_click(this)" data-id="{{$dataUser->id}}" aria-label="Default select example">
                  {{-- <option >Pending</option> --}}
                  {{-- <option value="active">Active</option> --}}
                  <option value="active" {{$dataUser->status === 'active' ? 'selected' : ''}}>Active</option>
                  <option value="suspended" {{$dataUser->status === 'suspended' ? 'selected' : ''}}>Suspended</option>
                  <option value="deleted" {{$dataUser->status === 'deleted' ? 'selected' : ''}}>Deleted</option>
                  <option value="pending" {{$dataUser->status === 'pending' ? 'selected' : ''}}>Pending</option>
                  <!-- <option value="3">Three</option> -->
                </select></td>
              {{-- <td>
                    @if($dataUser->status === 'suspended')
                    <svg class="cross-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="height:15px; width:15px;"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg></td>
                    @endif
                    
                  <td>
                    @if($dataUser->status !== 'active')
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style="height:15px; width:15px;"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg></td>
                    @endif --}}
              <td><a href="javascript:void(0);" onclick="confirmDelete({{ $dataUser->id }})" class="btn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="height:15px; width:15px;"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                  </svg></a></td>
              <!-- <td>61</td>
                  <td>2011-04-25</td>
                  <td>$320,800</td> -->
            </tr>

            @endforeach

          </tbody>

        </table>
      </div>
      {{-- <div class="save-button button"  style="text-align: right;"><input type="submit" class="btn btn-primary "></button></div> --}}
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="deleteConfirmationModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirm Deletion</h5>
            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> --}}
          </div>
          <div class="modal-body">
            Are you sure you want to delete this user?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <a id="deleteUserLink" class="btn btn-danger" href="#">Delete</a>
          </div>
        </div>
      </div>
    </div>

    {{-- Modal --}}
    <form method="POST" action="{{ url('addUser') }} " id="epmtymodal">
      @csrf
      <div class="modal fade addrolemodal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header" style="display: block;">
              <h5 class="modal-title" id="addModalLabel" style="text-align: center;">Add User</h5>
            </div>
            <div class="modal-body">
              <!-- <div class="rolename">
              <label>Role Name</label>
              <input type="text" placeholder="Enter Role Name">
            </div> -->
              <!-- <div class="rolename">
              <label>Description</label>
              <input type="text" placeholder="Enter Your Role Description">
            </div> -->
              <div class="row">
                <div class="col-md-6">
                  <div class="rolename">
                    <label for="name">Name </label>
                    <input type="text" id="name" name="name" placeholder="Enter Your Name" required pattern=".{2,}">
                  </div>
                  <div class="rolename">
                    <label for="genderSelect">Gender</label>
                    <select name="gender" class="select-gender" data-required="true" required>
                      <option value="" disabled selected>Select your Gender</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>


                  </div>

                  <div class="rolename">
                    <label for="user_address">User Address</label>
                    <textarea id="user_address" name="user_address" class="useraddress" type="text" placeholder="Enter Address"></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="rolename">
                    <label for="email">Email Id</label>
                    <input type="email" id="email" name="email" placeholder="Enter Email" onblur="checkDuplicate()" required>

                  </div>
                  <div class="rolename">
                    <label for="mobile_number">Phone No.</label>
                    <input type="text" id="mobile_number" name="mobile_number" placeholder="Enter Phone Number" required pattern="[0-9]{10}">
                    <span id="mobile-number-error" style="color: red;"></span>
                  </div>

                  <div class="supervisor-check">
                    <input type="checkbox" id="is_supervisor" name="is_supervisor">
                    <label for="is_supervisor">Supervisor</label><br>
                  </div>
                  <input type="hidden" id="password" name="password" value="Password@123">
                </div>
              </div>
              <div class="modal-footer-button" style="margin-top: 20px;">
                <button type="submit" class="btn save-button">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>

    {{-- modal end --}}
    {{-- edit modal --}}
    <form method="POST" action="{{ url('addUser')}}" id="editModalform">
      @csrf
      <div class="modal fade addrolemodal" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header" style="display: block;">
              <h5 class="modal-title" id="exampleModalLabel" style="text-align: center;">Edit User</h5>
            </div>
            <div class="modal-body">
              <!-- <div class="rolename">
              <label>Role Name</label>
              <input type="text" placeholder="Enter Role Name">
            </div> -->
              <!-- <div class="rolename">
              <label>Description</label>
              <input type="text" placeholder="Enter Your Role Description">
            </div> -->
              <input type="hidden" name="id" id="empId">
              <div class="row">
                <div class="col-md-6">
                  <div class="rolename">
                    <label>Name </label>
                    <input type="text" placeholder="Edit Name" id="nameIndex" name="name" required pattern=".{2,}">
                  </div>
                  <div class="rolename">
                    <label for="genderSelect">Gender</label>
                    <select name="gender" class="select-gender" id="genderSelect" data-required="true" required>
                      <option value="" disabled selected>Select your Gender</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>

                  </div>
                  <div class="rolename">
                    <label>User Address</label>
                    <textarea class="useraddress" name="user_address" type="text" placeholder="Enter Address" id="addressIndex"></textarea>
                  </div>
                  {{-- <div class="rolename">
              <label>Status</label>
              <select name="status" class="select-gender" id="statusSelect" required>
                <option value="--Select your Gender--" style="color: rgb(213, 213, 213);">--Pending--</option>
                <option value="active">Active</option>
                <option value="suspended">Suspended</option>
                <option value="pending">Pending</option>
                <option value="deleted">Deleted</option>
              </select>
            </div> --}}
                </div>
                <div class="col-md-6">
                  <div class="rolename">
                    <label>Email Id</label>
                    <input type="email" placeholder="Email" name="email" id="emailIndex" onblur="checkDuplicateEdit()" required>
                  </div>
                  <div class="rolename">
                    <label>Phone No.</label>
                    <input type="number" placeholder="Phone Number" id="phoneIndex" name="mobile_number" required pattern="[0-9]{10}">
                    <span id="edit_mobile-number-error" style="color: red;"></span>
                    <div class="supervisor-check">
                      <input type="checkbox" id="supervisorCheckbox" name="is_supervisor">
                      <label for="is_supervisor">Supervisor</label><br>
                    </div>
                  </div>
                </div>


                <div class="modal-footer-button" style="margin-top: 45px;">
                  <button type="submit" class="btn save-button">Update</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>

              </div>

            </div>

          </div>
        </div>
      </div>
    </form>
    {{-- edit modal end --}}
  </section>
</main><!-- End #main -->


<script>
  function reply_click(clicked_id) {
    $('#selstatus').val(clicked_id.value);
    $('#id').val($(clicked_id).data('id'));
    document.frmstatus.submit();
  }

  function editModal(e) {
    $('#emaildupledit').empty();
    //alert('hi');
    var modalId = $(e).data("id");
    //alert(modalId);
    $.ajax({
      type: "GET",
      url: "{{url('modalEditview')}}" + '/' + modalId,
      success: function(response) {
        if (response.status == 404) {
          alert(response.message)
        } else {
          $('#empId').val(response.modalData.id);
          $('#nameIndex').val(response.modalData.name);

          $('#addressIndex').val(response.modalData.user_address);

          $('#genderSelect').val(response.modalData.gender);
          $('#statusSelect').val(response.modalData.status);

          $('#emailIndex').val(response.modalData.email);
          $('#phoneIndex').val(response.modalData.mobile_number);

          if (response.modalData.is_supervisor) {
            $('#supervisorCheckbox').prop('checked', true);
          } else {
            $('#supervisorCheckbox').prop('checked', false);
          }
        }
      }
    });
  }


  // Function to open the delete confirmation modal
  function confirmDelete(userId) {
    // Set the user ID for the delete link in the modal
    document.getElementById("deleteUserLink").href = "{{ url('userDelete') }}/" + userId;

    // Open the modal
    $('#deleteConfirmationModal').modal('show');
  }

  function emplyMdal() {
    $('#epmtymodal')[0].reset();
    $('#emaildupladd').empty();
  }

  // add phone number validation
  document.addEventListener('DOMContentLoaded', function() {
    const mobileNumberInput = document.getElementById('mobile_number');
    const mobileNumberError = document.getElementById('mobile-number-error');

    mobileNumberInput.addEventListener('input', function() {
      if (!mobileNumberInput.checkValidity()) {
        mobileNumberError.textContent = 'Please enter a 10-digit phone number.';
      } else {
        mobileNumberError.textContent = '';
      }
    });
  });

  // edit phone number validation
  document.addEventListener('DOMContentLoaded', function() {
    const mobileNumberInput = document.getElementById('phoneIndex'); // Your edit phone input ID
    const mobileNumberError = document.getElementById('edit_mobile-number-error'); // Your error message span ID

    mobileNumberInput.addEventListener('input', function() {
      if (mobileNumberInput.value.length !== 10) {
        mobileNumberInput.setCustomValidity('Please enter a 10-digit phone number.');
        mobileNumberError.textContent = 'Please enter a 10-digit phone number.';
      } else {
        mobileNumberInput.setCustomValidity('');
        mobileNumberError.textContent = '';
      }
    });

    const form = document.getElementById('editModalform'); // Replace with the actual form ID
    form.addEventListener('submit', function(event) {
      if (mobileNumberInput.value.length !== 10) {
        event.preventDefault();
        mobileNumberInput.setCustomValidity('Please enter a 10-digit phone number.');
        mobileNumberError.textContent = 'Please enter a 10-digit phone number.';
      }
    });
  });


  function checkDuplicate() {
    $("#email").removeClass("error");
    $("#email").parent().find("span").remove();
    var email = $('#email').val();
    var csrfToken = '{{ csrf_token() }}';
    var submitButton = $("#submit_button");
    $.ajax({
      method: "POST",
      url: "{{ url('checkexistingemail') }}",

      data: {
        '_token': csrfToken,
        'email': email
      },
      success: function(data) {
        if (data['emailcheck'] != null) {
          $("#email").focus();
          $("#email").addClass("error");
          $('#emaildupladd').empty();
          $("#email").after("<span id='emaildupladd' class='emailcolocss'>This email already exists</span>");
          submitButton.prop("disabled", true); // Disable the submit button
          return false;
        }
        //else {
        //     submitButton.prop("disabled", false); // Enable the submit button
        //  }
      }

    });
  }

  function checkDuplicateEdit() {
    $("#emailIndex").removeClass("error");
    $("#emailIndex").parent().find("span").remove();
    var email = $('#emailIndex').val();
    var csrfToken = '{{ csrf_token() }}';
    var submitButton = $("#submit_button");
    $.ajax({
      method: "POST",
      url: "{{ url('checkexistingemail') }}",

      data: {
        '_token': csrfToken,
        'email': email
      },
      success: function(data) {
        if (data['emailcheck'] != null) {
          $("#emailIndex").focus();
          $("#emailIndex").addClass("error");
          $("#emaildupledit").empty();
          $("#emailIndex").after("<span id='emaildupledit' class='emailcolocss'>This email already exists</span>");
          submitButton.prop("disabled", true); // Disable the submit button
          // return false;
        } else {
          submitButton.prop("disabled", false); // Enable the submit button
        }
      }

    });
  }
  setTimeout(() => {
    $('#useraddmessage').remove();
  }, 3000);
</script>
@endsection