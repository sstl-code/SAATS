<?php
namespace App\Imports;


use App\Models\aditionalBatchProcess;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;
use DB;

class ExcelAdditionaliteam implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // dd('test');
        //print_r($collection->toArray());die();
         //dd($collection->toArray());
         $instdata=Carbon::now();

         $assetmanufacSerialNumber = DB::table('ats.t_asset')
         ->pluck('ta_asset_manufacture_serial_no')
         ->whereNull('ta_effective_end_date')
         ->toArray();
         $exist =  DB::table('ats.t_asset_dump')
         ->pluck('tad_asset_manufacture_serial_no')
         ->toArray();
         $innerCheck =array();
        foreach($collection as $row){
            //dd($row[1][0]);
            $tad_validation_status="EXIST";
            $tad_transactional_direction="NOT FAR TO ATS";
            if((!in_array($row['tad_asset_manufacture_serial_no'], $assetmanufacSerialNumber) && !in_array($row['tad_asset_manufacture_serial_no'], $exist ) && !in_array($row['tad_asset_manufacture_serial_no'], $innerCheck) ))
            {
                $tad_validation_status="DOSNT EXIST";
                $tad_transactional_direction="FAR TO ATS"; 
            }
            aditionalBatchProcess::create([
				'tad_location_id' => $row['tad_location_id'],
			    'tad_asset_manufacture_serial_no' => $row['tad_asset_manufacture_serial_no'],
				'tad_asset_active_inactive_status'=>$row['tad_asset_active_inactive_status'],
                'tad_creation_date' => $instdata,
                'tad_approve_reject_remarks'=>$row['tad_approve_reject_remarks'],
                'tad_approved_rejected_by'=>1,
                'tad_created_by' =>1,
                'tad_validation_status'=>$tad_validation_status,
                'tad_transactional_direction'=>$tad_transactional_direction,
                'tad_approve_reject'=>1,
                'tad_effective_end_date'=> Carbon::now(),
            ]);
        }
        
        Session::put('inserted_datetime', $instdata);
        //die($instdata);
         $data = [
             'inserted_datetime' => $instdata,
         ];
         //$request->session()->put('key', 'value');
         
        return $instdata;

    }
}