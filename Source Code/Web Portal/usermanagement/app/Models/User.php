<?php

namespace App\Models;
use App\Traits\CommonFunction;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,CommonFunction;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile_number',
        'user_address',
        'gender',
        'is_supervisor',
        'status',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        //'password' => 'hashed',
        
    ];
    
//     protected $appends=["UserRole"];
//     public function getUserRoleAttribute()
//     {
//         $strstatus=RoleUserMappers::where('user_id',$this->id)->select('user_role_mapper_status')->first();
//         return isset($strstatus->status)?$strstatus->status:false;
//    }
        public function getIsSupervisorAttribute()
        {
            return (bool)RoleUserMappers::where('user_id',$this->id)->where('user_role_mapper_status','t')->whereRaw("role_id in (select id from roles where lower(role_name)='supervisor')")->count();
           

        }

        public function administrators()
        {
            return $this->whereIn('id', function ($query) {
                $query->select('user_id')
                    ->from('role_user_mapper')
                    ->whereRaw('role_id IN (SELECT id FROM roles WHERE role_name = ? AND user_role_mapper_status = ?)', ['Administrator', 't']);
            })->get();
        }
}
