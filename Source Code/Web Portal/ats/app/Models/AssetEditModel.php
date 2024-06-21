<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Location;
use App\Models\Operator;
use App\Models\Asset_type_model;
use App\Models\AssetHistoryModel;
use Spatie\Activitylog\LogOptions;
use App\Models\Asset_type_attribute_model;
//use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class AssetEditModel extends Model
{
    protected $connection= 'pgsql';
    use HasFactory;
///LogsActivity;
    protected $table = 'ats.t_asset_edit';
	protected $primaryKey = 'id';
//	protected $fillable = ['ta_asset_status', 'ta_asset_location_id', 'ta_asset_type_master_id', 'ta_asset_type_code', 'ta_asset_name', 'ta_asset_manufacture_serial_no', 'ta_asset_tag_number', 'ta_creation_date', 'ta_asset_catagory', 'ta_asset_parent_id', 'operator_id','ta_asset_active_inactive_status', 'is_shown','pm_project_id'];
    protected $guarded = [];
    public $timestamps = false;
    protected $appends = ["AssetType","operators", "TypeAttr","childs"];
   //  protected $attributes=["asset_type_attr1"];
	
	public function locationtype(): HasOne
    {  
        return $this->HasOne(Location::class,'tl_location_id','ta_asset_location_id');
    }
	
    public function getchildsAttribute()
    {
        return AssetEditModel::where('ta_asset_parent_id',$this->id)->get();
    }
    public function getOperatorsAttribute()
    {  
        return Operator::where('op_id',$this->operator_id)->pluck('op_operator_name')->first();
    }

    public function getAssetTypeAttribute() {
        $assetType =  Asset_type_model::where('at_asset_type_id',$this->ta_asset_type_master_id)->first(['at_asset_type_name']);
		return $assetType ? $assetType->at_asset_type_name : null;
	}
	
	public function getTypeAttrAttribute() {
        
        return AssetEditAttribute::where('at_asset_edit_id',$this->id)->get();
        // AssetTypeAttr
	}

    
    public function getTaCreationDateAttribute($value) {
        if($value!=""){
        return $this->attributes['ta_creation_date']= date('d-M-Y H:i:s',strtotime($value));
        }
	}
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");
        // Chain fluent methods for configuration options
    }
    
    
}
