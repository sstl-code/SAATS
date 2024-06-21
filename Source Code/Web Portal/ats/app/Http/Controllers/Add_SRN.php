<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Add_SRN extends Controller
{
     public function add_SRN(Request $request)
     {
    
    $user_task_id=$request->user_task_id;
    
    $tl_location_id = DB::table('ats.t_location')
   
        ->join('ats.t_user_task', 'ats.t_location.tl_location_id', '=', 'ats.t_user_task.ut_location_id')
        ->where('tl_effective_end_date',NULL)
        ->where('ut_user_task_completion_date',NULL)
        ->where('ut_effective_end_date',NULL)
        ->where('ut_user_task_code','SRN')
        ->where('ut_user_task_id',$user_task_id)
        ->first(['tl_location_id']);
        $tl_location_id = $tl_location_id->tl_location_id;
        //dd($tl_location_id);

      $tl_location_name=DB::table('ats.t_location')
        ->join('ats.t_user_task','t_location.tl_location_id','=','t_user_task.ut_location_id')
        ->where('tl_effective_end_date',NULL)
        ->where('ut_user_task_completion_date',NULL)
        ->where('ut_effective_end_date',NULL)
        ->where('ut_user_task_code','SRN')
        ->where('ut_user_task_id',$user_task_id)
        ->first(['tl_location_name']);
        $tl_location_name = $tl_location_name->tl_location_name;
        //dd($tl_location_name,$tl_location_id);

        $ut_task_number=DB::table('ats.t_user_task')
        ->where('ut_user_task_completion_date',NULL)
        ->where('ut_effective_end_date',NULL)
        ->where('ut_user_task_code','SRN')
        ->where('ut_user_task_id',$user_task_id)
        ->first(['ut_task_number']);
        $ut_task_number = $ut_task_number->ut_task_number;
        //dd($tl_location_name,$tl_location_id,$ut_task_number);

       
       $tl_location_address=DB::table('ats.t_location')
       ->join('ats.t_user_task','t_location.tl_location_id','=','t_user_task.ut_location_id')
       ->where('tl_effective_end_date',NULL)
       ->where('ut_user_task_completion_date',NULL)
       ->where('ut_effective_end_date',NULL)
       ->where('ut_user_task_code','SRN')
       ->where('ut_user_task_id',$user_task_id)
       ->first(['tl_location_address']);
       $tl_location_address = $tl_location_address->tl_location_address;
      //dd($tl_location_name,$tl_location_id,$ut_task_number,$tl_location_address);

    

        $ta_asset_type_code=DB::table('ats.t_asset')
           ->join('ats.t_user_task','t_asset.ta_asset_id','=','t_user_task.ut_asset_id')
           ->where('ut_user_task_completion_date',NULL)
           ->where('ut_effective_end_date',NULL)
           ->where('ta_effective_end_date',NULL)
           ->where('ut_user_task_id',$user_task_id)
           ->first(['ta_asset_type_code']);
           $ta_asset_type_code = $ta_asset_type_code->ta_asset_type_code;

            //dd($tl_location_name,$tl_location_id,$ut_task_number,$tl_location_address,$ta_asset_type_code);



                 $ta_asset_name=DB::table('ats.t_asset')
                 ->join('ats.t_user_task','t_asset.ta_asset_id','=','t_user_task.ut_asset_id')
                 ->where('ut_user_task_completion_date',NULL)
                 ->where('ut_effective_end_date',NULL)
                 ->where('ta_effective_end_date',NULL)
                 ->where('ut_user_task_id',$user_task_id)
                 ->first(['ta_asset_name']);
                 $ta_asset_name = $ta_asset_name->ta_asset_name;
                  //dd($tl_location_name,$tl_location_id,$ut_task_number,$tl_location_address,$ta_asset_type_code,$ta_asset_name);
               

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
          ->where('ut_user_task_code','SRN')
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
               
             
               $srn_details = DB::table('ats.t_srn')
                ->insert(
                [
                    'srn_loaction_id'=>$tl_location_id,
                    'srn_location_name'=>$tl_location_name,
                    'srn_file_name'=>$ut_task_number,
                    'srn_location_address'=>$tl_location_address,
                    'srn_asset_type_code'=>$ta_asset_type_code,
                    'srn_asset_name'=>$ta_asset_name,
                    'srn_asset_manufacture_serial_no'=>$ta_asset_manufacture_serial_no,
                    'srn_asset_status'=>$ta_asset_status,
                    'srn_asset_id'=>$ta_asset_id,
                    'srn_asset_tag_number'=>$ta_asset_tag_number,
                    'srn_remarks'=>$request->srn_remarks,
                    'srn_task_id'=>$ut_user_task_id,
                    'srn_creation_date'=>now(),
                    'srn_created_by'=>$tu_user_name,
                    'srn_effective_start_date'=>now(),
                    'srn_last_updated_date'=>now(),
                    'srn_last_updated_by'=>$tu_user_name,
                    'srn_effective_end_date'=>Null
                ],
               
            );
          //   return response()->json([
          //       "status" => 200,
                
          //       "message" => 'SRN details added successfully',

          //   ]);
   
     


       //update t_user_task last_updated_by and last_updated 
       //dd($ut_user_task_id);
        DB::table('ats.t_user_task')
        ->where('ut_user_task_id',$ut_user_task_id)
        //->where('tl_effective_end_date',NULL)
        ->update([
        'ut_last_updated_date' =>  now(),
        'tl_last_updated_by' => $tu_user_name,
        
         ]);

         return response()->json([
                "status" => 200,  
                "message" => 'SRN details added successfully',

            ]);
     }
     public function update_SRN(Request $request)
     {
          $asset_id=$request->asset_id;
          $user_name = $request->user_name;
          $srn_remarks = $request->remarks;
          $time = now();
          //dd($remarks);
          $update = DB::table('ats.t_asset')
          ->where('ta_asset_id',$asset_id)
          ->where('ta_effective_end_date',NULL)
          ->update([
          'ta_asset_location_id' => null,
          'ta_asset_parent_id' => null,
          'ta_last_updated_date' =>  now(),
          'ta_last_updated_by' =>$user_name,
          ]);
          //dd( $update);
          
          // $srn_data=DB::table('ats.t_asset')->where('ta_asset_id',$asset_id)->first();
          // //dd($srn_data);
          // $inserrt_ats = DB::table('ats.t_asset')
          //   ->insert(
          //       [
          //           'ta_asset_type_master_id' =>  $srn_data->ta_asset_type_master_id,
          //           'ta_asset_type_code' => $srn_data->ta_asset_type_code,
          //           'ta_asset_manufacture_serial_no' =>$srn_data->ta_asset_manufacture_serial_no,
          //           'ta_asset_name' =>  $srn_data->ta_asset_name,
          //           'ta_asset_description' =>  $srn_data->ta_asset_description,
          //           'ta_asset_tag_number' =>  $srn_data->ta_asset_tag_number,
          //           'ta_asset_parent_id' =>   $srn_data->ta_asset_parent_id,
          //           'ta_asset_location_id' =>null,
          //           'ta_asset_status' =>strtoupper($srn_data->ta_asset_status),
          //           'ta_creation_date' => now(),
          //           'ta_created_by' =>$user_name,
          //           'ta_effective_start_date' =>  now(),
          //           'ta_last_updated_date' =>  now(),
          //           'ta_last_updated_by' =>$user_name,
          //           'ta_effective_end_date' => Null,
          //           'ta_asset_last_tag_scan_date' => now(),
          //           'ta_asset_reason' => $srn_data->ta_asset_reason,
          //           'ta_asset_image' => $srn_data->ta_asset_image,
          //        ],
               
          //   );
            //dd($inserrt_ats);
            $update2 = DB::table('ats.t_srn')
            ->where('srn_asset_id',$asset_id)
            ->where('srn_effective_end_date',NULL)
            ->update([
            'srn_effective_end_date' => $time,
            'srn_approve_reject' => 'APPROVED',
            'srn_approve_reject_date' => $time,
            'srn_remarks'=>$srn_remarks,
            ]);

            return response()->json([
              "status" => 200,    
              "message" => 'SRN details updated successfully',

          ]);

  
     }
   public function get_srn(Request $request)
    { 
      $asset_id = $request->asset_id;
      //dd($asset_id);
      //asset_details
      $details=DB::table('ats.t_asset')
      ->where('ta_asset_id',$asset_id)
      ->first();
      //dd($details);
      //dd(!empty($details));
      $parent_assetname=DB::table('ats.t_asset')
      ->select('ta_asset_name')
      ->where('ta_asset_id',$details->ta_asset_parent_id)
      ->first();
      //dd($parent_assetname);
      $location_id = $details==null?null:$details->ta_asset_location_id;
      //dd($location_id);

      $location_name=DB::table('ats.t_location')
      ->select('tl_location_code', 'tl_location_address','tl_location_name')
      ->where('tl_location_id',$location_id)
      ->first();
     
      
     $asset_type_id=$details==null?null:$details->ta_asset_type_master_id;
     
      
    //dynamic_attribute_name
    $asset_static_dynamic_attribute_name = DB::table('product.t_asset_type_attribute_master')
        ->where('ata_asset_type_id',$asset_type_id)
        ->orWhere('ata_asset_type_attribute_mandatory_flag','REQUIRED')
        ->get();
    //dd($asset_static_dynamic_attribute_name);

    $asset_static_dynamic_attribute_value = DB::table('ats.t_asset_attribute')
        ->where('at_asset_id',$asset_id)
        ->Where('at_effective_end_date',null)
        ->get(); 
      //dd($asst_dynamc_att_value);

      //asset_childs_names

      $asst_child_details=DB::table('ats.v_asset_child_parent_tag_status')
      ->distinct()
         ->where('parent_asset_id',$asset_id)
         ->get(['child_asset_id as ta_asset_id','child_asset_name as ta_asset_name','child_manufacture_serial_no as ta_asset_manufacture_serial_no','tag_status']);
         //dd( $asst_child_details);
           
        if(!empty($asst_child_details->toArray()))
         {


         return response()->json([
            "status"=>200,
            "static"=>$details,
            "parent_asset_name"=>$parent_assetname== NULL ? NULL : $parent_assetname->ta_asset_name,
            'site_code'=>$location_name==null?null:$location_name,
            "attribute_name"=>$asset_static_dynamic_attribute_name,
            "attribute_value"=>$asset_static_dynamic_attribute_value,
            "child_asset"=>$asst_child_details
    
        ]);
    }
    else{
        return response()->json([
            "status"=>200,
            "static"=>$details,
            "parent_asset_name"=>$parent_assetname== NULL ? NULL : $parent_assetname->ta_asset_name,
            "attribute_name"=>$asset_static_dynamic_attribute_name,
            "attribute_value"=>$asset_static_dynamic_attribute_value,
            //"child_asset"=>$asst_child_details
            "Message"=>'No child data found',
            
    
        ]);

    }
     
    } 
   
}
