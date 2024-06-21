<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AddLocationController extends Controller
{
    
    public function store(Request $request)
    {
        
        $site = ucfirst($request->site);
        $lt_location_type_id = DB::table('product.t_location_type_master')->where('lt_location_type_name',$site)->get(['lt_location_type_id']);
        $lt_location_type = DB::table('product.t_location_type_master')->where('lt_location_type_name',$site)->get(['lt_location_type']);
        $lt_location_type_id = $lt_location_type_id[0]->lt_location_type_id;
        $lt_location_type = $lt_location_type[0]->lt_location_type;
       //dd($lt_location_type);
        $location = DB::table('ats.t_location')
            ->insert(
                [
                    'tl_location_type_master_id' => $lt_location_type_id,
                    'tl_location_type' => $lt_location_type,
                    'tl_location_code' => $request->location_code,
                    'tl_location_address' =>  strtoupper($request->location_address),
                    'tl_location_description' => $request->location_description,
                    'tl_location_status' => $request->location_status,
                    'tl_location_region' => $request->location_region,
                    'tl_location_latitude' => $request->location_latitude,
                    'tl_location_longitude' => $request->location_longitude,
                    'tl_creation_date' => now(),
                    'tl_created_by' =>'Admin01',
                    'tl_effective_start_date' =>  now(),
                    'tl_last_updated_date' =>  now(),
                    'tl_last_updated_by' => 'Admin01',
                    'tl_effective_end_date' => Null,
                    'tl_location_name' => $request->location_name
                 ],
               
            );

            return response()->json([
                "status" => 200,
                "message" => 'Location created successfully'
            ]);


    }

    public function update(Request $request, $location_id)
    {
        // $asset_type_name = ucfirst($request->asset_type_name);
        //dd(Auth::user());
        // $at_asset_type_id = DB::table('product.t_asset_type_master')->where('at_asset_type_name',$asset_type_name)->get(['at_asset_type_id']); 
        // $at_asset_type_code = DB::table('product.t_asset_type_master')->where('at_asset_type_name',$asset_type_name)->get(['at_asset_type_code']);
        //$at_asset_type_description = DB::table('product.t_asset_type_master')->where('at_asset_type_name',$asset_type_name)->get(['at_asset_type_description']);      
        
        // $at_asset_type_id = $at_asset_type_id[0]->at_asset_type_id;
        // $at_asset_type_code = $at_asset_type_code[0]->at_asset_type_code;
        // $at_asset_type_description = $at_asset_type_description[0]->at_asset_type_description;
        //dd($asset_id);
        $details=DB::table('ats.t_location')
        ->where('tl_location_id',$location_id)
        ->where('tl_effective_end_date',NULL)
        ->update([
        'tl_location_description' => $request->location_description,
        'tl_last_updated_date' =>  now(),
        'tl_last_updated_by' => 'Admin01',
        
    ]);
    return response()->json([
        "status" => 200,
        "message" => 'Location updated successfully'
    ]);
        
    }

}


