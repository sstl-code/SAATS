<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Log;
use App\Models\asset;

class Add_asset extends Controller
{
    public function store(Request $request)
    {
        $fields = json_decode($request->fields);
        
        $static_attribute = $fields->static_attribute;
        
        $asset_type_name = strtoupper($static_attribute->asset_type_name);
      
        $at_asset_type_id = DB::table('product.t_asset_type_master')->where(DB::raw('upper(at_asset_type_name)'),$asset_type_name)->get(['at_asset_type_id']); 
       
        $at_asset_type_code = DB::table('product.t_asset_type_master')->where(DB::raw('upper(at_asset_type_name)'),$asset_type_name)->get(['at_asset_type_code']);
        $at_asset_type_description = DB::table('product.t_asset_type_master')->where(DB::raw('upper(at_asset_type_name)'),$asset_type_name)->get(['at_asset_type_description']);      
    
        $at_asset_type_id = $at_asset_type_id[0]->at_asset_type_id;
       
        $at_asset_type_code = $at_asset_type_code[0]->at_asset_type_code;
        $at_asset_type_description = $at_asset_type_description[0]->at_asset_type_description;
        $at_asset_type_attribute_code = DB::table('product.t_asset_type_attribute_master')->where('ata_asset_type_id',$at_asset_type_id)->first();
        $at_asset_type_attribute_code = $at_asset_type_attribute_code->ata_asset_type_attribute_code;
        
        $file = $request->file('asset_image');

      if(isset($file)==true){
        $file_name = $file->getClientOriginalName();
       
        $file->move(base_path().'/assetimage/', $file_name);
        $tagimage = base_path().'/assetimage/'.$file_name;
       
        $tagimagearray =(explode("/",$tagimage));
    
        $app_url = env('APP_URL');
        $app_urlarray =(explode("/",$app_url));

        $app_urlfinal =  $app_urlarray[0]."/".$app_urlarray[1]."/".$app_urlarray[2]."/".$app_urlarray[3]; 
     
        $tagimagefinal = $app_urlfinal."/".$tagimagearray[5]."/".$tagimagearray[6]; 
      
    }else{
        $tagimagefinal = null;

    }
        
        
  
        $asset_manufacture_serial_no_exists = DB::table('ats.t_asset')
  
        ->where('ta_asset_manufacture_serial_no',$static_attribute->asset_manufacture_serial_no)
         ->where('ta_effective_end_date', null)
        ->first();
        $asset_manufacture_serial_no = $asset_manufacture_serial_no_exists==null?null:$asset_manufacture_serial_no_exists->ta_asset_manufacture_serial_no;
        $ta_asset_location_id =  $asset_manufacture_serial_no_exists==null?null:$asset_manufacture_serial_no_exists->ta_asset_location_id;
   
        $asset_id = DB::table('ats.t_asset')
        ->select('ta_asset_id')
        ->where('ta_asset_manufacture_serial_no',$static_attribute->asset_manufacture_serial_no)
        ->where('ta_effective_end_date', null)
        ->first();
        $asset_id = $asset_id==null?null:$asset_id->ta_asset_id;
       
        
        if($asset_manufacture_serial_no==''){
            return response()->json([
                "status" => 422,
                "message" => 'Record not found. please check',
            ]);
                
        }
        if($ta_asset_location_id!=null){
            return response()->json([
                "status" => 422,
                "message" => 'This asset is already allocated to another site',
            ]);
                
        }
        

        if(($asset_manufacture_serial_no!='') && ($ta_asset_location_id==null)){

            //dd($asset_id);
            DB::beginTransaction();
            try {
            $update_asset = DB::table('ats.t_asset')
            ->where('ta_asset_id',$asset_id)
            ->where('ta_effective_end_date',NULL)
            ->update([
            'ta_asset_name' => $static_attribute->asset_name,
            'ta_asset_description' => $static_attribute->asset_description,
            'ta_asset_tag_number' => $static_attribute->asset_tag_number,
            'ta_asset_image'=>$tagimagefinal,
            'ta_asset_parent_id' => $static_attribute->asset_parent_id,
            'ta_asset_location_id' => $static_attribute->asset_location_id,
            'ta_asset_status' => $static_attribute->asset_status,
            'ta_asset_manufacture_serial_no' => $static_attribute->asset_manufacture_serial_no,
            'ta_asset_active_inactive_status'=> $static_attribute->ta_asset_active_inactive_status,
            'ta_asset_reason'=> $static_attribute->asset_reason,
            'ta_last_updated_date' =>  now(),
            'ta_last_updated_by' => "Admin",
            
            ]);
            //dd($update_asset);

               //$asset_id = DB::getPdo()->lastInsertId();
               //dd($asset_id);
               $dynamic_attribute = $fields->dynamic_attribute;
             //dd($dynamic_attribute);
   
               foreach ($dynamic_attribute as $item) {
                  
                   $key = $item->key;
                   $value = $item->value;
                   $valueType = $item->valueType;
                   $attr_code = $item->attributeCode;
                   $value = strlen($value)==0 || $value == "null" ? null : $value;
                if($valueType == 'INTEGER'){
                   
                    $at_asset_attribute_value = 'at_asset_attribute_value_integer';
                } 
                else if($valueType == 'TIMESTAMP WITHOUT TIMEZONE'){
                    $valuestr = strtotime($value);
                    $value =  date("Y-m-d", $valuestr);
                    $at_asset_attribute_value = 'at_asset_attribute_value_date_type';
                }else if($valueType == 'NUMERIC'){
                   $value = $at_asset_attribute_value = 'at_asset_attribute_value_number';
                } else {
                    $at_asset_attribute_value = 'at_asset_attribute_value_text';
                }
   
                   // Process the key-value pair as needed
                   //echo "Key: $key, Value: $value, ValueType: $valueType\n";
                   //DB::enableQueryLog();
                   //dd($at_asset_type_id);
                   $asset_attribute_exits = DB::table('ats.t_asset_attribute')
                   ->where('at_asset_attribute_code',$attr_code)
                   ->where('at_asset_id', $asset_id)
                   //->where('ta_effective_end_date', null)
                   ->first();
                   //dd($at_asset_type_attribute_code);
                   if($asset_attribute_exits==null){
                    //dd('hello');
                    $insert = DB::table('ats.t_asset_attribute')
                   ->insert(
                       [
                           'at_asset_id' => $asset_id,
                           'at_asset_attribute_description' =>$key,
                            $at_asset_attribute_value =>$value,
                           'at_asset_type_attribute_master_id' => $at_asset_type_id,
                           'at_asset_attribute_code' => $attr_code,
                           'at_creation_date' => now(),
                           'at_created_by' => 'Admin001',
                           'at_effective_start_date' => now(),
                           'at_last_updated_date' =>  now(),
                           'at_last_updated_by' => 'Admin',
                          
                        ],
                      
                       );

                   }else{
                    //dd('hello1');
                    $update = DB::table('ats.t_asset_attribute')
                    ->where('at_asset_id',$asset_id)
                    ->where('at_asset_attribute_description', $key)
                    ->update(
                        [
                            $at_asset_attribute_value => $value,
                            'at_last_updated_date' =>  now(),
                            'at_last_updated_by' => 'Admin',
                           
                         ],
                       
                        );

                   }
                   
                  //dd(DB::getQueryLog());
   
   
               }
               DB::commit();
               return response()->json([
                   "status" => 200,
                   "message" => 'Asset created successfully',
   
               ]);
           } catch (\Exception $e) { 
               DB::rollback();
               // something went wrong
               return response()->json([
                   
                   "message" => 'Something went wrong',
   
               ]);
           }
        }
    }

