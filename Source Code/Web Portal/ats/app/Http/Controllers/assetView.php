<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class assetView extends Controller
{
    public function index() 
    {   
       
        // $assets=DB::table('ats.v_asset_list')->get();
        
        $assets_data = DB::table('ats.v_asset_list_parent_site_code')->get();
        // $asset_details=DB::table('ats.v_asset_list_parent_site_code')
        
        // ->where('v_asset_list_parent_site_code.ta_asset_location_id',$id)
        // ->get();
       // echo "<pre>";print_r($assets_data);die();
        //dd($asset_details);

        
       return view('asset_view',compact('assets_data'));
      
    }

}