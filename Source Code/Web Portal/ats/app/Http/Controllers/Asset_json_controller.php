<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Asset_json_controller extends Controller
{
    public function test(Request $request)
    {
    
       // print_r($request->asset_id);die();
        //$asset_id=$request->ta_asset_id;
        
        $testDB= DB::table('ats.v_asset_list_parent_site_code')->where('ta_asset_id',$request->asset_id)->first();
        //dd($testDB);
        //$asset_type_master_id=$testDB->ta_asset_type_master_id;
        $child_asset= DB::table('ats.v_asset_list_parent_site_code')->where('parent_asset_id',$request->asset_id)->get();
        //echo "<pre>"; print_r($child_asset->toArray()); die;

      $details=DB::table('ats.v_asset_list_parent_site_code')
      ->select('ta_asset_manufacture_serial_no','ta_asset_tag_number','parent_asset_name','tl_location_code','ta_asset_status','ta_asset_description','ta_asset_type_master_id')
      ->where('ta_asset_id',$request->asset_id)
      ->first();
      //dd($details);
      $asset_type_id=$details->ta_asset_type_master_id;
      
    //dynamic_attribute_name
      $asset_dynamic_attribute = DB::table('ats.v_attr_list')
      ->where('at_asset_type_id',$asset_type_id)
      ->get(['ata_asset_type_attribute_name']);


      $at_asset_attribute_description= DB::table('ats.v_location_asset_attr')
           ->where('ta_asset_type_master_id',$asset_type_id)
          ->where('ta_asset_id',$request->asset_id)
          ->get(['at_asset_attribute_description','at_asset_attribute_value_text']);
          //dd($asst_dynamc_att_value);

      
      
         return response()->json([
            'status' => 'success',
            'data' =>   $testDB,
            'child_asset' => $child_asset,
            'at_asset_attribute_description' => $at_asset_attribute_description,
            
            // 'asset_attr'=> $asset_attr
         ]);
}
}

