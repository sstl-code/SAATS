<?php

namespace App\Imports;


use App\Models\srnModal;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;
use DB;

class MyExcellsrn implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        try{
                    $instdata = Carbon::now();

                    $locationId = DB::table('ats.t_location')
                                    ->whereNull('tl_effective_end_date')
                                    ->pluck('tl_location_id')
                                    ->toArray();
                                    
                    // $locAssetId = DB::table('ats.t_asset')
                    //                 ->whereNull('ta_effective_end_date')
                    //                 ->pluck('ta_asset_location_id')
                    //                 ->toArray();
                                    
                    $manufactSerialNumber = DB::table('ats.t_asset')
                                    ->whereNull('ta_effective_end_date')
                                    ->whereNotNull('ta_asset_location_id')
                                    ->pluck('ta_asset_manufacture_serial_no')
                                    ->toArray();
                                // dd($manufactSerialNumber);
                    // $manufactSerialNumber = DB::table('ats.t_asset')->select('ta_asset_manufacture_serial_no')
                    //                                                 ->whereNull('ta_effective_end_date')
                    //                                                 ->whereNotNull('ta_asset_location_id')->get();
                    //                                                 $manufactSerialNumberChk = json_decode(json_encode($manufactSerialNumber),true);
                                                                //   $manufactSerialNumberChk = $manufactSerialNumber->toArray();
                                                                //   dd($manufactSerialNumberChk);
                                    
                    $exist =  DB::table('ats.t_srn_insert')
                                ->where('srn_validation','!=','DONE')             //take a note: 21/07/2023
                                ->pluck('srn_insert_asset_manufacture_serial_no')
                                ->toArray();

                    $innerCheck =array();

                //  $activeTab = $request->input('STN', 'SRN');// Store the active tab in the session
                    

                    foreach($collection as $row){
                        $status = "REJECT";
                        //echo "<pre>";print_r($row);echo("loc_id");print_r($locationId);echo("manufactSerialNumber:");print_r($manufactSerialNumber);
                        if((in_array($row['srn_location_id'], $locationId) && in_array($row['srn_insert_asset_manufacture_serial_no'], $manufactSerialNumber) && !in_array($row['srn_insert_asset_manufacture_serial_no'], $exist) && !in_array($row['srn_insert_asset_manufacture_serial_no'], $innerCheck))){
                            $status = "ACCEPT";  
                        }
                    //     DB::table('ats.t_srn_insert')->insert(
                    //         array(
                    //             'srn_location_id' => $row['srn_location_id'],
                    //             'srn_asset_id' => $row['srn_asset_id'],
                    //             'srn_remarks' => $row['srn_remarks'],
                    //             'srn_file_name' => $row['srn_file_name'],
                    //             'srn_insert_asset_manufacture_serial_no' => $row['srn_insert_asset_manufacture_serial_no'],
                    //             'srn_validation' => $status,
                    //             'srn_creation_date' => $instdata,
                    //             'srn_created_by' => 1,
                    //         )
                    //    );
                            srnModal::create([
                                'srn_location_id' => $row['srn_location_id'],
                                //'srn_asset_id' => $row['srn_asset_id'],
                                'srn_remarks' => $row['srn_remarks'],
                                'srn_file_name' => $row['srn_file_name'],
                                'srn_insert_asset_manufacture_serial_no' => $row['srn_insert_asset_manufacture_serial_no'],
                                'srn_validation' => $status,
                                'srn_creation_date' => $instdata,
                                'srn_effective_start_date'=> Carbon::now(),
                                'srn_last_updated_date'=> Carbon::now(),
                                'srn_last_updated_by'=> 'Admin',
                                'srn_created_by' => 'Admin',
                            ]);
                        array_push($innerCheck, $row['srn_insert_asset_manufacture_serial_no']);

                    }
                    Session::put('inserted_datetime_srn', $instdata);
                    //die($instdata);
                    $data = [
                        'inserted_datetime_srn' => $instdata,
                    ];
                    //$request->session()->put('key', 'value');
                    
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
