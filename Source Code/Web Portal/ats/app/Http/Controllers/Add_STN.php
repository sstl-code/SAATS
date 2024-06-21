<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Add_STN extends Controller
{
    public function add_STN(Request $request){
        $user_task_id=$request->user_task_id;
    // $user_task_id = $user_task_id[0]->user_task_id;
    $tl_location_id = DB::table('ats.t_location')
   
        ->join('ats.t_user_task', 'ats.t_location.tl_location_id', '=', 'ats.t_user_task.ut_location_id')
        ->where('tl_effective_end_date',NULL)
        ->where('ut_user_task_completion_date',NULL)
        ->where('ut_effective_end_date',NULL)
        ->where('ut_user_task_code','STN')
        ->where('ut_user_task_id',$user_task_id)
        ->first(['tl_location_id']);
        $tl_location_id = $tl_location_id->tl_location_id;
        //dd($tl_location_id);


    $tl_location_name = DB::table('ats.t_location')
   
        ->join('ats.t_user_task', 'ats.t_location.tl_location_id', '=', 'ats.t_user_task.ut_location_id')
        ->where('tl_effective_end_date',NULL)
        ->where('ut_user_task_completion_date',NULL)
        ->where('ut_effective_end_date',NULL)
        ->where('ut_user_task_code','STN')
        ->where('ut_user_task_id',$user_task_id)
        ->first(['tl_location_name']);
        $tl_location_name = $tl_location_name->tl_location_name;
        //dd($tl_location_name);

    $ut_task_number = DB::table('ats.t_user_task')
    // dd($ut_task_number);
   
        // ->join('ats.t_user_task', 'ats.t_location.tl_location_id', '=', 'ats.t_user_task.ut_location_id')
        ->where('ut_user_task_completion_date',NULL)
        ->where('ut_effective_end_date',NULL)
        ->where('ut_user_task_code','STN')
        ->where('ut_user_task_id',$user_task_id)
        ->first(['ut_task_number']);
        $ut_task_number = $ut_task_number->ut_task_number;
        //dd($ut_task_number);

    $tl_location_address=DB::table('ats.t_location')
       ->join('ats.t_user_task','t_location.tl_location_id','=','t_user_task.ut_location_id')
       ->where('tl_effective_end_date',NULL)
       ->where('ut_user_task_completion_date',NULL)
       ->where('ut_effective_end_date',NULL)
       ->where('ut_user_task_code','STN')
       ->where('ut_user_task_id',$user_task_id)
       ->first(['tl_location_address']);
       $tl_location_address = $tl_location_address->tl_location_address;
       //dd($tl_location_address);

    $ta_asset_type_code=DB::table('ats.t_asset')
       ->join('ats.t_user_task','t_asset.ta_asset_id','=','t_user_task.ut_asset_id')
       ->where('ut_user_task_completion_date',NULL)
       ->where('ut_effective_end_date',NULL)
       ->where('ta_effective_end_date',NULL)
       ->where('ut_user_task_id',$user_task_id)
       ->first(['ta_asset_type_code']);
       $ta_asset_type_code = $ta_asset_type_code->ta_asset_type_code;
       //dd($ta_asset_type_code);

    $ta_asset_name=DB::table('ats.t_asset')
       ->join('ats.t_user_task','t_asset.ta_asset_id','=','t_user_task.ut_asset_id')
       ->where('ut_user_task_completion_date',NULL)
       ->where('ut_effective_end_date',NULL)
       ->where('ta_effective_end_date',NULL)
       ->where('ut_user_task_id',$user_task_id)
       ->first(['ta_asset_name']);
       $ta_asset_name = $ta_asset_name->ta_asset_name;
       

    $ta_asset_manufacture_serial_no=DB::table('ats.t_asset')
       ->join('ats.t_user_task','t_asset.ta_asset_id','=','t_user_task.ut_asset_id')
       ->where('ut_user_task_completion_date',NULL)
       ->where('ut_effective_end_date',NULL)
       ->where('ta_effective_end_date',NULL)
       ->where('ut_user_task_id',$user_task_id)
       ->first(['ta_asset_manufacture_serial_no']);
       $ta_asset_manufacture_serial_no = $ta_asset_manufacture_serial_no->ta_asset_manufacture_serial_no; 
       //dd($ta_asset_manufacture_serial_no); 

    $ta_asset_status=DB::table('ats.t_asset')
       ->join('ats.t_user_task','t_asset.ta_asset_id','=','t_user_task.ut_asset_id')
       ->where('ut_user_task_completion_date',NULL)
       ->where('ut_effective_end_date',NULL)
       ->where('ta_effective_end_date',NULL)
       ->where('ut_user_task_id',$user_task_id)
       ->first(['ta_asset_status']);
       $ta_asset_status = $ta_asset_status->ta_asset_status; 
       //dd($ta_asset_status);  

    $ta_asset_id=DB::table('ats.t_asset')
       ->join('ats.t_user_task','t_asset.ta_asset_id','=','t_user_task.ut_asset_id')
       ->where('ut_user_task_completion_date',NULL)
       ->where('ut_effective_end_date',NULL)
       ->where('ta_effective_end_date',NULL)
       ->where('ut_user_task_id',$user_task_id)
       ->first(['ta_asset_id']);
       $ta_asset_id = $ta_asset_id->ta_asset_id; 
       //dd($ta_asset_id);  

    $ta_asset_tag_number=DB::table('ats.t_asset')
       ->join('ats.t_user_task','t_asset.ta_asset_id','=','t_user_task.ut_asset_id')
       ->where('ut_user_task_completion_date',NULL)
       ->where('ut_effective_end_date',NULL)
       ->where('ta_effective_end_date',NULL)
       ->where('ut_user_task_id',$user_task_id)
       ->first(['ta_asset_tag_number']);
       $ta_asset_tag_number = $ta_asset_tag_number->ta_asset_tag_number; 
       //dd($ta_asset_tag_number); 

    $ut_user_task_id=DB::table('ats.t_user_task')
          ->where('ut_user_task_completion_date',NULL)
          ->where('ut_effective_end_date',NULL)
          ->where('ut_user_task_code','STN')
          ->where('ut_user_task_id',$user_task_id)
          ->first(['ut_user_task_id']);
          $ut_user_task_id = $ut_user_task_id->ut_user_task_id;
          //dd($ut_user_task_id);

    $tu_user_name=DB::table('usr.t_user')
          ->join('ats.t_user_task','t_user_task.ut_user_id','=','t_user.tu_user_id')
          ->where('tu_effective_end_date',NULL)
          ->where('ut_user_task_completion_date',NULL)
          ->where('ut_effective_end_date',NULL)
          ->where('ut_user_task_id',$user_task_id)
          ->first(['tu_user_name']);
          $tu_user_name = $tu_user_name->tu_user_name;
          //dd($tu_user_name);

          $stn_details = DB::table('ats.t_stn')
                ->insert(
                [
                    'stn_loaction_id'=>$tl_location_id,
                    'stn_location_name'=>$tl_location_name,
                    'stn_file_name'=>$ut_task_number,
                    'stn_location_address'=>$tl_location_address,
                    'stn_asset_type_code'=>$ta_asset_type_code,
                    'stn_asset_name'=>$ta_asset_name,
                    'stn_asset_manufacture_serial_no'=>$ta_asset_manufacture_serial_no,
                    'stn_asset_status'=>$ta_asset_status,
                    'stn_asset_id'=>$ta_asset_id,
                    'stn_asset_tag_number'=>$ta_asset_tag_number,
                    'stn_remarks'=>$request->stn_remarks,
                    'stn_task_id'=>$ut_user_task_id,
                    'stn_creation_date'=>now(),
                    'stn_created_by'=>$tu_user_name,
                    'stn_effective_start_date'=>now(),
                    'stn_last_updated_date'=>now(),
                    'stn_last_updated_by'=>$tu_user_name,
                    'stn_effective_end_date'=>Null
                ],
               
            );
            return response()->json([
                "status" => 200,
                
                "message" => 'STN details added successfully',

            ]);
    }


    public function update_stn(Request $request)
    {
         $asset_id=$request->asset_id;
         $user_name = $request->user_name;
         $stn_remarks = $request->remarks;
         $tag_number = $request->tag_number;
         $asset_name = $request->asset_name;
        
         //dd($asset_name);
         //$tag_image = $request->tag_image;

         $time = now();
         
         $stn_data=DB::table('ats.t_asset')->where('ta_asset_id',$asset_id)->first();
         //dd($stn_data);
         if($asset_name!=null){
            $ta_asset_name = $asset_name;
         }else{
            $ta_asset_name = $stn_data->ta_asset_name;
         }
         $stn_location=DB::table('ats.t_stn')->select('stn_loaction_id')->where('stn_asset_id',$asset_id)->where('stn_effective_end_date',null)->first();
         $stn_loaction_id = $stn_location->stn_loaction_id;

        $file = $request->file('tag_image');

     if(isset($file)==true){

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
         $update = DB::table('ats.t_asset')
         ->where('ta_asset_id',$asset_id)
         ->where('ta_effective_end_date',NULL)
         ->update([
            'ta_asset_name' => $ta_asset_name,
            'ta_asset_tag_number' =>   $tag_number,
            'ta_asset_location_id' => $stn_loaction_id,
            'ta_creation_date' => now(),
            'ta_created_by' =>$user_name,
            'ta_last_updated_date' =>  now(),
            'ta_last_updated_by' =>$user_name,
            'ta_asset_last_tag_scan_date' => now(),
            'ta_asset_image' => $tagimagefinal,  
         ]);

      }else{

         $update = DB::table('ats.t_asset')
         ->where('ta_asset_id',$asset_id)
         ->where('ta_effective_end_date',NULL)
         ->update([
            'ta_asset_name' => $ta_asset_name,
            'ta_asset_tag_number' =>   $tag_number,
            'ta_asset_location_id' => $stn_loaction_id,
            'ta_creation_date' => now(),
            'ta_created_by' =>$user_name,
            'ta_last_updated_date' =>  now(),
            'ta_last_updated_by' =>$user_name,
            'ta_asset_last_tag_scan_date' => now(),
         ]);
      
      }

         $update2 = DB::table('ats.t_stn')
           ->where('stn_asset_id',$asset_id)
           ->where('stn_effective_end_date',NULL)
           ->update([
           'stn_effective_end_date' => $time,
           'stn_approve_reject' => 'APPROVED',
           'stn_approve_reject_date' => $time,
           'stn_remarks'=>$stn_remarks,
           ]);

           return response()->json([
             "status" => 200,
             "message" => 'STN details updated successfully',

         ]);

 
    }
    
}
