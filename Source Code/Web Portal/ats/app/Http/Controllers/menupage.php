<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class menupage extends Controller
{
    public function index() 
    {
        return view('menu_page');
    }

}