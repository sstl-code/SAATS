<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelAdditionaliteam;

use App\Models\aditionalBatchProcess;
use DB;

class AdditionalBatchProcess extends Controller
{
    public function index(Request $request){
        //dd('index');
        $inserted_datetime_addiasset = $request->session()->get('inserted_datetime');
        if((!empty( $inserted_datetime_addiasset)) ){
            $asset_return = DB::table('ats.t_asset_dump AS t1')
            ->leftJoin('ats.t_location AS t2', 't1.tad_location_id', '=', 't2.tl_location_id')
            ->leftJoin('ats.t_asset AS t3', 't1.tad_asset_manufacture_serial_no', '=', 't3.ta_asset_manufacture_serial_no')
            ->select('t1.tad_location_id','t1.tad_asset_manufacture_serial_no','t1.tad_approve_reject_remarks','t1.tad_asset_active_inactive_status','t1.tad_validation_status','t1.tad_created_by','t1.tad_creation_date','t1.tad_approved_rejected_by','t1.tad_approve_reject','t1.tad_effective_end_date','t1.tad_transactional_direction')
            ->where('tad_creation_date',$inserted_datetime_addiasset)
            //->where('stn_validation','!=','DONE')
            ->get();

            // print_r($asset_return);
            // die();
        return view('AdditionalIteamBatchProcess',compact('asset_return'));
    }
    else{
        return view('AdditionalIteamBatchProcess');
    }
}
public function assetbatch(Request $request){
    $file = $request->file('files');
    $data = Excel::import(new ExcelAdditionaliteam, $file);
   // $inserted_datetime = $request->session()->get('inserted_datetime');
   
   // echo '<pre>'; print_r($bulk_return);die($inserted_datetime);
  //  return view('batch_upload',compact('bulk_return'));
    //return redirect()->route('batch_upload');
    return redirect('/AdditionalIteamBatchProcess');
  //  return redirect()->route('route.name', [$param]);
   // location.reload()

}

    // public function additionitem(Request $request){

        
    //     $file = $request->file('files');
    //     $data = Excel::import(new ExcelAdditionaliteam, $file);
    //     $inserted_datetime = $request->session()->get('inserted_datetime');
    //     $bulk_return = DB::table('ats.t_asset_dump AS t1')
    //                     ->leftJoin('ats.t_location AS t2', 't1.tad_location_id', '=', 't2.tl_location_id')
    //                     //->leftJoin('ats.t_asset AS t3', 't1.stn_asset_id', '=', 't3.ta_asset_id')
    //                     ->select('t1.tad_location_id','t1.tad_asset_manufacture_serial_no','t1.tad_approve_reject_remarks','t1.tad_asset_active_inactive_status')
    //                     ->where('tad_creation_date',$inserted_datetime)
    //                     ->get();
    //     //echo '<pre>'; print_r($bulk_return);die;
    //     return view('AdditionalIteamBatchProcess',compact('bulk_return'));
    // }

}
