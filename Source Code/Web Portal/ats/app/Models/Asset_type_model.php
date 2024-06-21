<?php

namespace App\Models;

use App\Models\asset;
use App\Traits\Observable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Asset_type_attribute_master_model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset_type_model extends Model
{
    use HasFactory,Observable;
    protected $connection= 'pgsql';
    protected $table = 'product.t_asset_type_master';
	protected $primaryKey = 'at_asset_type_id';
	public $timestamps = false;
    protected $guarded =[];
    protected $appends = ["at_is_child_available"];
    public function AssetType()
    {
        return $this->belongsTo(asset::class, 'ta_asset_type_master_id', 'at_asset_type_id');
    }
	
	public function assetattr(): HasMany
    {  
        return $this->HasMany(Asset_type_attribute_master_model::class,'ata_asset_type_id','at_asset_type_id');
    }
    public function getAtIsChildAvailableAttribute() 
    {
        $childdata=Asset_type_model::where('at_parent_asset_type_id',$this->at_asset_type_id)->count();
        return $childdata>0?1:0;
    }
    public function childs() {
        return $this->hasMany('App\Models\Asset_type_model','at_parent_asset_type_id','at_asset_type_id') ;
    }
    public function parents() {
        return $this->hasMany('App\Models\Asset_type_model','at_asset_type_id','at_parent_asset_type_id') ;
    }
}
