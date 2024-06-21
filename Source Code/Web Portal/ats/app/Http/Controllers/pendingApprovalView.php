<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Location;
use App\Models\TPmApproval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class pendingApprovalView extends Controller
{
    public function index() 
    {
         $pmServer    = env('PM_SERVER');
       $pmWorkspace = env('PM_WORKSAPCE');
//         $postParams = array(
//             'grant_type'    => 'password',
//             'scope'         => '*',       //set to 'view_process' if not changing the process
//             'client_id'     => env('PM_CLIENTID'),
//             'client_secret' => env('PM_CLIENT_SECRET'),
//             'username'      => env('PM_USERNAME'),
//             'password'      => env('PM_PASSWORD')
//         );
 
//    $ch = curl_init("$pmServer/$pmWorkspace/oauth2/token");
   
//     curl_setopt($ch, CURLOPT_TIMEOUT, 30);
//     curl_setopt($ch, CURLOPT_POST, 1);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $postParams);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
//     $oToken = json_decode(curl_exec($ch));
//     $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//     curl_close($ch);
    
//     $accessToken = $oToken->access_token;

    $accessToken=session('PM_accesstoken');
    
    $ch = curl_init($pmServer . "/api/1.0/workflow/cases/draft");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $accessToken));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $aCases = json_decode(curl_exec($ch));

    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $keys = array_column($aCases, 'del_init_date');
    array_multisort($keys, SORT_DESC, $aCases);
    
       array_walk($aCases,"self::getTicketData");
     
        return view('pendingApproval', compact('aCases',  'accessToken'));
    }

    public function pendingApprovalAccept(Request $request){
      
        ini_set("soap.wsdl_cache_enabled", "0");
        //ini_set('error_reporting', E_ALL); //uncomment to debug
        //ini_set('display_errors', True);  //uncomment to debug
             
        $client = new \SoapClient(env('PM_SERVER').'/sysworkflow/en/neoclassic/services/wsdl2');
        $pass = 'md5:' . hash('sha256', env('PM_PASSWORD'));
        $params = array(array('userid'=>env('PM_USERNAME'), 'password'=>$pass));
        $result = $client->__SoapCall('login', $params);
         
        if ($result->status_code == 0) {
            $sessionId = $result->message;
             return $sessionId;  
            //     header("Location: env('PM_SERVER')/sysworkflow/en/neoclassic/cases/main?sid=$sessionId");
        }
        else {
            die("<html><body><pre> Unable to connect to ProcessMaker.\n" .
                "Error Message: $result->message");
        }
       /* $pmServer    = env('PM_SERVER');
        $token = $request->token;
        $pro_uid =  $request->pro_uid;
        $ch = curl_init($pmServer . "/api/1.0/workflow/project/".$pro_uid."/web-entry-events");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $token));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $aCases = json_decode(curl_exec($ch));
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $aCases[0]->wee_url;*/
    }
 public function getTicketData(&$value,$key)
 {
    $value->usrcr_usr_firstname=""; 
    $value->usrcr_usr_lastname="";
    $StrpmData=TPmApproval::where('pm_project_id',$value->pro_uid)->first();
    //Log::debug($value->pro_uid);
    if(!empty($StrpmData)){
        //Log::debug($StrpmData);
       
    $userData=User::where('id',$StrpmData->tpm_technician_id)->first();
    if(!empty($userData)){
    $value->usrcr_usr_firstname= $userData->name; 
    }
    $location=Location::where('tl_location_id',$StrpmData->tpm_asset_site_id)->first();
    if(!empty($location)){
    $value->usrcr_usr_lastname=$location->tl_location_code."-".$location->tl_location_address;
    }
    }
   
   
 }
}