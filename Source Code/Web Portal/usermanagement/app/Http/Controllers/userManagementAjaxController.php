<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use App\Models\Module;
use App\Models\Functions;
use App\Models\Policies;
use Illuminate\Http\Request;
use App\Models\RoleUserMappers;
use App\Models\RoleUserfunctionMappers;

class userManagementAjaxController extends Controller
{
    //module search
    public function searchFunction(Request $request)
    {
        $searchTerm = strtoupper($request->input('search'));
        
        $modules=Functions::where('module_id',$request->moduleusrid)->whereRaw("upper(function_name) LIKE '"."%{$searchTerm}%'")->get();
        
        $formattedModules = [];
        foreach ($modules as $module) {
            $formattedModules[] = [
                'label' => $module->function_name,
                'value' => $module->function_name,
                'id'=>$module->id
            ];
        }
        return response()->json($formattedModules);
        
     }


     public function AllFunctionSearch(){
        $moduleData = Module::with(['functions' => function ($query) {
            $query->where('status', 't');
        }])->get();
        return response()->json($moduleData);
    }
   
     public function moduleName(Request $request){
        $roleModule = Module::get();
    //dd($roleModule);
        return response()->json([
            'status' => 'success',
            'roleModule' => $roleModule,
        ]);
    }


    public function modalEditview($id){
        $modalData = User::find($id);
        if($modalData)
        {
            return response()->json([
                'status'=>200,
                'modalData'=>$modalData
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>"Not Found"
            ]);
        }
    }

    public function roleEditview($id){
        $roleView = Roles::find($id);
        if($roleView)
        {
            return response()->json([
                'status'=>200,
                'roleView'=>$roleView
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>"Not Found"
            ]);
        }
    }

    // Method for searching roles
    public function searchRole(Request $request)
{
    $searchTerm = strtoupper($request->input('search'));
    //$roles = Roles::where('role_name', 'like', '%' . $searchTerm . '%')->get();
    $roles = Roles::whereRaw("upper(role_name) LIKE '"."%{$searchTerm}%'")->get();
    $formattedRoles = [];
    foreach ($roles as $role) {
        $formattedRoles[] = [
            'label' => $role->role_name,
            'value' => $role->role_name,
            'Role_id'=>$role->id
        ];
    }

    return response()->json($formattedRoles);
    }

        // Method for searching users
        public function searchUser(Request $request)
        {
            $searchTerm = strtoupper($request->input('search'));
            //$roles = Roles::where('role_name', 'like', '%' . $searchTerm . '%')->get();
            $users = User::whereRaw("upper(name) LIKE '"."%{$searchTerm}%'")->get();
            $formattedUsers = [];
            foreach ($users as $user) {
                $formattedUsers[] = [
                    'label' => $user->name,
                    'value' => $user->name,
                    'email' => $user->email,
                    'userId'=>$user->id
                ];
            }
        
            return response()->json($formattedUsers);
            }
//method for role method function status
            public function functionName(Request $request){
                //$statusMod = Module::with('RoleUserfunctionMappers')->get();
                //dd($statusMod);
                $moduleDataAjax = Module::with(['functions' => function ($query) {
                    $query->where('status', 't');
                }])->where('id', $request->Module_id)->first();                
                array_walk($moduleDataAjax->functions,"self::getFunctionStatus",$request->role_id);
                return response()->json([
                    'status'=>'success',
                    'moduleDataAjax'=>$moduleDataAjax,
                  ]);
            }
            public function getFunctionStatus(&$value, $key, $roleId)
            {
                if (is_array($value)) {
                   for($i=0;$i<count($value);$i++)
                   {
                    $fid = (int)($value[$i]->id);
                    $strstatus = RoleUserfunctionMappers::where('function_id', $fid)->where('role_id', $roleId)->first();
                    // Modify the array element if it's an array
                    if(!empty($strstatus)){
                    $value[$i]->functionStatus =$strstatus->status ;
                    }else{
                        $value[$i]->functionStatus =false;
                    }
                    }
                } else {
                    // Handle the case when $value[0] is not an array
                    // You may want to log an error or perform other actions.
                }
            }
//method for role user status          
public function roleAllName(Request $request)
{
    //dd($request->User_id);
    $user_id = $request->User_id;
    $roleModule = Roles::all();

    foreach ($roleModule as $role) {
        $rid = (int)($role->id);
        $strstatus = RoleUserMappers::where('role_id', $rid)->where('user_id', $user_id)->first();
        
        if (!empty($strstatus)) {
            $role->functionStatus = $strstatus->user_role_mapper_status;
        } else {
            $role->functionStatus = false;
        }
    }

    // Add some debugging output to check the values
    // dd($roleModule); // Uncomment this line for debugging

    return response()->json([
        'status' => 'success',
        'roleModule' => $roleModule
    ]);
}

public function removeRoleSearch(){
    $roleSearchData = Roles::all();
    return response()->json($roleSearchData);
}

public function removeUserSearch(){
    $userSearchData = User::all();
    return response()->json($userSearchData);
}

public function updatePolicyValue(Request $request)
{
    $policyId = $request->input('policyId');
    $newValue = $request->input('newValue');

    // Assuming you have a Policy model
    $policy = Policies::find($policyId);

    if ($policy) {
        // Update the policy value
        $policy->policy_Value = $newValue;
        $policy->save();

        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false, 'message' => 'Policy not found'], 404);
    }
}

public function getPasswordPolicy()
    {
        $passwordPolicyjs = Policies::where('policy_status', true)->get();
        return response()->json($passwordPolicyjs);
    }
}