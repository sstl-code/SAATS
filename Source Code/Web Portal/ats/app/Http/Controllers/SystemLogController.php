<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\SystemLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SystemLogController extends Controller
{
    public function index(Request $request) 
    {
       
         $SystemLogDetails=SystemLog::orderByRaw('date(created_at) DESC')->get();
      $Users=User::get();
       
        if(isset($request->start_date)){
        $Systemlogsearch=SystemLog::whereRaw("date(created_at) between '".Carbon::parse($request->start_date)->format('Y-m-d') ."' AND '". Carbon::parse($request->end_date)->format('Y-m-d')."'");
        if(isset($request->user_id)&&!empty($request->user_id)){
            $Systemlogsearch=$Systemlogsearch->where('user_id',$request->user_id);
        }
        $SystemLogDetails=$Systemlogsearch->orderByRaw('date(created_at) DESC')->get();
        
    }
    
       return view('SystemLogView',compact('SystemLogDetails','Users'));
        
       
    }
   
}
