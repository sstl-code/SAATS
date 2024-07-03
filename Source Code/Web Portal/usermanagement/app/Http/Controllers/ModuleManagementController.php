<?php

namespace App\Http\Controllers;

use Log;
use Session;
use Exception;
use App\Models\User;
use App\Models\Roles;
use App\Models\Module;
use App\Models\Policies;
use App\Mail\WelcomeMail;
use App\Models\Functions;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use App\Models\RoleUserMappers;
use App\Mail\NewUserNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Models\RoleUserfunctionMappers;
use App\Class\PMClass;

class ModuleManagementController extends Controller
{ 
    
    public function moduleManagement(){
        $moduleData = Module::with(['functions' => function ($query) {
            $query->where('status', 't');
        }])->get();
        //dd($moduleData);
        return view('module',compact('moduleData'));
    }

    public function functionManagement(){
        $FunctionManagement = Functions::all();
        return view('');
    }

    public function roleAdd(Request $request){
        $oldDataArray=[];
        try{
            if(!empty($request->id)){
                $oldData=Roles::where('id',$request->id)->first();
                $oldDataArray=[
                    'Role Name' => $oldData->role_name,
                    'Role Description' => $oldData->role_description,
                    
                               ];
                            }
                $role_Add=Roles::updateOrCreate(
            ['id'=>$request->id],
            [
                'role_name'=>$request->role_name,
                'role_description'=>$request->role_description
            ]);
            $newData=[
                'Role Name' => $role_Add->role_name,
                'Role Description' => $role_Add->role_description,
            ];
            if(!empty($oldDataArray)){
                $ResponseAuditTrail=CommonFunction::auditTrail('Role Modification','Module',$request->id,$oldDataArray,$newData,Auth::user()->id,'User Management');

            }
            elseif(empty($oldDataArray)){
                $ResponseAuditTrail=CommonFunction::auditTrail('Role Addition','Module',$role_Add->id,$oldDataArray,$newData,Auth::user()->id,'User Management');
            }


            $message="Role Added Successfully";
        
            if(($request->id)!=null){
                $message="Role Updated Successfully";
            }
            Session::flash('Status',$message);
            return redirect('roleManagement');
        }catch(\Exception $e){
            \Log::error('Error adding user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while adding the Role.');
        }
    }

    public function roleModuleFunctionMap(Request $request){
        //print_r($request->all());die;
        $role_id=$request->role_id;
        $role_name=Roles::where('id', $role_id)->select('role_name')->first();
            $mapRoleMod=RoleUserfunctionMappers::updateOrCreate(
                ['module_id'=>$request->module_id,
                'function_id'=>$request->data_id,
                'role_id'=>$request->role_id,
            ],
                ['role_id'=>$request->role_id,
                 'role_name'=>$role_name->role_name,
                 'module_id'=>$request->module_id,
                 'function_id'=>$request->data_id,
                 'status'=>$request->status
                ]
            );
            return redirect('roleManagement');
 
    }  
    
    public function roleUserMap(Request $request){
        //print_r($request->all());die;
        $user_id=$request->user_id;
        $user_name=user::where('id', $user_id)->select('name')->first();
        //dd($user_name);
            $mapRoleMod=RoleUserMappers::updateOrCreate(
                ['user_id'=>$request->user_id,
                'role_id'=>$request->role_id,
            ],
                ['role_id'=>$request->role_id,
                 'user_name'=>$user_name->name,
                 'user_id'=>$request->user_id,
                 'user_role_mapper_status'=>$request->status
                ]
            );
            return redirect('userRoleMapp');
 
    } 

    public function rolemanagement(){
        $roleData = Roles::all();
        //$moduleData = Module::with('functions')->get();
        //$roleModule = Roles::with('Modules')->get();
        //dd($roleModule);
        return view('roleManagement',compact('roleData'));
    }

    public function dashboard(){
        $moduleData = Module::with('functions')->get();
        return view('dashboard',compact('moduleData'));
    }

    public function userManagement(){
        $userData = User::get();

        return view('userManagement',compact('userData'));
    }

    public function userDelete($id){
        $users = User::find($id);
        $users->delete();
        return redirect('userManagement');
    }

    public function success(){
        Auth::logout();
        return view('success');
    }

    public function statusAddUser(Request $request){
        // Get the user's ID from the request
        try{
        $id = $request->id;

        // Retrieve the user's password
        $user = User::where('id', $id)->first();
       
        $user_password = Crypt::decrypt($user->password); 
       
        $status_Add=User::updateOrCreate(
            ['id'=>$request->id],
            [
                'status'=>$request->status,
                'password' => Hash::make($user_password),
            ]);
            
            if ($request->status === 'active') {
            Mail::to($status_Add->email)->send(new WelcomeMail($status_Add,$user_password));
           // dd('yy');
            }
           
           
        }catch(Exception $e){
            
            $status_Add=User::updateOrCreate(
                ['id'=>$request->id],
                [
                    'status'=>$request->status,
                    
                ]);
                
                if ($request->status === 'active') {
                    $user_password="Your current password";
                Mail::to($status_Add->email)->send(new WelcomeMail($status_Add,$user_password));
               // dd('yy');
                }    
        }
        return redirect('userManagement');
    }

