@extends('Layout.mainlayout')
@section('content')
    <div class="card col-12" style="border-radius: unset;">
        <div class="card-header">
            Location View
        </div>
    </div>

    <div class="row mx-2">
        <div class="col-sm-4 my-2 padding-right">
            <div class="card">
                <div class="card-header" style="background-color: #DEEBF6;">
                    Location List
                </div>
                <div class="card-header">
                    <input type="checkbox" style="background-color: white">Apply Filter Map
                    <button align="right" style="float:right">View Map</button>
                </div>
            </div>
        </div>

        <div class="col-sm-8 my-2">
            <div class="card">
                <div class="card-header" style="background-color: lavender;">
                    LS-SALTLAKE/2
                </div>
                <!-- nav bar start -->
                <nav class="mt-2">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-details"
                            type="button" role="tab" {{-- change "nav-home" --}} aria-controls="nav-details"
                            aria-selected="true">
                            Details
                        </button>
                        <button class="nav-link" {{-- change "nav-attributes-tab" --}} id="nav-attributes-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-attributes" type="button" role="tab" aria-controls="nav-attributes"
                            aria-selected="false">
                            Attributes
                        </button>
                        <button class="nav-link" id="nav-assets-tab" data-bs-toggle="tab" data-bs-target="#nav-assets"
                            type="button" role="tab" aria-controls="nav-assets" aria-selected="false">
                            Assets
                        </button>
                    </div>
            </div>
        </div>

    </div>

    </div>
    <div class="row mx-2">
        <div class="col-sm-4 my-3 padding-right">
            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th scope="col">Location Code</th>
                        <th scope="col">Location Type</th>
                        <th scope="col">Region</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">LS-SALTLAKE/1</td>
                        <td>Sites</td>
                        <td>kolkata</td>
                    </tr>
                    <tr>
                        <td scope="row">LS-SALTLAKE/2</td>
                        <td>Sites</td>
                        <td>kolkata</td>
                    </tr>
                    <tr>
                        <td scope="row">LS-SALTLAKE/3</td>
                        <td>Sites</td>
                        <td>kolkata</td>
                    </tr>
                    <tr>
                        <td scope="row">LS-SALTLAKE/4</td>
                        <td>Sites</td>
                        <td>kolkata</td>
                    </tr>
                </tbody>
            </table>
        </div>
        {{-- change my-2 --}}
        <div class="col-sm-8 my-3">
            <div class="card" style="border:none">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-details" role="tabpanel"
                        aria-labelledby="nav-details-tab">

                        <div class="row mt-3 p-3">
                            <div class="col">
                                <div class="col-6 col-sm-4">Location Code</div>
                                <p><b>LS-SALTLAKE/2</b></p>
                                <br />
                                <div class="col-6 col-sm-4">Address</div>
                                <p><b>39/1 Salt Lake,Sector V,kolkata-700091</b></p>
                                <br />
                                <div class="col-6 col-sm-4">Status</div>
                                <p><b>Active</b></p>
                                <br />
                                <div class="col-6 col-sm-4">Creation Date</div>
                                <p><b>20-Apr-2023</b></p>
                            </div>
                            <div class="col">
                                <div class="col-6 col-sm-4">Description</div>
                                <p><b>salt Lake Sector V,near SDF</b></p>
                                <br />
                                <div class="col-6 col-sm-4">Location Type</div>
                                <p><b>Site</b></p>
                                <br />
                                <div class="col-6 col-sm-4">Region</div>
                                <p><b>Kolkata</b></p>
                                <br>
                                <div class="col-6 col-sm-4">Latitude/Longitude</div>
                                <p><b>22.5726 N/88.3639 E</b></p>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="nav-attributes " role="tabpanel" aria-labelledby="nav-attributes-tab">
                        <!-- <div class="card">
                        <div class="card-body"> -->
                        <div class="row ">
                            <div class="col">
                                <div class="col-6 col-sm-6 text-muted">Location Landmark</div>
                                <p><b>39/1 Salt Lake,sector-V,kolkata-700091</b></p>
                                <br>
                                <div class="col-6 col-sm-6  text-muted">Description</div>
                                <p><b>Salt lake sector-V, near SDF </b></p>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-assets" role="tabpanel" aria-labelledby="nav-assets-tab">


                        <div class="" style="margin-top: 9.5px">
                            <table class="table table-bordered border-primary">
                                <thead>
                                    <tr>
                                        <th scope="col">Location Code</th>
                                        <th scope="col">Location Type</th>
                                        <th scope="col">Region</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row">LS-SALTLAKE/1</td>
                                        <td>Sites</td>
                                        <td>kolkata</td>
                                        <td><button type="button" class="btn btn-primary add_button">Edit</button></td>
                                        <td><button type="button" class="btn btn-primary add_button">View</button></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">LS-SALTLAKE/2</td>
                                        <td>Sites</td>
                                        <td>kolkata</td>
                                        <td><button type="button" class="btn btn-primary add_button">Edit</button></td>
                                        <td><button type="button" class="btn btn-primary add_button">View</button></td>

                                    </tr>
                                    <tr>
                                        <td scope="row">LS-SALTLAKE/3</td>
                                        <td>Sites</td>
                                        <td>kolkata</td>
                                        <td><button type="button" class="btn btn-primary add_button">Edit</button></td>
                                        <td><button type="button" class="btn btn-primary add_button">View</button></td>

                                    </tr>
                                    <tr>
                                        <td scope="row">LS-SALTLAKE/4</td>
                                        <td>Sites</td>
                                        <td>kolkata</td>
                                        <td><button type="button" class="btn btn-primary add_button">Edit</button></td>
                                        <td><button type="button" class="btn btn-primary add_button">View</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>



                    </div>

                </div>
            </div>
        </div>

    </div>



    </body>
@endsection


{{-- Css --}}

{{-- #search-bar {
    position: relative;
    right: 464px;
  }
  
  #search-input {
    line-height: 2rem;
    width: 20rem;
    padding: 0.2rem 2rem;
    font-size: 1.2rem;
  }
  
  #search-icon {
    position: absolute;
    top: 0;
    left: 0;
    margin-top: 0.8rem;
    padding: 0px 0.5rem;
  }
  
  #mic-icon {
    position: absolute;
    top: 0;
    right: 0;
    margin-top: 0.8rem;
    padding: 0px 0.5rem;
  }

  .offcanvas-header{
    background-color: blue;
  }
  
  .sidemenu{
    color: black; 
    text-decoration: none;
  }
/* 
body{
  overflow-x: hidden;
} */
.allclass{
  margin: 15px;
}

.details{
  box-shadow: 0 4px 8px 4px rgba(0, 0, 0, 0.5), 0 6px 12px 0 rgba(0, 0, 0, 0.10);
}

body{
  overflow-x:hidden;
} --}}
