<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;
    protected $connection= 'pgsql';
    protected $table = 'product.t_operator';
	protected $primaryKey = 'op_id';
    protected $guarded = [];
    public $timestamps = false;

   
}
