<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mailLog extends Model
{
    use HasFactory;
    protected $connection= 'pgsql';
    protected $table = 'ats.mail_log';
    

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
