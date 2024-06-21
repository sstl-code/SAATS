<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileStore extends Model
{
    use HasFactory;
    protected $connection= 'pgsql';
    protected $table = 'ats.t_file_upload';
    protected $primaryKey = 'id';
	protected $fillable = ['file_name', 'created_at', 'file_name_output', 'updated_at'];
    public $timestamps = false;
}
