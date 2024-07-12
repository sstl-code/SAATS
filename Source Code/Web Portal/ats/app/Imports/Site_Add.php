<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Location;
use App\Models\LocationType;

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
              //  Location::
              }else{
               $location_type_id=LocationType::where('lt_location_type',trim($row['site_category']))->value('lt_location_type_id');
               Location::create(['tl_location_type_master_id'=>$location_type_id,'tl_location_type'=>$row['site_category'],'tl_location_code'=>$row['site_code'],'tl_location_address'=>$row['address'],'tl_location_region'=>$row['region'],'tl_location_latitude'=>$row['latitude'],'tl_location_longitude'=>$row['longitude'],'tl_created_by'=>$row['created_by'],'tl_location_name'=>$row['site_name']]);
              }
           }
        }
    }
}
