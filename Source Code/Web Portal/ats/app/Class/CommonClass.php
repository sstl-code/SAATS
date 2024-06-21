<?php

namespace App\Class;
use Carbon\Carbon;
use App\Models\asset;
use Illuminate\Support\Facades\Log;


class CommonClass
{

    public $assetdataActivechild="";
    public $assetdataPassivechild="";
    public $operatorID=0;
    
    public function childs_html($childs,$astid,$parentAssetType,$operatorID=0 ){
      $this->operatorID=$operatorID;
      
        $Child_Serial_Number="";
         $tag_green = "<span class='dotGreen'></span>";
         $tag_amber = "<span class='dotAmber'></span>";
         $tag_red = "<span class='dotRed'></span>";
         $i=1;
             foreach($childs as $child)
             {
                Log::debug($child['operators']);
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
                             if($this->operatorID>0 && $child['operator_id']==$this->operatorID ){

                             
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
                             }elseif($operatorID==0){
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
                            }
                       
   
                  $Child1=asset::where('ta_asset_location_id',$child['ta_asset_location_id'])->where('ta_asset_parent_id',$child['ta_asset_id'])->whereNotNull('ta_asset_catagory')->where('is_shown','t')->count();
                 // //AssetEditModel::where('ta_asset_parent_id',$child->id)->count();
                  if($Child1>0){
                    $childs_data=asset::where('ta_asset_location_id',$child['ta_asset_location_id'])->where('ta_asset_parent_id',$child['ta_asset_id'])->whereNotNull('ta_asset_catagory')->where('is_shown','t')->get();
                  $this->childs_html($childs_data,$child['ta_asset_id'],$parentAssetType."->".$child['AssetType'],$this->operatorID);
                  
                  }
             
     
             }
          
       }
}