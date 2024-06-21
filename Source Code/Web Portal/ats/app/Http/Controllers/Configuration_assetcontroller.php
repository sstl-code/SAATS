<?php

namespace App\Http\Controllers;

use DB;
use App\Traits\Observable;
use App\Models\ReasonModel;
use Illuminate\Http\Request;
use App\Models\Asset_type_model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Asset_type_attribute_master_model;

class Configuration_assetcontroller extends Controller
{
 public function index(Request $request)
 {
   // $config_assetadd= DB::connection('pgsql')->table("product.t_asset_type_master")->select('at_asset_type_id','at_asset_type_description','at_parent_asset_type_id','at_asset_type_category','at_asset_type_status','at_asset_type_name')->where('at_asset_type_id',$request->assttype_id)->get();
   $config_assetadd=Asset_type_model::with('childs')->where('at_asset_type_id',$request->assttype_id)->get();
   
    return response()->json([
      'status'=>'success',
      'config_assetadd'=>$config_assetadd,
    ]);
 }
 public function addasset_type(Request $request)
 { 
  
   $add_assettype=Asset_type_model::create(
    [
      
      'at_asset_type_description'=>$request->description,
      'at_parent_asset_type_id'=>$request->passttype,
      'at_asset_type_category'=>$request->catagory,
      'at_asset_type_status'=>$request->status,
      'at_creation_date'=> now(),
      'at_created_by'=>Auth::user()->email,
      'at_effective_start_date'=>now(),
      'at_last_updated_date'=>now(),
      'at_last_updated_by'=>"Admin",
      'at_effective_end_date'=>null,
      'at_asset_type_name'=>$request->typename
    ],
  );
  $parent_asset=Asset_type_model::where('at_asset_type_id',$add_assettype->at_parent_asset_type_id)->first();
  //dd($add_assettype);
  $oldDataArray=[];
  $newData=[
  'Parent Asset Name'=>isset($parent_asset->at_asset_type_name)?$parent_asset->at_asset_type_name:'',
  'Name' =>  $request->typename,
  'Description'=> $request->description,
  'Category' => $request->catagory,
  'ParentAssetTypeId'=>$request->passttype,
  'Status' => $request->status
  ];
 
  Observable::storeLog('Asset Type Addition', 'App\Models\Asset_type_model','CREATED',0,$oldDataArray,$newData,Auth::user()->id,'Web Portal');        


  
  return response()->json([
    'status'=>'success',
    'add_assettype'=>$add_assettype
  ]);
  
}
public function updasset_type(Request $request)
 {
 
  $oldData=Asset_type_model::where('at_asset_type_id',$request->id)->first();
  //dd($oldData);
  $parent_asset=Asset_type_model::where('at_asset_type_id',$oldData->at_parent_asset_type_id)->first();
  $oldDataArray=[ 'Parent Asset Name'=>isset($parent_asset->at_asset_type_name)?$parent_asset->at_asset_type_name:'',
                  'Name' => $oldData->at_asset_type_name,
                  'Description'=> $oldData->at_asset_type_description,
                  'Category' => $oldData->at_asset_type_category,
                  'Status' => $oldData->at_asset_type_status,
                  
                ];
  $update =Asset_type_model::where('at_asset_type_id',$request->id)
  ->update([
  'at_asset_type_description' =>$request->description,
  'at_asset_type_status'=>$request->status,
  'at_parent_asset_type_id'=>$request->passttype,
  'at_asset_type_category'=>$request->catagory,
  'at_asset_type_name'=>$request->typename
  
  ]);
  $parent_asset_update=Asset_type_model::where('at_asset_type_id',$request->passttype)->first();
 
 $newData=[
          'Parent Asset Name'=>isset($parent_asset_update->at_asset_type_name)?$parent_asset_update->at_asset_type_name:'',
          'Name' =>  $request->typename,
          'Description'=> $request->description,
          'Category' => $request->catagory,
          'Status' => $request->status
          ];

  Observable::storeLog('Asset Type Modification', 'App\Models\Asset_type_model','UPDATED',$request->id,$oldDataArray,$newData,Auth::user()->id,'Web Portal'); 
         

  // session()->flash('status', 'Record Updated Successfully .');

  return response()->json([
    'status'=>'success',
    'update'=>$update
  ]);
}
// public function tests(Request $request){
//   print_r($request->toArray());
//   die("aaaaa");
// }
 public function fixedassetattr(Request $request)
{
  // die("sss");
  $addfixattr=Asset_type_attribute_master_model::create(
    [
     'ata_asset_type_attribute_code'=>$request->attribute_code,
      'ata_asset_type_attribute_description'=>$request->attribute_fixdescription,
      'ata_asset_type_attribute_datatype'=>$request->datatypes,
      'attribute_catagory'=>$request->attribute_fixflag,
      'ata_asset_type_attribute_default_value'=>$request->attribute_fixdefault,
      'ata_asset_type_id'=>($request->asset_name)==null?0:$request->asset_name,
      'ata_asset_type_attribute_name'=>$request->attribute_attname,
      'ata_flov'=>$request->fixflov,
      'ata_status'=>$request->fixstatus,
      'ata_field_requiered_not_required_flag'=>$request->required_notrequired,
      'ata_field_editable_non_editable_flag'=>$request->fixedit,
      'ata_display'=>$request->fixdisplay,
      'ata_creation_date'=>now(),
      'ata_created_by'=>Auth::user()->email,
      'ata_effective_start_date'=>now(),
      'ata_last_updated_date'=>now(),
      'ata_last_updated_by'=>null,
      'ata_effective_end_date'=>null
      
    ]
    );
    $oldDataArray=[];
    $newData= [
       'Attribute Name'=>$request->attribute_attname,
       'Attribute Code'=>$request->attribute_code,
       'Attribute Description'=>$request->attribute_fixdescription,
       'Default Value'=>$request->attribute_fixdefault,
       'Data Type'=>$request->datatypes,
       'FLoV'=>$request->fixflov,
       'Status'=>$request->fixstatus,
       'Mandatory Flag'=>"'".$request->required_notrequired."'",
       'Editable'=>"'".$request->fixedit."'",
       'Display'=>"'".$request->fixdisplay."'",
       ];
    Observable::storeLog('Asset Type Fixed Attribute Addition', 'App\Models\Asset_type_attribute_master_model','CREATED',0,$oldDataArray,$newData,Auth::user()->id,'Web Portal');
    
    //session()->flash('status', 'Record Created Successfully .');
  // print_r($addfixattr);
  // die();

    //return redirect()->to('Configuration_management');
    return DB::connection('pgsql')->table('product.t_asset_type_attribute_master')->max('ata_asset_type_attribute_id');
}

public function fixfetchedit(Request $request)
{
  //dd($request->fixatt_id);
  $fetchfixattr=Asset_type_attribute_master_model::where('ata_asset_type_attribute_id',$request->fixatt_id)
  ->get();
//dd($fetchfixattr);



return response()->json([
  'status'=>'success',
  'fetchfixattr'=>$fetchfixattr
]);

}
public function updfix_asst(Request $request)
 { //dd($request);
  
  $oldData=Asset_type_attribute_master_model::where('ata_asset_type_attribute_id',$request->id)->first();
  $oldDataArray=[
  'Attribute Name'=>$oldData->ata_asset_type_attribute_name." ",
  'Attribute Code'=>$oldData->ata_asset_type_attribute_code,
  'Attribute Description'=>$oldData->ata_asset_type_attribute_description,
  'Default Value'=>$oldData->ata_asset_type_attribute_default_value,
  'Data Type'=>$oldData->ata_asset_type_attribute_datatype,
  'FLoV'=>$oldData->ata_flov,
  'Status'=>$oldData->ata_status,
  'Mandatory Flag'=>"'".$oldData->ata_field_requiered_not_required_flag."'",
  'Editable'=>"'".$oldData->ata_field_editable_non_editable_flag."'",
  'Display'=>"'".$oldData->ata_display."'"
                ];
                //dd($oldDataArray);
  $updatefix = Asset_type_attribute_master_model::where('ata_asset_type_attribute_id',$request->id)
  ->update([
  
      'ata_asset_type_attribute_code'=>$request->attribute_code,
      'ata_asset_type_attribute_description'=>$request->attribute_fixdescription,
      'ata_asset_type_attribute_datatype'=>$request->datatypes,
      'attribute_catagory'=>$request->attribute_fixflag,
      'ata_asset_type_attribute_default_value'=>$request->attribute_fixdefault,
      // 'ata_asset_type_id'=>$request->asset_name,
      'ata_asset_type_attribute_name'=>$request->attribute_attname,
      'ata_flov'=>$request->fixflov,
      'ata_status'=>$request->fixstatus,
      'ata_field_requiered_not_required_flag'=>$request->required_notrequired,
      'ata_field_editable_non_editable_flag'=>$request->fixedit,
      'ata_display'=>$request->fixdisplay,
      'ata_last_updated_by'=>Auth::user()->email
    ]);

    $newData=['Attribute Name'=>$request->attribute_attname,
    'Attribute Code'=>$request->attribute_code,
    'Attribute Description'=>$request->attribute_fixdescription,
    'Default Value'=>$request->attribute_fixdefault,
    'Data Type'=>$request->datatypes,
    'FLoV'=>$request->fixflov,
    'Status'=>$request->fixstatus,
    'Mandatory Flag'=>"'".$request->required_notrequired."'",
    'Editable'=>"'".$request->fixedit."'",
    'Display'=>"'".$request->fixdisplay."'"
          ];
          //dd($newData);

  Observable::storeLog('Asset Type Fixed Attribute Modification', 'App\Models\Asset_type_attribute_master_model','UPDATED',$request->id,$oldDataArray,$newData,Auth::user()->id,'Web Portal'); 

 
  

  return response()->json([
    'status'=>'success',
    'updatefix'=>$updatefix
  ]);


}

public function dynamicattribute(Request $request)
{
 
  
  $adddynamicatt=Asset_type_attribute_master_model::create(
    [
      'ata_asset_type_attribute_code'=>$request->attribute_code,
      'ata_asset_type_attribute_description'=>$request->attribute_fixdescription,
      'ata_asset_type_attribute_datatype'=>$request->datatypes,
      'attribute_catagory'=>$request->attribute_fixflag,
      'ata_asset_type_attribute_default_value'=>$request->attribute_fixdefault,
      'ata_asset_type_id'=>$request->asset_name,
      'ata_asset_type_attribute_name'=>$request->attribute_attname,
      'ata_flov'=>$request->fixflov,
      'ata_status'=>$request->fixstatus,
      'ata_field_requiered_not_required_flag'=>$request->required_notrequired,
      'ata_field_editable_non_editable_flag'=>$request->fixedit,
      'ata_display'=>$request->fixdisplay,
      'ata_creation_date'=>now(),
      'ata_created_by'=>Auth::user()->email,
      'ata_effective_start_date'=>now(),
      'ata_last_updated_date'=>now(),
      'ata_last_updated_by'=>"Admin",
      'ata_effective_end_date'=>null
    ]
    );
    
    $parent_asset=Asset_type_model::where('at_asset_type_id',$adddynamicatt->ata_asset_type_id)->first();
    $oldDataArray=[];
    $newData= [
       'Asset Type Name'=> $parent_asset->at_asset_type_name,
       'Attribute Name'=>$request->attribute_attname,
       'Attribute Code'=>$request->attribute_code,
       'Attribute Description'=>$request->attribute_fixdescription,
       'Default Value'=>$request->attribute_fixdefault,
       'Data Type'=>$request->datatypes,
       'FLoV'=>$request->fixflov,
       'Status'=>$request->fixstatus,
       'Mandatory Flag'=>"'".$request->required_notrequired."'",
       'Editable'=>"'".$request->fixedit."'",
       'Display'=>"'".$request->fixdisplay."'",
       ];
    Observable::storeLog('Asset Type Dynamic Attribute Addition', 'App\Models\Asset_type_attribute_master_model','CREATED',0,$oldDataArray,$newData,Auth::user()->id,'Web Portal');
    return DB::connection('pgsql')->table('product.t_asset_type_attribute_master')->max('ata_asset_type_attribute_id');
}
//dd($adddynamicatt);
public function dynamiceditatt(Request $request)
{
  $fetchdynamicatt=Asset_type_attribute_master_model::where('ata_asset_type_attribute_id',$request->dynamic_id)
  ->get();
  return response()->json([
    'status'=>'success',
    'fetchdynamicatt'=>$fetchdynamicatt
  ]);
}

public function updatedynamic(Request $request)
{//dd($request->id);


  $oldData=Asset_type_attribute_master_model::where('ata_asset_type_attribute_id',$request->id)->first();
  $parent_asset=Asset_type_model::where('at_asset_type_id',$oldData->ata_asset_type_id)->first();
  $oldDataArray=[
  'Asset Type Name'=> $parent_asset->at_asset_type_name,  
  'Attribute Name'=>$oldData->ata_asset_type_attribute_name." ",
  'Attribute Code'=>$oldData->ata_asset_type_attribute_code,
  'Attribute Description'=>$oldData->ata_asset_type_attribute_description,
  'Default Value'=>$oldData->ata_asset_type_attribute_default_value,
  'Data Type'=>$oldData->ata_asset_type_attribute_datatype,
  'FLoV'=>$oldData->ata_flov,
  'Status'=>$oldData->ata_status,
  'Mandatory Flag'=>"'".$oldData->ata_field_requiered_not_required_flag."'",
  'Editable'=>"'".$oldData->ata_field_editable_non_editable_flag."'",
  'Display'=>"'".$oldData->ata_display."'"
                ];
  $updatedynamiced=Asset_type_attribute_master_model::where('ata_asset_type_attribute_id',$request->id)
  ->update([
      'ata_asset_type_attribute_code'=>$request->attribute_code,
      'ata_asset_type_attribute_description'=>$request->attribute_fixdescription,
      'ata_asset_type_attribute_datatype'=>$request->datatypes,
      'attribute_catagory'=>$request->attribute_fixflag,
      'ata_asset_type_attribute_default_value'=>$request->attribute_fixdefault,
      'ata_asset_type_id'=>$request->asset_name,
      'ata_asset_type_attribute_name'=>$request->attribute_attname,
      'ata_flov'=>$request->fixflov,
      'ata_status'=>$request->fixstatus,
      'ata_field_requiered_not_required_flag'=>$request->required_notrequired,
      'ata_field_editable_non_editable_flag'=>$request->fixedit,
      'ata_display'=>$request->fixdisplay, 
      'ata_last_updated_by'=>Auth::user()->email
  ]);
  $update_parent_asset=Asset_type_model::where('at_asset_type_id',$request->asset_name)->first();

  $newData=[
  'Asset Type Name'=>$update_parent_asset->at_asset_type_name,   
  'Attribute Name'=>$request->attribute_attname,
  'Attribute Code'=>$request->attribute_code,
  'Attribute Description'=>$request->attribute_fixdescription,
  'Default Value'=>$request->attribute_fixdefault,
  'Data Type'=>$request->datatypes,
  'FLoV'=>$request->fixflov,
  'Status'=>$request->fixstatus,
  'Mandatory Flag'=>"'".$request->required_notrequired."'",
  'Editable'=>"'".$request->fixedit."'",
  'Display'=>"'".$request->fixdisplay."'"
        ];

Observable::storeLog('Asset Type Dynamic Attribute Modification', 'App\Models\Asset_type_attribute_master_model','UPDATED',$request->id,$oldDataArray,$newData,Auth::user()->id,'Web Portal'); 

  //session()->flash('status', 'Record Updated Successfully .');
  

  return response()->json([
    'status'=>'success',
    'updatedynamiced'=>$updatedynamiced
  ]);
}

public function Sub_Reasons(Request $request){
  $subreason=ReasonModel::where('rm_reason_parent_id',$request->reamastrid)->get();
  return response()->json([
    'status'=>'success',
    'subreason'=>$subreason
  ]);
}
public function Add_Update_Reason(Request $request){

  $reason=ReasonModel::updateOrCreate(
    ['rm_reason_id'=>$request->rm_reason_id],
    [
    'rm_reason_description'=>$request->reason_description,
    'rm_reason_status'=>$request->reason_status,
    'rm_reason_parent_id'=>$request->rm_reason_parent_id,
    'rm_reason_code'=>$request->reason_code
    ]
 );
 return response()->json([
  'status'=>'success',
  'reason'=>$reason
]);

}
public function ReasonDetails(Request $request)
{
  $fetchreason=ReasonModel::where('rm_reason_id',$request->resn_id)->first();
  
 return response()->json([
    'status'=>'success',
    'fetchreason'=> $fetchreason
  ]);
  
 
}



}

 




