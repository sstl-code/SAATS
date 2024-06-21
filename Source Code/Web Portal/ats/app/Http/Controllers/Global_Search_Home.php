<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class Global_Search_Home extends Controller
{
    public function search(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'search' => 'required',
           
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'message'=>'please input a search keywaord',
            ]);

        }else{

           $search=strtoupper($request->get('search'));
           //dd($search);
          // $global_search_home=DB::table('ats.t_location')->where('tl_location_type','SITES')->where(DB::raw('upper(tl_location_name)'),'LIKE',"%{$search}%")->orWhere('tl_location_code','LIKE',"%{$search}%")->orWhere('tl_location_address','LIKE',"%{$search}%")->get();
           //dd($global_search_home);
           $global_search_home = DB::table('ats.t_location')
            ->where('tl_location_type', 'SITES')
            ->where(function ($query) use ($search) {
                $query->where(DB::raw('upper(tl_location_name)'), 'LIKE', "%{$search}%")
                    ->orWhere('tl_location_code', 'LIKE', "%{$search}%")
                    ->orWhere('tl_location_address', 'LIKE', "%{$search}%");
            })
            ->get();
           if(!empty($global_search_home)){
           return response()->json([
               "status"=>200,
               "data"=>$global_search_home,
           ]);
           }else{
               return response()->json([
                   'status'=>'No data found',
               ]);
           }


        }
        
       
    }
}
