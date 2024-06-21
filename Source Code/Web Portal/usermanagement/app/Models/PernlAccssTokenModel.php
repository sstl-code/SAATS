<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PernlAccssTokenModel extends Model
{
   
    use HasFactory;
    protected $table = 'public.personal_access_tokens';
    protected $guarded = [];
    protected $primaryKey = 'id';

  
}
