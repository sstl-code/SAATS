<?php

namespace App\Models;

use App\Models\RoleUserfunctionMappers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Functions extends Model
{
    use HasFactory;
    protected $table='functions';
    protected $guarded = ['id'];
    protected $connection= 'user_db_connection';
//     protected $appends=["FunctionStatus"];
//     public function getFunctionStatusAttribute()
//     {
//         $strstatus=RoleUserfunctionMappers::where('function_id',$this->id)->select('status')->first();
//         return isset($strstatus->status)?$strstatus->status:false;
//    }
}
