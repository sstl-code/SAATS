<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\RoleUserMappers;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    //get function list
    public function getAllFunctions(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'userId' => 'required',
      
    ]);
    if ($validator->fails())
    {
      return ['message' => $validator->errors()->first(),'status'=>401];
    }
      $data=RoleUserMappers::where('user_id',$request->userId)->where('user_role_mapper_status','t')->first();
      $user=User::where('id',$request->userId)->first();
      return response()->json(['status' => 200,'data' =>$data->functions->pluck('function_url'),'user'=> $user]);
      
    }
}
