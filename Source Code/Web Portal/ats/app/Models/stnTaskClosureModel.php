<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stnTaskClosureModel extends Model
{
    use HasFactory;
    protected $connection= 'pgsql';
    protected $table = 'ats.t_user_location';
	protected $primaryKey = 'ul_user_location_id';
    protected $fillable = ['stn_id','stn_loaction_id','stn_location_name','stn_location_address', 'stn_asset_type_code', 'stn_asset_name','stn_asset_manufacture_serial_no','stn_asset_status','stn_asset_id','stn_task_id','stn_asset_tag_number','stn_remarks','stn_creation_date','stn_created_by','stn_effective_start_date','stn_last_updated_date','stn_last_updated_by','stn_effective_end_date','stn_file_name','stn_approve_reject','stn_approve_reject_remarks','stn_approved_rejected_by'];
    public $timestamps = false;
}
