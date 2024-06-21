<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function checkSession()
    {
        return response()->json(['guest' => Auth::guest()]);
    }
}