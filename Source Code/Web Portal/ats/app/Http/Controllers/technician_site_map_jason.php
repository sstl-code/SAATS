<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use App\Models\asset;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\User_Location_Model;

class technician_site_map_jason extends Controller
{
    public function index(Request $request)
    {
    
      $tech_site_table=User_Location_Model::with('locations')->where('ul_user_id',$request->user_id)->select('*')->get();

      return response()->json([
        'status'=>'success',
        'tech_site_table'=>$tech_site_table,
      ]);
    }


    public function search_user(Request $request)
    {
      $dataArray = array();
      $search= strtoupper($request->get('search'));
      $global_search_home=User::select('*')->whereRaw("upper(email) LIKE '"."%{$search}%'")->orWhereRaw("upper(name) LIKE'"."%{$search}%'")->get();
      //dd($global_search_home);
      foreach($global_search_home as $item ){
        $dataArray[] = array(
          "label" => $item->email."(".$item->name.")",
          "value" => $item->id,
          "name"=>$item->name,
          "email"=>$item->email
        
        );
      }
      
      return response()->json($dataArray);
    }
}