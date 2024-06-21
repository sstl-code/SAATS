<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUserfunctionMappers extends Model
{
    use HasFactory;
    protected $table='role_module_function_mapper';
    protected $guarded = ['id'];
}
