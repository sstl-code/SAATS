@extends('layout.configManagementMaster')
@section('title', 'Configuration Management')
@section('content')
    <div class="card col-12" style="border-radius: unset;">
        <div class="card-header">
            Configuration Management 
        </div>
        
        <nav>
            <div class="nav nav-underline" id="nav-tab" role="tablist">
              <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-asset" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Asset</button>
              <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-site" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Site</button>
              <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-reason" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Reason</button>
            </div>
        </nav>
        {{-- Asset --}}
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-asset" role="tabpanel" aria-labelledby="nav-home-tab">
                <nav>
                     <div class="nav nav-underline" id="nav-tab" role="tablist">
                     <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-asset-site" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Site</button>
                     <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-asset-attribute" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Attribute</button>
                     </div>
                </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-asset-site" role="tabpanel" aria-labelledby="nav-home-tab">
                    <table id="sitetable" class="table table-striped table-bordered mx-2" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Reason Code</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center">101</td>
                                <td>Asset Modification</td>
                                <td style="text-align: center">Reason code for asset related modification</td>
                                <td>Active</td>
                                <td style="text-align: center">
                                <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0;
                                background-color: #202C55;width: 76px;">Edit</button>
                                <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0;
                                background-color: #202C55;">Sub Reason</button>
                                </td>
                            
                            </tr>
                            <tr>
                                <td style="text-align: center">102</td>
                                <td>Location Modification</td>
                                <td style="text-align: center">Reason code for location related modification</td>
                                <td>Inactive</td>
                                <td style="text-align: center">
                                <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0; background-color: #202C55;width: 76px;">Edit </button>
                                <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0; background-color: #202C55;">Sub Reason</button>
                                </td>
                                
                            </tr>
                            <tr>
                                <td style="text-align: center">103</td>
                                <td>Others</td>
                                <td>Other reason</td>
                                <td>Active</td>
                                <td style="text-align: center">
                                <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0; background-color: #202C55;width: 76px;">Edit </button>
                                <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0; background-color: #202C55;" >Sub Reason</button>
                                </td>
                                
                            </tr>
                        </tbody>
                    
                    </table>
                </div>
              
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade " id="nav-asset-attribute" role="tabpanel" aria-labelledby="nav-home-tab">
                    <nav>
                        <div class="nav nav-underline" id="nav-tab" role="tablist">
                          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-asset-fixed" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Fixed</button>
                          <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-asset-dynamic" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Dynamic</button>
                        </div>
                      </nav>
                      
                      {{--Asset Fixed table --}}
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-asset-fixed" role="tabpanel" aria-labelledby="nav-home-tab">
                            <table id="sitetable" class="table table-striped table-bordered mx-2" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Reason Code</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align: center">101</td>
                                        <td>Asset Modification</td>
                                        <td style="text-align: center">Reason code for asset related modification</td>
                                        <td>Active</td>
                                        <td style="text-align: center">
                                        <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0;
                                        background-color: #202C55;width: 76px;">Edit</button>
                                        <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0;
                                        background-color: #202C55;">Sub Reason</button>
                                        </td>
                                    
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">102</td>
                                        <td>Location Modification</td>
                                        <td style="text-align: center">Reason code for location related modification</td>
                                        <td>Inactive</td>
                                        <td style="text-align: center">
                                        <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0; background-color: #202C55;width: 76px;">Edit </button>
                                        <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0; background-color: #202C55;">Sub Reason</button>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">103</td>
                                        <td>Others</td>
                                        <td>Other reason</td>
                                        <td>Active</td>
                                        <td style="text-align: center">
                                        <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0; background-color: #202C55;width: 76px;">Edit </button>
                                        <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0; background-color: #202C55;" >Sub Reason</button>
                                        </td>
                                        
                                    </tr>
                                </tbody>
                            
                            </table>
                        </div>

                    </div>
                    {{-- Asset Dynamic table --}}
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade " id="nav-asset-dynamic" role="tabpanel" aria-labelledby="nav-home-tab">
                            <table id="sitetable" class="table table-striped table-bordered mx-2" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Reason Code</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align: center">101</td>
                                        <td>Asset Modification</td>
                                        <td style="text-align: center">Reason code for asset related modification</td>
                                        <td>Active</td>
                                        <td style="text-align: center">
                                        <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0;
                                        background-color: #202C55;width: 76px;">Edit</button>
                                        <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0;
                                        background-color: #202C55;">Sub Reason</button>
                                        </td>
                                    
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">102</td>
                                        <td>Location Modification</td>
                                        <td style="text-align: center">Reason code for location related modification</td>
                                        <td>Inactive</td>
                                        <td style="text-align: center">
                                        <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0; background-color: #202C55;width: 76px;">Edit </button>
                                        <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0; background-color: #202C55;">Sub Reason</button>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">103</td>
                                        <td>Others</td>
                                        <td>Other reason</td>
                                        <td>Active</td>
                                        <td style="text-align: center">
                                        <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0; background-color: #202C55;width: 76px;">Edit </button>
                                        <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0; background-color: #202C55;" >Sub Reason</button>
                                        </td>
                                        
                                    </tr>
                                </tbody>
                            
                            </table>
                        </div>

                    </div>


    
              </div>
              </div>
    
          </div>
          {{-- Site --}}
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade " id="nav-site" role="tabpanel" aria-labelledby="nav-home-tab">
                <nav>
                    <div class="nav nav-underline" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#site-site" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Site</button>
                      <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#sit-attribute" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Attribute</button>
                    </div>
                </nav>

            
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade " id="site-site" role="tabpanel" aria-labelledby="nav-home-tab">
                    <table id="sitetable" class="table table-striped table-bordered mx-2" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Reason Code</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center">101</td>
                                <td>Asset Modification</td>
                                <td style="text-align: center">Reason code for asset related modification</td>
                                <td>Active</td>
                                <td style="text-align: center">
                                <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0;
                                background-color: #202C55;width: 76px;">Edit</button>
                                <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0;
                                background-color: #202C55;">Sub Reason</button>
                                </td>
                            
                            </tr>
                            <tr>
                                <td style="text-align: center">102</td>
                                <td>Location Modification</td>
                                <td style="text-align: center">Reason code for location related modification</td>
                                <td>Inactive</td>
                                <td style="text-align: center">
                                <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0; background-color: #202C55;width: 76px;">Edit </button>
                                <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0; background-color: #202C55;">Sub Reason</button>
                                </td>
                                
                            </tr>
                            <tr>
                                <td style="text-align: center">103</td>
                                <td>Others</td>
                                <td>Other reason</td>
                                <td>Active</td>
                                <td style="text-align: center">
                                <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0; background-color: #202C55;width: 76px;">Edit </button>
                                <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0; background-color: #202C55;" >Sub Reason</button>
                                </td>
                                
                            </tr>
                        </tbody>
                    
                    </table>
                </div>    



         

        </div>
        {{--Reason--}}
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade " id="nav-reason" role="tabpanel" aria-labelledby="nav-home-tab">
                <table id="sitetable" class="table table-striped table-bordered mx-2" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Reason Code</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center">101</td>
                            <td>Asset Modification</td>
                            <td style="text-align: center">Reason code for asset related modification</td>
                            <td>Active</td>
                            <td style="text-align: center">
                            <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0;
                            background-color: #202C55;width: 76px;">Edit</button>
                            <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0;
                            background-color: #202C55;">Sub Reason</button>
                            </td>
                        
                        </tr>
                        <tr>
                            <td style="text-align: center">102</td>
                            <td>Location Modification</td>
                            <td style="text-align: center">Reason code for location related modification</td>
                            <td>Inactive</td>
                            <td style="text-align: center">
                            <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0; background-color: #202C55;width: 76px;">Edit </button>
                            <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0; background-color: #202C55;">Sub Reason</button>
                            </td>
                            
                        </tr>
                        <tr>
                            <td style="text-align: center">103</td>
                            <td>Others</td>
                            <td>Other reason</td>
                            <td>Active</td>
                            <td style="text-align: center">
                            <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0; background-color: #202C55;width: 76px;">Edit </button>
                            <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0; background-color: #202C55;" >Sub Reason</button>
                            </td>
                            
                        </tr>
                    </tbody>
                
                </table>
            </div>
    </div>
            
    @endsection