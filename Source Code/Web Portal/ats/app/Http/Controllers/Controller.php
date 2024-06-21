<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function getAllFunctions($userId)
    {
    
      $data=RoleUserMappers::where('user_id',$userId)->where('user_role_mapper_status','t')->first();
      return response()->json(['status' => 200,'data' =>$data->functions->pluck('function_url')]);
      
    }
}
