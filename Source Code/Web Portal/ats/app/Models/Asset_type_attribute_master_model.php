<?php

namespace App\Models;

use App\Traits\Observable;
use App\Models\Asset_type_model;
use App\Models\Asset_type_attribute_model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Asset_type_attribute_master_model extends Model
{
    use HasFactory,Observable;
    protected $connection= 'pgsql';
	protected $table = 'product.t_asset_type_attribute_master';
    //protected $fillable = ['',];
    public $timestamps = false;
	protected $primaryKey = 'ata_asset_type_attribute_id';
    protected $appends = ["AssetType"];
    protected $guarded =[];
	
	public function TypeAttrMaster()
    {
        return $this->belongsTo(Asset_type_attribute_model::class, 'at_asset_type_attribute_master_id', 'ata_asset_type_attribute_id');
    }
    public function getAssetTypeAttribute()
    {  
        return Asset_type_model::where('at_asset_type_id',$this->ata_asset_type_id)->pluck('at_asset_type_name')->first();
    }
	
	
}
