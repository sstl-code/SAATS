<?php

namespace App\Models;

use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_Location_Model extends Model
{
	use HasFactory, SoftDeletes;
    protected $connection= 'pgsql';
    protected $table = 'ats.t_user_location';
	protected $primaryKey = 'ul_user_location_id';
    public $timestamps = true;
	protected $fillable = ['ul_location_id', 'ul_user_id', 'ul_user_role_id', 'created_at', 'deleted_at','status','reason'];
	public function locations(): HasMany
    {  
        return $this->hasMany(Location::class,'tl_location_id','ul_location_id')->orderby('tl_location_code');
    }
	public function users(): HasMany
    {  
        return $this->hasMany(User::class,'id','ul_user_id');
    }
	
	/*public function locations_mapping()
    {
		return $this->belongsTo(Location::class, 'tl_location_id', 'ul_user_location_id');
    }*/
	
	public function users_location_mapping(): HasMany
    {  
        return $this->HasMany(Location::class,'tl_location_id','ul_location_id')->orderBy('tl_location_code','asc');
    }
	
}