    public function addchild(Request $request)
    {
        //dd($request->fields);
        //Log::info($request);
        $fields = json_decode($request->fields);
        //dd($fields);
        $static_attribute = $fields->static_attribute;
        //dd($static_attribute);
        $asset_type_name = strtoupper($static_attribute->asset_type_name);
        //dd($asset_type_name);
        $at_asset_type_id = DB::table('product.t_asset_type_master')->where(DB::raw('upper(at_asset_type_name)'),$asset_type_name)->get(['at_asset_type_id']); 
        //dd($at_asset_type_id);
        $at_asset_type_code = DB::table('product.t_asset_type_master')->where(DB::raw('upper(at_asset_type_name)'),$asset_type_name)->get(['at_asset_type_code']);
        $at_asset_type_description = DB::table('product.t_asset_type_master')->where(DB::raw('upper(at_asset_type_name)'),$asset_type_name)->get(['at_asset_type_description']);      
    
        $at_asset_type_id = $at_asset_type_id[0]->at_asset_type_id;
        //dd($at_asset_type_id);
        $at_asset_type_code = $at_asset_type_code[0]->at_asset_type_code;
        $at_asset_type_description = $at_asset_type_description[0]->at_asset_type_description;
        $at_asset_type_attribute_code = DB::table('product.t_asset_type_attribute_master')->where('ata_asset_type_id',$at_asset_type_id)->first();
        //dd($at_asset_type_attribute_code);
        $at_asset_type_attribute_code = $at_asset_type_attribute_code->ata_asset_type_attribute_code;
        
        //dd($at_asset_type_id,$at_asset_type_code,$at_asset_type_description);
        //var_dump(json_decode(static_attribute));
        $file = $request->file('asset_image');

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
        //dd($static_attribute->asset_manufacture_serial_no);
    }else{
        $tagimagefinal = null;

    }
        
