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

class UsersLocationMappingImport implements ToCollection, WithHeadingRow
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
			$user_id = User::where('email', trim($row['user_email']))->value('id');
			$exist_data =  User_Location_Model::where('ul_location_id', $location_id)->where('ul_user_id', $user_id)->value('ul_user_location_id');
            
			if(empty($exist_data) && $row['action_flag'] == "ALLOCATE" && !empty($location_id)){
                User_Location_Model::create([
                    'ul_location_id' => $location_id,
                    'ul_user_id' => $user_id,
                    'ul_user_role_id' => '1',
                    'status'=>'Success',
                    'reason'=>'Assigning a technician to a site was done successfully'                   				                			                    
                ]);
            }else if($row['action_flag'] == "DEALLOCATE" && !empty($location_id)){
                User_Location_Model::where('ul_location_id',$location_id)->where('ul_user_id', $user_id)->delete();
            }else if(empty($location_id) && empty($user_id) ){
                
    
                User_Location_Model::create([
                    'ul_location_id' => $location_id,
                    'ul_user_id' => $user_id,
                    'ul_user_role_id' => '0',
                    'status'=>'Failed',
                    'reason'=>$row['site_code'].' Site and '.$row['user_email'].' user does not exist.'                   				                			                    
                ]);
            }else if(empty($location_id)){
                
    
                User_Location_Model::create([
                    'ul_location_id' => $location_id,
                    'ul_user_id' => $user_id,
                    'ul_user_role_id' => '0',
                    'status'=>'Failed',
                    'reason'=> $row['site_code'].'Location does not exist.'                   				                			                    
                ]);
            }else if(empty($user_id)){
                
    
                User_Location_Model::create([
                    'ul_location_id' => $location_id,
                    'ul_user_id' => $user_id,
                    'ul_user_role_id' => '0',
                    'status'=>'Failed',
                    'reason'=>$row['user_email'].' User does not exist.'                   				                			                    
                ]);
            }
            
           }
        }
    }
}
