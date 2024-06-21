<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class change_passwordweb extends Controller
{
    
    public function index()
    {
    return view('change_password');
    }
}
