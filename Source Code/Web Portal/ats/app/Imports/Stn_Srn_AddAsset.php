<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\asset;
use App\Models\FarToAts;
use App\Models\Location;
use App\Models\Operator;
use App\Models\FileStore;
use App\Models\Asset_Attribute;
use App\Models\Asset_type_model;
use App\Models\AssetHistoryModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Asset_type_attribute_master_model;

class Stn_Srn_AddAsset implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
	protected $filename;

    public function __construct($filename,$uploadfileoutput,$task_name)
    {
        $this->filename = $filename;
        $this->outputfilename = $uploadfileoutput;
		$this->taskname=$task_name;
    }
    public function collection(Collection $collection)
    {
		$collection = $collection->map(function ($item) {
			$item['activity'] = $this->taskname;
			return collect($item)->map(function ($value, $key) {
				return is_string($value) ? trim($value) : $value;
			});
		});
		
		$filename = $this->filename;
		 //dd($filename);
		$uploadfileoutput = $this->outputfilename;
        $current_date = Carbon::now();
		
		FileStore::create([					
			'file_name' => $filename,
			'file_name_output' => $uploadfileoutput,
			'created_at' => $current_date,
		]);
		// filter add Asset data in collection
		$assetcollections = $collection->filter(function ($collection) {
			return $collection['activity'] === 'ADDASSET';
		});
		$assetcollections = $assetcollections->values()->toarray();
		$attr_size_add_asset = "";
		if(!empty($assetcollections)){
			$attr_size_add_asset = floor(sizeof(array_slice($assetcollections[0],8))/2);
		}
		// filter add Update Asset data in collection
		$updateassetcollections = $collection->filter(function ($collection) {
			return $collection['activity'] === 'UPDATEASSET';
		});
		$updateassetcollections = $updateassetcollections->values()->toarray();		
		$attr_size_update_asset = "";
		if(!empty($updateassetcollections)){
			$attr_size_update_asset = floor(sizeof(array_slice($updateassetcollections[0],8))/2);
		}
		// filter add STN data in collection
		$stncollections = $collection->filter(function ($collection) {
			return $collection['activity'] === 'STN';
		});
		$stncollections = $stncollections->values()->toarray();
		// filter add SRN data in collection
		$srncollections = $collection->filter(function ($collection) {
			return $collection['activity'] === 'SRN';
		});
		$srncollections = $srncollections->values()->toarray();
		
		// Add Asset Batch Code
		if(!empty($assetcollections)){
			foreach($assetcollections as $assetdata){
				if(isset($assetdata['manufacturer_serial_no']))
				{
				$fartoats = FarToAts::select('id')->where('f2a_manufacture_serial_no', $assetdata['manufacturer_serial_no'])->where('f2a_status', 'Received')->Where('f2a_type',$assetdata['activity'])->get();
				$location_id = Location::where('tl_location_code', $assetdata['site_id'])->value('tl_location_id');
				$tl_location_type = Location::where('tl_location_code', $assetdata['site_id'])->value('tl_location_type');
				$tl_location_name = Location::where('tl_location_code', $assetdata['site_id'])->value('tl_location_name');
				$tl_location_address = Location::where('tl_location_code', $assetdata['site_id'])->value('tl_location_address');
				$at_asset_type_code = Asset_type_model::where('at_asset_type_name', $assetdata['asset_type'])->value('at_asset_type_code');
				$assetdata['parent_serial_no']=!empty($assetdata['parent_serial_no']) ? $assetdata['parent_serial_no'] :0;
				$asset_parent_id = asset::where('ta_asset_manufacture_serial_no', $assetdata['parent_serial_no'])->value('ta_asset_id');
				$asset_type = Asset_type_model::where('at_asset_type_name',trim($assetdata['asset_type']))->value('at_asset_type_id');
				$op_id = Operator::where('op_operator_name', $assetdata['operator_name'])->value('op_id');
				$asset_id = asset::where('ta_asset_manufacture_serial_no', $assetdata['manufacturer_serial_no'])->value('ta_asset_id');
				$asset_category = Asset_type_model::where('at_asset_type_name', $assetdata['asset_type'])->value('at_asset_type_category');
				$asset_category_details = Asset_type_model::where('at_asset_type_name', $assetdata['asset_type'])->first();
				$reason = "";
				$status = "";
			
				if(empty($asset_parent_id) && !empty($assetdata['parent_serial_no'])){
					$reason = "Parent Does Not Exist";
					$status = "Failed";
				}
				/*else if(count($fartoats->toarray()) > 0){
					$reason = "Already in Process";
					$status = "Failed";
				}*/
				else if(!isset($asset_type)){
			
					$reason = " Asset Type Not Exist";
					$status = "Failed";
				}else if(isset($asset_id)){
					$reason = "Asset Already Exist In Asset Table";
					$status = "Failed";
				}
                else if(!empty($asset_category_details) && $asset_category_details->at_asset_type_category!=$assetdata['asset_category']){
					$reason = "Asset Type Mismatch";
					$status = "Failed";
				}
				else if(!empty($asset_category_details->at_parent_asset_type_id) && empty($assetdata['parent_serial_no'])){
					$reason = "Parent Does Not Exist";
					$status = "Failed";
				}
				else if(empty($asset_id) && !empty($asset_type)){
					$reason = "Asset Added In Asset Table";
					$status = "Received";
				}
				
				FarToAts::create([					
					'f2a_sync_date' => $current_date,
					'f2a_file_name' => $filename,
					'f2a_asset_type' => $assetdata['asset_type'],
					'f2a_asset_name' => $assetdata['asset_name'],
					'f2a_manufacture_serial_no' => $assetdata['manufacturer_serial_no'],
					'f2a_description' => $assetdata['asset_tag_no'],
					'f2a_site_id' =>  empty($location_id) ? 0 :$location_id,
					'f2a_site_code' => isset($assetdata['site_id'])?$assetdata['site_id']:null,
					'f2a_site_type' => empty($tl_location_type)?null:$tl_location_type,
					'f2a_site_name' => empty($tl_location_name)?null:$tl_location_name,
					'f2a_address' => empty($tl_location_address)?null:$tl_location_address,
					'f2a_status' =>  $status,
					'f2a_reason' => $reason,
					'f2a_creation_date' => $current_date,
					'f2a_type' => $assetdata['activity'],
					'f2a_Parent_id' => !empty($asset_parent_id) ? $asset_parent_id :0,	
					'f2a_operator_id' => $assetdata['asset_category'] == 'Active' ? $op_id :null,	
					'f2a_category' => $assetdata['asset_category'],
				]);
				if($status == "Received"){
					asset::create(['ta_asset_catagory' => $assetdata['asset_category'],
						'ta_asset_location_id' =>!empty($location_id)?intval($location_id):null,
						'ta_asset_type_master_id' =>intval($asset_type),
						'ta_asset_type_code' =>$at_asset_type_code,
						'ta_asset_name' => $assetdata['asset_name'],
						'ta_asset_manufacture_serial_no' =>$assetdata['manufacturer_serial_no'],
						'ta_asset_tag_number' => $assetdata['asset_tag_no'],
						'ta_creation_date' => $current_date,							
						'ta_asset_parent_id' => intval($asset_parent_id),
						'is_shown' => !empty($location_id)? true: false,	
						'operator_id' => $assetdata['asset_category'] == 'Active' ? $op_id : 0,	
						
					]);
					$asset_id = asset::where('ta_asset_manufacture_serial_no', $assetdata['manufacturer_serial_no'])->value('ta_asset_id');
				   if(!empty($location_id)){
					AssetHistoryModel::create(['movein_date' => Carbon::now(), 'status' => 1,'asset_id'=>$asset_id,'location_id'=> intval($location_id)]);
				   } 
					for($i=0; $i < $attr_size_add_asset; $i++){
						if(isset($assetdata['atribute'.$i + 1])){
						$asset_type_attribute_master_id = Asset_type_attribute_master_model::where('ata_asset_type_attribute_name', $assetdata['atribute'.$i + 1])->value('ata_asset_type_attribute_id');
					
						$asset_type_attribute_master_code = Asset_type_attribute_master_model::where('ata_asset_type_attribute_name', $assetdata['atribute'.$i + 1])->value('ata_asset_type_attribute_id');
						if(!empty($asset_type_attribute_master_id) && !empty($asset_type)){
							Asset_Attribute::create([					
								'at_asset_type_attribute_master_id' => $asset_type_attribute_master_id,
								'at_asset_id' => $asset_id,
								'at_asset_attribute_code' => $asset_type_attribute_master_code,
								'at_asset_attribute_description' => $assetdata['atribute'.$i + 1],
								'at_creation_date' => $current_date,
								'at_asset_attribute_value_text' => $assetdata['atributevalue'.$i + 1],
								'at_asset_attribute_name' => $assetdata['atribute'.$i + 1],								                   
							]);	
						}
					 }
					}
				}
			}
			}
		}
		// Add Stn Batch Code
		if(!empty($stncollections)){
			foreach($stncollections as $assetdata){
				$fartoats = FarToAts::select('id')->where('f2a_manufacture_serial_no', $assetdata['manufacturer_serial_no'])->where('f2a_status', 'Received')->Where('f2a_type',$assetdata['activity'])->get();
				$location_id = Location::where('tl_location_code', $assetdata['site_id'])->value('tl_location_id');
				$tl_location_type = Location::where('tl_location_code', $assetdata['site_id'])->value('tl_location_type');
				$tl_location_name = Location::where('tl_location_code', $assetdata['site_id'])->value('tl_location_name');
				$tl_location_address = Location::where('tl_location_code', $assetdata['site_id'])->value('tl_location_address');
				$asset_parent_id = asset::where('ta_asset_manufacture_serial_no', $assetdata['parent_serial_no'])->value('ta_asset_id');
				$asset_type = Asset_type_model::where('at_asset_type_name', $assetdata['asset_type'])->value('at_asset_type_id');
				$op_id = Operator::where('op_operator_name', $assetdata['operator_name'])->value('op_id');
				$asset_id = asset::where('ta_asset_manufacture_serial_no', $assetdata['manufacturer_serial_no'])->value('ta_asset_id');
			
				$reason = "";
				$status = "";
				if(empty($location_id)){
					$reason = "Site Does Not Exist";
					$status = "Failed";
				}else if(empty($asset_parent_id) && !empty($assetdata['parent_serial_no'])){
					$reason = "Parent Does Not Exist";
					$status = "Failed";
				}else if(count($fartoats->toarray()) > 0){
					$reason = "Already in Process{ id - ".$fartoats."}";
					$status = "Failed";
				}else if(empty($asset_type)){
					$reason = "Asset Type Not Exist";
					$status = "Failed";
				}else if(!empty($asset_id)){
					$reason = " ";
					$status = "Received";
				}else if(empty($asset_id)){
					$reason = "Asset Does Not Exist";
					$status = "Failed";
				}
				FarToAts::create([					
					'f2a_sync_date' => $current_date,
					'f2a_file_name' => $filename,
					'f2a_asset_type' => $assetdata['asset_type'],
					'f2a_asset_name' => $assetdata['asset_name'],
					'f2a_manufacture_serial_no' => $assetdata['manufacturer_serial_no'],
					'f2a_description' => $assetdata['asset_tag_no'],
					'f2a_site_id' => empty($location_id) ? 0 :$location_id,
					'f2a_site_code' => $assetdata['site_id'],
					'f2a_site_type' => $tl_location_type,
					'f2a_site_name' => $tl_location_name,
					'f2a_address' => $tl_location_address,
					'f2a_status' => $status,
					'f2a_reason' => $reason,
					'f2a_creation_date' => $current_date,
					'f2a_type' => $assetdata['activity'],
					'f2a_Parent_id' => empty($asset_parent_id)? 0: $asset_parent_id,	
					'f2a_operator_id' => $assetdata['asset_category'] == 'Active' ? $op_id : null,	
					'f2a_category' => $assetdata['asset_category'],
				]);
				asset::where('ta_asset_id',$asset_id)->update(['ta_asset_location_id'=>$location_id,'ta_asset_parent_id'=>empty($asset_parent_id)?0:$asset_parent_id]);
			}
		}
		
		// Add Srn Batch Code
		if(!empty($srncollections)){
			foreach($srncollections as $assetdata){
				$fartoats = FarToAts::select('id')->where('f2a_manufacture_serial_no', $assetdata['manufacturer_serial_no'])->where('f2a_status', 'Received')->Where('f2a_type',$assetdata['activity'])->get();
				$location_id = Location::where('tl_location_code', $assetdata['site_id'])->value('tl_location_id');
				$tl_location_type = Location::where('tl_location_code', $assetdata['site_id'])->value('tl_location_type');
				$tl_location_name = Location::where('tl_location_code', $assetdata['site_id'])->value('tl_location_name');
				$tl_location_address = Location::where('tl_location_code', $assetdata['site_id'])->value('tl_location_address');
				$asset_parent_id = asset::where('ta_asset_manufacture_serial_no', $assetdata['parent_serial_no'])->value('ta_asset_id');
				$asset_type = Asset_type_model::where('at_asset_type_name', $assetdata['asset_type'])->value('at_asset_type_id');
				$op_id = Operator::where('op_operator_name', $assetdata['operator_name'])->value('op_id');
				$asset_id = asset::where('ta_asset_manufacture_serial_no', $assetdata['manufacturer_serial_no'])->value('ta_asset_id');
				$reason = "";
				$status = "";
				if(empty($location_id)){
					$reason = "Site Does Not Exist";
					$status = "Failed";
				}else if(empty($asset_parent_id) && !empty($assetdata['parent_serial_no'])){
					$reason = "Parent Does Not Exist";
					$status = "Failed";
				}else if(count($fartoats->toarray()) > 0){
					$reason = "Already in Process{ id - ".$fartoats."}";
					$status = "Failed";
				}else if(empty($asset_type)){
					$reason = "Asset Type Not Exist";
					$status = "Failed";
				}else if(!empty($asset_id)){
					$reason = " ";
					$status = "Received";
				}else if(empty($asset_id)){
					$reason = "Asset Does Not Exist";
					$status = "Failed";
				}
				FarToAts::create([					
					'f2a_sync_date' => $current_date,
					'f2a_file_name' => $filename,
					'f2a_asset_type' => $assetdata['asset_type'],
					'f2a_asset_name' => $assetdata['asset_name'],
					'f2a_manufacture_serial_no' => $assetdata['manufacturer_serial_no'],
					'f2a_description' => $assetdata['asset_tag_no'],
					'f2a_site_id' => empty($location_id) ? 0 :$location_id,
					'f2a_site_code' => $assetdata['site_id'],
					'f2a_site_type' => $tl_location_type,
					'f2a_site_name' => $tl_location_name,
					'f2a_address' => $tl_location_address,
					'f2a_status' => $status,
					'f2a_reason' => $reason,
					'f2a_creation_date' => $current_date,
					'f2a_type' => $assetdata['activity'],
					'f2a_Parent_id' => empty($asset_parent_id)? 0: $asset_parent_id,	
					'f2a_operator_id' => $assetdata['asset_category'] == 'Active' ? $op_id : null,	
					'f2a_category' => $assetdata['asset_category'],
				]);
			}
		}
		// Update Asset Batch Code
		if(!empty($updateassetcollections)){
			foreach($updateassetcollections as $assetdata){
				$fartoats = FarToAts::select('id')->where('f2a_manufacture_serial_no', $assetdata['manufacturer_serial_no'])->where('f2a_status', 'Received')->Where('f2a_type',$assetdata['activity'])->get();
				$location_id = Location::where('tl_location_code', $assetdata['site_id'])->value('tl_location_id');
				$tl_location_type = Location::where('tl_location_code', $assetdata['site_id'])->value('tl_location_type');
				$tl_location_name = Location::where('tl_location_code', $assetdata['site_id'])->value('tl_location_name');
				$tl_location_address = Location::where('tl_location_code', $assetdata['site_id'])->value('tl_location_address');
				$at_asset_type_code = Asset_type_model::where('at_asset_type_name', $assetdata['asset_type'])->value('at_asset_type_code');
				$asset_parent_id = asset::where('ta_asset_manufacture_serial_no', $assetdata['parent_serial_no'])->value('ta_asset_id');
				$asset_type = Asset_type_model::where('at_asset_type_name', $assetdata['asset_type'])->value('at_asset_type_id');
				$op_id = Operator::where('op_operator_name', $assetdata['operator_name'])->value('op_id');
				$asset_id = asset::where('ta_asset_manufacture_serial_no', $assetdata['manufacturer_serial_no'])->value('ta_asset_id');
				$reason = "";
				$status = "";
				if(empty($location_id)){
					$reason = "Site Does Not Exist";
					$status = "Failed";
				}else if(empty($asset_parent_id) && !empty($assetdata['parent_serial_no'])){
					$reason = "Parent Does Not Exist";
					$status = "Failed";
				}else if(count($fartoats->toarray()) > 0){
					$reason = "Already in Process{ id - ".$fartoats."}";
					$status = "Failed";
				}else if(empty($asset_type)){
					$reason = "Asset Type Not Exist";
					$status = "Failed";
				}else if(!empty($asset_id)){
					$reason = " ";
					$status = "Received";
				}else if(empty($asset_id) && !empty($asset_type)){
					$reason = "Asset Does Not Exist";
					$status = "Failed";
				}
				FarToAts::create([					
					'f2a_sync_date' => $current_date,
					'f2a_file_name' => $filename,
					'f2a_asset_type' => $assetdata['asset_type'],
					'f2a_asset_name' => $assetdata['asset_name'],
					'f2a_manufacture_serial_no' => $assetdata['manufacturer_serial_no'],
					'f2a_description' => $assetdata['asset_tag_no'],
					'f2a_site_id' =>  empty($location_id) ? 0 :$location_id,
					'f2a_site_code' => $assetdata['site_id'],
					'f2a_site_type' => $tl_location_type,
					'f2a_site_name' => $tl_location_name,
					'f2a_address' => $tl_location_address,
					'f2a_status' => $status,
					'f2a_reason' => $reason,
					'f2a_creation_date' => $current_date,
					'f2a_type' => $assetdata['activity'],
					'f2a_Parent_id' => $assetdata['activity'] == 'ADDASSET' && !empty($asset_parent_id)? $asset_parent_id :0,	
					'f2a_operator_id' => $assetdata['asset_category'] == 'Active' ? $op_id :0,	
					'f2a_category' => $assetdata['asset_category'],
				]);
				if($status == "Received"){
					asset::where('ta_asset_id', $asset_id)->update(['ta_asset_catagory' => $assetdata['asset_category'],
						'ta_asset_location_id' =>intval($location_id),
						'ta_asset_type_master_id' =>intval($asset_type),
						'ta_asset_type_code' =>$at_asset_type_code,
						'ta_asset_name' => $assetdata['asset_name'],
						'ta_asset_manufacture_serial_no' =>$assetdata['manufacturer_serial_no'],
						'ta_asset_tag_number' => $assetdata['asset_tag_no'],
						'ta_creation_date' => $current_date,							
						'ta_asset_parent_id' => intval($asset_parent_id),
						'is_shown' => !empty($location_id)? true: false,	
						'operator_id' => $assetdata['asset_category'] == 'Active' ? $op_id : 0,
					]);
					
					$asset_id = asset::where('ta_asset_manufacture_serial_no', $assetdata['manufacturer_serial_no'])->value('ta_asset_id');
					for($i=0; $i < $attr_size_update_asset; $i++){
						if(isset($assetdata['atribute'.$i + 1])){
						$asset_type_attribute_master_id = Asset_type_attribute_master_model::where('ata_asset_type_attribute_name', $assetdata['atribute'.$i + 1])->value('ata_asset_type_attribute_id');
						$ata_asset_type_id = Asset_type_attribute_master_model::where('ata_asset_type_attribute_name', $assetdata['atribute'.$i + 1])->value('ata_asset_type_id');
						$at_asset_type_name = "";
						if($ata_asset_type_id > 0){
							$at_asset_type_name = Asset_type_attribute_master_model::where('ata_asset_type_id', $ata_asset_type_id)->value('ata_asset_type_attribute_name');
						}
						$asset_type_attribute_master_code = Asset_type_attribute_master_model::where('ata_asset_type_attribute_name', $assetdata['atribute'.$i + 1])->value('ata_asset_type_attribute_id');
						$attrcheck = Asset_Attribute::where('at_asset_attribute_code', $asset_type_attribute_master_code)->where('at_asset_id', $asset_id)->get();
					  }
						if(!empty($attrcheck) && !empty($asset_type_attribute_master_id) && !empty($asset_id) && !empty($asset_type)){
							if(isset($assetdata['atribute'.$i + 1])){
							Asset_Attribute::where('at_asset_attribute_code', $asset_type_attribute_master_code)->where('at_asset_id', $asset_id)->update([					
								'at_asset_type_attribute_master_id' => $asset_type_attribute_master_id,
								'at_asset_id' => $asset_id,
								'at_asset_attribute_code' => $asset_type_attribute_master_code,
								'at_asset_attribute_description' => $assetdata['atribute'.$i + 1],
								'at_creation_date' => $current_date,
								'at_asset_attribute_value_text' => $assetdata['atributevalue'.$i + 1],
								'at_asset_attribute_name' => $assetdata['atribute'.$i + 1],								                   
							]);
						   }
						}
						if(count($attrcheck) < 1 && !empty($asset_type_attribute_master_id) && !empty($asset_id)){
							if(isset($assetdata['atribute'.$i + 1])){
							Asset_Attribute::create([					
								'at_asset_type_attribute_master_id' => $asset_type_attribute_master_id,
								'at_asset_id' => $asset_id,
								'at_asset_attribute_code' => $asset_type_attribute_master_code,
								'at_asset_attribute_description' => $assetdata['atribute'.$i + 1],
								'at_creation_date' => $current_date,
								'at_asset_attribute_value_text' => $assetdata['atributevalue'.$i + 1],
								'at_asset_attribute_name' => $assetdata['atribute'.$i + 1],								                   
							]);	
						  }
						}
					}
				}
			}
		}
    }
}
