<?php

namespace App\Http\Controllers;

use DB;
use App\Models\asset;
use App\Models\Location;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Operator_location_model;

class operator_site_jason extends Controller
{
    public function index(Request $request)
    {
        $operator_site_table=asset::where('operator_id',$request->operator_id)->whereNotNull('ta_asset_location_id')->whereRaw("upper(ta_asset_catagory)='".strtoupper('Active')."'")->where('is_shown','t')->select('ta_asset_location_id')->groupBy('ta_asset_location_id')->get();
       
        $ope_site_id=$operator_site_table->pluck('ta_asset_location_id');
       
        $operator_site_table=Location::whereIn('tl_location_id',$ope_site_id)->orderby('tl_location_code')->get(); 

       //dd($operator_site_table);
        return response()->json([
            'status'=>'success',
            'operator_site_table'=>$operator_site_table,
          ]);
    }

    public function search_location(Request $request)
    {
      // $operator_site_table=asset::where('operator_id',$request->operator_id)->whereNotNull('ta_asset_location_id')->select('ta_asset_location_id')->groupBy('ta_asset_location_id')->get();
       
      // $ope_site_id=$operator_site_table->pluck('ta_asset_location_id');
     
      // $operator_site_table=Location::select('*')->whereInRaw('tl_location_id',$ope_site_id)->get();
      $dataArray = array();
      $search= strtoupper($request->get('search'));

      $global_search_home=Location::select('*')->whereRaw("upper(tl_location_name) LIKE '"."%{$search}%'")->orWhereRaw("upper(tl_location_code) LIKE'"."%{$search}%'")->get();

      
      foreach($global_search_home as $item ){
        $dataArray[] = array(
          "label" => $item->tl_location_name,
          "value" => $item->tl_location_code,
          "tl_location_id" => $item->tl_location_id,
          "region" => $item->tl_location_region,
          "tagging_status" => $item->tagging_status
        );
      }
      return response()->json($dataArray);  
      
    }
    
}
