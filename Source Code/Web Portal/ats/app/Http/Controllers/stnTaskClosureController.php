<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\stnTaskClosureModel;
use App\Models\srnTaskClosureModel;
use DB;

class stnTaskClosureController extends Controller
{
    public function stnClosure() 
    {
        $stnTaskClosureCon = DB::table('ats.t_stn')
                            ->whereNull('stn_effective_end_date')
                            ->get();
        //$stnDate = date("d/m/y",strtotime($stnTaskClosureCon->stn_creation_date));
        $srnTaskClosureCon = DB::table('ats.t_srn')
                            ->whereNull('srn_effective_end_date')
                            ->get();
        return view('stnTaskClosure',compact('stnTaskClosureCon','srnTaskClosureCon'));
    }
}
