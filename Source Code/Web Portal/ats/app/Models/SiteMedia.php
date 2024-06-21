<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteMedia extends Model
{
    use HasFactory;
    protected $connection= 'pgsql';
    protected $table = 'ats.site_media';
    protected $primaryKey = 'id';
	protected $guarded = [];
    public $timestamps = true;
}
