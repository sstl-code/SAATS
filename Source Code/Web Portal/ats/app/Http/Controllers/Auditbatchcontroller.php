<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AuditBatch;
use App\Models\auditbatchasset;
use DB;

use Illuminate\Http\Request;

class Auditbatchcontroller extends Controller
{
    // public function index() {
    //        return view('ExcelFarmismatch'); }
 
           public function index(Request $request) {
            $audit_asset_user= $request->session()->get('inserted_datetime'); 
          
            if((!empty( $audit_asset_user))){
                $audit_user=DB::table('ats.t_audit_insert AS t1')
                ->leftJoin('ats.t_location AS t2', 't1.ai_location_code', '=', 't2.tl_location_code')
                ->leftJoin('usr.t_user AS t3', 't1.ai_assigned_user_id', '=', 't3.tu_user_id')
                ->select('t1.ai_id','t1.ai_location_id',
                't1.ai_location_code','t1.ai_created_by',
                't1.ai_creation_date','t1.ai_last_updated_date','t1.ai_assigned_user_id',
                't1.ai_assigned_user_name','t1.ai_effective_end_date','t1.ai_completion_date',
                't1.ai_validation_status','t1.ai_remarks','t1.ai_assigned_user_email')
                ->where('ai_creation_date',$audit_asset_user)
                //->where('tad_validation_status','!=','DONE')
                ->get();
    
                return view('AuditBatchAsset',compact('audit_asset_user'));
            }
        }
        public function inventorybulk(Request $request){
            $file = $request->file('files');
            $data = Excel::import(new AuditBatch, $file);
            return redirect ('/audit_batch');
         }
        
}
