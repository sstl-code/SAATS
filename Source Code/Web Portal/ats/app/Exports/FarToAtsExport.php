<?php

namespace App\Exports;

use App\Models\Asset;
use App\Models\FarToAts;
use App\Models\Operator;
use App\Models\TPmApproval;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\AssetEditModel;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class FarToAtsExport implements FromCollection, WithHeadingRow, WithMapping,WithHeadings,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
	

    public function __construct()
    {
        
    }
	
    public function collection()
    {
       
		$row = TPmApproval:: where('task_status','Completed')->where('output_file_generated','!=','t') 
                   ->where('task_title', 'not Like', '%Audit%')->get();
		return $row;
    }
	public function headings(): array
    {
        return [
            "APPROVED_ON",
            "APPROVED_BY",
            "ACTIVITY",
            "ASSET_CATEGORY",
            "OPERATOR_NAME",
            "SITE",
            "ASSET_TYPE",
            "ASSET_NAME",
            "MANUFACTURER_SERIAL_NO",
            "ASSET_TAG_NO",
            "ATRIBUTE1",
            "ATRIBUTEVALUE1",
            "ATRIBUTE2",
            "ATRIBUTEVALUE2",
            "ATRIBUTE3",
            "ATRIBUTEVALUE3",
            "ATRIBUTE4",
            "ATRIBUTEVALUE4",
            "ATRIBUTE5",
            "ATRIBUTEVALUE5",
            "ATRIBUTE6",
            "ATRIBUTEVALUE6",
            "ATRIBUTE7",
            "ATRIBUTEVALUE7",
            "ATRIBUTE8",
            "ATRIBUTEVALUE8",
            "ATRIBUTE9",
            "ATRIBUTEVALUE9",
            "ATRIBUTE10",
            "ATRIBUTEVALUE10",
        ];
    }
    public function map($row): array
	{
		
        $assetEdit=AssetEditModel::where('pm_project_id',$row->pm_project_id)->whereNotNull('ta_asset_manufacture_serial_no')->first();
      
        if(isset($assetEdit->TypeAttr)){
            $attributes=[];$i=0;
            foreach($assetEdit->TypeAttr as $attr)
            {
                $attributes[$i]['attr_name']=$attr->at_asset_attribute_name;
                $attributes[$i]['attr_value']= $attr->at_asset_attribute_value_text;
                $i++;
                if($i>10){
                    break;
                }
            }
        }
		return [
            date('d-m-Y H:i:s',strtotime($row->created_at)),
            strtoupper($row->approver_name),
			strtoupper($row->task_title),
			isset($assetEdit->ta_asset_catagory)?strtoupper($assetEdit->ta_asset_catagory):"",
			isset($assetEdit->operators)?strtoupper($assetEdit->operators):"",
			isset($row->site_code)?$row->site_code:"",
			isset($assetEdit->AssetType)?strtoupper($assetEdit->AssetType):"",
			isset($assetEdit->ta_asset_name)?strtoupper($assetEdit->ta_asset_name):"",
			isset($assetEdit->ta_asset_manufacture_serial_no)?$assetEdit->ta_asset_manufacture_serial_no:"",
            isset($assetEdit->ta_asset_tag_number)?$assetEdit->ta_asset_tag_number:"",
            isset($attributes[0]['attr_name'])?$attributes[0]['attr_name']:"",
			isset($attributes[0]['attr_value'])?$attributes[0]['attr_value']:"",
            isset($attributes[1]['attr_name'])?$attributes[1]['attr_name']:"",
			isset($attributes[1]['attr_value'])?$attributes[1]['attr_value']:"",
			isset($attributes[2]['attr_name'])?$attributes[2]['attr_name']:"",
			isset($attributes[2]['attr_value'])?$attributes[2]['attr_value']:"",
            isset($attributes[3]['attr_name'])?$attributes[3]['attr_name']:"",
			isset($attributes[3]['attr_value'])?$attributes[3]['attr_value']:"",
            isset($attributes[4]['attr_name'])?$attributes[4]['attr_name']:"",
			isset($attributes[4]['attr_value'])?$attributes[4]['attr_value']:"",
            isset($attributes[5]['attr_name'])?$attributes[5]['attr_name']:"",
			isset($attributes[5]['attr_value'])?$attributes[5]['attr_value']:"",
            isset($attributes[6]['attr_name'])?$attributes[6]['attr_name']:"",
			isset($attributes[6]['attr_value'])?$attributes[6]['attr_value']:"",
            isset($attributes[7]['attr_name'])?$attributes[7]['attr_name']:"",
			isset($attributes[7]['attr_value'])?$attributes[7]['attr_value']:"",
            isset($attributes[8]['attr_name'])?$attributes[8]['attr_name']:"",
			isset($attributes[8]['attr_value'])?$attributes[8]['attr_value']:"",
            isset($attributes[9]['attr_name'])?$attributes[9]['attr_name']:"",
			isset($attributes[9]['attr_value'])?$attributes[9]['attr_value']:"",
            isset($attributes[10]['attr_name'])?$attributes[10]['attr_name']:"",
			isset($attributes[10]['attr_value'])?$attributes[10]['attr_value']:"",
			
		];
	}
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]]
        ];
    }
}
