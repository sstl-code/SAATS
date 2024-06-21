<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Asset_Attribute_Controller extends Controller
{
    public function store(Request $request){
        $asset_att = ucfirst($request->asset_att);
        $at_asset_type_id = DB::table('product.t_asset_type_master')->where('at_asset_type_name',$asset_att)->get(['at_asset_type_id']);
        // dd($at_asset_type_id);
        $at_asset_type_code = DB::table('product.t_asset_type_master')->where('at_asset_type_name',$asset_att)->get(['at_asset_type_code']);
        // dd($at_asset_type_code);
        $at_asset_type_description = DB::table('product.t_asset_type_master')->where('at_asset_type_name',$asset_att)->get(['at_asset_type_description']);
        // dd($at_asset_type_description);
        $at_asset_type_id=$at_asset_type_id[0]->at_asset_type_id;
        // dd($at_asset_type_id);
        $at_asset_type_code=$at_asset_type_code[0]->at_asset_type_code;
        // dd($at_asset_type_code);
        $at_asset_type_description=$at_asset_type_description[0]->at_asset_type_description;
        // dd($at_asset_type_description);
        $asset_att_Con=DB::table('ats.t_asset')
        ->insert(
            [
                'ta_asset_type_master_id' => $at_asset_type_id,
                'ta_asset_type_code' => $at_asset_type_code,
                'ta_asset_description'=>$at_asset_type_description,
                'ta_asset_manufacture_serial_no' => $request->ta_asset_manufacture_serial_no,
                'ta_asset_name' => $request->ta_asset_name,
                'ta_asset_tag_number' => $request->ta_asset_tag_number,
                'ta_asset_parent_id' => $request->ta_asset_parent_id,
                'ta_asset_location_id' => $request->ta_asset_location_id,
                'ta_asset_status' => $request->ta_asset_status,
                'ta_creation_date'=>now(),
                'ta_created_by'=>'Admin01',
                'ta_effective_start_date'=>now(),
                'ta_last_updated_date'=>now(),
                'ta_last_updated_by'=>'Admin01',
                'ta_effective_end_date'=>now(),
                'ta_asset_last_tag_scan_date'=>now(),
                'ta_asset_reason'=>'REASON3',
                'ta_asset_image'=>null
                
            ],
        );
        return response()->json([
            "status"=>200,
            "message"=>'asset attribute created successfully'
        ]);
    }
}


