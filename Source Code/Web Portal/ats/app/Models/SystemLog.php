<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\User;

class SystemLog extends Model
{
    use HasFactory;
    
    protected $table = 'system_logs';
    protected $connection= 'pgsql';
    protected $guarded = [];
    protected $appends = ["userdetails"];
   public function getuserdetailsAttribute(){
    $user_data=User::where('id',$this->user_id)->first();
        return $user_data;

   }
     

}
