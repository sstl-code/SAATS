<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Validator;
use Carbon\Carbon;
use App\Models\Report;
use App\Models\FarToAts;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\FarToAtsExport;

//far
use App\Imports\ExcelFARmismatch;
use App\Imports\Stn_Srn_AddAsset;
use App\Imports\Site_Add;

//far
use App\Models\User_Location_Model;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ExcelFarMisMatchAsset;
use App\Imports\UsersLocationMappingImport;



class batch_process extends Controller
{
	public function index()
	{
		if (empty(Session::get('active_tab'))) {
			Session::put('active_tab', 'addsite');
		}
		$BatchFailedData = FarToAts::where('f2a_status', 'Failed')->where('f2a_type', 'ADDASSET')->latest('id')->get();
		$BatchFailedDataStn = FarToAts::where('f2a_status', 'Failed')->where('f2a_type', 'STN')->latest('id')->get();
		$BatchFailedDataSrn = FarToAts::where('f2a_status', 'Failed')->where('f2a_type', 'SRN')->latest('id')->get();
	    $AddsiteFailedData=FarToAts::where('f2a_status', 'Failed')->where('f2a_type', 'ADDSITE')->latest('id')->get();
		$Techfaileddata = User_Location_Model::where('status', 'Failed')->get();

		$data = Report::where('is_active', 1)->get();
		return view('batch_upload', compact('BatchFailedData', 'Techfaileddata', 'BatchFailedDataStn', 'BatchFailedDataSrn','AddsiteFailedData', 'data'));
	}
	public function location_user_mapping(Request $request)
	{
		Session::put('active_tab', $request->activetab);
		$validator = Validator::make($request->all(), [
			'files' => 'required',

		]);
		if ($validator->fails()) {
			return redirect('/batch_upload')->with('error1', 'An error occurred while uploading file');
		} else {
			$file = $request->file('files');
			//$file_name = $file->getClientOriginalName(); 
			$file_name = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
			$file->move(base_path() . '/batchProcessfile/', $file_name);
			$uploadfile = base_path() . '/batchProcessfile/' . $file_name;
			$data = Excel::import(new UsersLocationMappingImport, $uploadfile);
			return redirect('/batch_upload')->with('success1', 'File uploaded successfully');
		}
	}

	public function addasset_srn_stn(Request $request)
	{


		$tasktitle = $request->task_title;
		Session::put('active_tab', $request->activetab);
		$validator = Validator::make($request->all(), [
			'files' => 'required',

		]);
		if ($validator->fails()) {
			return redirect('/batch_upload')->with('error', 'An error occurred while uploading file');
		} else {
			$file = $request->file('files');

			$file_name = time() . '.' . $file->getClientOriginalExtension();

			$file->move(base_path('storage/batchProcessfile/input'), $file_name);

			$uploadfile = base_path('storage/batchProcessfile/input/') . $file_name;

			$uploadfileoutput = base_path('storage/batchProcessfile/output/') . $file_name;
			$success = File::copy($uploadfile, $uploadfileoutput);

			$data = Excel::import(new Stn_Srn_AddAsset($uploadfile, $uploadfileoutput, $tasktitle), $uploadfile);
			return redirect('/batch_upload')->with('success', 'File uploaded successfully');
		}
	}
	public function add_site(Request $request)
	{
		Session::put('active_tab', $request->activetab);
		$validator = Validator::make($request->all(), [
			'files' => 'required',

		]);
		if ($validator->fails()) {
			return redirect('/batch_upload')->with('error', 'An error occurred while uploading file');
		} else {
			$file = $request->file('files');
			$file_name = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
			$file->move(base_path() . '/batchProcessfile/', $file_name);
			$uploadfile = base_path() . '/batchProcessfile/' . $file_name;
			$data = Excel::import(new Site_Add, $uploadfile);
			return redirect('/batch_upload')->with('success', 'File uploaded successfully');
		}
	}
}
