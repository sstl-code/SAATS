<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Models\asset;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\AssetHistoryModel;
use App\Models\Location_Attribute;
use App\Models\AssetTaggingHistory;
use App\Models\User_Location_Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Supervisor_to_technician;

class location_jason_controller extends Controller
{ 
  public $assetdataActivechild="";
  public $assetdataPassivechild="";
    public function location(Request $request)
    {

      
      $locationDB=Location::where('tl_location_id',$request->location_id)->first();
      
    
      $location_asset=asset::where('ta_asset_location_id',$request->location_id)->where('ta_asset_parent_id',0)->whereNotNull('ta_asset_catagory')->where('is_shown','t')->get();
      $vvv=""; 
      $i=0;
      foreach($location_asset  as $assets){
        if(($assets->childs)!=""){
          $this->assetdataPassivechild="";
          $this->assetdataActivechild="";
          $this->childs_html($assets->childs,$assets->ta_asset_id,$assets->AssetType);    
          $location_asset[$i]->child_HTML_Passive= $this->assetdataPassivechild;
          $location_asset[$i]->child_HTML_Active= $this->assetdataActivechild;
         
        }
        $i++;
      }

      //$this->childs_html($assets->childs,$assets->ta_asset_id,$assets->AssetType);
    
      // print_r($assets->AssetType);
      // die();
     
        
      $site_asset_history=AssetHistoryModel::where('location_id',$request->location_id)->where('moveout_date','!=',null)->get();
     
    //Location attributes

    $location_attribute_description=Location_Attribute::where('tla_location_id',$request->location_id)
    ->get();
  
     $location_creation_date=$locationDB->tl_creation_date;
     return response()->json([
        'status' => 'success',
        'data' =>   $locationDB,
        'location_asset'=> $location_asset,
        'location_attribute_description' => $location_attribute_description,
        'location_creation_date'=>$location_creation_date,
        'Site_Asset_History'=>$site_asset_history,
        
     ]);
    }
    public function childs_html($childs,$astid,$parentAssetType){

     $Child_Serial_Number="";
      $tag_green = "<span class='dotGreen'></span>";
      $tag_amber = "<span class='dotAmber'></span>";
      $tag_red = "<span class='dotRed'></span>";
      $i=1;
          foreach($childs as $child)
          {
             //dd($child);
            if(strtoupper($child['ta_asset_catagory'])=='PASSIVE'){
            
                          $asset_id = $child['ta_asset_id'];
                          if ($child['AssetType'] == null) {
                              $asset_type = '';
                          } else {
                              $asset_type = $child['AssetType'];
                          }

                          if ($child['ta_asset_tag_number'] == null) {
                              $tag_no = '';
                          } else {

                              $tag_no = $child['ta_asset_tag_number'];
                          }
                          if ($child['ta_asset_active_inactive_status'] == null) {
                              $asset_status = '';
                          } else {
                              $asset_status = $child[
                                  'ta_asset_active_inactive_status'];
                          }
                          if ($child['operators'] == null) {
                              $operator = '';
                          } else {
                              $operator = $child['operators'];
                          }
                          if ($child['ta_asset_tag_number'] != null) {
                            $this->assetdataPassivechild .=
                                  "<tr class='tablehover'><td>".$parentAssetType."->".$child['AssetType']."</td><td><a href='#' onclick='assetdetails(".$asset_id.");'>".$child['ta_asset_name']."</td><td>".$child['ta_asset_manufacture_serial_no'] ."</td><td>".
                                  $tag_no."</td><td>". $asset_status .
                                  "</td><td>".
                                  $tag_green."</td></tr>'";
                          } else {
                            $this->assetdataPassivechild .=
                            "<tr class='tablehover '
                            ' '><td>".$parentAssetType."->".$child['AssetType']."</td><td><a href='#' onclick='assetdetails(".$asset_id.");'>".$child['ta_asset_name']."</td><td>".$child[
                                'ta_asset_manufacture_serial_no'] .
                            "</td><td>".
                            $tag_no ."</td><td>".$asset_status."</td><td>".
                            $tag_red."</td></tr>'";

                          }
                        }

                        if(strtoupper($child['ta_asset_catagory'])=='ACTIVE'){
            
                          $asset_id = $child['ta_asset_id'];
                          if ($child['AssetType'] == null) {
                              $asset_type = '';
                          } else {
                              $asset_type = $child['AssetType'];
                          }

                          if ($child['ta_asset_tag_number'] == null) {
                              $tag_no = '';
                          } else {

                              $tag_no = $child['ta_asset_tag_number'];
                          }
                          if ($child['ta_asset_active_inactive_status'] == null) {
                              $asset_status = '';
                          } else {
                              $asset_status = $child[
                                  'ta_asset_active_inactive_status'];
                          }
                          if ($child['operators'] == null) {
                              $operator = '';
                          } else {
                              $operator = $child['operators'];
                          }
                          if ($child['ta_asset_tag_number'] != null) {
                            $this->assetdataActivechild .=
                                  "<tr class='tablehover'><td>".$parentAssetType."->".$child['AssetType']."</td><td><a href='#' onclick='assetdetails(".$asset_id.");'>".$child['ta_asset_name']."</td><td>".$operator."</td><td>".$child['ta_asset_manufacture_serial_no'] ."</td><td>".
                                  $tag_no."</td><td>". $asset_status .
                                  "</td><td>".
                                  $tag_green."</td></tr>'";
                          } else {
                            $this->assetdataActivechild .=
                            "<tr class='tablehover '
                            ' '><td>".$parentAssetType."->".$child['AssetType']."</td><td><a href='#' onclick='assetdetails(".$asset_id.");'>".$child['ta_asset_name']."</td><td>".$operator."</td><td>".$child[
                                'ta_asset_manufacture_serial_no'] .
                            "</td><td>".
                            $tag_no ."</td><td>".$asset_status."</td><td>".
                            $tag_red."</td></tr>'";

                          }
                        }
                    

