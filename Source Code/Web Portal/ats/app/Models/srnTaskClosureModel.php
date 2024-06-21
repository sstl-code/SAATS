<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class srnTaskClosureModel extends Model
{
    use HasFactory;
    protected $connection= 'pgsql';
    protected $table = 'ats.t_srn';
    protected $fillable = ['srn_id','srn_loaction_id','srn_location_name','srn_location_address', 'srn_asset_type_code', 'srn_asset_name','srn_asset_manufacture_serial_no','srn_asset_status','srn_asset_id','srn_task_id','srn_asset_tag_number','srn_remarks','srn_creation_date','srn_created_by','srn_effective_start_date','srn_last_updated_date','srn_last_updated_by','srn_effective_end_date','srn_file_name','srn_approve_reject','srn_approve_reject_remarks','srn_approved_rejected_by'];
    public $timestamps = false;
}
