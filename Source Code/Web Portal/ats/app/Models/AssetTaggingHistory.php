<?php

namespace App\Models;

use App\Models\User;
use App\Traits\Observable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetTaggingHistory extends Model
{
    use HasFactory,Observable;
    protected $connection= 'pgsql';
    protected $table = 'ats.t_tagging_history';
    protected $guarded = [];
    protected $appends = ["UserName"];

    public function getUserNameAttribute()
    {  
        $username=User::where('id',$this->th_asset_tagged_by)->first();
        return $username->name;
    }
    public function getCreatedAtAttribute($value) {
        if($value!=""){
        return $this->attributes['created_at']=date('d-M-Y H:i:s',strtotime($value));
        }
      }
    
}
