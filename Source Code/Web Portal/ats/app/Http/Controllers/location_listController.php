<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supervisor_to_technician;
use App\Models\User_Location_Model;


class location_listController extends Controller
{
    public function index()
    {
        $userdetails=Supervisor_to_technician::where('supervisor_id',Auth::id())->select('technician_id')->get();
    
         $location_id=User_Location_Model::wherein('ul_user_id',$userdetails)->select('ul_location_id')->get();
        if(Auth::user()->is_admin){
             $locationlist=Location::with('assets_site')->orderby('tl_location_code')->get();
         }else{
        $locationlist=Location::with('assets_site')->wherein('tl_location_id',$location_id)->orderby('tl_location_code')->get();
        }
        
        //dd($locationlist);
       
       return view('location_view',compact('locationlist'));
    }
}