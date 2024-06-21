<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class Single_asset_detail extends Controller
{
    public function single_asset_detail(Request $request)
    { 
        // /dd('hi');
      $asset_id = $request->asset_id;
      //dd($asset_id);
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
      ->select('tl_location_code')
      ->where('tl_location_id',$location_id)
      ->first();
      //$parent_asset_name=$parent_asset_name->ta_asset_name;
      //dd($location_name);


      $asset_image=DB::table('ats.t_asset')
      ->select('ta_asset_image')
      ->where('ta_asset_id',$asset_id)
      ->first();
      $asset_image = $asset_image->ta_asset_image;
      //dd($asset_image);

      
     
    $asset_type_id=$details==null?null:$details->ta_asset_type_master_id;
     
      
    //dynamic_attribute_name
    $asset_static_dynamic_attribute_name = DB::table('product.t_asset_type_attribute_master')
        ->where('ata_asset_type_id',$asset_type_id)
		->Where('ata_display','YES')
        ->orWhere('ata_asset_type_attribute_mandatory_flag','REQUIRED')
        ->get();
    //dd($asset_static_dynamic_attribute_name);

    $asset_static_dynamic_attribute_value = DB::table('ats.t_asset_attribute')
        ->where('at_asset_id',$asset_id)
        ->Where('at_effective_end_date',null)
        ->get();   
        
    //dd($asset_static_dynamic_attribute_value);   
       
      $asst_child_details=DB::table('ats.v_asset_child_parent_tag_status')
      ->distinct()
         ->where('parent_asset_id',$asset_id)
         ->get(['child_asset_id as ta_asset_id','child_asset_name as ta_asset_name','child_manufacture_serial_no as ta_asset_manufacture_serial_no','tag_status']);
         //dd($asst_child_details);
         $asst_child_details_arr = $asst_child_details->toArray();
         //dd($asst_child_details_arr);
         if(!empty($asst_child_details_arr)){
            $asst_child_details_arr = $asst_child_details_arr[0]->ta_asset_id;
            //dd($asst_child_details_arr);
            if($asst_child_details_arr==null){
               $asst_child_details=[];
            }
         }
         
         return response()->json([
            "status"=>200,
            "static"=>$details,
            'site_code'=>$location_name==null?null:$location_name->tl_location_code,
            'parent_asset_name'=>$parent_asset_name==null?null:$parent_asset_name->ta_asset_name,
            'ta_asset_image'=>$asset_image,
            "attribute_name"=>$asset_static_dynamic_attribute_name,
            "attribute_value"=>$asset_static_dynamic_attribute_value,
            "child_asset"=>$asst_child_details
        ]);
     
    } 


    public function update(Request $request)
    {

        //dd($request);
        $fields = json_decode($request->fields);
        //dd($fields);
        $asst_id =$fields->assetId;
        $updatedBy =$fields->updatedBy;
        //dd($updatedBy);  
        $static_attribute = $fields->static_attribute;
       
        //dd($static_attribute);
        $at_asset_type_id = DB::table('ats.t_asset')
        //->select('ta_asset_id')
        ->where('ta_asset_id',$asst_id)
        ->where('ta_effective_end_date', null)
        ->first();
        //$asset_id = $static_attribute->assetId;
        $ta_asset_type_code = $at_asset_type_id->ta_asset_type_code;
        $at_asset_type_id = DB::table('product.t_asset_type_master')->where('at_asset_type_code',$ta_asset_type_code)->first(['at_asset_type_id']); 
        $at_asset_type_id = $at_asset_type_id->at_asset_type_id;
        //dd($at_asset_type_id->at_asset_type_id);
        $ta_last_updated_date=now(); 
        //dd($static_attribute->asset_description);
        
                    //29.07.23 note
        //dd($asst_id);
       
        if (!empty($static_attribute->asset_description) || !empty($static_attribute->ta_asset_active_inactive_status))
        {
            $details=DB::table('ats.t_asset')
            ->where('ta_asset_id',$asst_id)
            ->where('ta_effective_end_date',NULL)
            ->update([
            'ta_asset_description' => $static_attribute->asset_description,
            'ta_asset_active_inactive_status'=> $static_attribute->ta_asset_active_inactive_status,
            'ta_last_updated_date' =>  $ta_last_updated_date,
            'ta_last_updated_by' =>  $updatedBy, 
            ]);
        }
         //dd($details);
        $dynamic_attribute = $fields->dynamic_attribute;
        
        foreach ($dynamic_attribute as $item) {

            $key = $item->key;
            $value = $item->value;
            $valueType = $item->valueType;
            $attrcode = $item->attributeCode;
            $value = strlen($value)==0 || $value == "null" ? null : $value;

            if($valueType == 'INTEGER'){
                   
                $at_asset_attribute_value = 'at_asset_attribute_value_integer';
            } 
            else if($valueType == 'TIMESTAMP WITHOUT TIMEZONE'){
                //dd($value);
                $valuestr = strtotime($value);
                $value =  date("Y-m-d", $valuestr);
                //dd($valuestr);
                //$value = 
                $at_asset_attribute_value = 'at_asset_attribute_value_date_type';
            }else if($valueType == 'NUMERIC'){
                 $at_asset_attribute_value = 'at_asset_attribute_value_number';
            } else {
                $at_asset_attribute_value = 'at_asset_attribute_value_text';
            }

          
            $asset_attribute_exits = DB::table('ats.t_asset_attribute')
            ->where('at_asset_attribute_code',$attrcode)
            ->where('at_asset_id', $asst_id)
            //->where('ta_effective_end_date', null)
            ->first();
            //dd($asset_attribute_exits);
               
            if($asset_attribute_exits==null){
                //dd('hello');
                $insert = DB::table('ats.t_asset_attribute')
               ->insert(
                   [
                       'at_asset_id' => $asst_id,
                       'at_asset_attribute_description' =>$key,
                        $at_asset_attribute_value =>$value,
                       'at_asset_type_attribute_master_id' => $at_asset_type_id,
                       'at_asset_attribute_code' => $attrcode,
                       'at_creation_date' => now(),
                       'at_created_by' => 'Admin001',
                       'at_effective_start_date' => now(),
                       'at_last_updated_date' =>  now(),
                       'at_last_updated_by' => 'Admin',
                      
                    ],
                  
                   );

               }else{
            
                $update = DB::table('ats.t_asset_attribute')
                ->where('at_asset_id',$asst_id)
                ->where('at_asset_attribute_code',$attrcode)
                ->update(
                    [
                        $at_asset_attribute_value => $value,
                        'at_last_updated_date' =>  now(),
                        'at_last_updated_by' => 'Admin',
                       
                     ],
                   
                    );
                }
                

            
           
        }
        
       
    return response()->json([
        "status" => 200,
        "message" => 'Asset updated successfully'
    ]);
        
    }

    public function update_dynamic_attr(Request $request)
    {
       
        $assetId = $request->assetId;
        $updatedBy = $request->updatedBy;
        //dd($request->dynamic_attribute);
        foreach ($request->dynamic_attribute as $item) {
            
               
            $key = strtoupper($item['key']);
            $value = $item['value'];
            $value = strlen($value)==0 || $value == "null" ? null : $value;
            $valueType = $item['valueType'];
            $attrcode = $item['attributeCode'];

            if($valueType == 'INTEGER'){
                $at_asset_attribute_value = 'at_asset_attribute_value_integer';
            } 
            else if($valueType == 'TIMESTAMP WITHOUT TIMEZONE'){
                $valuestr = strtotime($value);
                $value =  date("Y-m-d", $valuestr);
                $at_asset_attribute_value = 'at_asset_attribute_value_date_type';
            }else if($valueType == 'NUMERIC'){
                $at_asset_attribute_value = 'at_asset_attribute_value_number';
            }else {
                $at_asset_attribute_value = 'at_asset_attribute_value_text';
            }
            
            // Process the key-value pair as needed
            //echo "Key: $key, Value: $value, ValueType: $valueType\n";
            //DB::enableQueryLog();

            $update = DB::table('ats.t_asset_attribute')
            ->where('at_asset_id',$assetId)
            ->where('at_asset_attribute_code',$attrcode)
            ->update(
                [
                    $at_asset_attribute_value => $value,
                    'at_last_updated_date' =>  now(),
                    'at_last_updated_by' => $updatedBy,
                   
                 ],
               
                );
//dd($update);
        }
        
    return response()->json([
        "status" => 200,
        "message" => 'Asset updated successfully'
    ]);
        
    }


    public function fetch_asset_by_serialno(Request $request)
    { 
      $serialno = $request->serialno;
      //dd($serialno);
      //asset_details
      $details=DB::table('ats.t_asset as ta')
      ->join('product.t_asset_type_master as atm', 'ta.ta_asset_type_code', '=', 'atm.at_asset_type_code')
      ->where('ta.ta_asset_manufacture_serial_no',$serialno)
      ->where('ta.ta_effective_end_date',null)
      ->where('atm.at_parent_asset_type_id',null)
      ->where('atm.at_effective_end_date',null)
      ->first();
      

      $parent_asset_id = $details==null?null:$details->ta_asset_parent_id;

      $parent_asset_name=DB::table('ats.t_asset')
      ->select('ta_asset_name')
      ->where('ta_asset_id',$parent_asset_id)
      ->first();

      $location_id = $details==null?null:$details->ta_asset_location_id;
      //dd($location_id);

      $location_name=DB::table('ats.t_location')
      ->select('tl_location_code')
      ->where('tl_location_id',$location_id)
      ->first();
      //$parent_asset_name=$parent_asset_name->ta_asset_name;
      //dd($location_name);

      $asset_image = $details==null?null:$details->ta_asset_image;
      //dd($asset_image);

      $asset_id = $details==null?null:$details->ta_asset_id;
      //dd($asset_id);
     
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
      

    // dd($asst_dynamc_att_value->toArray());

      $asst_child_details=DB::table('ats.v_asset_child_parent_tag_status')
      ->distinct()
         ->where('parent_asset_id',$asset_id)
         ->get(['child_asset_id as ta_asset_id','child_asset_name as ta_asset_name','child_manufacture_serial_no as ta_asset_manufacture_serial_no','tag_status']);
         //dd($asst_child_details);
        
         //$asst_child_details_arr = $asst_child_details_arr[0]->ta_asset_id;
         //dd($asst_child_details_arr);

         if(!empty($asst_child_details_arr)){
            $asst_child_details_arr = $asst_child_details_arr[0]->ta_asset_id;
            //dd($asst_child_details_arr);
            if($asst_child_details_arr==null){
               $asst_child_details=[];
            }
         }
           
         return response()->json([
            "status"=>200,
            "static"=>$details,
            'site_code'=>$location_name==null?null:$location_name->tl_location_code,
            'parent_asset_name'=>$parent_asset_name==null?null:$parent_asset_name->ta_asset_name,
            'ta_asset_image'=>$asset_image,
            "attribute_name"=>$asset_static_dynamic_attribute_name,
            "attribute_value"=>$asset_static_dynamic_attribute_value,
            "child_asset"=>$asst_child_details
    
        ]);
    
     
    } 

    public function fetch_asset_by_serialno_toverify(Request $request){
        
        $serialno = $request->serialno;
        $ta_asset_type_master_id = $request->ta_asset_type_master_id;

        $at_asset_type_code=DB::table('product.t_asset_type_master')->where('at_parent_asset_type_id',$ta_asset_type_master_id)->pluck('at_asset_type_code')->toArray();
        

        $details = DB::table('ats.t_asset')
        ->where('ta_asset_manufacture_serial_no',$serialno)
        ->whereIn('ta_asset_type_code', $at_asset_type_code)
        ->where('ta_asset_parent_id', null)
        ->where('ta_effective_end_date', null)
        ->first();

        //$Child_asset_id = $details->ta_asset_id;
        $Child_asset_id    = !empty($details->ta_asset_id) ? $details->ta_asset_id : " ";
        
        if(!empty($details)){
            
            $asset_id = $Child_asset_id;
            $details=DB::table('ats.t_asset')
            ->where('ta_asset_id',$asset_id)
            ->first();
        
            $parent_asset_id = $details==null?null:$details->ta_asset_parent_id;

            $parent_asset_name=DB::table('ats.t_asset')
            ->select('ta_asset_name')
            ->where('ta_asset_id',$parent_asset_id)
            ->first();

            $location_id = $details==null?null:$details->ta_asset_location_id;

            $location_name=DB::table('ats.t_location')
            ->select('tl_location_code')
            ->where('tl_location_id',$location_id)
            ->first();


            $asset_image=DB::table('ats.t_asset')
            ->select('ta_asset_image')
            ->where('ta_asset_id',$asset_id)
            ->first();
            $asset_image = $asset_image->ta_asset_image;

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
            
        //dd($asset_static_dynamic_attribute_value);   
        
            $asst_child_details=DB::table('ats.v_asset_child_parent_tag_status')
            ->distinct()
            ->where('parent_asset_id',$asset_id)
            ->get(['child_asset_id as ta_asset_id','child_asset_name as ta_asset_name','child_manufacture_serial_no as ta_asset_manufacture_serial_no','tag_status']);
            //dd($asst_child_details);
            $asst_child_details_arr = $asst_child_details->toArray();
            //dd($asst_child_details_arr);
            if(!empty($asst_child_details_arr)){
                $asst_child_details_arr = $asst_child_details_arr[0]->ta_asset_id;
                //dd($asst_child_details_arr);
                if($asst_child_details_arr==null){
                $asst_child_details=[];
                }
            }
            
            return response()->json([
                "status"=>200,
                "static"=>$details,
                'site_code'=>$location_name==null?null:$location_name->tl_location_code,
                'parent_asset_name'=>$parent_asset_name==null?null:$parent_asset_name->ta_asset_name,
                'ta_asset_image'=>$asset_image,
                "attribute_name"=>$asset_static_dynamic_attribute_name,
                "attribute_value"=>$asset_static_dynamic_attribute_value,
                "child_asset"=>$asst_child_details
            ]);

        }else{
            return response()->json([
                "status"=>404,
                "data"=> "Either This Might Not Be Child Of This Parent/ Data Not Found !",
            ]);
        }

    }






}