        $asset_manufacture_serial_no_exists = DB::table('ats.t_asset')
        //->select('ta_asset_manufacture_serial_no')
        ->where('ta_asset_manufacture_serial_no',$static_attribute->asset_manufacture_serial_no)
        ->where('ta_effective_end_date', null)
        ->first();
        //dd($asset_manufacture_serial_no_exists);
        $ta_asset_type_master_id = $asset_manufacture_serial_no_exists->ta_asset_type_master_id;
        //dd( $ta_asset_type_master_id);
        $ta_asset_type_code = $asset_manufacture_serial_no_exists->ta_asset_type_code;
        //dd($ta_asset_type_code);
        $at_asset_type_code=DB::table('product.t_asset_type_master')->where('at_parent_asset_type_id',$ta_asset_type_master_id)->pluck('at_asset_type_code')->toArray();
        //dd($at_asset_type_code);
        //$at_asset_type_id= $at_asset_type_id->toArray();
        //dd($at_asset_type_id);
        $asset_manufacture_serial_no = $asset_manufacture_serial_no_exists==null?null:$asset_manufacture_serial_no_exists->ta_asset_manufacture_serial_no;
        $ta_asset_location_id =  $asset_manufacture_serial_no_exists==null?null:$asset_manufacture_serial_no_exists->ta_asset_location_id;
        //dd($asset_manufacture_serial_no);

        $asset_id = DB::table('ats.t_asset')
        ->select('ta_asset_id')
        ->where('ta_asset_manufacture_serial_no',$static_attribute->asset_manufacture_serial_no)
        ->where('ta_effective_end_date', null)
        ->first();
        $asset_id = $asset_id==null?null:$asset_id->ta_asset_id;
        //dd($asset_id);

        $asset_type_code_exists = DB::table('ats.t_asset')
        ->whereIn('ta_asset_type_code',$at_asset_type_code)
        //->where('ta_effective_end_date', null)
        ->where('ta_asset_manufacture_serial_no',$static_attribute->asset_manufacture_serial_no)
        ->get();

        $asset_type_code_exists = $asset_type_code_exists->toArray();
        //dd($asset_type_code_exists);
    
       if(empty( $asset_type_code_exists)){
        return response()->json([
            "status" => 422,
            "message" => 'you can not add child in this asset',
        ]);

       }
       if($asset_manufacture_serial_no==''){
            return response()->json([
                "status" => 422,
                "message" => 'Record not found. please check',
            ]);
                
        }
        if($ta_asset_location_id!=null){
            return response()->json([
                "status" => 422,
                "message" => 'This asset is already allocated to another site',
            ]);
                
        }


