<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class changePassword extends Controller
{
    public function changepassword(Request $request)
    {
       $userid = $request->userid;
       $oldPassword = $request->oldpassword;
       $newPassword = $request->password;
  
        $currentDateTime = Carbon::now();
        // $currentDateTime = '2023-05-22 07:59:08';
        // $currentDateTime = Carbon::now();
        // echo $currentDateTime;die();
        $userDetials = DB::table('usr.t_user_password')
        ->where(['up_user_id'=>$userid,'up_password'=>$oldPassword])
        ->orderBy('up_password_id', 'desc') // Assuming 'id' is the primary key column
        ->limit(5)
        ->pluck('up_password');
  
        $passwordMatched = false;
  
        foreach ($userDetials as $password) {
          if ($password == $newPassword) {
              $passwordMatched = true;
              break;
            }
        }

      
      if ($passwordMatched) 
      {
        
        return view()->json([
          'status' => 'Failed',
          'data' => "You can not use your last 5 password"
        ]);
      } 
      else 
      {
          DB::table('usr.t_user_password')->where('up_user_id',$userid)
          ->update([
            'up_effective_end_date' => $currentDateTime,
          ]);
  
          $createNewpass = ['up_user_id'=>$userid,'up_creation_date'=>$currentDateTime,'up_created_by'=>'Admin','up_effective_start_date'=>$currentDateTime,'up_last_updated_date'=>$currentDateTime,'up_last_updated_by'=>'Admin','up_effective_end_date'=>null,'up_password'=>$newPassword];
  
          // $createNewpass = ['up_user_id'=>$userid,'up_creation_date'=>$currentDateTime];
          
          $getLastInsertedID = DB::table('usr.t_user_password')->insert($createNewpass);
  
          // $test = $getLastInsertedID->toSql();
          // die($test);
          return response()->json([
            'status' => 'Success',
            'data' => $getLastInsertedID
          ]);
      }
    }
}