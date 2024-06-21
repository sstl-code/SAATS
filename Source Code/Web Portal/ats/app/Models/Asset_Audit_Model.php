<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset_Audit_Model extends Model
{
    use HasFactory;
    protected $connection= 'pgsql';
    protected $table = 'ats.t_asset_audit';
    protected $primaryKey = 'aa_audit_id';
    protected $guarded =[];
    public $timestamps = false;
    
}
