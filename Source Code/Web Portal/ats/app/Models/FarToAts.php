<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarToAts extends Model
{    
	use HasFactory;
    protected $connection= 'pgsql';
    protected $table = 'ats.t_far_to_ats';
    //protected $primaryKey = 'f2a_id';
    protected $primaryKey = 'id';
	// protected $fillable = ['far_to_ats_id', 'srn_asset_id', 'srn_remarks', 'srn_creation_date', 'srn_created_by', 'srn_projectt_id'];
    protected $guarded = [];

    public $timestamps = true;
}