    protected function addUser(Request $request)
    {
     
        $oldDataArray=[];

     try{
       
        
        if(!empty($request->id)){
            //dd("inside");
        $oldData=User::where('id',$request->id)->first();

        $oldDataArray=[
           'User Name' => $oldData->name,
           'Email' => $oldData->email,
           'Mobile Number' => $oldData->mobile_number,
           'User Address'=>$oldData->user_address,
           'Gender'=>$oldData->gender,
           'Supervisor'=>$oldData->is_supervisor,
           'Admin'=>$oldData->is_admin,
                      ];
                    }
                    $user_Add=User::updateOrCreate(
                        ['id'=>$request->id],
                        [
                            'name' => $request->name,
                            'email' => strtolower($request->email),
                            'mobile_number' => $request->mobile_number,
                            'user_address'=>$request->user_address,
                            'gender'=>$request->gender,
                            'is_supervisor'=>isset($request->is_supervisor)?$request->is_supervisor:0,
                            'is_admin'=>false,   
                        ]);
                        
            $newData=[
                'User Name' => $user_Add->name,
                'Email' => $user_Add->email,
                'Mobile Number' =>$user_Add->mobile_number,
                'User Address'=>$user_Add->user_address,
                'Gender'=>$user_Add->gender,
                'Supervisor'=>$user_Add->is_supervisor,
                'Admin'=>$user_Add->is_admin,
                  ];

            $message="User Updated Successfully";
            $ResponseAuditTrail=CommonFunction::auditTrail('User Modification', 'User',$request->id,$oldDataArray,$newData,Auth::user()->id,'User Management'); 
                
            if (empty($request->id)){
                
                User::where('id', $user_Add->id)->update(['password'=> Crypt::encrypt($request->password),'status'=>'pending',]);
                $message='User Added Successfully';
                if(isset($request->is_supervisor)){
                $PMClass = new PMClass();
                $accessToken = $PMClass->pm_login(env('PM_USERNAME'),env('PM_PASSWORD'));
               
                $userdetails=["usr_username"=>strtolower($request->email),'usr_firstname'=>$request->name,'usr_email'=>$request->email,'usr_new_pass'=>$request->password,'usr_address'=>$request->user_address,'usr_phone'=>$request->mobile_number];
                $PMClass->createUser($accessToken,$userdetails);
                }
                $oldDataArray="";
                $newDataArray=User::where('id', $user_Add->id)->first();
                $newData=[
                    'User Name' => $newDataArray->name,
                    'Email' => $newDataArray->email,
                    'Mobile Number' =>$newDataArray->mobile_number,
                    'User Address'=>$newDataArray->user_address,
                    'Gender'=>$newDataArray->gender,
                    'Supervisor'=>$newDataArray->is_supervisor,
                    'Admin'=>$newDataArray->is_admin,
                    ];
                  $ResponseAuditTrail=CommonFunction::auditTrail('User Addition', 'User',$user_Add->id,$oldDataArray,$newData,Auth::user()->id,'User Management');
                 }
            
            $user_Add->passwordText=$request->password;
            
            $roleId=Roles::where('role_name','Supervisor')->first(['id']);
            
            $mapRoleMod=RoleUserMappers::updateOrCreate(
                ['user_id'=>$user_Add->id,
                'role_id'=> $roleId->id,
            ],
                ['role_id'=>$roleId->id,
                 'user_name'=>$request->name,
                 'user_id'=>$user_Add->id,
                 'user_role_mapper_status'=>isset($request->is_supervisor)?1:0,
                ]
            );
          
            //$message = session('Status');
          Session::flash('Status',$message);
            //Mail::to($user_Add->email)->send(new WelcomeMail($user_Add));
            $adminUsers = $user_Add->administrators();
            Mail::to($adminUsers)->send(new NewUserNotification($user_Add));
             return redirect('userManagement');
            
        } 
        catch(\Exception $e){
            \Log::error('Error adding user: ' . $e->getMessage());
          
            return redirect()->back()->with('error', 'An error occurred while adding the user.');
        }
       
    }

    public function checkexistingemail(Request $request){
        $user_Add=User::select('email')->where('email',$request->email)->first();
        //dd($request->email);
        //dd($user_Add);
        return response()->json([
            'status' => 'success',
            'emailcheck' =>$user_Add
          ]);

    }

    public function checkexistinRole(Request $request){
        $role_check=Roles::select('role_name')->where('role_name',$request->role_name)->first();
        
        return response()->json([
            'status' => 'success',
            'roleCheck' =>$role_check
          ]);

    }

   

    public function userRoleMapp(){
        $allUser = User::orderBy('name', 'asc')->get();
        return view('userRoleAssociation',compact('allUser'));
    }

    public function splashScreen(){
        return view('splashScreen');
    }
    
    public function changePass(){
        $passworddata = Policies::where('policy_status', true)->select('policy_Name','policy_Value')->get();
        return view('changePassword',compact('passworddata'));
    }

    public function passwordPolicy(){
        $policyData = Policies::all();
        return view('passwordPolicy',compact('policyData'));
    }

    public function polyStatus(Request $request)
    {
        // Retrieve data from the AJAX request
        $polId = $request->polId;
        $status = $request->status;
    
        // Update or create the record in the database
        Policies::updateOrCreate(
            ['id' => $polId],
            ['policy_status' => $status]
        );
    
        // Redirect to the 'passwordPolicy' route or page
        return redirect('passwordPolicy');
    }    
}
