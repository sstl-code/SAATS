<?php

namespace App\Models;

use App\Models\Location;
use App\Models\Operator;
use App\Models\Asset_type_model;
use App\Models\AssetHistoryModel;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use App\Models\Asset_type_attribute_model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetEditAttribute extends Model
{
    use HasFactory;
    protected $connection= 'pgsql';
	protected $table = 'ats.t_asset_edit_attribute';
	protected $primaryKey = 'id';
  //  protected $fillable = [ 'at_asset_type_attribute_master_id', 'at_asset_id', 'at_asset_attribute_code', 'at_asset_attribute_description', 'at_creation_date', 'at_asset_attribute_value_text','at_asset_attribute_name'];
  protected $guarded = [];  
  public $timestamps = false;

}
