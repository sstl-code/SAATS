@extends('layouts.masterLayout')
@section('title', 'Password Policy')
@section('content')

<main id="main">
    <section class="inner-page my-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 page-heading">
                    <div class="module-logo">
                      <img src="{{url('/build/assets/img/insurance.png')}}">
                    </div>
                    <h4>Password Policy</h4>
                </div>
            </div>
        </div>
        <div class="userrole_div my-2">
            <table id="example" class="table moduletable3 ">
    
              <thead class="module-back">
                <tr>
                  <th style="width: 20%;padding-left: 8px;">Name</th>
                  <th style="padding-left: 6px;width: 40%;text-align:left">Value</th>
                  <th class="th_role">Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($policyData as $policyVal)
                <tr>
                    <td>
                        <button disabled style="cursor: pointer; border:none; padding: 5px; background-color:white; color:black; text-align:left">{{$policyVal->policy_Name}}</button>
                    </td>
                    <td>
                        <input type="text" style="width: 60px;" id="policyName_{{$policyVal->id}}" value="{{$policyVal->policy_Value}}" onblur="savePolicyValue({{$policyVal->id}}, this.value)">
                  </td>                  
                    <td>
                      <label class="switch">
                          <input id="checkbox_{{$policyVal->id}}" type="checkbox" data-id="{{$policyVal->id}}" onchange="reply_click(this)" {{$policyVal->policy_status ? 'checked' : ''}}>
                          <span class="slider round"></span>
                      </label>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
    </section>
</main>
<script>
  function reply_click(checkbox) {
    var polId = $(checkbox).data("id");
    var slider = $(checkbox).siblings('.slider');
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var isChecked = checkbox.checked;
    
    $.ajax({
      type: "POST",
      url: '{{ url("polyStatus") }}',
      data: {
        'polId': polId, // Add a comma here
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

  function savePolicyValue(policyId, newValue) {
        var inputField = document.getElementById('policyName_' + policyId);

        // Perform an AJAX request to update the policy value in the database
        $.ajax({
            type: "POST",
            url: '{{ url("updatePolicyValue") }}',
            data: {
                'policyId': policyId,
                'newValue': newValue
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log("Value updated successfully!");
            },
            error: function(error) {
                console.error("Error updating value:", error);
            }
        });
    }
</script>

@endsection
