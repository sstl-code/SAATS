<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Child_sat_dynamic extends Controller
{
    public function child_sat_dynamic(Request $request)
    {  
        $child_asset_id = $request->child_asset_id;
        $child_static_details=DB::table('ats.t_asset')
        //->select('ta_asset_manufacture_serial_no','ta_asset_tag_number','parent_asset_name','ta_asset_location_id','ta_asset_status','ta_asset_description','ta_asset_type_master_id','ta_asset_name','ta_asset_type_master_id')
        ->where('ta_asset_id',$child_asset_id)
        ->first();
        //dd($child_static_details);
       
      $parent_asset_id = $child_static_details==null?null:$child_static_details->ta_asset_parent_id;
      $parent_asset_name=DB::table('ats.t_asset')
      ->select('ta_asset_name')
      ->where('ta_asset_id',$parent_asset_id)
      ->first();
      //dd($parent_asset_name);

      $location_id = $child_static_details==null?null:$child_static_details->ta_asset_location_id;
      //dd($location_id);

      $location_name=DB::table('ats.t_location')
      ->select('tl_location_code')
      ->where('tl_location_id',$location_id)
      ->first();
      //dd($location_name);


        $asset_image=DB::table('ats.t_asset')
        ->select('ta_asset_image')
        ->where('ta_asset_id',$child_asset_id)
        ->first();
        $asset_image =$asset_image==null?null: $asset_image->ta_asset_image;

        $master_type_id=$child_static_details==null?null:$child_static_details->ta_asset_type_master_id;
        $child_dynamc_att_value= DB::table('ats.v_location_asset_attr')
        ->where('ta_asset_type_master_id',$master_type_id)
       ->where('ta_asset_id',$child_asset_id)
       ->get(['at_asset_attribute_description','at_asset_attribute_value_text', 'at_asset_attribute_value_integer', 'at_asset_attribute_value_number','tag_status']);

       return response()->json([
        "status"=>200,
        "static_attri"=> $child_static_details,
        'parent_asset_name'=>$parent_asset_name==null?null:$parent_asset_name->ta_asset_name,
        'site_code'=>$location_name==null?null:$location_name->tl_location_code,
        'ta_asset_image'=>$asset_image,
        "dynamic_attri"=>$child_dynamc_att_value,

    ]);
        
      

    }

    }

