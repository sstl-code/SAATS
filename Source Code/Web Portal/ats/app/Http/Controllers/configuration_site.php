<?php

namespace App\Http\Controllers;

use DB;
use App\Traits\Observable;
use App\Models\Location;
use App\Models\LocationType;
use Illuminate\Http\Request;
use App\Models\LocationAttribute;
use App\Models\Location_Attribute;
use Illuminate\Support\Facades\Auth;
use App\Models\LoactionAttributeMaster;

class configuration_site extends Controller
{
  public function index()
  {

    $configLocation = DB::connection('pgsql')->table("ats.t_location")->select('tl_location_id', 'tl_location_type', 'tl_location_code', 'tl_location_name', 'tl_location_address', 'tl_location_description', 'tl_location_region', 'tl_location_latitude', 'tl_location_longitude', 'tl_location_status')->get();

    $sitetype = DB::connection('pgsql')->table("product.t_location_type_master")->select('lt_location_type_id', 'lt_location_type')->get();

    $config_fixed_attribute = DB::connection('pgsql')->table("product.t_location_attribute_master")->select('la_location_attribute_id', 'la_location_attribute_name', 'la_location_attribute_description', 'la_location_attribute_datatype', 'la_flov', 'la_location_attribute_mandatory_flag', 'la_location_attribute_default_value', 'la_display', 'la_editable', 'la_status')->groupBy('la_location_attribute_id', 'la_location_attribute_name', 'la_location_attribute_description', 'la_location_attribute_datatype', 'la_flov', 'la_location_attribute_mandatory_flag', 'la_location_attribute_default_value', 'la_display', 'la_editable', 'la_status')->where('la_location_attribute_mandatory_flag', 'REQUIRED')->get();


    $fixedatrname = DB::connection('pgsql')->table("product.t_location_attribute_master")->select('la_location_type_id', 'la_location_attribute_name')->get();


    $config_dynamic_attribute = DB::connection('pgsql')->table("product.t_location_attribute_master")->select('la_location_attribute_id', 'la_location_attribute_location_type', 'la_location_attribute_name', 'la_location_attribute_description', 'la_location_attribute_datatype', 'la_flov', 'la_location_attribute_mandatory_flag', 'la_location_attribute_default_value', 'la_display', 'la_editable', 'la_status')->groupBy('la_location_attribute_id', 'la_location_attribute_name', 'la_location_attribute_description', 'la_location_attribute_datatype', 'la_flov', 'la_location_attribute_mandatory_flag', 'la_location_attribute_default_value', 'la_display', 'la_editable', 'la_status')->where('la_location_attribute_mandatory_flag', 'NOT REQUIRED')->get();

    $dynamicatrsitetype = DB::connection('pgsql')->table("product.t_location_type_master")->select('lt_location_type_id', 'lt_location_type')->get();

    // print_r($config_fixed_attribute);
    // die;

    return view("config_site", compact('configLocation', 'config_fixed_attribute', 'config_dynamic_attribute', 'sitetype', 'fixedatrname', 'dynamicatrsitetype'));
  }
  public function sitetypefetch(Request $request){
  $sitetype=LocationType::select('lt_location_type_id','lt_location_type')->get();
  return response()->json([
    'status' => 'success',
    'sitetype' => $sitetype
  ]);
  }

  public function add_site(Request $request)
  {

    $inserrt_ats = LocationType::create(
        [
          //'lt_location_type_id'=> $request->location_type_id, 
          'lt_location_type' => $request->location_type,
          'lt_location_type_address' => $request->location_type_address,
          'lt_location_type_status' => $request->location_type_status,
          'lt_location_type_name' => $request->location_type_name,
          'lt_creation_date' => now(),
          'lt_created_by' => Auth::user()->email,
          'lt_effective_start_date' => now(),
          'lt_last_updated_date' => now(),
          'lt_last_updated_by' => null,
          'lt_effective_end_date' => null,
        ],
      );
      $oldDataArray=[];
      $newData=['Site Type Name'=> $request->location_type,
      'Status' => $request->location_type_status
      ];
 
  Observable::storeLog('Site Type Addition', 'App\Models\LocationType','CREATED',0,$oldDataArray,$newData,Auth::user()->id,'Web Portal'); 
    // session()->flash('status', 'Record Created Successfully .');
    // print_r($inserrt_ats);
    //  die();
    return DB::connection('pgsql')->table('product.t_location_type_master')->max('lt_location_type_id');
  }


