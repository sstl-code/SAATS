<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class srnModal extends Model
{
    use HasFactory;
    protected $connection= 'pgsql';
    protected $table = 'ats.t_srn_insert';
    protected $fillable = ['srn_location_id','srn_asset_id','srn_creation_date','srn_insert_asset_manufacture_serial_no', 'srn_remarks', 'srn_file_name'];
    public $timestamps = false;
}
