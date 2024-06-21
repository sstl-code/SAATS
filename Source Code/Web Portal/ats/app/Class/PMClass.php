<?php

namespace App\Class;
use CURLFile;
use Illuminate\Support\Facades\Log;

class PMClass
{
    public function pm_login($username,$password)
   {
        $pmServer    = env('PM_SERVER');
        $pmWorkspace = env('PM_WORKSAPCE');
        $postParams = array(
            'grant_type'    => 'password',
            'scope'         => '*',       //set to 'view_process' if not changing the process
            'client_id'     => env('PM_CLIENTID'),
            'client_secret' => env('PM_CLIENT_SECRET'),
            'username'      =>$username,
            'password'      =>$password
        );
	 
	   $ch = curl_init("$pmServer/$pmWorkspace/oauth2/token");
	   
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postParams);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$oToken = json_decode(curl_exec($ch));
		$httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
       
        $accessToken='';
		isset($oToken->access_token)?$accessToken = $oToken->access_token:'';
        return  $accessToken;
   }

    public function get_act_uid($project_id, $token)
    {
        $pmServer    = env('PM_SERVER');
        $pmWorkspace = env('PM_WORKSAPCE');
	    $ch = curl_init("$pmServer/api/1.0/$pmWorkspace/project/$project_id");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $token));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $aCases = json_decode(curl_exec($ch));
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $aCases->diagrams[0]->activities[0]->act_uid;
   }

   public function assign_task_users($project_id, $token, $task_id, $pm_user_id){
        $pmServer    = env('PM_SERVER');
        $pmWorkspace = env('PM_WORKSAPCE');
        $postParams = array(
            'aas_uid'  =>$pm_user_id,
            'aas_type' => env('PM_GROUP_TYPE')
        );
    
        $ch = curl_init("$pmServer/api/1.0/$pmWorkspace/project/$project_id/activity/$task_id/assignee");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $token));
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postParams);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $oToken = json_decode(curl_exec($ch));
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $aVars = array(
            'pro_uid'   => $project_id,
            'tas_uid'   => $task_id,
            'usr_uid'   => $pm_user_id
         );
      
         $url = "/api/1.0/workflow/cases/impersonate";
      
         $ch1 = curl_init("$pmServer$url");
         curl_setopt($ch1, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $token));
         curl_setopt($ch1, CURLOPT_TIMEOUT, 30);
         curl_setopt($ch1, CURLOPT_POST, 1);
         curl_setopt($ch1, CURLOPT_POSTFIELDS, $aVars);
         curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
         $oRet = json_decode(curl_exec($ch1));
         $httpStatus = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
         curl_close($ch1);
         
        return $oRet;
    }

    public function pm_project_import($filename, $accessToken){
        $url  = env('PM_SERVER')."/api/1.0/".env('PM_WORKSAPCE')."/project/import";
        $projectFilePath = public_path($filename);
        $header = array(
              "Authorization: Bearer " . $accessToken
        );
        $aPost = array(
            "project_file" => new CURLFile($projectFilePath)
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $aPost);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $arrayResponse = (array)(json_decode(curl_exec($ch)));
        curl_close($ch);
        if (!isset($arrayResponse["prj_uid"])) {
           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, $url . "?option=keep&option_group=create");
           curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
           curl_setopt($ch, CURLOPT_POSTFIELDS, $aPost);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
           $arrayResponse = (array)(json_decode(curl_exec($ch)));
           curl_close($ch);
           //var_dump($arrayResponse);
        }

        return $arrayResponse;
    }
    public function pm_all_users_or_group($token, $type){
        $pmServer    = env('PM_SERVER');
        $pmWorkspace = env('PM_WORKSAPCE');
        $ch = curl_init("$pmServer/api/1.0/$pmWorkspace/$type");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $token));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $aCases = json_decode(curl_exec($ch));
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $aCases;
    }
    public function pm_get_user($token, $type){
        $pmServer    = env('PM_SERVER');
        $pmWorkspace = env('PM_WORKSAPCE');
        $ch = curl_init("$pmServer/api/1.0/$pmWorkspace/$type");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $token));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $aCases = json_decode(curl_exec($ch));
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $aCases;
    }
    public function getDraftcases($accessToken)
    {
        $pmServer    = env('PM_SERVER');
        $pmWorkspace = env('PM_WORKSAPCE');
        $ch = curl_init($pmServer . "/api/1.0/workflow/cases/draft");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $accessToken));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $aCases = json_decode(curl_exec($ch));
    
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $keys = array_column($aCases, 'del_init_date');
        array_multisort($keys, SORT_DESC, $aCases);
        return $aCases;
    }
}