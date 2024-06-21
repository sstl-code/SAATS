<?php

namespace App\Models;

use App\Models\Location;
use App\Models\Operator;
use App\Models\Asset_type_model;
use App\Models\AssetHistoryModel;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use App\Models\Asset_type_attribute_model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class asset extends Model
{
    use HasFactory,SoftDeletes;
    //LogsActivity;
    protected $connection= 'pgsql';
    protected $table = 'ats.t_asset';
	protected $primaryKey = 'ta_asset_id';
    protected $guarded = []; 
    public $timestamps = true;
    public $arrParent=[];
    protected $appends = ["AssetType","AssetTypeFull","operators", "TypeAttr","childs","ParentAssetName","at_is_child_available"];
   //  protected $attributes=["asset_type_attr1"];
	
	public function locationtype(): HasOne
    {  
        return $this->HasOne(Location::class,'tl_location_id','ta_asset_location_id');
    }
    public function getParentAssetNameAttribute()
    {  
        $parentname=asset::where('ta_asset_id',$this->ta_asset_parent_id)->first();
        return isset($parentname->ta_asset_name)?$parentname->ta_asset_name:"NA";
    }
	
    public function getchildsAttribute()
    {
        $childdata=asset::where('ta_asset_parent_id',$this->ta_asset_id)->where('is_shown','t')->wherenotnull('ta_asset_catagory')->get()->toArray();
     //  dd($childdata);
       if(!empty($childdata)){
        array_walk($childdata,"self::getAssetStatus");
       }
        return $childdata;
    }
    public function getAtIsChildAvailableAttribute() 
    {
        $childdata=Asset_type_model::where('at_parent_asset_type_id',$this->ta_asset_type_master_id)->count();
        return $childdata>0?1:0;
    }
    public function getOperatorsAttribute()
    {  
        return Operator::where('op_id',$this->operator_id)->pluck('op_operator_name')->first();
    }

    public function getAssetTypeAttribute() {
        $assetType =  Asset_type_model::where('at_asset_type_id',$this->ta_asset_type_master_id)->first(['at_asset_type_name']);
		return $assetType ? $assetType->at_asset_type_name : null;
	}
    public function getAssetTypeFullAttribute() {

        $assetTypeData =  Asset_type_model::with('childs')->where('at_asset_type_id',$this->ta_asset_type_master_id)->first();
	    if(!empty($assetTypeData->parents)&&count($assetTypeData->parents)>0) 
        { 
            $this->arrParent[]=$assetTypeData->at_asset_type_name;                
        $assetType=$this->getfullparentAssettype($assetTypeData->parents,$assetTypeData->at_asset_type_name);
        $assetType= implode("->",array_reverse(array_unique($assetType)));
        }else{
            $assetType=!empty($assetTypeData->at_asset_type_name)?$assetTypeData->at_asset_type_name:null;
        }
        return $assetType ? $assetType  : null;
	}
	public function getTypeAttrAttribute() {
        
        return Asset_type_attribute_model::where('at_asset_id',$this->ta_asset_id)->get();
        // AssetTypeAttr
	}
    
    public function asset_history(): HasMany
    {  
        return $this->HasMany(AssetHistoryModel::class,'asset_id','ta_asset_id')->orderBy('id','desc');
    }
    
    public function getTaCreationDateAttribute($value) {
        if($value!=""){
        return $this->attributes['ta_creation_date']= date('d-M-Y H:i:s',strtotime($value));
        }
	}
    public function getCreatedAtAttribute($value) {
        if($value!=""){
        return $this->attributes['created_at']= date('d-M-Y H:i:s',strtotime($value));
        }
	}
    public function getTaLastUpdatedDateAttribute($value) {
        if($value!=""){
        return $this->attributes['ta_last_updated_date']= date('d-M-Y H:i:s',strtotime($value));
        }
	}
    
    
    public function getTaAssetActiveInactiveStatusAttribute($value)
    {
     $data=Asset_Attribute::where('at_asset_id',$this->ta_asset_id)->where('at_asset_attribute_name','Status')->select('at_asset_attribute_value_text')->first();
     if(!empty($data)){
     return $this->attributes['ta_asset_active_inactive_status']= $data->at_asset_attribute_value_text;
     }else{
        return $this->attributes['ta_asset_active_inactive_status']='Used';
     }
        
    }
   
    public function getAssetStatus(&$value,$key)
    {
    
     $data=Asset_Attribute::where('at_asset_id',$value['ta_asset_id'])->where('at_asset_attribute_name','Status')->select('at_asset_attribute_value_text')->first();
      $value['ta_asset_active_inactive_status']=isset($data->at_asset_attribute_value_text)?$data->at_asset_attribute_value_text:"Used";
        
    }
    
   public function getfullparentAssettype($parents,$parent_name)
   {
    $i=0;
    foreach($parents as $parent)
         { 
            
            if(count($parent->parents))
           {
              
             $this->arrParent[]=trim($parent->at_asset_type_name);
                $this->getfullparentAssettype($parent->parents,$parent->at_asset_type_name);
           }else{
            
            $this->arrParent[]=trim($parent->at_asset_type_name);
           }
        }
     return $this->arrParent;
   }

}