<?php

namespace App\Models;

use App\Traits\CommonFunction;
use App\Models\RoleUserMappers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Roles extends Model
{
    use HasFactory,CommonFunction;
    protected $table='roles';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function modules(): HasMany
    {
        return $this->hasMany(Module::class,'role_id','id');
    }

    
    

//     protected $appends=["UserRole"];
//     public function getUserRoleAttribute()
//     {
//         $strstatus=RoleUserMappers::where('role_id',$this->id)->select('user_role_mapper_status')->first();
//         return isset($strstatus->user_role_mapper_status)?$strstatus->user_role_mapper_status:false;
//    }
}
