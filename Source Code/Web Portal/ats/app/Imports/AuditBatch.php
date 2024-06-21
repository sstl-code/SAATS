<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\auditbatchasset;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use DB;

class AuditBatch implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $instdata = Carbon::now();

        $locationId = DB::table('ats.t_asset')
        ->whereNull('ta_effective_end_date')
        ->pluck('ta_asset_location_id')
        ->toArray();

        $locationCode = DB::table('ats.t_location')
        ->whereNull('tl_effective_end_date')
        ->pluck('tl_location_code')
        ->toArray();

        $user_name = DB::table('usr.t_user')
        ->whereNull('tu_effective_end_date')
        ->pluck('tu_user_name')
        ->toArray();

        $user_code = DB::table('usr.t_user')
        ->whereNull('tu_effective_end_date')
        ->pluck('tu_user_id')
        ->toArray();

        $user_code = DB::table('usr.t_user')
                ->whereNull('tu_effective_end_date')
                ->pluck('tu_user_email')
                ->toArray();

        foreach($collection as $row){
            $ai_validation_status = "REJECT";
            
                
                
                $user_details = DB::table('usr.t_user')
                                ->where('tu_user_name', $row['ai_assigned_user_name'])
                                ->where('tu_user_id',  $row['ai_assigned_user_id'])
                                ->where('tu_user_email',  $row['ai_assigned_user_email'])
                                ->whereNull('tu_effective_end_date')
                                ->first();

                $location_details = DB::table('ats.t_location')
                                ->where('tl_location_code', $row['ai_location_code'])
                                ->whereNull('tl_effective_end_date')
                                ->first();

                if($user_details > 0 && $location_details > 0){
                    $ai_validation_status = "Accept";
                }

           
            ExcelFarMisMatchAsset::create([
                'ai_assigned_user_id' => $row['ai_assigned_user_id'],
                'ai_assigned_user_name' => $row['ai_assigned_user_name'],
                'ai_assigned_user_email'=>$row['ai_assigned_user_email'],
                'ai_location_code'=>$row['ai_location_code'],
                'ai_remarks'=>$row['ai_remarks'],
                'ai_validation_status'=>$ai_validation_status,
                'ai_creation_date' => $instdata,
            
                'ai_completion_date'=>Carbon::now(),
                'ai_created_by' => "Admin",
                'ai_last_updated_date'=>Carbon::now(),
                'ai_location_id'=>$locationId,
                'ai_effective_end_date'=> Carbon::now(),
            ]);

        }
        Session::put('inserted_datetime', $instdata);
        $data = [
            'inserted_datetime' => $instdata,
        ];
       return $instdata;

}
}
