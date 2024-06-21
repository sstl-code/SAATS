<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Asset_child_details extends Controller
{
    public function index($id) 
    {   
        //dd($id);
        //$location = DB::table('ats.t_location')->select('tl_location_code','tl_location_name')->where('tl_location_id',$id)->first();
        //dd($location_id);
        $child_assets_data = DB::table('ats.v_asset_list_parent_site_code')->where('v_asset_list_parent_site_code.parent_asset_id',$id)->get();
        //echo "<pre>";print_r($assets_data);die();
       

        //return $allData;
      
        if(!empty($child_assets_data)){
            return response()->json([
                "status" => 200,
               // "location" => $location,
                "data" => $child_assets_data
            ]);
        }else{
            return response()->json([
                'status'=>'No data found',
            ]);
        }
        
    }
}