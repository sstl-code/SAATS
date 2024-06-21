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
        //dd($lat);
        //$global_locations = DB::table('ats.ats_lat_long')->get();
        $site = 'SITES';
        //$results = DB::select('select * from ats.lat_long('.$lat.','.$lng.','.$radius.')');
        //$results = DB::select("select * from ats.lat_long(".$lat.",".$lng.",".$radius.") where tl_location_type = ".$site);
        $results = DB::select("select * from ats.lat_long(?, ?, ?) where tl_location_type = ?", [$lat, $lng, $radius, $site]);
        //dd($results);

        return response()->json([
            "status" => 200,
            "data" => $results
        ]);

    }
}