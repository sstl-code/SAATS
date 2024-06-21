<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelFarMisMatchAsset extends Model
{
    use HasFactory;
    protected $connection= 'pgsql';
    protected $table = 'ats.t_asset_dump';
    protected $fillable = ['tad_asset_id','tad_asset_manufacture_serial_no','tad_location_id','tad_creation_date', 'tad_created_by','tad_asset_active_inactive_status','tad_validation_status','tad_approve_reject','tad_approve_reject_remarks','tad_approved_rejected_by','tad_effective_end_date','tad_asset_name','tad_asset_type_status','tad_asset_type_code'];
    public $timestamps = false;
}
