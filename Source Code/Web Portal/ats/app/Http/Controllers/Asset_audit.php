<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Asset_audit extends Controller
{
    public function audit_list(request $request){
        // $asst_dynamc_att_value= DB::table('ats.v_asset_audit')
        //                             ->select('ta_asset_id', 'tl_location_name', 'tl_location_code', 'tl_location_id', 'ta_asset_name','ta_asset_manufacture_serial_no', 'ta_asset_tag_number', 'ta_asset_active_inactive_status', 'child', 'tag_status', 'ta_asset_status')
        //                             ->distinct()
        //                             ->where('tl_location_code',$request->location_code)
        //                             ->where('ta_asset_parent_id', null)
        //                             ->where('ta_asset_status', 'PASSIVE')
        //                             ->get();
                                    // return response()->json([
                                    //     "status" => 200,
                                    //     'message'=>'Ok',
                                    //     "data" => $asst_dynamc_att_value
                                    // ]); 
                                    $asst_dynamc_att_value= DB::table('ats.v_asset_child_parent_tag_status')
                                     ->select('parent_asset_id as ta_asset_id', 'location_name as tl_location_name', 'tl_location_code', 'location_id as tl_location_id', 'parent_asset_name as ta_asset_name','ta_asset_manufacture_serial_no','parent_tag as ta_asset_tag_number', 'ta_asset_active_inactive_status', 'child', 'tag_status', 'ta_asset_status')
                                    ->distinct()
                                    ->where('tl_location_code',$request->location_code)
                                    ->where('ta_asset_parent_id', null)
                                    ->where('ta_asset_status', 'PASSIVE')
                                    ->get();
                                    //dd($asst_dynamc_att_value);
                                    return response()->json([
                                        "status" => 200,
                                        'message'=>'Ok',
                                        "data" => $asst_dynamc_att_value
                                    ]); 
    }

    public function audit_list_child(request $request){
        $asst_dynamc_att_value= DB::table('ats.v_asset_audit')
                                    ->select('ta_asset_id', 'tl_location_name', 'tl_location_code', 'tl_location_id', 'ta_asset_name','ta_asset_manufacture_serial_no', 'ta_asset_tag_number', 'ta_asset_active_inactive_status', 'child', 'tag_status')
                                    ->distinct()
                                    ->where('ta_asset_parent_id', $request->id)
                                    ->get();
                                    return response()->json([
                                        "status" => 200,
                                        'message'=>'Ok',
                                        "data" => $asst_dynamc_att_value
                                    ]); 
    }

    public function details_view_audit(request $request){
        
      $asset_id = $request->asset_id;
      //asset_details
      $details=DB::table('ats.t_asset')
      //->select('ta_asset_manufacture_serial_no','ta_asset_tag_number','parent_asset_name','tl_location_code','ta_asset_status','ta_asset_description','ta_asset_type_master_id','ta_asset_image')
      ->where('ta_asset_id',$asset_id)
      ->first();
    //dd($details);
      $parent_asset_id = $details==null?null:$details->ta_asset_parent_id;

      $parent_asset_name=DB::table('ats.t_asset')
      ->select('ta_asset_name')
      ->where('ta_asset_id',$parent_asset_id)
      ->first();

      $location_id = $details==null?null:$details->ta_asset_location_id;
      //dd($location_id);

      $location_name=DB::table('ats.t_location')
      ->select('tl_location_code', 'tl_location_address','tl_location_name')
      ->where('tl_location_id',$location_id)
      ->first();
      
     //dd($location_name);
     $asset_type_id=$details==null?null:$details->ta_asset_type_master_id;
     //dd($asset_type_id);
     $asset_type_name = DB::table('product.t_asset_type_master')
     ->select('at_asset_type_name')
     ->where('at_asset_type_id',$asset_type_id)
     ->first();
      //dd($asset_type_name);
    //dynamic_attribute_name

    $asset_type_id=$details==null?null:$details->ta_asset_type_master_id;

    $asset_static_dynamic_attribute_name = DB::table('product.t_asset_type_attribute_master')
        ->where('ata_asset_type_id',$asset_type_id)
        ->orWhere('ata_asset_type_attribute_mandatory_flag','REQUIRED')
        ->get();
    //dd($asset_static_dynamic_attribute_name);

    $asset_static_dynamic_attribute_value = DB::table('ats.t_asset_attribute')
        ->where('at_asset_id',$asset_id)
        ->Where('at_effective_end_date',null)
        ->get(); 
     
      
      return response()->json([
        "status"=>200,
        "static"=>$details,
        'asset_type_name'=>$asset_type_name==null?null:$asset_type_name->at_asset_type_name,
        'site_code'=>$location_name==null?null:$location_name,
        'parent_asset_name'=>$parent_asset_name==null?null:$parent_asset_name->ta_asset_name,
         "attribute_name"=>$asset_static_dynamic_attribute_name,
        "attribute_value"=>$asset_static_dynamic_attribute_value,

    ]);

        
    }
    public function store(request $request){
        
        //dd($request->location_code);
        $asset_audit_data= DB::table('ats.v_asset_child_parent_tag_status')
        ->select('parent_asset_id as ta_asset_id', 'location_name as tl_location_name', 'tl_location_code', 'location_id as tl_location_id', 'parent_asset_name as ta_asset_name','ta_asset_manufacture_serial_no','parent_tag as ta_asset_tag_number', 'ta_asset_active_inactive_status', 'child', 'tag_status', 'ta_asset_status')
       ->distinct()
       ->where('tl_location_code',$request->location_code)
       ->where('ta_asset_parent_id', null)
       ->where('ta_asset_status', 'PASSIVE')
       ->get();
        //dd($asset_audit_data);
    
        foreach($asset_audit_data as $audit_data){
            
            $aa_asset_id = $audit_data->ta_asset_id;
          
            $created_date = DB::table('ats.t_asset')
            ->select('ta_creation_date')
            ->where('ta_asset_id',$audit_data->ta_asset_id)
            ->where('ta_effective_end_date', null)
            ->first();
            $created_date = $created_date->ta_creation_date;

            $aa_created_by = DB::table('ats.t_asset')
            ->select('ta_created_by')
            ->where('ta_asset_id',$audit_data->ta_asset_id)
            ->where('ta_effective_end_date', null)
            ->first();
            $aa_created_by = $aa_created_by->ta_created_by;
            
            $aa_effective_start_date = DB::table('ats.t_asset')
            ->select('ta_effective_start_date')
            ->where('ta_asset_id',$audit_data->ta_asset_id)
            ->where('ta_effective_end_date', null)
            ->first();
            $aa_effective_start_date = $aa_effective_start_date->ta_effective_start_date;
            
            
            $aa_technician_name = DB::table('ats.t_asset')
            ->select('ta_last_updated_by')
            ->where('ta_asset_id',$audit_data->ta_asset_id)
            ->where('ta_effective_end_date', null)
            ->first();
             $aa_technician_name = $aa_technician_name->ta_last_updated_by;
            

            $aa_technician_id = DB::table('usr.t_user')
            ->select('tu_user_id')
            ->where('tu_user_name','Admin01')
            ->first();
            $aa_technician_id = $aa_technician_id->tu_user_id;


            

            $aa_last_updated_date = DB::table('ats.t_asset')
            ->select('ta_last_updated_date')
            ->where('ta_asset_id',$audit_data->ta_asset_id)
            ->where('ta_effective_end_date', null)
            ->first();
            $aa_last_updated_date = $aa_last_updated_date->ta_last_updated_date;


             $aa_last_updated_by = DB::table('ats.t_asset')
             ->select('ta_last_updated_by')
             ->where('ta_asset_id',$audit_data->ta_asset_id)
             ->where('ta_effective_end_date', null)
             ->first();
              $aa_last_updated_by = $aa_last_updated_by->ta_last_updated_by;
              
              $aa_task_id = rand();
              //echo $audit_data->tl_location_id."--";
 
            DB::table('ats.t_asset_audit')
            ->insert(
                [
                    'aa_location_id' => $audit_data->tl_location_id,
                    'aa_loacation_name' =>$audit_data->tl_location_name,
                    'aa_location_address' =>$audit_data->tl_location_name,
                    'aa_task_id' => $aa_task_id,
                    'aa_created_date' => $created_date,
                    'aa_created_by' =>$aa_created_by,
                    'aa_effective_start_date' =>  $aa_effective_start_date,
                    'aa_technician_id' =>$aa_technician_id,
                    'aa_last_updated_date' => $aa_last_updated_date,
                    'aa_last_updated_by' => $aa_last_updated_by,
                    'aa_effective_end_date' => NULL,
                    'aa_asset_id' =>$aa_asset_id,
                    'aa_approve_reject' =>  NULL,
                    'aa_approve_reject_remarks' => NULL,
                    'aa_approved_rejected_by' => NULL,
                ],
            
            );


            $ad_audit_id = DB::table('ats.t_asset_audit')
            ->select('aa_audit_id')
            ->where('aa_asset_id',$audit_data->ta_asset_id)
            ->where('aa_effective_end_date', null)
            ->first();
            $ad_audit_id = $ad_audit_id->aa_audit_id;

           
            $at_asset_type_code = DB::table('ats.t_asset')
            ->select('ta_asset_type_code')
            ->where('ta_asset_id',$audit_data->ta_asset_id)
            ->where('ta_effective_end_date', null)
            ->first();
            $at_asset_type_code = $at_asset_type_code->ta_asset_type_code;
           
            $ad_asset_type = DB::table('product.t_asset_type_master')
            ->select('at_asset_type_name')
            ->where('at_asset_type_code',$at_asset_type_code)
            ->where('at_effective_end_date', null)
            ->first();
            $ad_asset_type = $ad_asset_type->at_asset_type_name;


            $ad_asset_name = DB::table('ats.t_asset')
            ->select('ta_asset_name')
            ->where('ta_asset_id',$audit_data->ta_asset_id)
            ->where('ta_effective_end_date', null)
            ->first();
            $ad_asset_name = $ad_asset_name->ta_asset_name;

            $ad_asset_manufacture_serial_no = DB::table('ats.t_asset')
            ->select('ta_asset_manufacture_serial_no')
            ->where('ta_asset_id',$audit_data->ta_asset_id)
            ->where('ta_effective_end_date', null)
            ->first();
            $ad_asset_manufacture_serial_no = $ad_asset_manufacture_serial_no->ta_asset_manufacture_serial_no;

            $ad_asset_tag_number = DB::table('ats.t_asset')
            ->select('ta_asset_tag_number')
            ->where('ta_asset_id',$audit_data->ta_asset_id)
            ->where('ta_effective_end_date', null)
            ->first();
            $ad_asset_tag_number = $ad_asset_tag_number->ta_asset_tag_number;

            DB::table('ats.t_asset_audit_details')
            ->insert(
                [
                    'ad_audit_id' => $ad_audit_id,
                    'ad_asset_id' =>$aa_asset_id,
                    'ad_asset_type' =>$ad_asset_type,
                    'ad_asset_name' =>   $ad_asset_name,
                    'ad_asset_manufacture_serial_no' => $ad_asset_manufacture_serial_no,
                    'ad_technician_id' =>$aa_technician_id,
                    'ad_asset_tag_number' => $ad_asset_tag_number,
                    'ad_scan_date' =>now(),
                    'ad_status' => NULL,
                    'ad_remarks' => NULL,
                   
                 ],
               
            );
            
        }

        return response()->json([
            "status"=>200, 
            "message"=>"Asset Audit submitted successfully",
    
        ]);

       


    }
   
    
}
