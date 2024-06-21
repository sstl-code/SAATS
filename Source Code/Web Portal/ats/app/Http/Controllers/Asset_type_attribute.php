<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset_type_attribute_model;
use DB;

class Asset_type_attribute extends Controller
{
    //
    public function index()
    {
        //dd('hello');
        //return $asset_type_attribute= Asset_type_attribute_model::all();
        $articles =DB::table('product.t_asset_type_master')
                ->join('product.t_asset_type_attribute_master', 't_asset_type_master.at_asset_type_id', '=', 't_asset_type_attribute_master.ata_asset_type_id')
                ->select('t_asset_type_attribute_master.ata_asset_type_attribute_name','t_asset_type_attribute_master.ata_asset_type_attribute_name','t_asset_type_attribute_master.ata_asset_type_attribute_name')
                ->where('t_asset_type_master.at_asset_type_name','Air Conditioner')
                ->get();
                dd($articles);


    }
    public function getAtributeByAttributetype($asset_type)
    {

        $asset_type_attribute =DB::table('ats.v_attr_list')
        ->where('ata_asset_type_attribute_mandatory_flag','NOT REQUIRED')
        ->where('at_asset_type_id',$asset_type)
        ->get();
        //dd($asset_type_attribute);
               

                if(!empty($asset_type_attribute->toArray())){
                    return response()->json([
                        "status" => 200,
                        'message'=>'Ok',
                        "data" => $asset_type_attribute
                    ]); 
                }else{
                    return response()->json([
                        'message'=>'No data found',
                    ]);
                }

              


    }


    public function getStaticAtribute($asset_type)
    {

        $static_attribute =DB::table('ats.v_attr_list')
        //->select('ata_asset_type_attribute_name')
        ->where('ata_asset_type_attribute_mandatory_flag','REQUIRED')
        ->where('at_asset_type_id',$asset_type)
        ->get();
 
                if(!empty($static_attribute->toArray())){
                    return response()->json([
                        "status" => 200,
                        'message'=>'Ok',
                        "data" => $static_attribute
                    ]); 
                }else{
                    return response()->json([
                        'message'=>'No data found',
                    ]);
                }

              


    }






}