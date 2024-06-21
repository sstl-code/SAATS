<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class auditbatchasset extends Model
{
    use HasFactory;
    protected $connection= 'pgsql';
    protected $table = 'ats.t_audit_insert';
    protected $fillable = ['ai_id','ai_location_id','ai_location_code','ai_created_by', 'ai_creation_date','ai_last_updated_date','ai_assigned_user_id','ai_assigned_user_name','ai_effective_end_date','ai_completion_date','ai_validation_status','ai_remarks','ai_assigned_user_email'];
    public $timestamps = false;
}
