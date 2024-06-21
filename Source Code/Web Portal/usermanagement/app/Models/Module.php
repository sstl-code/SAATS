<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;
    protected $table='modules';  
    protected $appends=['functionStatus'];
    
    public function functions(): HasMany
    {
        return $this->hasMany(Functions::class,'module_id','id');
    }

    public function getfunctionStatusAttribute() {
        
        $functionAccess=RoleUserfunctionMappers::where('module_id',$this->id)->where('status',true)->count();
       return $functionAccess;
	}
}