  public function edit_site(Request $request)
  {

    $fetch_site_details = LocationType::where('lt_location_type_id', $request->location_type_id)
      ->get();



    // dd($fetch_site_details);

    return response()->json([
      'status' => 'success',
      'fetch_site_details' => $fetch_site_details
    ]);
  }

  public function update_site(Request $request)
  {
    $oldData=LocationType::where('lt_location_type_id', $request->lt_location_type_id)->first();
   $oldDataArray=['Site Type Name'=> $oldData->lt_location_type,
   'Status' => $oldData->lt_location_type_status
                ];


    $updatesite = LocationType::where('lt_location_type_id', $request->lt_location_type_id)
      ->update([


        'lt_location_type' => $request->location_type,
        'lt_location_type_address' => $request->location_type_address,
        'lt_location_type_status' => $request->location_type_status,
        'lt_location_type_name' => $request->location_type_name,
        'lt_creation_date' => now(),
        'lt_effective_start_date' => now(),
        'lt_last_updated_date' => now(),
        'lt_last_updated_by' => Auth::user()->email,
        'lt_effective_end_date' => null,
      ]);
      $newData=[
      'Site Type Name'=> $request->location_type,
      'Status' => $request->location_type_status
      ];

   Observable::storeLog('Site Type Modification', 'App\Models\LocationType','UPDATED',$request->id,$oldDataArray,$newData,Auth::user()->id,'Web Portal'); 
    return response()->json([
      'status' => 'success',
      'updatesite' => $updatesite
    ]);
  }

  public function siteattributes(Request $request)
  {
    $site_all_attribute = LoactionAttributeMaster::where('la_location_type_id', $request->la_location_type_id)
      ->orWhere('la_location_type_id', 0)
      ->where('la_status', 'Valid')
      ->get();
    return response()->json([
      'status' => 'success',
      'fetch_site_attributes' => $site_all_attribute
    ]);

  }
  public function add_locationdetails(Request $request)
  {
    $site = $request->lt_location_type;
    $lt_location_type = LocationType::select('lt_location_type')->where('lt_location_type_id', $request->lt_location_type_masterid)->get(['lt_location_type']);

    $lt_location_type = $lt_location_type[0]->lt_location_type;
    $location = new Location;

    $location->tl_location_type_master_id = $request->lt_location_type_masterid;
    $location->tl_location_type = $lt_location_type;
    $location->tl_location_name = $request->location_name;
    $location->tl_location_code = $request->location_code;
    $location->tl_location_address = $request->location_address;
    $location->tl_created_by=Auth::user()->name;
    $location->save();
   if(!empty($request->attr))
{
    foreach ($request->attr as $key => $val) {
      $attrData = explode("_", $key);
      if(strtoupper(trim($attrData[0]))=='LATITUDE')
      {
        Location::where('tl_location_id', $location->tl_location_id)
        ->update([
          'tl_location_latitude' => $val
        ]);
      }
      if(strtoupper(trim($attrData[0]))==strtoupper('Longitude'))
      {
        Location::where('tl_location_id', $location->tl_location_id)
        ->update([
          'tl_location_longitude' => $val
        ]);
      }
      LocationAttribute::create([
        'tla_location_attribute_master_id' => $attrData[1],
        'tla_location_attribute_name' => $attrData[0],
        'tla_location_attribute_value_text' => $val,
        'tla_location_id' => $location->tl_location_id,
      ]);
    }
  }

    return $location;
  }


