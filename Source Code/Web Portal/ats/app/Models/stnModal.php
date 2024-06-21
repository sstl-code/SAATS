<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stnModal extends Model
{
    use HasFactory;
    protected $connection= 'pgsql';
    protected $table = 'ats.t_stn_insert';
    protected $fillable = ['stn_location_id','stn_asset_id','stn_creation_date','stn_insert_asset_manufacture_serial_no', 'stn_remarks', 'stn_file_name','stn_projectt_id','stn_comment','stn_image','far_to_ats_id','id','stn_created_by'];
    public $timestamps = false;
}
