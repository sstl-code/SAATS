<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Models\asset;
use Illuminate\Http\Request;
use App\Models\AssetHistoryModel;
use App\Models\AssetTaggingHistory;


class Asset_History_Jason extends Controller
{
    public function search(Request $request)
    {
          
        $validator = Validator::make($request->all(), [
            'search' => 'required',
           
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'=>'nothing',
                'message'=>'please input a search keywaord',
            ]);

        }else{
                $search=$request->get('search');
                $global_search_asset=asset::with('locationtype','asset_history')->select("*")->where('ta_asset_manufacture_serial_no',$search)->first();
                
                //dd($global_search_asset);
              
                if(!empty($global_search_asset)){
                    return response()->json([
                        "status"=>'success',
                        "data"=>$global_search_asset,
                       
                    ]);

                }else{
                    return response()->json([
                        "status"=>'failed',
                        "message"=>'No data found',
                    ]);

                }
            }
                
            

     }
     public function site_asset_details(Request $request){
        $site_assets=AssetHistoryModel::where('location_id',$request->location_id)->where('asset_id',$request->asset_id)->get();
        $tagging_history=AssetTaggingHistory::where('th_location_id',$request->location_id)->where('th_asset_id',$request->asset_id)->get();
        return response()->json([
            "status"=>'success',
            "Site_Asset_Data"=>$site_assets,
            "Tag_history"=> $tagging_history
        ]);


     }
}
