<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit_Details_Model extends Model
{
    use HasFactory;
    protected $connection= 'pgsql';
    protected $table = 'ats.t_asset_audit_details';
    protected $primaryKey = 'ad_asset_audit_details_id';
    protected $guarded =[];
    public $timestamps = false;
}
