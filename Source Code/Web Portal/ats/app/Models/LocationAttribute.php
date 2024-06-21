<?php

namespace App\Models;

use App\Models\Location;
use App\Models\LoactionAttributeMaster;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LocationAttribute extends Model
{
    use HasFactory;
    protected $connection= 'pgsql';
    protected $table = 'ats.t_location_attribute';
   

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'tla_location_attribute_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $guarded = [];
    // protected $appends = ["LocationAttrMaster"];
    
    
    public function location()
    {
		return $this->belongsTo(Location::class, 'tl_location_id', 'tla_location_id');
    }
    public function attributemaster()
    {
		return $this->belongsTo(LoactionAttributeMaster::class, 'la_location_attribute_id', 'tla_location_attribute_master_id');
    }
  //   public function getLocationAttrMasterAttribute() 
	// {
	// 	return $assetMasterType = LoactionAttributeMaster::where('la_location_attribute_id', $this->tla_location_attribute_master_id)->get();
		
	// }
	
}
