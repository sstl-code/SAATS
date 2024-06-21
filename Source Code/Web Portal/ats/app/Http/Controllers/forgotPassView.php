<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class forgotPassView extends Controller
{
    public function index() 
    {
        return view('forgot_password');
    }

}