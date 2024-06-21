<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\Asset_type_model;

class configViewController extends Controller
{
    public function index() 
    {  
        DB::connection('pgsql')->beginTransaction();
            try {
                //Asset_type_fetch
               // $assettype_details=DB::connection('pgsql')->table("product.t_asset_type_master as t1")->select('t1.*', 't2.at_asset_type_name as parent_name')->leftjoin('product.t_asset_type_master as t2', 't1.at_parent_asset_type_id', '=', 't2.at_asset_type_id')->where('t1.at_effective_end_date', null)->orderBy('t1.at_asset_type_id','desc')->get();
                //dd($assettype_details);
               
                $assettype_details= Asset_type_model::with('childs')->where('at_effective_end_date', null)->orderBy('at_asset_type_id','desc')->get();
               // $parenttype_details=DB::connection('pgsql')->table("product.t_asset_type_master")->select('at_asset_type_id','at_asset_type_name')->where('at_parent_asset_type_id', null)->get();
               
               $parenttype_details=  Asset_type_model::with('childs')->where('at_parent_asset_type_id', null)->orderBy('at_asset_type_name')->get();
                // Asset fixed fetch web-APIasset_name
                $assetfixed_details=DB::connection('pgsql')->table("product.t_asset_type_attribute_master")->select('ata_asset_type_attribute_id','ata_asset_type_attribute_code','ata_asset_type_attribute_description','ata_asset_type_attribute_datatype','attribute_catagory','ata_asset_type_attribute_default_value','ata_asset_type_id','ata_creation_date','ata_created_by','ata_effective_start_date','ata_last_updated_date','ata_last_updated_by','ata_effective_end_date','ata_asset_type_attribute_name','ata_flov','ata_status','ata_field_requiered_not_required_flag','ata_field_editable_non_editable_flag','ata_display')
                ->where('attribute_catagory',0)->get();

                $asset_name=DB::connection('pgsql')->table("product.t_asset_type_master")->select('at_asset_type_name','at_asset_type_id')->get();

                //Asset Attribute Dynamic

                $asset_att_dynamic=DB::connection('pgsql')->table("product.t_asset_type_attribute_master")->select
                ('ata_asset_type_attribute_id','ata_asset_type_attribute_code','ata_asset_type_attribute_description','ata_asset_type_attribute_datatype','attribute_catagory','ata_asset_type_attribute_default_value',
                'ata_asset_type_id','ata_creation_date','ata_created_by','ata_effective_start_date','ata_last_updated_date','ata_last_updated_by','ata_effective_end_date','ata_asset_type_attribute_name','ata_flov','ata_status','ata_field_requiered_not_required_flag','ata_field_editable_non_editable_flag','ata_display')->where
                ('attribute_catagory',1)->get();

                //////SITE//////
        
                $configLocation=DB::connection('pgsql')->table("product.t_location_type_master")->get();
                // dd("mm");
                
                $configsite=Location::whereIn( 'tl_location_type_master_id',$configLocation->pluck("lt_location_type_id"))->get();
            
                $sitetype=DB::connection('pgsql')->table("product.t_location_type_master")->select('lt_location_type_id','lt_location_type')->get();
                


            
                $config_fixed_attribute=DB::connection('pgsql')->table("product.t_location_attribute_master")->where('la_location_type_id',0)
                ->get();


                $fixedatrname=DB::connection('pgsql')->table("product.t_location_attribute_master")->select('la_location_type_id','la_location_attribute_name')->get();

                
                $config_dynamic_attribute=DB::connection('pgsql')->table("product.t_location_attribute_master")->select('la_location_attribute_id', 'la_location_attribute_location_type','la_location_attribute_name', 'la_location_attribute_description', 'la_location_attribute_datatype','la_flov', 'la_location_attribute_mandatory_flag', 'la_location_attribute_default_value', 'la_display', 'la_editable','la_status','la_requiered_not_required_flag')->where('la_location_attribute_mandatory_flag', 'NOT REQUIRED')
                ->where('la_location_attribute_location_type','!=',0)
                ->get();

                $dynamicatrsitetype=DB::connection('pgsql')->table("product.t_location_type_master")->select('lt_location_type_id','lt_location_type')->get();



                $datatypes=DB::connection('pgsql')->table("product.t_datatypes")->select('typeName')->get();

                $site_alltyp_attributes=DB::connection('pgsql')->table("product.t_location_attribute_master")->select('la_location_attribute_id', 'la_location_type_id','la_location_attribute_location_type', 'la_location_attribute_name', 'la_location_attribute_description', 'la_location_attribute_datatype', 'la_location_attribute_mandatory_flag','la_requiered_not_required_flag', 'la_location_attribute_default_value','la_flov', 'la_display', 'la_editable', 'la_status'
                )->first();

                $reason_sub_reason=DB::connection('pgsql')->table('product.t_reason_master')->select('*')->get();
                
                
                //dd($sitetype);
                return view('Configuration_management',compact('assettype_details', 'parenttype_details','assetfixed_details','asset_name','asset_att_dynamic', 'configLocation', 'config_fixed_attribute', 'config_dynamic_attribute','sitetype','fixedatrname', 'dynamicatrsitetype','configsite','datatypes','site_alltyp_attributes','reason_sub_reason'));
                
                } catch (Exception $e) {
                return $e->getMessage();
                }
    }
    

}
