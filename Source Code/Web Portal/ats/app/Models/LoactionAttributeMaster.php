<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Observable;
use Illuminate\Database\Eloquent\Model;

class LoactionAttributeMaster extends Model
{
    use HasFactory,Observable;
    protected $connection= 'pgsql';
    protected $table = 'product.t_location_attribute_master';
    
   
    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'la_location_attribute_id';
     
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
    public function getLocationAttrAttribute(){
        return LocationType::where('lt_location_type_id',$this->la_location_attribute_location_type)->get();
    }
}
