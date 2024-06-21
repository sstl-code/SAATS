<?php

namespace App\Models;

use DateTime;
use App\Models\asset;
use Illuminate\Database\Eloquent\Model;
use App\Models\Asset_type_attribute_master_model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset_type_attribute_model extends Model
{
	use HasFactory;
	protected $connection= 'pgsql';
    protected $table = 'ats.t_asset_attribute';
    //protected $fillable = ['',];
	protected $primaryKey = 'at_asset_attribute_id';
    public $timestamps = false;
	protected $appends = ["TypeAttrMaster","AttrCatagory"];
	protected $guarded =[];
	
	public function TypeAttr()
    {
        return $this->belongsTo(asset::class, 'ta_asset_id', 'at_asset_id');
    }
	
	public function getTypeAttrMasterAttribute() 
	{
		$assetMasterType = Asset_type_attribute_master_model::where('ata_asset_type_attribute_id', $this->at_asset_type_attribute_master_id)->get();
		return  call_user_func_array('array_merge',$assetMasterType->toarray());
	}
	
	
	// public function getAttributeTypeMasterAttribute() {
    //     return Asset_type_attribute_master_model::where('ata_asset_type_attribute_id',$this->at_asset_type_attribute_master_id)->select('attribute_catagory')->get();
	// }
	public function getAttrCatagoryAttribute()
    {  
        return Asset_type_attribute_master_model::where('ata_asset_type_attribute_id',$this->at_asset_type_attribute_master_id)->pluck('attribute_catagory')->first();
    }

	

			public function getAtAssetAttributeValueTextAttribute($value) {

				
				if($value!=""){
					
					$assetMasterType = Asset_type_attribute_master_model::where('ata_asset_type_attribute_id', $this->at_asset_type_attribute_master_id)->first();

						if(!empty($assetMasterType)&& $assetMasterType->ata_asset_type_attribute_datatype=='Date'){
							
							return date('d-M-Y H:i:s',strtotime($value));
						}
					   else{
						return $value;
					   }					
					
						
					
				}
			}
}

