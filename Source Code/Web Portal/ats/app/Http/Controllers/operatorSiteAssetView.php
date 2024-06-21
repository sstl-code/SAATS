<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Operator;
use Illuminate\Http\Request;

class operatorSiteAssetView extends Controller
{
    public function index() 
    {
        
        $operator_name=Operator::select('*')->get();
   
        return view('operatorSiteAssetView',compact('operator_name'));
    }

}