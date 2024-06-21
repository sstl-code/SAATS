<?php

namespace App\Models;

use App\Models\Location;
use App\Models\LoactionAttributeMaster;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location_Attribute extends Model
{
    use HasFactory;
    protected $connection= 'pgsql';
	protected $table = 'ats.t_location_attribute';
    //protected $fillable = ['',];
    protected $primaryKey = 'tla_location_attribute_id';
    protected $guarded = [];
    protected $appends = ['locationAllAttr'];
    public $timestamps = false;
    public function location()
    {
        return $this->belongsTo(Location::class, 'tl_location_id','tla_location_id');
    }
    public function getlocationAllAttrAttribute(){
        return LoactionAttributeMaster::where('la_location_attribute_id',$this->tla_location_attribute_master_id)->select('la_location_type_id')->first();
        

    }
}
