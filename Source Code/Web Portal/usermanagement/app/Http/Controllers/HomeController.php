<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard(){
        $moduleData = Module::with('functions')->where('dashBoardCheck',true)->get();
        return view('dashboard',compact('moduleData'));
    }
}
