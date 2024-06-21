<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTaskModel extends Model
{
    use HasFactory;
    protected $connection= 'pgsql';
	protected $table = 'ats.t_user_task';
    //protected $fillable = ['',];
    public $timestamps = false;
	protected $primaryKey = 'ut_user_task_id';
	
	/*public function TypeAttrMaster()
    {
        return $this->belongsTo(Asset_type_attribute_model::class, 'at_asset_type_attribute_master_id', 'ata_asset_type_attribute_id');
    }
	
	public function getTypeAttrMasterAttribute() 
	{
		$assetMasterType = Asset_type_attribute_master_model::where('ata_asset_type_attribute_id', $this->at_asset_type_attribute_master_id)->get();
		return  call_user_func_array('array_merge', $assetMasterType->toarray());
	}
	
	public function locationtype(): HasOne
    {  
        return $this->HasOne(Location::class,'tl_location_id','ta_asset_location_id');
    }*/
}
