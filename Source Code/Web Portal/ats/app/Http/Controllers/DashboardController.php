<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }
    public function asset_view()
    {
        return view('asset_view');
    }
}