               $Child1=asset::where('ta_asset_location_id',$child['ta_asset_location_id'])->where('ta_asset_parent_id',$child['ta_asset_id'])->whereNotNull('ta_asset_catagory')->where('is_shown','t')->count();
              // //AssetEditModel::where('ta_asset_parent_id',$child->id)->count();
               if($Child1>0){
                 $childs_data=asset::where('ta_asset_location_id',$child['ta_asset_location_id'])->where('ta_asset_parent_id',$child['ta_asset_id'])->whereNotNull('ta_asset_catagory')->where('is_shown','t')->get();
               $this->childs_html($childs_data,$child['ta_asset_id'],$parentAssetType."->".$child['AssetType']);
               
               }
          
  
          }
       
    }


    public function search_location(Request $request)
    {
      $dataArray = array();
      $search= strtoupper($request->get('search'));
     
      $global_search_home=Location::select('*')->whereRaw("upper(tl_location_name) LIKE '"."%{$search}%'")->orWhereRaw("upper(tl_location_code) LIKE'"."%{$search}%'");
   //   if (strtotime($search) !== false)  {
    $search1=str_replace('/','-',$search);
        $global_search_home=$global_search_home->orWhereRaw("to_char(created_at,'dd-mm-YYYY') LIKE '"."%{$search1}%'");
     // }
      $global_search_home=$global_search_home->get();
  
      foreach($global_search_home as $item ){
        $dataArray[] = array(
          "label" => $item->tl_location_name."(".$item->tl_location_code.")",
          "value" => $item->tl_location_code,
          "tl_location_id" => $item->tl_location_id,
          "region" => $item->tl_location_region,
          "tagging_status" => $item->tagging_status,
          "created_at"=>$item->created_at
        );
      }
      return response()->json($dataArray);    
        
  }

  public function near_site(Request $request) 
  {
      $lat = $request->lat;
      $lon = $request->lng;
      $radius = $request->radius;
      $site = 'SITES';
      
         
     $results=DB::connection('pgsql')->select("select * from ats.lat_long(?, ?, ?)", [$lat, $lon, $radius]);
 //   $results= LatLongModel::where()

      return response()->json([
          "status" => 200,
          "data" => $results
      ]);
  }
  public function site_asset_details_history(Request $request){
    $site_assets=AssetHistoryModel::where('location_id',$request->location_id)->where('asset_id',$request->asset_id)->get();
    $tagging_history=AssetTaggingHistory::where('th_location_id',$request->location_id)->where('th_asset_id',$request->asset_id)->get();
    return response()->json([
        "status"=>'success',
        "Site_Asset_Data"=>$site_assets,
        "Tag_history"=> $tagging_history
    ]);


 }
 public function all_data(){


        $userdetails=Supervisor_to_technician::where('supervisor_id',Auth::id())->select('technician_id')->get();
        $location_id=User_Location_Model::wherein('ul_user_id',$userdetails)->select('ul_location_id')->get();
         if(Auth::user()->is_admin){
          $locationlist=Location::with('assets_site')->orderby('tl_location_code')->get();
          }else{
         $locationlist=Location::with('assets_site')->wherein('tl_location_id',$location_id)->orderby('tl_location_code')->get();
         }
          return response()->json([
            "status"=>'success',
            "locationlist"=>$locationlist
           ]);
           
          

 }


}