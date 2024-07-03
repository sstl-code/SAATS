<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Roles;
use App\Models\Policies;
use App\Mail\WelcomeMail;
use App\Models\RoleUserMappers;
use App\Mail\NewUserNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Class\PMClass;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/success';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => strtolower($data['email']),
            'password' => Crypt::encrypt($data['password']),
            'mobile_number' => $data['mobile_number'],
            'user_address' => $data['user_address'],
            'gender' => $data['gender'],
            'is_supervisor' => isset($data['is_supervisor']) ? $data['is_supervisor'] : 0,
            'status' => 'pending',
            'is_admin'=>false,
        ]);
        if(isset($data['is_supervisor'])){
            $PMClass = new PMClass();
            $accessToken = $PMClass->pm_login(env('PM_USERNAME'),env('PM_PASSWORD'));
            $userdetails=["usr_username"=>strtolower($data['email']),'usr_firstname'=>$data['name'],'usr_email'=>$data['email'],'usr_new_pass'=>$data['password'],'usr_address'=>$data['user_address'],'usr_phone'=>$data['mobile_number']];
            $PMClass->createUser($accessToken,$userdetails);
            }
        $roleId = Roles::where('role_name', 'Supervisor')->first(['id']);
    
        $mapRoleMod = RoleUserMappers::updateOrCreate(
            [
                'user_id' => $user->id,
                'role_id' => $roleId->id,
            ],
            [
                'role_id' => $roleId->id,
                'user_name' => $data['name'],
                'user_id' => $user->id,
                'user_role_mapper_status' => isset($data['is_supervisor']) ? 1 : 0,
            ]
        );
    
        $adminUsers = $user->administrators();
        Mail::to($adminUsers)->send(new NewUserNotification($user));
    
        return $user;
    }
    public function showRegistrationForm()
    {
        $passworddata = Policies::where('policy_status', true)->select('policy_Name','policy_Value')->get();
        return view('auth.register',compact('passworddata'));
    } 
    
}
