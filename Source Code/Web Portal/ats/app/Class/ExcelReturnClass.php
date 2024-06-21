<?php

namespace App\Class;
use Carbon\Carbon;
use App\Models\FileStore;
use Maatwebsite\Excel\Excel;
use App\Exports\FarToAtsExport;
use App\Imports\ExcelFARmismatch;
use Illuminate\Support\Facades\File;
use App\Models\ExcelFarMisMatchAsset;

class ExcelReturnClass
{
    public function generate($uploadfile)
	{
        $fileName =  Carbon::now()->format('YmdHis') . '.xlsx';
		$data2 = Excel::download(new FarToAtsExport($uploadfile), 'far_to_ats_'.$fileName);
		$export = new FarToAtsExport($data2);
		$filePath = storage_path('far_to_ats_' . $fileName);
		if (file_exists($data2->getFile()->getPathname())) {
			$destinationPath = storage_path()."/output";
			File::move($data2->getFile()->getPathname(), $destinationPath ."/". $fileName);
		}
		FileStore::where('file_name', $uploadfile)->update(['file_name_output' => $destinationPath."/".$fileName]);
	}
	
	public function delete_excel($filename)
	{
        if(file_exists($filename)){
			unlink($filename);
		}
	}
}