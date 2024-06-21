<?php

namespace App\Models;

use App\Models\asset;
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetHistoryModel extends Model
{
    use HasFactory;
    protected $connection= 'pgsql';
    protected $table = 'ats.t_asset_history';
	  protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;
    protected $appends = ["sitedetails"];
    public function asset()
    {
		return $this->belongsTo(asset::class, 'ta_asset_id', 'asset_id');
    }

    public function getsitedetailsAttribute() {
    return Location::where('tl_location_id',$this->location_id)->get()->toArray();
	      }
  public function getMoveoutDateAttribute($value) {
    if($value!=""){
    return $this->attributes['moveout_date']=date('d-M-Y h:i:s',strtotime($value));
    }
  }
  public function getMoveinDateAttribute($value) {
    if($value!=""){
    return $this->attributes['movein_date']=date('d-M-Y h:i:s',strtotime($value));
    }
  }

  
  
}


