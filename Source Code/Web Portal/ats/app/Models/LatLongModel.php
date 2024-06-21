<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatLongModel extends Model
{
    use HasFactory;
   
    protected $connection= 'pgsql';
    protected $table = 'ats.lat_long';
    

}
