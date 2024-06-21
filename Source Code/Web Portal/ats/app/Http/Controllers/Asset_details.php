<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\asset;
use App\Class\PMClass;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\AssetHistoryModel;
use App\Models\AssetTaggingHistory;
use Illuminate\Support\Facades\Auth;
use App\Models\Supervisor_to_technician;


class Asset_details extends Controller
{
    
    public function index() 
    {   
    return view('AssetDetails');
    }
    public function supervisor() 
    {   //$userdetail=Supervisor_to_technician::with('technician_details','supervisor_details')->get();
        if(Auth::user()->is_admin){
            $userdetail=Supervisor_to_technician::with('technician_details','supervisor_details')->get();
        }else{
           $userdetail=Supervisor_to_technician::with('technician_details','supervisor_details')->where('supervisor_id',Auth::id())->get();
        }
        $alluser=User::get();
        $PMClass = new PMClass();
        $accessToken = $PMClass->pm_login( env('PM_USERNAME'),env('PM_PASSWORD'));
        $pmdata = $PMClass->pm_all_users_or_group($accessToken,'users');
      //dd($pmdata);
        $filteredData = collect($pmdata)->map(function ($item) {
            return [
                'user_id' => $item->usr_uid,
                'usr_firstname' => $item->usr_firstname,
                'usr_lastname' => $item->usr_lastname,
                'usr_email' => $item->usr_email,
            ];
        })->toArray();
        ksort($filteredData);
    return view('Supervisor_to_technician_mapping', compact('userdetail','alluser', 'filteredData'));
    }
    public function AssetDetails(Request $request)
    {
        $asstdetail=asset::where('ta_asset_id',$request->asst_id)->get();
        $ParentAssetDetails=asset::where('ta_asset_id',$asstdetail[0]->ta_asset_parent_id)->first();
        $location_id=$asstdetail[0]->ta_asset_location_id;
        //dd($location_id);
        $site_details=Location::where('tl_location_id',$location_id)->get();

        $site_asset_history=AssetTaggingHistory::where('th_location_id',$location_id)->where('th_asset_id',$request->asst_id)->get();
        // print_r(json_encode($asstdetail));asstdetail
        // die();
        
        return response()->json([
            'status'=>'success',
            'assetdetails'=>$asstdetail,
            'parentdetails'=>$ParentAssetDetails,
            'site_details'=>$site_details,
            'Tag_history'=>$site_asset_history
          ]);
    }
    public function supervisor_technician_mapping(Request $request){
        $technician_id = $request->technician_id;
        $supervisor_id = $request->supervisor_id;
        $supervisor_mail = $request->supervisor_mail;
        $PMClass = new PMClass();
        $accessToken = $PMClass->pm_login( env('PM_USERNAME'),env('PM_PASSWORD'));
        $pmdata = $PMClass->pm_get_user($accessToken,'users?filter='.$supervisor_mail);
        //dd($pmdata);
        $filteredData = collect($pmdata)->map(function ($item) {
            return [
                'user_id' => $item->usr_uid,
                'usr_firstname' => $item->usr_firstname,
                'usr_lastname' => $item->usr_lastname,
                'usr_email' => $item->usr_email,
            ];
        })->toArray();
        $pmuser_id=$filteredData[0]['user_id'];
        $user_id = User::where('email', $supervisor_mail)->first(['id']);
       $countdata= Supervisor_to_technician::where('technician_id',$technician_id)->where('supervisor_id',$supervisor_id)->count();
      if($countdata>0)
      {
        return response()->json([
            'status'=>'fail',
            'code'=>'404'
          ]);
      }else{
       Supervisor_to_technician::create([
            'technician_id'=>$technician_id,
            'supervisor_id'=> $supervisor_id ,
            'pm_user_id'=>$pmuser_id,
            'created_at'=>Carbon::now(),
        ]);
        return response()->json([
            'status'=>'success',
            'code'=>'200'
          ]);
        }
    }
    public function technician_delete(Request $request){
        Supervisor_to_technician::where('id',$request->id)->delete();
        return redirect('Operator_to_technician');
    }

   

}