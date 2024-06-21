<?php

namespace App\Http\Controllers;

use DB;
use Log;
use Auth;
use Response;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;


class userloginController extends Controller
{
   
   
  public function userLogin(Request $request){
    $email = strtolower($request->email);
    $password = $request->password;
//dd($email);
      $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
           
            
            return redirect('/login')->withInput($request->only('email', 'password'))->withErrors([
                'message' => $validator->errors()->all(),
            ]);
        }
        if (Auth::attempt(['email' => strtolower($request->email), 'password' => $request->password,'is_supervisor'=>'t','status'=>'active'])) {

          
            return redirect('dashboard');
        }
       elseif (Auth::attempt(['email' => strtolower($request->email), 'password' => $request->password,'is_admin'=>'t','status'=>'active'])) {

          
            return redirect('dashboard');
        }

        else
        {
          
           return redirect('/login')->withInput($request->only('email', 'password'))->withErrors([
             'message' => 'Incorrect User ID or password',
         ]);

        }

           
        
    }

    public function changepassword(Request $request)
{
    try{
    $input = $request->all();
    $userid = Auth::user()->id;
    //dd($userid);

    $rules = array(
        'oldpassword' => 'required',
        'password' => 'required|min:6',
        'confirm_password' => 'required|same:password'
    );

    $validator = Validator::make($input, $rules);

    if ($validator->fails()) {
        return redirect()->back()->with('error',$validator->Errors()->first());
    } else {
        $user = User::where('id', $userid)->first();

//dd($user);
        if (!(Hash::check(request('oldpassword'), $user->password))) {
            return redirect()->back()->with('error', 'Check your old password.');
        } elseif (Hash::check(request('password'), $user->password)) {
            return redirect()->back()->with('error', 'Please enter a password that is not the same as the current password.');
        } else {
            User::where('id', $userid)->update(['password' => Hash::make($input['password'])]);
            return redirect()->back()->with('success', 'Password updated successfully.');
        }
    }
}
catch(Exception $e){
    //Log::debug("fhhj");
    Log::error('Error adding user: ' . $e->getMessage());
    return redirect()->back()->with('error', 'An error occure during change password');
}

}
public function userLoginByToken(Request $request){
    Auth::loginUsingId(base64_decode($request->token));
    return redirect('/dashboard');
}
}
