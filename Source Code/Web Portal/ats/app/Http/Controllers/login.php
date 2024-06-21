<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use DB;
use Auth;
use App\Class\PMClass;
use Session;

class login extends Controller
{
    public function index() 
    {
        return view('login');
    }
   
  public function Weblogin(Request $request){
   
    $email = strtolower($request->email);
    $password = $request->password;

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
        if (Auth::attempt(['email' => $email, 'password' => $request->password])) {

            $PMClass = new PMClass();
            if(Auth::user()->is_admin){
              $accessToken = $PMClass->pm_login(env('PM_USERNAME'),env('PM_PASSWORD'));
            }else{
              $accessToken = $PMClass->pm_login($request->email,$request->password);
          }
       
            if(empty($accessToken)){
               Auth::logout();
               return redirect('/login')->withInput($request->only('email', 'password'))->withErrors([
                  'message' => 'PM User does not exist.',
              ]);
              }
         
            $formattedLoginTime = now()->format('jS F, Y H:i:s');
            $request->session()->put('login_time',$formattedLoginTime);
            
            session(['PM_accesstoken'=>$accessToken]);
            ini_set("soap.wsdl_cache_enabled", "0");
            ini_set('error_reporting', E_ALL); //uncomment to debug
            ini_set('display_errors', True);  //uncomment to debug
                 
            $client = new \SoapClient(env('PM_SERVER').'/sysworkflow/en/neoclassic/services/wsdl2');
            $pass = 'md5:' . hash('sha256', $request->password);
            $params = array(array('userid'=>$request->email, 'password'=>$pass));
            $result = $client->__SoapCall('login', $params);
             
            if ($result->status_code == 0) {
                $sessionId = $result->message; 
                  session(['PM_web_sessionId'=>$sessionId]);
                    header("Location: env('PM_SERVER')/sysworkflow/en/neoclassic/cases/main?sid=$sessionId");
            }
          
            return redirect('menu_page');
          
        }
        else
        {
          
           return redirect('/login')->withInput($request->only('email', 'password'))->withErrors([
             'message' => 'Incorrect User ID or password.',
         ]);

        }

           
        
    }

    public function logout(Request $request) {
       session_start();
        Auth::logout();
        Session::flush(); 
        session_destroy(); 
        return redirect('/login');
      }

    public function LoginfromuserMgmt(Request $request)
    {
      Auth::loginUsingId(base64_decode($request->token));
      $PMClass = new PMClass();
      //dd(Auth::user()->email);
      $accessToken = $PMClass->pm_login(Auth::user()->email,'Password@123');
   
      if(empty($accessToken)){
         Auth::logout();
         return redirect('/login')->withInput($request->only('email', 'password'))->withErrors([
            'message' => 'PM User does not exist.',
        ]);
        }
        session(['PM_accesstoken'=>$accessToken]);
      $formattedLoginTime = now()->format('jS F, Y H:i:s');
      $request->session()->put('login_time',$formattedLoginTime);
      return redirect('menu_page');
    }  

}