  public function update_locationdetails(Request $request)
  {

    $site = $request->lt_location_type;
    $lt_location_type = LocationType::select('lt_location_type')->where('lt_location_type_id', $request->lt_location_type_masterid)->get(['lt_location_type']);
    $lt_location_type = $lt_location_type[0]->lt_location_type;

    Location::where('tl_location_id', $request->location_id)
      ->update([
        'tl_location_type_master_id' => $request->lt_location_type_masterid, 'tl_location_type' => $lt_location_type, 'tl_location_name' => $request->location_name, 'tl_location_code' => $request->location_code,
        'tl_location_address' => $request->location_address,
        'tl_created_by'=>Auth::user()->name
      ]);
    if (isset($request->attr)) {
      foreach ($request->attr as $key => $val) {
        $attrData = explode("_", $key);
        if(strtoupper(trim($attrData[0]))=='LATITUDE')
        {
          Location::where('tl_location_id', $request->location_id)
          ->update([
            'tl_location_latitude' => $val
          ]);
        }
        if(strtoupper(trim($attrData[0]))==strtoupper('Longitude'))
        {
          Location::where('tl_location_id', $request->location_id)
          ->update([
            'tl_location_longitude' => $val
          ]);
        }
        LocationAttribute::updateOrCreate(['tla_location_id' => $request->location_id,'tla_location_attribute_master_id' => $attrData[1]], [
          'tla_location_attribute_master_id' => $attrData[1],
          'tla_location_attribute_name' => $attrData[0],
          'tla_location_attribute_value_text' => $val,
          'tla_location_id' => $request->location_id,
        ]);
      }
    }
    return response()->json([
      'status' => 'success',
      'detail' => Location::with('attributes')->where('tl_location_id', $request->location_id)->first()
    ]);
  }

  public function edit_location(Request $request)
  {


    $fetch_site_details = Location::where('tl_location_id', $request->location_id)->first();

    $attributes = LoactionAttributeMaster::whereIn('la_location_type_id', [$fetch_site_details->tl_location_type_master_id, 0])->get()->toArray();
    
    
   
     array_walk($attributes,"self::getAttributeData",$request->location_id);
    $fetch_site_details->attributes = $attributes;
    return response()->json([
      'status' => 'success',
      'fetch_site_details' => $fetch_site_details
    ]);
  }


  public function add_fix_atr(Request $request)
  {
    $inserrt_product = LoactionAttributeMaster::create(
        [
          'la_location_attribute_location_type' => $request->la_location_attribute_location_type,
          'la_location_attribute_name' => $request->la_location_attribute_name,
          'la_location_attribute_description' =>  $request->la_location_attribute_description,
          'la_location_attribute_datatype' => $request->datatypes,
          'la_flov' => $request->la_flov,
          'la_location_attribute_mandatory_flag' => $request->la_location_attribute_mandatory_flag,
          'la_location_attribute_default_value' => $request->la_location_attribute_default_value,
          'la_display' => $request->la_display,
          'la_editable' => $request->la_editable,
          'la_status' => $request->la_status,
          'la_requiered_not_required_flag' => $request->fixed_required,
          'la_location_type_id' => intval($request->sitetype),
          'la_creation_date' => now(),
          'la_last_updated_date' => now(),
          'la_created_by' => Auth::user()->email,
          'la_last_updated_by' =>null,
          'la_effective_start_date' =>  now(),

        ],
      );
        $oldDataArray=[];
        $newData= [
              'Attribute Name' => $request->la_location_attribute_name,
              'Attribute Description' =>  $request->la_location_attribute_description,
              'Data Type' => $request->datatypes,
              'FLoV' => $request->la_flov,
              'Mandatory Flag' =>"'".$request->fixed_required."'",
              'Default Value' => $request->la_location_attribute_default_value,
              'Display' => "'".$request->la_display."'",
              'Editable' =>"'".$request->la_editable."'",
              'Status' =>"'".$request->la_status."'",
              
          ];
    Observable::storeLog('Site Type Fixed Attribute Addition', 'App\Models\LoactionAttributeMaster','CREATED',0,$oldDataArray,$newData,Auth::user()->id,'Web Portal');

    return DB::connection('pgsql')->table('product.t_location_attribute_master')->max('la_location_attribute_id');

  }

  public function fixed_fetch_atr_edit(Request $request)
  {
    $fixed_atr_fetch_edit = LoactionAttributeMaster::where('la_location_attribute_id', $request->fixedatr_id)
      ->get();

    return response()->json([
      'status' => 'success',
      'fixed_atr_fetch_edit' => $fixed_atr_fetch_edit
    ]);
  }

