<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Forgot_Password_phone extends Controller
{
    public function index(Request $request)
    {
        $userId=$request->get('userId');
        $userEmail=$request->get('userEmail');
        $email_verification=DB::table('usr.v_user_login')->where('tu_user_email',$userEmail)->first();
        $email=$email_verification->tu_user_email;
        $otp=rand(1234,9876);
        dd($otp);
        if(!empty($global_search_home)){
        return response()->json([
            "status"=>200,
            "data"=>$global_search_home,
        ]);
    }else{
        return response()->json([
            'status'=>'No data found',
        ]);
    }
    }
}
