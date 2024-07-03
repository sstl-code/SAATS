<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Global_location_home extends Controller
{
   
    public function index(Request $request) 
    {  
       
        $lat = $request->lat;
        $lng = $request->lng;
        $radius = $request->radius;
        $site = 'SITES';
        $results = DB::select("select * from ats.lat_long(?, ?, ?) where tl_location_type = ?", [$lat, $lng, $radius, $site]);
       
        return response()->json([
            "status" => 200,
            "data" => $results
        ]);

    }
}