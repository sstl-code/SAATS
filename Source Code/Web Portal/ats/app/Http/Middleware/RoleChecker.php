<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\RoleUserMappers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect; 
use Symfony\Component\HttpFoundation\Response;

class RoleChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId=Auth::check() ? Auth::user()->id:"";
        
        if($userId){
        $userId=Auth::check() ? Auth::user()->id:"";
        
        $access=$this->getAllFunctions($userId);
   
             if($access && in_array(basename(request()->path()), $access->toArray())|| Auth::user()->is_admin)
             {
                return $next($request);
            }

        }
        return Redirect::to(url('unauthorize'));
    }
    public function getAllFunctions($userId)
    {
    
      $data=RoleUserMappers::where('user_id',$userId)->where('user_role_mapper_status','t')->first();
      return $data->functions->pluck('function_url');
      
    }
}

