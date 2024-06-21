<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Models\asset;
use App\Traits\Observable;
use App\Models\SiteSettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    
    public function commondata(){

        $data['app_metadata']=SiteSettings::get(['setting_key','setting_value']);
    
        return response()->json([
            'status'=>200,
            'data'=>$data,
            'message'=>"Common Settings"
        ]);
        
    }
    public function auditTrail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'model_name' => 'required',
            'data_id' => 'required',
           
            'new_data' => 'required',
            'user_id'=>'required',
            'source'=>'required'
        ]);
        if ($validator->fails())
        {
            return response()->json([ 'status' => 'Failed', 'errors'=>$validator->errors()->first()], 422);
        }
        Observable::storeLog($request->event_name, $request->model_name,'UPDATED',$request->data_id,$request->old_data,$request->new_data, $request->user_id,$request->source);  
       return response()->json([
            'status'=>200,
            'message'=>"Data Added"
        ]);
    }
    public function fetch_asset_by_barcode(Request $request)
    { 
      
        $validator = Validator::make($request->all(), [
            'barcode' => 'required',
        ]);
        if ($validator->fails())
        {
            return response()->json([ 'status' => 404, 'errors'=>$validator->errors()->first()], 422);
        }

        $barcode = $request->barcode;

	     $assets_data=asset::select('*')->where('ta_asset_tag_number',$barcode)->first();
        
        if(!empty($assets_data)){
        $status=200;
        $msg="Asset Found";
        }
        else{
            $status=404;
            $msg="Asset Not found"; 
        }
     
		return response()->json([
            "status"=>$status,
            "data"=>$assets_data,
            "message"=>$msg
        ]);
        
    }
}
