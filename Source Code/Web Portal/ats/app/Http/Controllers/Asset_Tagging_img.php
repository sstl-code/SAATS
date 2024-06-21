<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Log;

class Asset_Tagging_img extends Controller
{
    public function uploadTagImage(Request $request){
        //dd('hello');
        
        $tagnumber=$request->get('tagnumber');
        //$tagimage = $request->file('tagimage');
        $file = $request->file('tagimage');
        //dd(isset($file));
        //Log::info($file);
    if(isset($file)==true){
        //dd('yes');

        $file_name = $file->getClientOriginalName();
        //dd(base_path());
        $file->move(base_path().'/assetimage/', $file_name);
        $tagimage = base_path().'/assetimage/'.$file_name;
        //dd($tagimage);
        $tagimagearray =(explode("/",$tagimage));
        //dd($tagimagearray);
        $app_url = env('APP_URL');
        $app_urlarray =(explode("/",$app_url));
        //dd($app_urlarray);
        $app_urlfinal = $app_urlarray[0]."/".$app_urlarray[1]."/".$app_urlarray[2]."/".$app_urlarray[3]; 
        //dd($app_urlfinal);
        $tagimagefinal = $app_urlfinal."/".$tagimagearray[5]."/".$tagimagearray[6]; 
        //dd($tagimagefinal);
        
        $asset_id=$request->get('asset_id');
        //dd($tagnumber);
        $ta_last_updated_date=now(); 
    
        $details=DB::table('ats.t_asset')
        ->where('ta_asset_id',$asset_id)
        ->where('ta_effective_end_date',NULL)
        ->update([
        'ta_asset_tag_number' => $tagnumber,
        'ta_asset_image' =>  $tagimagefinal,
        'ta_last_updated_by' => $request->user_name,
        'ta_last_updated_date' => $ta_last_updated_date,
        'ta_asset_last_tag_scan_date' => $ta_last_updated_date,
        
    ]);


    }else{
        //dd('no');
         
        $asset_id=$request->get('asset_id');
        //dd($tagnumber);
        $ta_last_updated_date=now(); 
        $details=DB::table('ats.t_asset')
        ->where('ta_asset_id',$asset_id)
        ->where('ta_effective_end_date',NULL)
        ->update([
        'ta_asset_tag_number' => $tagnumber,
        'ta_last_updated_by' => $request->user_name,
        'ta_last_updated_date' => $ta_last_updated_date,
        
         ]);
        

    }
        
        
        return response()->json([
            'status'=>'success',
            //'task_list'=>$user_task_list
           ]);
    }
}
