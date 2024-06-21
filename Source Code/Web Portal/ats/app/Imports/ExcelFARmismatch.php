<?php

namespace App\Imports;

use App\Models\ExcelFarMisMatchAsset;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use DB;

class ExcelFARmismatch implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        try{
        $instdata = Carbon::now();
      
        $InventSerialNumber = DB::table('ats.t_asset')
                        ->pluck('ta_asset_manufacture_serial_no')
                        ->whereNull('ta_effective_end_date')
                        ->toArray();

        $exist =  DB::table('ats.t_asset_dump')
            ->pluck('tad_asset_manufacture_serial_no')
            ->toArray();

            $locationId = DB::table('ats.t_asset')
            ->pluck('ta_asset_location_id')
            ->whereNull('ta_effective_end_date')
            ->toArray();
            
            // $masterassetId= DB::table('ats.t_asset')
            // ->pluck('ta_asset_id')
            // ->whereNull('ta_effective_end_date')
            // ->toArray();
            $asset_type_code=DB::table('ats.t_asset')
            ->pluck('ta_asset_type_code')
            ->whereNull('ta_effective_end_date')
            ->toArray();

            $master_asset_type_code=DB::table('product.t_asset_type_master')
            ->pluck('at_asset_type_code')
            ->whereNull('at_effective_end_date')
            ->toArray();
           
            $asst_location_id = DB::table('ats.t_location')
            ->pluck('tl_location_id')
            ->whereNull('tl_effective_end_date')
            ->toArray();

            

        $innerCheck =array();
        $locationid =array();
        // $masterid =array();
        $assesttycode=array();
      
        Session::put('active_tab', 'FAR');

        foreach($collection as $row){
             
            //dd($row->toArray());
             
            $tad_validation_status = "REJECT";
            $tad_transactional_direction = "FAR TO ATS";

            if (!in_array($row['tad_asset_manufacture_serial_no'], $InventSerialNumber) && !in_array($row['tad_asset_manufacture_serial_no'], $exist) && !in_array($row['tad_asset_manufacture_serial_no'], $innerCheck) && in_array($row['tad_asset_type_code'], $master_asset_type_code) && in_array($row['tad_location_id'], $asst_location_id)) {
                //dd("hello1");
                $tad_validation_status = "DOES NOT EXIST";
                $tad_transactional_direction = "FAR TO ATS";
            
            }


            if (in_array($row['tad_location_id'], $locationId) && in_array($row['tad_asset_type_code'], $asset_type_code) && in_array($row['tad_asset_manufacture_serial_no'], $InventSerialNumber) && in_array($row['tad_asset_type_code'], $asset_type_code) && !in_array($row['tad_asset_type_code'], $assesttycode)&& !in_array($row['tad_asset_manufacture_serial_no'], $innerCheck)&& !in_array($row['tad_asset_manufacture_serial_no'], $exist)) {
                $tad_validation_status = "MATCHED";
                $tad_transactional_direction = "FAR TO ATS";
            }

            if(!in_array($row['tad_location_id'], $locationId) && !in_array($row['tad_asset_type_code'], $asset_type_code) && in_array($row['tad_asset_manufacture_serial_no'], $InventSerialNumber)  && !in_array($row['tad_asset_type_code'], $assesttycode)&& !in_array($row['tad_asset_manufacture_serial_no'], $innerCheck)&& !in_array($row['tad_asset_manufacture_serial_no'], $exist)  ){
                $tad_validation_status = "MISMATCH";
                $tad_transactional_direction = "FAR TO ATS";
            }
            //dd($row['tad_asset_manufacture_serial_no']);
                // echo $tad_validation_status." Data:-".$row['tad_asset_manufacture_serial_no'];
                // echo "<br>";
                ExcelFarMisMatchAsset::create([
                    'tad_location_id' => $row['tad_location_id'],
                    'tad_asset_manufacture_serial_no' =>$row['tad_asset_manufacture_serial_no'],
                    'tad_asset_type_code'=>$row['tad_asset_type_code'],
                    'tad_asset_active_inactive_status'=>$row['tad_asset_active_inactive_status'],
                    'tad_asset_name'=>$row['tad_asset_name'],
                    
                    'tad_asset_type_status'=>$row['tad_asset_type_status'],
                    'tad_approve_reject_remarks'=>$row['tad_approve_reject_remarks'],
                    
                    'tad_creation_date' => $instdata,
                    
                    'tad_approved_rejected_by'=>'',
                    'tad_created_by' => "Admin",
                    'tad_validation_status'=>$tad_validation_status,
                    'tad_approve_reject'=>'',
                    'tad_effective_end_date'=> Carbon::now(),
                ]);
                //die("test");
                array_push($innerCheck, $row['tad_asset_manufacture_serial_no']);
                //dd($innerCheck);
                array_push($locationid, $row['tad_location_id']);
                
                // array_push($masterid, $row['tad_asset_id']);
                array_push( $assesttycode, $row['tad_asset_type_code']);
                //dd($assesttycode);
                
        }
           
            //die();
            Session::put('inserted_datetime', $instdata);
             $data = [
                 'inserted_datetime' => $instdata,
             ];
            return $instdata;
            }catch (\Exception $e) {
                //echo $e->getMessage(); die;
                //throw new \Exception("Error: " . $e->getMessage());
                $exception_msg = $e->getMessage();
                session()->flash('exception_msg', $exception_msg);
                return redirect ('/batch_upload');

        }

        }


}