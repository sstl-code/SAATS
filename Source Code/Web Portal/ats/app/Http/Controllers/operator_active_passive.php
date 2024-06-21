<?php

namespace App\Http\Controllers;

use DB;
use App\Models\asset;
use App\Models\Location;
use App\Class\CommonClass;
use Illuminate\Http\Request;


class operator_active_passive extends Controller
{
  public $assetdataActivechild="";
  public $assetdataPassivechild="";
    public function index(Request $request)
    {
         $operator_asset_detail=asset::with('locationtype')->where('ta_asset_location_id',$request->site_id)->where('is_shown','t')->where('ta_asset_parent_id',0)->whereNotNull('ta_asset_catagory')->get();
         $ChildData = new CommonClass();
         $i=0;
         foreach($operator_asset_detail as $assets){
          if(($assets->childs)!=""){
            $ChildData->assetdataPassivechild="";
            $ChildData->assetdataActivechild="";
            $ChildData->childs_html($assets->childs,$assets->ta_asset_id,$assets->AssetType,$request->operator_id);    
            $operator_asset_detail[$i]->child_HTML_Passive= $ChildData->assetdataPassivechild;
            $operator_asset_detail[$i]->child_HTML_Active= $ChildData->assetdataActivechild;
           
          }
          $i++;
        }
      //dd($operator_asset_detail);
          return response()->json([
        'status'=>'success',
        'operator_asset_detail'=>$operator_asset_detail,
      ]);
    }


 
    
}
