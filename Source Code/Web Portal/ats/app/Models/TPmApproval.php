<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TPmApproval extends Model
{
    use HasFactory;
    protected $connection= 'pgsql';
    protected $table = 'ats.t_pm_approval';
	protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
