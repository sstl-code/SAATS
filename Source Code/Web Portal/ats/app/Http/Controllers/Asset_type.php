<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;



class Asset_type extends Controller
{
    //
    public function index()
    {
        //dd('index');
        //return $site = Site::all();
       $asset_type_describtion=DB::table('product.t_asset_type_master')->get(['at_asset_type_description','at_asset_type_id','at_asset_type_category','at_asset_type_code' ]);
       //dd($asset_type_describtion);
       $asset_type_describtion=$asset_type_describtion->toArray();
       if(!empty($asset_type_describtion)) {
        return response()->json([
            'status'=>'success',
            'asset_type'=>$asset_type_describtion
           ]);
       } else {
        return response()->json([
            'status'=>'No asset type found',
            
           ]);
       }
       




    }
    public function get_child_asset_type($asset_type_name)
    {

       $at_asset_type_id=DB::table('product.t_asset_type_master')->where('at_asset_type_name',$asset_type_name)->first(['at_asset_type_id']);
       $at_asset_type_id = $at_asset_type_id->at_asset_type_id;
       //dd($at_asset_type_id);
       $at_asset_type_name=DB::table('product.t_asset_type_master')->where('at_parent_asset_type_id',$at_asset_type_id)->get();
       if(!empty($at_asset_type_name)) {
        return response()->json([
            'status'=>'success',
            'asset_type'=>$at_asset_type_name
           ]);
       } else {
        return response()->json([
            'status'=>'No asset type found',
            
           ]);
       }
       




    }

}