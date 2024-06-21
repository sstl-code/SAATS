<?php

namespace App\Imports;


use App\Models\stnModal;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;
use DB;


class MyExcelImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {   
            try{
        //dd('test');     
        //$instdata = Carbon::now();
                    $instdata = Carbon::now();
                
                    $locationId = DB::table('ats.t_location')
                                    ->whereNull('tl_effective_end_date')
                                    ->pluck('tl_location_id')
                                    ->toArray();

                    // $locationId = DB::table('ats.t_location')->select('tl_location_id')->whereNull('tl_effective_end_date')
                    // ->get();
                    // $LocationCh = $locationId->toArray();
                    //dd($LocationCh);

                                    
                    // $assetId = DB::table('ats.t_asset')
                    //                 ->pluck('ta_asset_id')
                    //                 ->toArray();
                                    
                    $manufactSerialNumber = DB::table('ats.t_asset')
                                        ->whereNull('ta_effective_end_date')
                                        ->whereNull('ta_asset_location_id') 
                                        ->pluck('ta_asset_manufacture_serial_no')
                                        ->toArray();
                    // echo "<pre>";
                    // print_r($manufactSerialNumber);
                    // die;
                    // $manufactSerialNumber = DB::table('ats.t_asset')->select('ta_asset_manufacture_serial_no')->whereNull(['ta_effective_end_date','ta_asset_location_id'])->get();
                    //                 //print_r($manufactSerialNumber);die;
                    //                 $manufactSerialNumberCh = $manufactSerialNumber->toArray();
                    //                 //dd($manufactSerialNumberCh);
                                    
                                    
                    $exist =  DB::table('ats.t_stn_insert')
                                ->where('stn_validation','!=','DONE')             //take a note: 21/07/2023
                                ->pluck('stn_insert_asset_manufacture_serial_no')
                                ->toArray();
                    //dd($exist);

                    // $exist =  DB::table('ats.t_stn_insert')->select('stn_insert_asset_manufacture_serial_no')->get();
                    //                 $existCh = $exist->toArray();
                    //                 dd($existCh);
                    
                    //             echo "<pre>";
                    //             print_r($locationId);
                    // echo "<pre>";
                    // print_r($manufactSerialNumber);
                    $innerCheck =array();


                    //$activeTab = $request->input('STN', 'SRN');// Store the active tab in the session
                    Session::put('active_tab', 'STN');


                    foreach($collection as $row){
                        $status = "REJECT";
                        //echo "<pre>";print_r($row);echo("loc_id");print_r($locationId);echo("manufactSerialNumber:");print_r($manufactSerialNumber);
                        if((in_array($row['stn_location_id'], $locationId) && in_array($row['stn_insert_asset_manufacture_serial_no'], $manufactSerialNumber) && !in_array($row['stn_insert_asset_manufacture_serial_no'], $exist) && !in_array($row['stn_insert_asset_manufacture_serial_no'], $innerCheck))){
                            $status = "ACCEPT";  
                        }
                        //$arr = in_array($row['stn_location_id'], $locationId);
                        
                        // if(in_array($row['stn_location_id'], $locationId)){
                        //     echo "ress: ".$row['stn_location_id'];
                        //     if(in_array($row['stn_insert_asset_manufacture_serial_no'], $manufactSerialNumber)){

                        //         if(!in_array($row['stn_insert_asset_manufacture_serial_no'], $exist)){
                        //             $status = "ACCEPT";

                        //         }
                        //     }
                        // }
                    // echo $status."\n";
                        stnModal::create([
                            'stn_location_id' => $row['stn_location_id'],
                            //'stn_asset_id' => $row['stn_asset_id'],
                            'stn_remarks' => $row['stn_remarks'],
                            'stn_insert_asset_manufacture_serial_no' => $row['stn_insert_asset_manufacture_serial_no'],
                            'stn_file_name' => $row['stn_file_name'],
                            'stn_validation' => $status,
                            'stn_creation_date' => $instdata,
                            'stn_effective_start_date'=> Carbon::now(),
                            'stn_last_updated_date'=> Carbon::now(),
                            'stn_last_updated_by'=> 'Admin',
                            'stn_created_by' => 'Admin',
                        ]);
                        array_push($innerCheck, $row['stn_insert_asset_manufacture_serial_no']);
                    }
                    Session::put('inserted_datetime_stn', $instdata);
                    //die($instdata);
                    $data = [
                        'inserted_datetime_stn' => $instdata,
                    ];
                    //$request->session()->put('key', 'value');
                    
                    return $instdata;
                }catch (\Exception $e) 
                {
                    //echo $e->getMessage(); die;
                    //throw new \Exception("Error: " . $e->getMessage());
                    $exception_msg = $e->getMessage();
                    session()->flash('exception_msg', $exception_msg);
                    return redirect ('/batch_upload');
    
                }

       
    }
}
