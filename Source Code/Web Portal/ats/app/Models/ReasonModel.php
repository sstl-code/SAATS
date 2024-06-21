<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReasonModel extends Model
{
    use HasFactory;
    protected $connection= 'pgsql';
    protected $table = 'product.t_reason_master';
	protected $primaryKey = 'rm_reason_id';
    protected $guarded = ['rm_reason_id'];
    public $timestamps = false;
}
