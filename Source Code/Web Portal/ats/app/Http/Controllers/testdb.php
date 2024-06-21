<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use App\Models\asset;
use ReflectionObject;
use App\Models\Location;
use App\Models\Operator;
use PHPJasper\Exception;
use PHPJasper\PHPJasper;
use Illuminate\Http\Request;
use App\Models\AssetHistoryModel;
use App\Models\Asset_type_attribute_model;

class testdb extends Controller
{
    
public function index(Request $request)
{
  /* $assetAttrData=Asset_type_attribute_model::get();
   foreach($assetAttrData as $data)
   {
    Asset_type_attribute_model::where('at_asset_id',$data->at_asset_id)->where('at_asset_type_attribute_master_id',$data->at_asset_type_attribute_master_id)->where('at_asset_attribute_id','!=',$data->at_asset_attribute_id)->delete();
   }*/
     $site_asset_history=AssetHistoryModel::get();

     foreach($site_asset_history as $history)
     {
        $asstdetail=asset::where('ta_asset_id',$history->asset_id)->first();
        if(!empty($asstdetail) &&  $asstdetail->ta_asset_location_id!=null){
        $parent_asset_name=asset::where('ta_asset_id',$asstdetail->ta_asset_parent_id)->first();
       
        $Site_details=Location::where('tl_location_id', $asstdetail->ta_asset_location_id)->first(['tl_location_code','tl_location_name']);
        $Site_Code=$Site_details->tl_location_code;
        $Site_name=$Site_details->tl_location_name;
        $user_name=User::where('id',$asstdetail->ta_created_by)->first();
        if($asstdetail->operator_id!=""){
            $operator_name_data=Operator::where('op_id',$asstdetail->operator_id)->first();
            $operator_name=isset($operator_name_data->op_operator_name)?$operator_name_data->op_operator_name:null;
        }

        $Master_Asset_Data=[
            'ta_asset_id'=>$history->asset_id,
            'ta_asset_type_master_id'=>$asstdetail->ta_asset_type_master_id ,
            'ta_asset_manufacture_serial_no'=>$asstdetail->ta_asset_manufacture_serial_no,
            'ta_asset_name'=>$asstdetail->ta_asset_name,
            'ta_asset_tag_number'=>$asstdetail->ta_asset_tag_number,
            'ta_asset_location_id'=>$asstdetail->ta_asset_location_id,
            'ta_asset_catagory'=>$asstdetail->ta_asset_catagory,
            'ta_asset_active_inactive_status'=>$asstdetail->ta_asset_active_inactive_status,
            'ta_asset_parent_id'=>$asstdetail->ta_asset_parent_id,
            'ta_asset_type_code'=>$asstdetail->ta_asset_type_code,
            'operator_id'=>$asstdetail->operator_id,
            'ta_asset_image'=>$asstdetail->ta_asset_image,
            'pm_project_id'=>$asstdetail->pm_project_id,
            'is_shown' =>isset($asstdetail->is_shown)?$asstdetail->is_shown:'f',
            'Asset_Type'=>$asstdetail->AssetType,
            'Site_Name'=>$Site_name,
            'Site_Code'=>$Site_Code,
            'Parent_asset_name'=>isset($parent_asset_name->ta_asset_name)?$parent_asset_name->ta_asset_name:null,
            'Operator_Name'=> isset($operator_name->op_operator_name)?$operator_name->op_operator_name:null,
            'Action_By'=>isset($user_name->name)?$user_name->name:null,
            'Creation_Date'=>$asstdetail->created_at
           
             ];
             $Master_Asset_Data_attr=[];
             foreach($asstdetail->TypeAttr as $attr){
             $Master_Asset_Data_attr[]=['at_asset_id'=>$history->asset_id,
            'at_asset_attribute_name'=>$attr->at_asset_attribute_name,
            'at_asset_attribute_value_text'=>$attr->at_asset_attribute_value_text,
            'at_asset_type_attribute_master_id'=>$attr->at_asset_type_attribute_master_id,
            'attr_catagory'=>$attr->AttrCatagory
                ];
                }
                                    
        $Master_Asset_Data['attr']=$Master_Asset_Data_attr;
        AssetHistoryModel::where('id',$history->id)->update(['asset_data'=> json_encode($Master_Asset_Data)]);
     
            }
    }

   
   

   



   /* $input =  public_path('jasper/input/')."Blank_A4_1.jrxml";   

    $jasper = new PHPJasper();
   // $jasper->compile($input)->execute();
  //  $input = "/var/www/html/ats/public/Tree1.jasper";  
    $output = public_path('jasper/output/');    
    $options = [
        'format' => ['pdf','xls'],
        'locale' => 'en',
        'params' => ['serialNo'=>'AC100'],
        'db_connection' => [
            'driver' => 'postgres', //mysql, ....
            'username' => 'postgres',
            'password' => 'postgres',
            'host' => 'localhost',
            'database' => 'ats',
            'port' => '5432'
        ]
    ];
   
    $jasper = new PHPJasper();
    
    $jasper->process(
        $input,
        $output,
        $options
    )->execute();*/
    
}
}

