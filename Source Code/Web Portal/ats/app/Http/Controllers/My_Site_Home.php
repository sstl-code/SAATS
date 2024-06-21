<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class My_Site_Home extends Controller
{
    public function index(Request $request)
    {
       // dd($request);
        $my_site_home=DB::table('ats.v_technician_to_site_tagging')->select('location_id','tl_location_code','location_name','tl_location_address')->where('user_id',$request->userId)->groupBy('location_id','tl_location_code','location_name','tl_location_address')->get();
        if(!empty($my_site_home)){
        return response()->json([
            "status"=>200,
            "data"=>$my_site_home
        ]);
    }else{
        return response()->json([
            'status'=>'No data found',
        ]);
    }
    
    }
    
}