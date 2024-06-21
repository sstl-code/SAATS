<?php

namespace App\Models;

use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Operator_location_model extends Model
{
    use HasFactory;
    protected $connection= 'pgsql';
    protected $table = 'ats.t_location_operators';
	protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;
    
    public function operator_sites(): HasMany
    {  
        return $this->HasMany(Location::class,'tl_location_id','location_id');
    }
    
    

}
