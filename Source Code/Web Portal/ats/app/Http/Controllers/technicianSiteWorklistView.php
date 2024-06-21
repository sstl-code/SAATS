<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supervisor_to_technician;

class technicianSiteWorklistView extends Controller
{
    public function index() 
    {  
       
        // $userdetails=User::select('email as user_email','name as user_name','id as user_id')->where('is_supervisor',0)->get();
        //users
        $userdetails=Supervisor_to_technician::with('technician_details');
        if(!Auth::user()->is_admin){
            $userdetails->where('supervisor_id',Auth::id());
        }
        $userdetails=$userdetails->get();
        $userdetails=$userdetails->pluck('technician_details');
      
      
        $userdetails =collect( $userdetails )->unique();
       // Log::debug($userdetails);
        return view('technicianSiteWorklistView',compact('userdetails'));
    }

}