  public function fixed_update_atr(Request $request)
  {
   
    $oldData=LoactionAttributeMaster::where('la_location_attribute_id', $request->la_location_attribute_id)->first();
    $oldDataArray=[
    'Attribute Name'=>$oldData->la_location_attribute_name." ",
    'Attribute Description'=>$oldData->la_location_attribute_description,
    'Default Value'=>$oldData->la_location_attribute_default_value,
    'Data Type'=>$oldData->la_location_attribute_datatype,
    'FLoV'=>$oldData->la_flov,
    'Status'=>$oldData->la_status,
    'Mandatory Flag'=>"'".$oldData->la_requiered_not_required_flag."'",
    'Editable'=>"'".$oldData->la_editable."'",
    'Display'=>"'".$oldData->la_display."'"
                  ];
    $fixed_atr_update = LoactionAttributeMaster::where('la_location_attribute_id', $request->la_location_attribute_id)
      ->update([
        'la_location_attribute_location_type' => $request->la_location_attribute_location_type,
        'la_location_attribute_name' => $request->la_location_attribute_location_type,
        'la_location_attribute_description' => $request->la_location_attribute_description,
        'la_location_attribute_datatype' => $request->datatypes,
        'la_flov' => $request->la_flov,
        'la_location_attribute_mandatory_flag' => $request->la_location_attribute_mandatory_flag,
        'la_location_attribute_default_value' => $request->la_location_attribute_default_value,
        'la_display' => $request->la_display,
        'la_editable' => $request->la_editable,
        'la_status' => $request->la_status,
        'la_requiered_not_required_flag' => $request->fixed_required,
        'la_location_type_id' => intval($request->sitetype),
]);
      $newData=['Attribute Name' => $request->la_location_attribute_name,
      'Attribute Description' =>  $request->la_location_attribute_description,
      'Data Type' => $request->datatypes,
      'FLoV' => $request->la_flov,
      'Mandatory Flag' => "'".$request->fixed_required."'",
      'Default Value' => $request->la_location_attribute_default_value,
      'Display' =>"'".$request->la_display."'",
      'Editable' => "'".$request->la_editable."'",
      'Status' => $request->la_status,
            ];
  
    Observable::storeLog('Site Type Fixed Attribute Modification', 'App\Models\LoactionAttributeMaster','UPDATED',$request->id,$oldDataArray,$newData,Auth::user()->id,'Web Portal'); 

    return response()->json([
      'status' => 'success',
      'fixed_atr_update' =>  $fixed_atr_update
    ]);
  }

  public function add_dynamic_atr(Request $request)
  {

    $lt_location_type = LocationType::where('lt_location_type_id', $request->dynamicatrtype)->get(['lt_location_type']);
    $lt_location_type = $lt_location_type[0]->lt_location_type;
    $inserrt_product2 =LoactionAttributeMaster::create(
        [
          'la_location_attribute_location_type' => $lt_location_type,
          'la_location_attribute_name' => $request->la_location_attribute_name,
          'la_location_attribute_description' =>  $request->la_location_attribute_description,
          'la_location_attribute_datatype' => $request->datatypes,
          'la_flov' => $request->la_flov,
          'la_location_attribute_mandatory_flag' => $request->la_location_attribute_mandatory_flag,
          'la_location_attribute_default_value' => $request->la_location_attribute_default_value,
          'la_display' => $request->la_display,
          'la_editable' => $request->la_editable,
          'la_status' => $request->la_status,
          'la_requiered_not_required_flag' => $request->fixed_required,
          'la_location_type_id' => intval($request->dynamicatrtype),
          'la_creation_date' => now(),
          'la_last_updated_date' => now(),
          'la_created_by' => Auth::user()->email,
          'la_last_updated_by' =>null,
          'la_effective_start_date' =>  now()

        ],

      );
      
        $Site_type_name=LocationType::where('lt_location_type_id',$inserrt_product2->la_location_type_id)->first();
        $oldDataArray=[];
        $newData= [
              'Site Type'=> isset($Site_type_name->lt_location_type)?$Site_type_name->lt_location_type:'',
              'Attribute Name' => $request->la_location_attribute_name,
              'Attribute Description' =>  $request->la_location_attribute_description,
              'Data Type' => $request->datatypes,
              'FLoV' => $request->la_flov,
              'Mandatory Flag' => "'".$request->fixed_required."'",
              'Default Value' => $request->la_location_attribute_default_value,
              'Display' => "'".$request->la_display."'",
              'Editable' =>"'".$request->la_editable."'",
              'Status' => $request->la_status,
              
          ];
    Observable::storeLog('Site Type Dynamic Attribute Addition', 'App\Models\LoactionAttributeMaster','CREATED',0,$oldDataArray,$newData,Auth::user()->id,'Web Portal');
    return DB::connection('pgsql')->table('product.t_location_attribute_master')->max('la_location_attribute_id');

  }

