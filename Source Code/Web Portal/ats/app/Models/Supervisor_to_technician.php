<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supervisor_to_technician extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection= 'pgsql';
    protected $table = 'ats.t_technician_supervisor_mappinng';
	protected $primaryKey = 'id';
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    public $timestamps = false;

    public function technician_details(): HasOne
    {  
        return $this->HasOne(User::class,'id','technician_id');
    }
    public function supervisor_details(): HasOne
    {  
        return $this->HasOne(User::class,'id','supervisor_id');
    }
}
