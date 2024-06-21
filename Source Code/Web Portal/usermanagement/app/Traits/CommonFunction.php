<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use App\Models\PernlAccssTokenModel;
use Illuminate\Support\Facades\Auth;

trait CommonFunction
{
public static function auditTrail($event_name,$model_name,$data_id,$old_data,$new_data,$user_id,$source){
     

    $url  = env("SATS_URL")."api/audit_trail";
   
  

    $postData = array(
        'event_name' => $event_name,
        'model_name' => $model_name,
        'data_id' => $data_id,
        'old_data' => $old_data,
        'new_data' => $new_data,
        'user_id' => $user_id,
        'source' => $source
    );

     
     $token = Auth::user()->createToken('Token Name')->accessToken;
     
   
     $authorization_id=$token->id;
     $authriz_token=PernlAccssTokenModel::where('id',$authorization_id)->first();
     $authorization = "Authorization: Bearer ". $authriz_token->token;
   
  //return($authorization);

    // Initialize a cURL session
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' ,$authorization));
    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
    $response = curl_exec($ch);

    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    return $response;
}
}