  public function dynamic_fetch_atr_edit(Request $request)
  {
    $dynamic_atr_fetch_edit = LoactionAttributeMaster::where('la_location_attribute_id', $request->dynamicatr_id)
      ->get();
    return response()->json([
      'status' => 'success',
      'dynamic_atr_fetch_edit' => $dynamic_atr_fetch_edit
    ]);
  }


  public function dynamic_update_atr(Request $request)
  {
    
    $oldData=LoactionAttributeMaster::where('la_location_attribute_id', $request->la_location_attribute_id)->first();
    $Site_type_name=LocationType::where('lt_location_type_id',$oldData->la_location_type_id)->first();
    $oldDataArray=[
    'Site Type'=> isset($Site_type_name->lt_location_type)?$Site_type_name->lt_location_type:'',
    'Attribute Name'=>$oldData->la_location_attribute_name." ",
    'Attribute Description'=>$oldData->la_location_attribute_description,
    'Default Value'=>$oldData->la_location_attribute_default_value,
    'Data Type'=>$oldData->la_location_attribute_datatype,
    'FLoV'=>$oldData->la_flov,
    'Status'=>$oldData->la_status,
    'Mandatory Flag'=>"'".$oldData->la_requiered_not_required_flag."'",
    'Editable'=>"'".$oldData->la_editable."'",
    'Display'=>"'".$oldData->la_display."'"
                  ];

    $lt_location_type = LocationType::where('lt_location_type_id', $request->dynamicatrtype)->get(['lt_location_type']);
    $lt_location_type = $lt_location_type[0]->lt_location_type;

    $fixed_atr_update = LoactionAttributeMaster::where('la_location_attribute_id', $request->la_location_attribute_id)
      ->update([
        'la_location_attribute_location_type' => $lt_location_type,
        'la_location_type_id' => intval($request->dynamicatrtype),
        'la_location_attribute_name' => $request->la_location_attribute_location_type,
        'la_location_attribute_description' =>  $request->la_location_attribute_description,
        'la_location_attribute_datatype' => $request->datatypes,
        'la_flov' => $request->la_flov,
        'la_location_attribute_mandatory_flag' => $request->la_location_attribute_mandatory_flag,
        'la_location_attribute_default_value' => $request->la_location_attribute_default_value,
        'la_display' => $request->la_display,
        'la_editable' => $request->la_editable,
        'la_status' => $request->la_status,
        'la_requiered_not_required_flag' => $request->fixed_required,
        ]);
      $Site_type_name_up=LocationType::where('lt_location_type_id',intval($request->dynamicatrtype))->first();
      $newData=[
      'Site Type'=>isset($Site_type_name_up->lt_location_type)?$Site_type_name_up->lt_location_type:'',
      'Attribute Name' => $request->la_location_attribute_location_type,
      'Attribute Description' =>  $request->la_location_attribute_description,
      'Data Type' => $request->datatypes,
      'FLoV' => $request->la_flov,
      'Mandatory Flag' =>"'".$request->fixed_required."'",
      'Default Value' => $request->la_location_attribute_default_value,
      'Display' => "'".$request->la_display."'",
      'Editable' => "'".$request->la_editable."'",
      'Status' => $request->la_status,
            ];
  
    Observable::storeLog('Site Type Dynamic Attribute Modification', 'App\Models\LoactionAttributeMaster','UPDATED',$request->id,$oldDataArray,$newData,Auth::user()->id,'Web Portal'); 
    return response()->json([
      'status' => 'success',
      'fixed_atr_update' =>  $fixed_atr_update
    ]);
  }

  //Value already exists

  public function check_site(Request $request)
  {
    $sitecheck = $request->location_code;
    $location = LocationType::select('lt_location_type')->where('lt_location_type', $sitecheck)->get();
    return response()->json([
      'status' => 'success',
      'sitecheck' => $location
    ]);
  }
  public function getAttributeData(&$value,$key,$location)
  {
   $data=Location_Attribute::where('tla_location_attribute_master_id',$value['la_location_attribute_id'])->where('tla_location_id',$location)->select('tla_location_attribute_value_text')->first();
    $value["tla_location_attribute_value_text"]=isset($data->tla_location_attribute_value_text)?$data->tla_location_attribute_value_text:"";
      
  }
}
