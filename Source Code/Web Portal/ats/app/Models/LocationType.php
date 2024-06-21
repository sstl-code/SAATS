<?php

namespace App\Models;

use App\Traits\Observable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationType extends Model
{
    use HasFactory,Observable;
    protected $connection= 'pgsql';
    protected $table = 'product.t_location_type_master';
    public $timestamps = false;

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'lt_location_type_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
