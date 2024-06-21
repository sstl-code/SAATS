<?php

namespace App\Models;

use App\Models\Functions;
use App\Models\RoleUserfunctionMappers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleUserMappers extends Model
{
    use HasFactory;
    protected $table='role_user_mapper';
    protected $guarded = ['id'];
    protected $appends = ["functions"];
    protected $connection= 'user_db_connection';
    public function getfunctionsAttribute() {
        
        $functionAccess=RoleUserfunctionMappers::where('role_id',$this->role_id)->where('status',1)->get();
       return Functions::whereIn('id', $functionAccess->pluck('function_id'))->where('status',1)->get();
	}
}
