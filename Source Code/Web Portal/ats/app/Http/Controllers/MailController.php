<?php

namespace App\Http\Controllers;

use Exception;
use Validator;
use App\Models\User;
use App\Models\asset;
use App\Models\mailLog;
use App\Models\FarToAts;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\Supervisor_to_technician;

class MailController extends Controller
{
    public function sendMessage(Request $request)

    {
        //Log::debug($request);
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'notification_type' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'=>404,
                'errors'=>$validator->errors()->first(),
            ]);
    
        }else{
            
            try{
                $supervisor_id=$this->findSupervisor($request->user_id);
             switch($request->notification_type)
             {
              case 'unassignedSite':
              
                if (empty($request->location)) {
                    return response()->json([
                        'status'=>404,
                        'errors'=>"Location Missing",
                    ]);    
                }
             //   $supervisor_details=Supervisor_to_technician::where('technician_id',$request->user_id)->first(['supervisor_id', 'pm_user_id']);
                
                $supervisor_details=Supervisor_to_technician::where('supervisor_id',$supervisor_id)->first(['supervisor_id', 'pm_user_id']);
                //Log::debug($supervisor_details);
                $technician=User::where('id',$request->user_id)->first(['email','name']); 
                //Log::debug($technician);
                $location=Location::where('tl_location_id',$request->location)->first();
                //Log::debug($location);
                $supervisorData=User::where('id',$supervisor_id)->first(['email','name']); 

                $tomail=$supervisorData->email;
                //Log::debug($supervisorData);
                mailLog::create(['mail_type'=>'unassignedSite','subject'=>'Unassigned Site Access Notification','mail_to'=>$tomail,'mail_body'=>'This is to notify that a technician user '.$technician['name'].' ('.$technician['email'].') has accessed site '.$location->tl_location_code."-".$location->tl_location_name.' which is not assigned to him. ']);
                
               break;
               case 'srnNotMatching' :

                    $ManSerialNo=asset::where('ta_asset_id',$request->asset_id)->first(['ta_asset_manufacture_serial_no']);
                    $SRNDetails=FarToAts::where('f2a_manufacture_serial_no', $ManSerialNo->ta_asset_manufacture_serial_no)->where('f2a_type','SRN')->select('f2a_file_name','f2a_site_code')->orderBy('created_at','desc')->first();
                    $ManufacturalNo=$ManSerialNo->ta_asset_manufacture_serial_no;

                    $SRNFileName1=$SRNDetails->f2a_file_name;
                    $path_parts = explode("/", $SRNFileName1);
                    $SRNFileName= str_replace(".xlsx","",$path_parts[count($path_parts)-1]);
                    $SRNSiteCode=$SRNDetails->f2a_site_code;
                    $supervisorData=User::where('id',$supervisor_id)->first(['email','name']); 
                    $tomail=$supervisorData->email;
                    $mail_body = 'SRN'. $SRNFileName .' not matching  for Asset Serial No: '. $ManufacturalNo. ' at site: '. $SRNSiteCode;
                   
                    //Log::debug($tomail);
                    //Log::debug($mail_body);
                        mailLog::create(['mail_type' => 'srnNotMatching', 'subject' => 'SRN Not Matching', 'mail_to' => $tomail, 'mail_body' => $mail_body]);
               break;
               case 'assetMissing':
                if (empty($request->asset_id)) {
                    return response()->json([
                        'status'=>404,
                        'errors'=>"asset_id Missing",
                    ]);    
                }
               $asset=asset::where('ta_asset_id',$request->asset_id)->first();
                $tomail=env('NOTIFY_FAR');   
                $location=Location::where('tl_location_id',$request->location)->first();
                mailLog::create(['mail_type'=>'assetMissing','subject'=>'Asset Missing Notification','mail_to'=>$tomail,'mail_body'=>'This is to notify that an asset '.$asset->ta_asset_name.', SL#'.$asset->ta_asset_manufacture_serial_no.' is showing at site '.$location->tl_location_code .' but the asset is actually missing at the site location.']); 
                break;
                case 'tagMissing':
                    $supervisor_details=Supervisor_to_technician::where('supervisor_id',$supervisor_id)->first(['supervisor_id','technician_id', 'pm_user_id']);
                    $supervisorData=User::where('id',$supervisor_details["technician_id"])->first(['email','name']);    
                    if (empty($request->asset_id)) {
                        return response()->json([
                            'status'=>404,
                            'errors'=>"asset_id Missing",
                        ]);    
                    }
                    $asset=asset::where('ta_asset_id',$request->asset_id)->first();
                   
                 $tomail=$supervisorData['email'];
                 $location=Location::where('tl_location_id',$request->location)->first();
                 mailLog::create(['mail_type'=>'tagMissing','subject'=>'TAG Missing Notification','mail_to'=>$tomail,'mail_body'=>'This is to notify that the TAG is missing for asset '.$asset->ta_asset_name.', SL#'.$asset->ta_asset_manufacture_serial_no.' at site '.$location->tl_location_code.', please attach the TAG to the Asset as per defined operating procedure.']); 
                break;
               case 'isAssetDetailsMatching':
                if (empty($request->asset_id)) {
                    return response()->json([
                        'status'=>404,
                        'errors'=>"asset_id Missing",
                    ]);    
                }
                $supervisor_details=Supervisor_to_technician::where('supervisor_id',$supervisor_id)->first(['supervisor_id','technician_id', 'pm_user_id']);
                $supervisorData=User::where('id',$supervisor_details["technician_id"])->first(['email','name']);    
                $asset=asset::where('ta_asset_id',$request->asset_id)->first();
                $location=Location::where('tl_location_id',$request->location)->first();
                $tomail=$supervisorData['email'];

                 mailLog::create(['mail_type'=>'isAssetDetailsMatching','subject'=>'Asset Details Mismatch Notification','mail_to'=>$tomail,'mail_body'=>'This is to notify that the asset details at the system are not matching with the actual asset details of asset at the site '.$location->tl_location_code.' for asset '.$asset->ta_asset_name.', SL#'.$asset->ta_asset_manufacture_serial_no.', please modify the data accordingly.']); 
        
               break;
            
             }  
       
       
     //   \Mail::to($tomail)->send(new \App\Mail\NotificationMail($details));
       
        return response()->json([
            "status"=>200,
            "message"=>"Mail sent"
        ]);

       }
        catch(Exception $e)
        {
            return response()->json([
                "status"=>404,
                "message"=>$e->getMessage()
            ]);
            //Log::debug($e->getMessage());
        }
     }
    }
    
    public function findSupervisor($userId)
    {
        //Log::debug($userId);
       $user=User::where('id',$userId)->first();
       if($user->is_supervisor)
       {
        //Log::debug($userId);
        return $userId;
       }
       else{
         $user=Supervisor_to_technician::where('technician_id',$userId)->first();
         //Log::debug($user);
         return $user->supervisor_id;
       }
    }
}
