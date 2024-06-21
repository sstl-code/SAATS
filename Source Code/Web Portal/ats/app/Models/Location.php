<?php

namespace App\Models;

use App\Models\asset;
use App\Models\Operator;
use App\Models\LocationType;
use App\Models\AssetHistoryModel;
use App\Models\LocationAttribute;
use App\Models\User_Location_Model;
use App\Models\Operator_location_model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    protected $connection= 'pgsql';
    use HasFactory;
    protected $table = 'ats.t_location';
    

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'tl_location_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $appends = ["location"];

    public function attributes(): HasMany
    {  
        return $this->HasMany(LocationAttribute::class,'tla_location_id','tl_location_id')->rightjoin('product.t_location_attribute_master', 'ats.t_location_attribute.tla_location_attribute_master_id','=','product.t_location_attribute_master.la_location_attribute_id')->where('product.t_location_attribute_master.la_location_type_id',$this->getAttributes('tl_location_type_master_id'))->orwhere('product.t_location_attribute_master.la_location_type_id',0);

    }
    public function locationtype(): HasOne
    {  
        return $this->HasOne(LocationType::class,'lt_location_type_id','tl_location_type_master_id');
    }
	
	public function locations_mapping()
    {
		return $this->belongsTo(User_Location_Model::class, 'ul_user_location_id', 'tl_location_id');
    }
	
	public function location()
    {
        return $this->belongsTo(asset::class, 'ta_asset_location_id', 'tl_location_id');
    }

    public function operator_sites(): HasMany
    {  
        return $this->HasMany(Operator_location_model::class,'location_id','tl_location_id');
    }
    public function assets_site(): HasMany
    {  
        return $this->HasMany(asset::class,'ta_asset_location_id','tl_location_id')->where('t_asset.is_shown','t');
    }
    public function getlocationAttribute()
    {
        return Location_Attribute::where('tla_location_id',$this->tl_location_id)->get();
    }
    public function assethistory()
    {
		return $this->belongsTo(AssetHistoryModel::class, 'location_id','tl_location_id');
    }
    public function getTaggingStatusAttribute() 
    {
        $TotalAssets=asset::where('ta_asset_location_id',$this->tl_location_id)->where('is_shown','t')->count();
    
        $ParentAssets=asset::where('ta_asset_location_id',$this->tl_location_id)->where('ta_asset_parent_id',0)->whereNotNull('ta_asset_tag_number')->whereNotNull('ta_asset_catagory')->where('is_shown','t')->count();

        $ChildAssets=asset::where('ta_asset_location_id',$this->tl_location_id)->where('ta_asset_parent_id','!=',0)->whereNotNull('ta_asset_tag_number')->whereNotNull('ta_asset_catagory')->where('is_shown','t')->count();
        
        if($TotalAssets==0){
            $Tagging_status='';
        }
        elseif(($TotalAssets-($ParentAssets+$ChildAssets))==0){
            $Tagging_status='Green';
        }
        elseif(($ParentAssets+$ChildAssets)>=($TotalAssets*.5)){
            $Tagging_status='Orange';
        }
        else{
            $Tagging_status='Red';
        }

        return $Tagging_status;
       
       
	}

     public function getLastAuditDateAttribute() 
    {
       $assetAudit=Asset_Audit_Model::where('aa_location_id',$this->tl_location_id)->orderBy('aa_created_date','desc')->first();
       if($assetAudit){
         return date('d-M-Y H:i:s',strtotime($assetAudit->aa_created_date));
       }
       else{
        return "";
       }
    }
    public function getCreatedAtAttribute($value) {
        if($value!=""){
        return $this->attributes['created_at']=date('d-M-Y H:i:s',strtotime($value));
        }
    }
  
}
