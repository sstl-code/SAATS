<?php

namespace App\Http\Controllers;


use App\Models\asset;
use App\Models\Location;
use App\Class\CommonClass;
use Illuminate\Http\Request;

class technician_site_active_passive extends Controller
{
 
    public function index(Request $request)
    {
      
       $site_asset_passive=asset::whereRaw("upper(ta_asset_catagory)='".strtoupper('Passive')."'")->where('ta_asset_parent_id',0)->where('ta_asset_location_id',$request->asset_site)->where('is_shown','t')->get();

       $tech_asset_details=asset::whereRaw("upper(ta_asset_catagory)='".strtoupper('Active')."'")->where('ta_asset_parent_id',0)->where('ta_asset_location_id',$request->asset_site)->where('is_shown','t')->get();

       $ChildData = new CommonClass();
       
           $i=0;
           $j=0;
       foreach($site_asset_passive as $assets){
        if(($assets->childs)!=null){
          $ChildData->assetdataPassivechild="";
          
          $ChildData->childs_html($assets->childs,$assets->ta_asset_id,$assets->AssetType);    
          $site_asset_passive[$i]->child_HTML_Passive= $ChildData->assetdataPassivechild;
         
         
        }
        $i++;
      }
      foreach( $tech_asset_details as $assets){
        if(($assets->childs)!=null){
        
          $ChildData->assetdataActivechild="";
          $ChildData->childs_html($assets->childs,$assets->ta_asset_id,$assets->AssetType);    
        
          $tech_asset_details[$j]->child_HTML_Active= $ChildData->assetdataActivechild;
         
        }
        $j++;
      }

       $tech_asset_heading = Location::select('*')->where('tl_location_id',$request->asset_site)->first();
        return response()->json([
        'status'=>'success',
        'tech_asset_details'=>$tech_asset_details,
         //'site_asset_active'=>$site_asset_active,
        'site_asset_passive'=>$site_asset_passive,
        'tech_asset_heading'=>$tech_asset_heading
        
        
      ]);
    }

    
}
