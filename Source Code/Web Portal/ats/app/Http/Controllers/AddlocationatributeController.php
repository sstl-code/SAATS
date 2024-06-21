<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AddlocationatributeController extends Controller
{
    public function store(Request $request)
    {  
        
       
        $SiteCode = ucfirst($request->site_code);
        $locationname = strtoupper($request->location_name);
        $la_location_attribute_id=DB::table('product.t_location_attribute_master')->where('la_location_attribute_name',$SiteCode)->get(['la_location_attribute_id']);
        $tl_location_id=DB::table('ats.t_location')->where('tl_location_name',$locationname)->get(['tl_location_id']);
        
        //print_r($tl_location_id);die("nnnn");
        
        $la_location_attribute_name=DB::table('product.t_location_attribute_master')->where('la_location_attribute_name',$SiteCode)->get(['la_location_attribute_name']);
        
        $la_location_attribute_id=$la_location_attribute_id[0]->la_location_attribute_id;
        
        $tl_location_id=$tl_location_id[0]->tl_location_id;
        
       
        $la_location_attribute_name=$la_location_attribute_name[0]->la_location_attribute_name;
        // dd($request);
        $location=DB::table('ats.t_location_attribute')
        
        ->insert (
            [
            'tla_location_attribute_master_id' => $la_location_attribute_id,
            'tla_location_id' => $tl_location_id,
            'tla_location_attribute_name' => $la_location_attribute_name,
            'tla_location_attribute_description' => $request->tla_location_attribute_description,
            'tla_creation_date' => now(),
            'tla_created_by' => 'Admin01',
            'tla_effective_start_date' => now(),
            'tla_last_updated_date' => now(),
            'tla_last_updated_by' => 'Admin01',
            'tla_effective_end_date' => now(),
            'tla_location_attribute_value_number' =>2,
            'tla_location_attribute_value_integer' =>1,
            'tla_location_attribute_value_text' => 'Text',
            'tla_location_attribute_value_date' => now(),
           ],
        

    );
    return response()->json([
        "status" => 200,
        "message" => 'Location Attribute created successfully'
    ]);


    
    }


}


