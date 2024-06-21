<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class configuration_site_details extends Controller
{
    public function index(Request $request){

        $configLocation=DB::connection('pgsql')->table("ats.t_location")->select('tl_location_id','tl_location_type','tl_location_name', 'tl_location_address', 'tl_location_status')->where('tl_location_id',$request->locationType_id)->groupBy('tl_location_id','tl_location_type','tl_location_name', 'tl_location_address', 'tl_location_status')->get();
       
        return response()->json([
            'status'=>'success',
            'configLocation'=>$configLocation,
        ]);
        //return view("config_site",compact('configLocation'));
    }

    // public function update_site(Request $request){
    //     $update = DB::table(ats.t_location)
    //     ->where('tl_location_id',$request->id)
    //     ->update([
    //         'tl_location_type'=>$request->
    //         'tl_location_name'=>$request->
    //         'tl_location_address'=>$request->
    //         'tl_location_status'=>$request->
    //     ]);
    //     return response()->json([
    //         'status'=>'success',
    //         'update'=>$update
    //     ]);
    // }
}
