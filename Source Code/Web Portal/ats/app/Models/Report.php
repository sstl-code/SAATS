<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Report extends Model
{
    use HasFactory;
    
    protected $table = 'product.t_reports';
    protected $connection= 'pgsql';
    protected $guarded = [];
   
     

}