        if(($asset_manufacture_serial_no!='') && ($ta_asset_location_id==null) &&(!empty( $asset_type_code_exists))){

            //dd($asset_id);
            DB::beginTransaction();
            try {
            $update_asset = DB::table('ats.t_asset')
            ->where('ta_asset_id',$asset_id)
            ->where('ta_effective_end_date',NULL)
            ->update([
            'ta_asset_name' => $static_attribute->asset_name,
            'ta_asset_description' => $static_attribute->asset_description,
            'ta_asset_tag_number' => $static_attribute->asset_tag_number,
            'ta_asset_image'=>$tagimagefinal,
            'ta_asset_parent_id' => $static_attribute->asset_parent_id,
            'ta_asset_location_id' => $static_attribute->asset_location_id,
            'ta_asset_status' => $static_attribute->asset_status,
            'ta_asset_manufacture_serial_no' => $static_attribute->asset_manufacture_serial_no,
            'ta_asset_active_inactive_status'=> $static_attribute->ta_asset_active_inactive_status,
            'ta_asset_reason'=> $static_attribute->asset_reason,
            'ta_last_updated_date' =>  now(),
            'ta_last_updated_by' => "Admin",
            
            ]);
            //dd($update_asset);

               //$asset_id = DB::getPdo()->lastInsertId();
               //dd($asset_id);
               $dynamic_attribute = $fields->dynamic_attribute;
             //dd($dynamic_attribute);
   
               foreach ($dynamic_attribute as $item) {
                  
                   $key = $item->key;
                   $value = $item->value;
                   $valueType = $item->valueType;
                   $attr_code = $item->attributeCode;
                   $value = strlen($value)==0 || $value == "null" ? null : $value;
                if($valueType == 'INTEGER'){
                   
                    $at_asset_attribute_value = 'at_asset_attribute_value_integer';
                } 
                else if($valueType == 'TIMESTAMP WITHOUT TIMEZONE'){
                    $valuestr = strtotime($value);
                    $value =  date("Y-m-d", $valuestr);
                    $at_asset_attribute_value = 'at_asset_attribute_value_date_type';
                }else if($valueType == 'NUMERIC'){
                   $value = $at_asset_attribute_value = 'at_asset_attribute_value_number';
                } else {
                    $at_asset_attribute_value = 'at_asset_attribute_value_text';
                }
   
                   // Process the key-value pair as needed
                   //echo "Key: $key, Value: $value, ValueType: $valueType\n";
                   //DB::enableQueryLog();
                   //dd($at_asset_type_id);
                   $asset_attribute_exits = DB::table('ats.t_asset_attribute')
                   ->where('at_asset_attribute_code',$attr_code)
                   ->where('at_asset_id', $asset_id)
                   //->where('ta_effective_end_date', null)
                   ->first();
                   //dd($at_asset_type_attribute_code);
                   if($asset_attribute_exits==null){
                    //dd('hello');
                    $insert = DB::table('ats.t_asset_attribute')
                   ->insert(
                       [
                           'at_asset_id' => $asset_id,
                           'at_asset_attribute_description' =>$key,
                            $at_asset_attribute_value =>$value,
                           'at_asset_type_attribute_master_id' => $at_asset_type_id,
                           'at_asset_attribute_code' => $attr_code,
                           'at_creation_date' => now(),
                           'at_created_by' => 'Admin001',
                           'at_effective_start_date' => now(),
                           'at_last_updated_date' =>  now(),
                           'at_last_updated_by' => 'Admin',
                          
                        ],
                      
                       );

                   }else{
                    //dd('hello1');
                    $update = DB::table('ats.t_asset_attribute')
                    ->where('at_asset_id',$asset_id)
                    ->where('at_asset_attribute_description', $key)
                    ->update(
                        [
                            $at_asset_attribute_value => $value,
                            'at_last_updated_date' =>  now(),
                            'at_last_updated_by' => 'Admin',
                           
                         ],
                       
                        );

                   }
                   
                  //dd(DB::getQueryLog());
   
   
               }
               DB::commit();
               return response()->json([
                   "status" => 200,
                   "message" => 'Asset created successfully',
   
               ]);
           } catch (\Exception $e) { 
               DB::rollback();
               // something went wrong
               return response()->json([
                   
                   "message" => 'Something went wrong',
   
               ]);
           }
        }
    }
	
	public function asset_getall(){
		$data = asset::all();
		print_r($data);
	}
}

