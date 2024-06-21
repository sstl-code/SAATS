<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Srn_insert_Model extends Model
{
	use HasFactory;
	protected $connection= 'pgsql';
    protected $table = 'ats.t_srn_insert';
	//protected $primaryKey = 'at_asset_attribute_id';
    public $timestamps = false;
	protected $guarded = [];
}
