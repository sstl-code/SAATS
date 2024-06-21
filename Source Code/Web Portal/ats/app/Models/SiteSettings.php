<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSettings extends Model
{
    use HasFactory;
    
    protected $connection= 'pgsql';
    protected $table = 'product.t_site_settings';
    protected $primaryKey = 'id';
	protected $guarded = [];
    public $timestamps = true;
}
