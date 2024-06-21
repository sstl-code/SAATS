<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset_Attribute extends Model
{
    use HasFactory;
    protected $connection= 'pgsql';
	protected $table = 'ats.t_asset_attribute';
	protected $primaryKey = 'at_asset_attribute_id';
    protected $fillable = ['at_asset_attribute_id', 'at_asset_type_attribute_master_id', 'at_asset_id', 'at_asset_attribute_code', 'at_asset_attribute_description', 'at_creation_date', 'at_asset_attribute_value_text','at_asset_attribute_name'];
    public $timestamps = false;
}
