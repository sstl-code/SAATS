<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class stnUpload_json extends Controller
{
    public function getSTNData(Request $request)
    {
        // Retrieve and process the data
     //   $inserted_datetime = $request->session()->get('inserted_datetime');    
     //   $result = DB::select(DB::raw('SELECT ats.insert_t_stn(?, ?) as result'), ['param1', 'param2']);
     //die("mmsssssm");
       // $result = DB::select(DB::raw('SELECT ats.insert_t_stn() as result'));
        // $query = DB::raw('SELECT ats.insert_t_stn()');
        // $result = DB::select($query);
        $allUsersCount=DB::select('SELECT ats."insert_t_stn"()');
       // $result = DB::select($query->toString());
        //print_r($allUsersCount);die();
        // Return the data as a JSON response
        //dd($allUsersCount);
        session()->flash('status', 'STN Created Successfully .');
        return response()->json($allUsersCount);
    }
}
