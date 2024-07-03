<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Location;
use Illuminate\Support\Collection;
use App\Models\User_Location_Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Site_Add implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {		
		$current_date = Carbon::now();	
        foreach($collection as $row){
          if(isset($row['site_code'])){
		         	$location_id =  Location::where('tl_location_code', trim($row['site_code']))->value('tl_location_id');
			        if(!empty($location_id)){
                Location::
              }
           }
        }
    }
}
