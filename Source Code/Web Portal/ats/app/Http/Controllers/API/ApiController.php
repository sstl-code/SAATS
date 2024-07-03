<?php

namespace App\Http\Controllers\API;

use DB;
use Log;
use Cache;
use CURLFile;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\asset;
use App\Class\PMClass;
use App\Models\mailLog;
use App\Models\FarToAts;
use App\Models\Location;
use App\Models\Operator;
use App\Models\stnModal;
use App\Models\FileStore;
use App\Models\SiteMedia;
use App\Traits\Observable;
use App\Models\TPmApproval;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\SiteSettings;
use Illuminate\Http\Request;
use App\Models\AssetEditModel;
use Laravel\Passport\Passport;
use App\Class\ExcelReturnClass;
use App\Models\Asset_Attribute;
use App\Models\Asset_type_model;
use App\Models\Srn_insert_Model;
use App\Models\Asset_Audit_Model;
use App\Models\AssetHistoryModel;
use App\Models\AssetEditAttribute;
use App\Models\AssetTaggingHistory;
use App\Models\Audit_Details_Model;
use App\Models\User_Location_Model;
use App\Models\Asset_type_attribute_model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supervisor_to_technician;
use App\Models\Asset_type_attribute_master_model;

class ApiController extends Controller
{
    public $assetdataHTML = "";
    public function testapi(Request $request)
    {
        $project_id = $request->project_id;
        $token = $request->token;
        $task_id = $request->task_id;
        $PMClass = new PMClass();
        $data = $PMClass->assign_task_users($project_id, $token, $task_id);
        print_r($data);
    }

    public function my_sites(Request $request)
    {
        $my_sites = User_Location_Model::with(['users_location_mapping' => function ($query) {
            $query->select('*', 'tl_location_name as location_name', 'tl_location_id as location_id');
        }])
            ->where('ul_user_id', $request->user_id)->orderBy('created_at', 'desc')->get();

        if (count($my_sites) == 0) {
            $my_sites = [];
        } else {
            $my_sites = $my_sites->pluck('users_location_mapping');
        }
        return response()->json([
            "status" => 200,
            "data" => Arr::flatten($my_sites)
        ]);
    }

    public function near_site(Request $request)
    {
        $lat = $request->lat;
        $lon = $request->lng;
        $radius = $request->radius;
        $site = 'SITES';


        $results = DB::connection('pgsql')->select("select * from ats.lat_long(?, ?, ?)", [$lat, $lon, $radius]);
        array_walk($results, "self::getLastAuditDate");
        return response()->json([
            "status" => 200,
            "data" => $results
        ]);
    }
    //Audit by location asset list

    public function assets_list_location_wise($id)
    {
        $assets_data = asset::select('ta_asset_type_master_id', 'ta_asset_id', 'ta_asset_location_id', 'ta_asset_name', 'ta_asset_manufacture_serial_no', 'ta_asset_tag_number', 'ta_asset_active_inactive_status', 'ta_asset_parent_id', 'ta_asset_catagory', 'operator_id')->where('ta_asset_location_id', $id)->where('is_shown', 't')->where('ta_asset_parent_id', 0)->get();
        if (count($assets_data) == 0) {
            $assets_data = [];
        }
        return response()->json([
            "status" => 200,
            "data" => $assets_data
        ]);
    }

    public function single_asset_details(Request $request)
    {
        $id = $request->asset_id;
        $assets_data = asset::with('locationtype')->select('ta_asset_type_master_id', '*')->where('ta_asset_id', $id)->get();
        if (count($assets_data) == 0) {
            $assets_data = [];
        }
        return response()->json([
            "status" => 200,
            "data" => count($assets_data) == 0 ? null : call_user_func_array('array_merge', $assets_data->toarray()),
        ]);
    }

    public function fetch_asset_by_serialno(Request $request)
    {
        Log::debug($request);
        $serialno = $request->serialno;

        $assets_data = asset::select('*')->where('ta_asset_manufacture_serial_no', $serialno)->get();
        $assets_data_count = asset::select('*')->where('ta_asset_manufacture_serial_no', $serialno)->where('ta_asset_location_id', $request->location_id)->where('is_shown', 't')->count();
        if (isset($request->is_add_asset)) {
            if ($assets_data_count > 0) {
                return response()->json([
                    "status" => 404,
                    "data" => null,
                    "message" => "This asset is already in the site"
                ]);
            }
            if (count($assets_data) == 0) {
                $assets_data = [];
                $msg = "This asset is new asset";
                $status = 200;
            } else {
                $msg = "This asset is already in other site";
                $status = 300;
            }
        } else {
            $status = 200;
            $msg = "Asset Found";
        }
        return response()->json([
            "status" => $status,
            "data" => count($assets_data) == 0 ? null : call_user_func_array('array_merge', $assets_data->toarray()),
            "message" => $msg
        ]);
    }

    public function asset_type(Request $request)
    {
        $parent_id = $request->id;
        $assetCategory = strtoupper($request->assetCategory);
        $asset_type_query = Asset_type_model::select('at_asset_type_name', 'at_asset_type_id', 'at_asset_type_category', 'at_parent_asset_type_id')
            ->whereRaw("upper(at_asset_type_category)='$assetCategory' and at_asset_type_status='Valid'");

        if ($parent_id) {
            $asset_type_query->where('at_parent_asset_type_id', $parent_id);
        } else {
            $asset_type_query->where('at_parent_asset_type_id', null);
        }

        $asset_type = $asset_type_query->get();

        return response()->json([
            'status' => 200,
            'data' => $asset_type,
        ]);
    }

    public function asset_attributes(Request $request)
    {
        $asset_id = $request->id;
        $assets_dynamic_data = Asset_type_model::with('assetattr')->select('*')->where('at_asset_type_id', $asset_id)->where('at_asset_type_status', 'Valid')->get();
        $assets_sataic_data = Asset_type_attribute_master_model::select('*')->where('ata_asset_type_id', 0)->get();
        return response()->json([
            'status' => 200,
            'static_attr' => $assets_sataic_data,
            'dynamic_attr' => $assets_dynamic_data,
        ]);
    }


    public function asset_tagging(Request $request)
    {
        Log::debug($request);

        $requestData = json_decode($request["fields"]);

        $checktag_number = asset::where('ta_asset_tag_number', $requestData->tag_number)->count();
        if ($checktag_number > 0) {
            return response()->json([
                'status' => 404,
                'message' => 'please give a unique tag number',
            ]);
        } else {
            if (isset($requestData->latitude)) {
                $resultsites = DB::connection('pgsql')->select("select tl_location_id from ats.lat_long(?, ?, ?)", [$requestData->latitude, $requestData->longitude, env('Asset_Add_Radius') / 1000]);
                $editable = 0;
                foreach ($resultsites as $sites) {
                    if ($sites->tl_location_id == $requestData->location_id) {
                        $editable = 1;
                        break;
                    }
                }
                if ($editable == 0) {
                    return response()->json([
                        'status' => 404,
                        'message' => "Asset can be edited only  " . env('Asset_Add_Radius') . " meter distance from site",
                    ]);
                }
            }
            $user_id = $request->user()->id;
            $modified_by = $requestData->modified_by;
            $asset_id = $requestData->asset_id;
            $asset_img = $request->asset_img;
            $supervisor_id = $this->findSupervisor($user_id);
            $supervisor_details = Supervisor_to_technician::where('supervisor_id', $supervisor_id)->first(['supervisor_id', 'pm_user_id']);
            $supervisorData = User::where('id', $supervisor_details["supervisor_id"])->first(['email', 'name']);
            $pm_user_id = $supervisor_details->pm_user_id;
            $technician_details = User::where('id', $user_id)->first(['name']);
            if (!empty($asset_img)) {
                $asset_img_name = $asset_img->getClientOriginalName();
                $asset_img->move(base_path() . '/storage/app/public/assetimage/', $asset_img_name);
                $asset_img = url('/storage/assetimage/' . $asset_img_name);
            }
            $asset = asset::where('ta_asset_id', $requestData->asset_id)->first();
            $email = $supervisorData['email'];
            $name = $supervisorData['name'];

            $PMClass = new PMClass();
            $accessToken = $PMClass->pm_login(env('PM_USERNAME'), env('PM_PASSWORD'));
            $arrayResponse = $PMClass->pm_project_import("Asset_Tagging.pmx", $accessToken);
            $task_id = $PMClass->get_act_uid($arrayResponse['prj_uid'], $accessToken);
            $assign = $PMClass->assign_task_users($arrayResponse['prj_uid'], $accessToken, $task_id, $pm_user_id);
            Log::debug($arrayResponse);
            $Asset_Add = AssetEditModel::create(

                [
                    'ta_asset_type_master_id' => $asset->ta_asset_type_master_id,
                    'ta_asset_manufacture_serial_no' => $asset->ta_asset_manufacture_serial_no,
                    'ta_asset_name' => $asset->ta_asset_name,
                    'ta_asset_tag_number' => $requestData->tag_number,
                    'ta_asset_location_id' => $asset->ta_asset_location_id,
                    'ta_asset_catagory' => $asset->ta_asset_catagory,
                    'ta_asset_active_inactive_status' => $asset->ta_asset_active_inactive_status,
                    'ta_asset_image' => $asset_img,
                    'ta_asset_parent_id' => ($asset->ta_asset_parent_id) != null ? ($asset->ta_asset_parent_id) : 0,
                    'ta_asset_type_code' => $asset->ta_asset_name,
                    'operator_id' => $asset->operator_id,
                    'pm_project_id' => $arrayResponse["prj_uid"],
                    'is_shown' => ($asset->is_shown) != null ? $asset->is_shown : "0",
                    'ta_created_by' => Auth::user()->id,

                ]
            );
            $site_code = Location::where('tl_location_id', $asset->ta_asset_location_id)->first();
            TPmApproval::create(['tpm_asset_id' => $asset_id, 'tpm_asset_site_id' => $asset->ta_asset_location_id, 'pm_project_id' => $arrayResponse["prj_uid"], 'tpm_technician_id' => $user_id, 'tpm_supervisor_id' => $supervisor_details["supervisor_id"], 'technician_name' => $technician_details->name, 'approver_name' => $supervisorData->name, 'site_code' => $site_code->tl_location_code, 'task_title' => 'Asset Tagging', 'task_status' => 'Pending']);


            FarToAts::create([
                'proj_id' => $arrayResponse["prj_uid"],
                'f2a_asset_name' => $asset->ta_asset_name,
                'f2a_manufacture_serial_no' => $asset->ta_asset_manufacture_serial_no,
                'f2a_status' => 'Pending',
                'f2a_type' => 'Asset Tagging',
                'f2a_creation_date' => Carbon::now(),
                'f2a_created_by' => Auth::user()->id,
                'f2a_site_id' => $asset->ta_asset_location_id
            ]);

            $AssetDetails = asset::where('ta_asset_id', $requestData->asset_id)->first();
            $Serial_Number = $AssetDetails->ta_asset_manufacture_serial_no;

            $Site_details = Location::where('tl_location_id', $AssetDetails->ta_asset_location_id)->first(['tl_location_code', 'tl_location_name']);
            $Site_Code = $Site_details->tl_location_code;
            $Site_name = $Site_details->tl_location_name;

            mailLog::create(['mail_type' => 'Asset Tagging', 'subject' => 'New Asset Tagging ticket created in PM', 'mail_to' => $email, 'mail_body' => 'Ticket created for asset tagging in PM.<br>
       Here are the details:<br>
       Asset Serial No:' . $Serial_Number . '<br>
       Site Name:' . $Site_name . '<br>
       Site Code:' . $Site_Code]);
            return response()->json([
                'status' => 200,
                'message' => "Asset Tagging Succesfully."
            ]);
        }
    }
    public function asset_tagging_approve(Request $request)
    {
        $project_id = $request->project_id;
        $comment = $request->comment;
        $data = AssetEditModel::where('pm_project_id', $project_id)->first();
        $oldAssetData = asset::where('ta_asset_manufacture_serial_no', $data->ta_asset_manufacture_serial_no)->first();
        $location_code = Location::where('tl_location_id', $oldAssetData->ta_asset_location_id)->first();
        $locationid = $data->ta_asset_location_id;
        $Site_details = Location::where('tl_location_id', $locationid)->first(['tl_location_code', 'tl_location_name']);
        $Site_Code = $Site_details->tl_location_code;
        $Site_name = $Site_details->tl_location_name;
        $user_name = User::where('id', $data->ta_created_by)->first();
        $parent_asset_name = asset::where('ta_asset_id', $oldAssetData->ta_asset_parent_id)->first();
        $oldDataArray[0] = [
            'Serial No' => $oldAssetData->ta_asset_manufacture_serial_no,
            'Asset Name' => $oldAssetData->ta_asset_name,
            'Tag Number' => $oldAssetData->ta_asset_tag_number,
            'Location Code' => isset($location_code->tl_location_code) ? $location_code->tl_location_code : '',
        ];

        if (strtoupper($data->ta_asset_catagory) == 'ACTIVE') {
            $op_id = $data->operator_id;
        } else {
            $op_id = null;
        }
        $Asset_Add = asset::updateOrCreate(
            ['ta_asset_manufacture_serial_no' => $data->ta_asset_manufacture_serial_no . ""],
            [
                'ta_asset_tag_number' => $data->ta_asset_tag_number,
                'ta_last_updated_by' => $data->ta_created_by,
                'ta_asset_image' => $data->ta_asset_image,
                'operator_id' => $op_id,
                'ta_last_updated_date' => Carbon::now()
            ]
        );


        $AssetTagHistory = AssetTaggingHistory::updateOrCreate(
            [
                'th_location_id' => $data->ta_asset_location_id,
                'th_asset_id' => $oldAssetData->ta_asset_id,
                'th_asset_tag_number' => $data->ta_asset_tag_number
            ],
            [
                'th_location_id' => $data->ta_asset_location_id,
                'th_asset_id' => $oldAssetData->ta_asset_id,
                'th_asset_name' => $data->ta_asset_name,
                'th_asset_manufacture_serial_no' => $data->ta_asset_manufacture_serial_no,
                'th_asset_tag_number' => $data->ta_asset_tag_number,
                'th_asset_tagged_by' => $data->ta_created_by,
            ]
        );

        $Master_Asset_Data = [
            'ta_asset_id' => $data->ta_asset_id,
            'ta_asset_type_master_id' => $data->ta_asset_type_master_id,
            'ta_asset_manufacture_serial_no' => $data->ta_asset_manufacture_serial_no,
            'ta_asset_name' => $data->ta_asset_name,
            'ta_asset_tag_number' => $data->ta_asset_tag_number,
            'ta_asset_location_id' => $data->ta_asset_location_id,
            'ta_asset_catagory' => $data->ta_asset_catagory,
            'ta_asset_active_inactive_status' => $data->ta_asset_active_inactive_status,
            'ta_asset_parent_id' => $data->ta_asset_parent_id,
            'ta_asset_type_code' => $data->ta_asset_type_code,
            'operator_id' => $data->operator_id,
            'ta_asset_image' => $data->ta_asset_image,
            'pm_project_id' => $data->pm_project_id,
            'Site_Name' => $Site_name,
            'Site_Code' => $Site_Code,
            'Parent_asset_name' => isset($parent_asset_name->ta_asset_name) ? $parent_asset_name->ta_asset_name : null,
            'Operator_Name' => isset($operator_name->op_operator_name) ? $operator_name->op_operator_name : null,
            'Action_By' => $user_name->name,
            'Creation_Date' => $Asset_Add->ta_last_updated_date
        ];
        FarToAts::updateOrCreate(
            ['proj_id' => $project_id],
            [
                'f2a_status' => 'Approved',
                'f2a_type' => 'Asset Tagging',
                'f2a_creation_date' => Carbon::now(),
            ]
        );
        TPmApproval::updateOrCreate(
            ['pm_project_id' => $project_id],
            [
                'task_status' => 'Completed',
                'asset_data' => json_encode($Master_Asset_Data)
            ]
        );
        $location_code1 = Location::where('tl_location_id', $data->ta_asset_location_id)->first();

        $newData[0] = [
            'SerialNo' => $Asset_Add->ta_asset_manufacture_serial_no,
            'Asset Name' => $oldAssetData->ta_asset_name,
            'Tag Number' => $Asset_Add->ta_asset_tag_number,
            'Location Code' => isset($location_code1->tl_location_code) ? $location_code1->tl_location_code : '',

        ];
        Log::debug($AssetTagHistory);
        Observable::storeLog('Asset Tagging', 'App\Models\asset', 'UPDATED', $oldAssetData->ta_asset_id, $oldDataArray[0], $newData[0], $data->ta_created_by, 'Mobile App');
    }

    public function Get_task_list_by_location(Request $request)
    {
        $code = $request->location_code;
        $data = FarToAts::select('*')->where('f2a_site_code', $code)->where('f2a_status', 'Received')->whereIn('f2a_type', ['STN', 'SRN'])->get();
        return response()->json([
            "status" => 200,
            "data" => $data,
        ]);
    }

    public function update_srn(Request $request)
    {
        Log::debug($request);
        $asset_id = $request->asset_id;
        $user_id = $request->user_name;
        $srn_remarks = $request->remarks;
        $supervisor_id = $this->findSupervisor($user_id);
        $supervisor_details = Supervisor_to_technician::where('supervisor_id', $supervisor_id)->first(['supervisor_id', 'pm_user_id']);

        $pm_user_id = $supervisor_details->pm_user_id;
        $technician_details = User::where('id', $user_id)->first(['name']);

        $supervisorData = User::where('id', $supervisor_details["supervisor_id"])->first(['email', 'name']);


        $ta_asset_manufacture_serialno = asset::where('ta_asset_id', $asset_id)->whereNull('ta_effective_end_date')->first(['ta_asset_manufacture_serial_no', 'ta_asset_location_id']);


        $ta_asset_manufacture_serial_no = $ta_asset_manufacture_serialno['ta_asset_manufacture_serial_no'];

        $ta_asset_location_id = $ta_asset_manufacture_serialno['ta_asset_location_id'];

        if (isset($request->latitude)) {
            $resultsites = DB::connection('pgsql')->select("select tl_location_id from ats.lat_long(?, ?, ?)", [$request->latitude, $request->longitude, env('Asset_Add_Radius') / 1000]);
            $editable = 0;
            foreach ($resultsites as $sites) {
                if ($sites->tl_location_id == $request->location_id) {
                    $editable = 1;
                    break;
                }
            }
            if ($editable == 0) {
                return response()->json([
                    'status' => 404,
                    'message' => "Asset can be edited only  " . env('Asset_Add_Radius') . " meter distance from site",
                ]);
            }
        }

        $id = asset::where('ta_asset_id', $asset_id)->update(['ta_last_updated_date' => Carbon::now(), 'ta_last_updated_by' => $technician_details, 'is_shown' => '1', 'ta_asset_reason' =>  $srn_remarks]);

        $updatedRecordid = FarToAts::where('f2a_manufacture_serial_no', $ta_asset_manufacture_serial_no)->where('f2a_type', 'SRN')->where('f2a_status', 'Received')->first(['id']);


        $PMClass = new PMClass();
        $accessToken = $PMClass->pm_login(env('PM_USERNAME'), env('PM_PASSWORD'));
        $arrayResponse = $PMClass->pm_project_import("Srn.pmx", $accessToken);
        $task_id = $PMClass->get_act_uid($arrayResponse['prj_uid'], $accessToken);
        $assign = $PMClass->assign_task_users($arrayResponse['prj_uid'], $accessToken, $task_id, $pm_user_id);


        $SRN_DETAILS = Srn_insert_Model::create([
            'far_to_ats_id' => $updatedRecordid['id'],
            'srn_remarks' => $srn_remarks,
            'srn_asset_id' => $asset_id,
            'srn_creation_date' => Carbon::now(),
            'srn_created_by' => $user_id,
            'srn_projectt_id' => $arrayResponse["prj_uid"]
        ]);

        TPmApproval::create(['tpm_asset_id' => $asset_id, 'tpm_asset_site_id' => $ta_asset_location_id, 'pm_project_id' => $arrayResponse["prj_uid"], 'tpm_technician_id' => $user_id, 'tpm_supervisor_id' => $supervisor_details["supervisor_id"]]);

        asset::where('ta_asset_id', $asset_id)->update(['pm_project_id' => $arrayResponse["prj_uid"]]);

        $updatedRecord = FarToAts::where('f2a_manufacture_serial_no', $ta_asset_manufacture_serial_no)->where('f2a_type', 'SRN')->where('f2a_status', 'Received')->update(['f2a_status' => 'Pending', 'f2a_last_updated_date' => Carbon::now(), 'f2a_last_updated_by' => $user_id]);


        $email = $supervisorData['email'];
        $name = $supervisorData['name'];
        $farAssetId = $SRN_DETAILS->far_to_ats_id;
        $SRNDetails = FarToAts::where('id', $farAssetId)->select('f2a_file_name', 'f2a_site_code')->first();
        $SRNFileName1 = $SRNDetails->f2a_file_name;
        $path_parts = explode("/", $SRNFileName1);
        $SRNFileName = str_replace(".xlsx", "", $path_parts[count($path_parts) - 1]);
        $SRNSiteCode = $SRNDetails->f2a_site_code;


        mailLog::create(['mail_type' => 'SRNUpdate', 'subject' => 'New SRN ticket created in PM', 'mail_to' => $email, 'mail_body' => 'SRN ' . $SRNFileName . ' has been created for ' . $ta_asset_manufacture_serial_no . ' at site ' . $SRNSiteCode]);

        return response()->json([
            "status" => 200,
            "message" => 'SRN details updated successfully',
        ]);
    }
    /* SRN Approval */
    public function approve_pm_request(Request $request)
    {
        $project_id = $request->project_id;
        $comment = $request->comment;
        Srn_insert_Model::where('srn_projectt_id', $project_id)->update(['srn_comment' => $comment]);
        $data = Srn_insert_Model::where('srn_projectt_id', $project_id)->select('far_to_ats_id', 'srn_asset_id')->first();

        $farid = $data['far_to_ats_id'];

        $assetid = $data['srn_asset_id'];
        $manufacnumber = asset::where('ta_asset_id', $assetid)->select('ta_asset_manufacture_serial_no')->first();
        $manfacserialnumber = $manufacnumber['ta_asset_manufacture_serial_no'];
        FarToAts::where('f2a_manufacture_serial_no', $manfacserialnumber)->update(['f2a_status' => 'Approved', 'f2a_comment' => $comment]);
        asset::where('ta_asset_id', $assetid)->update(['is_shown' => false, 'ta_asset_location_id' => null]);
        AssetHistoryModel::where('asset_id', $assetid)->where('status', 1)->update(['moveout_date' => Carbon::now(), 'status' => 0]);

        $filename = FarToAts::where('f2a_manufacture_serial_no', $manfacserialnumber)->select('f2a_file_name')->first();

        return response()->json([
            "status" => 200,
            "message" => 'SRN Approved Successfully',
        ]);
    }
    /* SRN Reject */

    public function reject_pm_request(Request $request)
    {

        $project_id = $request->project_id;
        $comment = $request->comment;

        Srn_insert_Model::where('srn_projectt_id', $project_id)->update(['srn_comment' => $comment]);
        $farid = Srn_insert_Model::where('srn_projectt_id', $project_id)->select('far_to_ats_id', 'srn_asset_id', 'srn_created_by')->first();


        $farAssetId = $farid->far_to_ats_id;
        $assetid = $farid->srn_asset_id;
        $technicianid = $farid->srn_created_by;


        $technician_details = User::where('id', $technicianid)->first(['name', 'email']);
        $email = $technician_details['email'];
        $name = $technician_details['name'];

        FarToAts::where('id',)->update(['f2a_status' => 'Failed']);
        asset::where('ta_asset_id', $assetid)->update(['is_shown' => true]);
        $SRNDetails = FarToAts::where('id', $farAssetId)->select('f2a_file_name', 'f2a_site_code', 'f2a_manufacture_serial_no')->first();
        $serial_no = $SRNDetails->f2a_manufacture_serial_no;
        $SRNFileName1 = $SRNDetails->f2a_file_name;
        $path_parts = explode("/", $SRNFileName1);
        $SRNFileName = str_replace(".xlsx", "", $path_parts[count($path_parts) - 1]);
        $SRNSiteCode = $SRNDetails->f2a_site_code;

        mailLog::create(['mail_type' => 'SRNUpdate', 'subject' => 'SRN has been rejected.', 'mail_to' => $email, 'mail_body' => 'SRN ' . $SRNFileName . ' for Asset Serial No:' . $serial_no . ' at site ' . $SRNSiteCode . ' has been rejected.']);

        return response()->json([
            "status" => 200,
            "message" => 'SRN Rejected',
        ]);
    }

    public function update_stn(Request $request)
    {
        Log::debug($request);
        $requestData = json_decode($request["fields"]);
        $request1 = $request;
        $request = $requestData;
        $ta_asset_manufacture_serial_no = $request->manufacture_serial_no;
        if ($requestData->asset_id == '') {
            return response()->json([
                'status' => 404,
                'message' => 'please input an asset id',
            ]);
        }
        $checktag_number = asset::where('ta_asset_tag_number', $request->asset_tag_number)->count();
        $checktag_number1 = AssetEditModel::where('ta_asset_tag_number', $request->asset_tag_number)->count();
        if ($checktag_number > 0 || $checktag_number1 > 0) {
            return response()->json([
                'status' => 404,
                'message' => 'please give a unique tag number',
            ]);
        }
        $asset_id = $request->asset_id;
        $assetData = asset::where('ta_asset_id', $requestData->asset_id)->first();
        $user_id = Auth::user()->id;
        $stn_remarks = $request->remarks;
        $tag_number = $request->asset_tag_number;

        $supervisor_id = $this->findSupervisor($user_id);
        $supervisor_details = Supervisor_to_technician::where('supervisor_id', $supervisor_id)->first(['supervisor_id', 'pm_user_id']);

        $supervisorData = User::where('id', $supervisor_details["supervisor_id"])->first(['email', 'name']);

        $pm_user_id = $supervisor_details->pm_user_id;
        $technician_details = User::where('id', $user_id)->first(['name']);


        if (isset($request->latitude)) {
            $resultsites = DB::connection('pgsql')->select("select tl_location_id from ats.lat_long(?, ?, ?)", [$request->latitude, $request->longitude, env('Asset_Add_Radius') / 1000]);
            $editable = 0;
            foreach ($resultsites as $sites) {
                if ($sites->tl_location_id == $request->location_id) {
                    $editable = 1;
                    break;
                }
            }
            if ($editable == 0) {
                return response()->json([
                    'status' => 404,
                    'message' => "Asset can be edited only  " . env('Asset_Add_Radius') . " meter distance from site",
                ]);
            }
        }
        $updatedRecordid = FarToAts::where('f2a_manufacture_serial_no', $ta_asset_manufacture_serial_no)->where('f2a_type', 'STN')->where('f2a_status', 'Received')->first(['id']);



        $PMClass = new PMClass();
        $accessToken = $PMClass->pm_login(env('PM_USERNAME'), env('PM_PASSWORD'));
        $arrayResponse = $PMClass->pm_project_import("STN.pmx", $accessToken);
        $task_id = $PMClass->get_act_uid($arrayResponse['prj_uid'], $accessToken);
        $assign = $PMClass->assign_task_users($arrayResponse['prj_uid'], $accessToken, $task_id, $pm_user_id);

        $STN_DETAILS = stnModal::create([
            'far_to_ats_id' => $updatedRecordid['id'],
            'stn_remarks' => $stn_remarks,
            'stn_asset_id' => $asset_id,
            'stn_creation_date' => Carbon::now(),
            'stn_created_by' => $user_id,
            'stn_projectt_id' => $arrayResponse["prj_uid"]
        ]);

        TPmApproval::create(['tpm_asset_id' => $asset_id, 'tpm_asset_site_id' => $request->location_id, 'pm_project_id' => $arrayResponse["prj_uid"], 'tpm_technician_id' => $user_id, 'tpm_supervisor_id' => $supervisor_details["supervisor_id"]]);


        $Asset_Add = AssetEditModel::create(

            [
                'ta_asset_id' => $asset_id,
                'ta_asset_type_master_id' => $assetData->ta_asset_type_master_id,
                'ta_asset_manufacture_serial_no' => $request->manufacture_serial_no,
                'ta_asset_name' => $request->asset_name,
                'ta_asset_location_id' => $request->location_id,
                'ta_asset_catagory' => strtoupper($request->asset_catagory),
                'ta_asset_active_inactive_status' => $request->asset_active_inactive_status,
                'ta_asset_parent_id' => $assetData->ta_asset_parent_id,
                'ta_asset_type_code' => $assetData->ta_asset_type_code,
                'operator_id' => $request->operator_id,
                'pm_project_id' => $arrayResponse["prj_uid"],
                'ta_created_by' => $user_id,
                'ta_asset_tag_number' => $request->asset_tag_number,
                'ta_last_updated_date' => Carbon::now(),
                'is_shown' => '0',
                'ta_asset_reason' => $stn_remarks,

            ]
        );

        $data = $request->attributes;
        $Asset_Attr_Add_Update = [];

        foreach ($data as $value) {
            if ($value->attribute_value != "") {
                $Asset_Attr_Add_Update[] = AssetEditAttribute::updateOrCreate(
                    [
                        'at_asset_type_attribute_master_id' => $value->attr_master_id,
                        'at_asset_edit_id' => $Asset_Add->id,
                    ],
                    [
                        'at_asset_id' => $asset_id,
                        'at_asset_attribute_name' => $value->attribute_name,
                        'at_asset_attribute_value_text' => $value->attribute_value,
                    ]
                );
            }
        }

        $ta_asset_location_id = $request->location_id;

        $rqdata = $requestData->manufacture_serial_no;
        $asset_img = $request1->$rqdata;
        if (!empty($asset_img)) {
            $asset_img_name = $asset_img->getClientOriginalName();
            $asset_img->move(base_path() . '/storage/app/public/assetimage/', $asset_img_name);
            $asset_img = url('/storage/assetimage/' . $asset_img_name);
            AssetEditModel::where('id', $Asset_Add->id)->update(['ta_asset_image' => $asset_img]);
            $asset_img = "";
        }
        $updatedRecord = FarToAts::where('f2a_manufacture_serial_no', $ta_asset_manufacture_serial_no)->where('f2a_type', 'STN')->where('f2a_status', 'Received')->update(['f2a_status' => 'Pending', 'f2a_last_updated_date' => Carbon::now(), 'f2a_last_updated_by' => $request->user_name]);

        $email = $supervisorData['email'];
        $name = $supervisorData['name'];

        $farid = $STN_DETAILS->far_to_ats_id;
        $STNDetails = FarToAts::where('id', $farid)->select('f2a_file_name', 'f2a_site_code')->first();
        $STNFileName1 = $STNDetails->f2a_file_name;
        $path_parts = explode("/", $STNFileName1);
        $STNFileName = str_replace(".xlsx", "", $path_parts[count($path_parts) - 1]);
        $STNSiteCode = $STNDetails->f2a_site_code;
        mailLog::create(['mail_type' => 'STNUpdate', 'subject' => 'STN ticket created in PM', 'mail_to' => $email, 'mail_body' => 'STN ' . $STNFileName . ' for Asset Serial No:' . $ta_asset_manufacture_serial_no . ' at site ' . $STNSiteCode . ' has been created.']);
        return response()->json([
            "status" => 200,
            "message" => 'STN details submitted successfully',

        ]);
    }

    public function approve_pm_request_stn(Request $request)
    {

        Log::debug($request);
        $project_id = $request->project_id;
        $comment = $request->comment;
        $tech_id = stnModal::where('stn_projectt_id', $project_id)->select('stn_created_by')->first();
        stnModal::where('stn_projectt_id', $project_id)->update(['stn_comment' => $comment]);
        $data = stnModal::where('stn_projectt_id', $project_id)->select('far_to_ats_id', 'stn_asset_id')->first();
        $farid = $data['far_to_ats_id'];
        $assetid = $data['stn_asset_id'];
        FarToAts::where('id', $farid)->update(['f2a_status' => 'Approved']);

        $asst_details = asset::where('ta_asset_id', $assetid)->first();
        $data = AssetEditModel::where('pm_project_id', $project_id)->first();
        $farid = $data->ta_asset_manufacture_serial_no;
        FarToAts::where('f2a_manufacture_serial_no', $farid)->where('f2a_status', 'Pending')->where('f2a_type', 'ADDASSET')->update(['f2a_status' => 'Approved', 'f2a_reason' => $comment]);
        $oldAssetData = asset::where('ta_asset_manufacture_serial_no', $data->ta_asset_manufacture_serial_no)->first();
        $location_code = Location::where('tl_location_id', $oldAssetData->ta_asset_location_id)->first();
        $operator_name = Operator::where('op_id', $oldAssetData->operator_id)->first();
        $oldDataArray[0] = [
            'Serial No' => $oldAssetData->ta_asset_manufacture_serial_no . " ",
            'Asset Name' => $oldAssetData->ta_asset_name,
            'Tag Number' => $oldAssetData->ta_asset_tag_number,
            'Location Code' => isset($location_code->tl_location_code) ? $location_code->tl_location_code : '',
            'Asset Category' => $oldAssetData->ta_asset_catagory,
            'Status' => $oldAssetData->ta_asset_active_inactive_status,
            'Operator Name' => isset($operator_name->op_operator_name) ? $operator_name->op_operator_name : ''
        ];
        if (strtoupper($data->ta_asset_catagory) == 'ACTIVE') {
            $op_id = $data->operator_id;
        } else {
            $op_id = null;
        }
        $Asset_Add = asset::updateOrCreate(
            ['ta_asset_manufacture_serial_no' => $data->ta_asset_manufacture_serial_no],
            [
                'ta_asset_type_master_id' => $data->ta_asset_type_master_id,
                'ta_asset_manufacture_serial_no' => $data->ta_asset_manufacture_serial_no,
                'ta_asset_name' => $data->ta_asset_name,
                'ta_asset_tag_number' => $data->ta_asset_tag_number,
                'ta_asset_location_id' => $data->ta_asset_location_id,
                'ta_asset_catagory' => $data->ta_asset_catagory,
                'ta_asset_active_inactive_status' => $data->ta_asset_active_inactive_status,
                'ta_asset_parent_id' => $data->ta_asset_parent_id,
                'ta_asset_type_code' => $data->ta_asset_type_code,
                'operator_id' => $op_id,
                'ta_asset_image' => $data->ta_asset_image,
                'pm_project_id' => $data->pm_project_id,
                'is_shown' => 'true',
                'created_at' => now(),
            ]
        );

        Log::debug($data->ta_created_by);
        $AssetTagHistory = AssetTaggingHistory::updateOrCreate(
            [
                'th_location_id' => $data->ta_asset_location_id,
                'th_asset_id' => $Asset_Add->ta_asset_id,
                'th_asset_tag_number' => $data->ta_asset_tag_number,

            ],
            [
                'th_location_id' => $data->ta_asset_location_id,
                'th_asset_id' => $Asset_Add->ta_asset_id,
                'th_asset_name' => $data->ta_asset_name,
                'th_asset_manufacture_serial_no' => $data->ta_asset_manufacture_serial_no,
                'th_asset_tag_number' => $data->ta_asset_tag_number,
                'th_asset_tagged_by' => $data->ta_created_by,
            ]
        );
        $parent_id = asset::where('ta_asset_manufacture_serial_no', $data->ta_asset_manufacture_serial_no)->first();
        $parent_asset_name = asset::where('ta_asset_id', $parent_id->ta_asset_parent_id)->first();
        $Site_details = Location::where('tl_location_id', $data->ta_asset_location_id)->first(['tl_location_code', 'tl_location_name']);
        $Site_Code = $Site_details->tl_location_code;
        $Site_name = $Site_details->tl_location_name;
        $user_name = User::where('id', $data->ta_created_by)->first();
        $Master_Asset_Data = [
            'ta_asset_id' => $Asset_Add->ta_asset_id,
            'ta_asset_type_master_id' => $data->ta_asset_type_master_id,
            'ta_asset_manufacture_serial_no' => $data->ta_asset_manufacture_serial_no,
            'ta_asset_name' => $data->ta_asset_name,
            'ta_asset_tag_number' => $data->ta_asset_tag_number,
            'ta_asset_location_id' => $data->ta_asset_location_id,
            'ta_asset_catagory' => $data->ta_asset_catagory,
            'ta_asset_active_inactive_status' => $data->ta_asset_active_inactive_status,
            'ta_asset_parent_id' => $data->ta_asset_parent_id,
            'ta_asset_type_code' => $data->ta_asset_type_code,
            'operator_id' => $data->operator_id,
            'ta_asset_image' => $data->ta_asset_image,
            'pm_project_id' => $data->pm_project_id,
            'is_shown' => $Asset_Add->is_shown,
            'Operator_Name' => isset($operator_name->op_operator_name) ? $operator_name->op_operator_name : null,
            'Parent_asset_name' => isset($parent_asset_name->ta_asset_name) ? $parent_asset_name->ta_asset_name : null,
            'Site_Name' => $Site_name,
            'Site_Code' => $Site_Code,
            'Action_By' => isset($user_name->name) ? $user_name->name : null,
            'Creation_Date' => $Asset_Add->created_at
        ];
        $childs = asset::where('ta_asset_parent_id', $asst_details->ta_asset_id)->count();

        $Child_Serial_Number = "";
        if ($childs > 0) {

            $childs_data = asset::where('ta_asset_parent_id', $asst_details->ta_asset_id)->get();
            $Child_Serial_Number = $this->child_asset_move($childs_data, $asst_details->ta_asset_id, $data->ta_asset_location_id);
        }
        $location_code1 = Location::where('tl_location_id', $Asset_Add->ta_asset_location_id)->first();
        $operator_name1 = Operator::where('op_id', $Asset_Add->operator_id)->first();

        $newData[0] = [
            'Serial No' => $Asset_Add->ta_asset_manufacture_serial_no,
            'Asset Name' => $Asset_Add->ta_asset_name,
            'Tag Number' => $Asset_Add->ta_asset_tag_number,
            'Location Code' => isset($location_code1->tl_location_code) ? $location_code1->tl_location_code : '',
            'Asset Category' => $Asset_Add->ta_asset_catagory,
            'Status' => $Asset_Add->ta_asset_active_inactive_status,
            'Operator Name' => isset($operator_name1->op_operator_name) ? $operator_name1->op_operator_name : '',
        ];


        $asset = asset::where('ta_asset_manufacture_serial_no', $data->ta_asset_manufacture_serial_no)->first();
        $dataAttributes = AssetEditAttribute::where('at_asset_edit_id', $data->id)->get();

        $Asset_Attr_Add_Update = [];
        foreach ($dataAttributes as $value) {
            if ($value['at_asset_attribute_name'] == 'Status' && in_array($value['at_asset_attribute_value_text'], ['Missing', 'Redundant', 'Scrap'])) {
                asset::where('ta_asset_manufacture_serial_no', $data->ta_asset_manufacture_serial_no)->update(['is_shown' => false]);
            }
            $oldAttr = Asset_Attribute::where('at_asset_type_attribute_master_id', $value['at_asset_type_attribute_master_id'])->where(
                'at_asset_id',
                $value['at_asset_id']
            )->first();
            if ($oldAttr) {
                $oldDataArray[0][$oldAttr->at_asset_attribute_name] = $oldAttr->at_asset_attribute_value_text;
            }

            $Asset_Attr_Add_Update[] = Asset_Attribute::updateOrCreate(
                [
                    'at_asset_type_attribute_master_id' => $value['at_asset_type_attribute_master_id'],
                    'at_asset_id' => $value['at_asset_id']
                ],
                [
                    'at_asset_attribute_name' => $value['at_asset_attribute_name'],
                    'at_asset_attribute_value_text' => $value['at_asset_attribute_value_text'],
                ]
            );
            $Master_Asset_Data_attr[] = [
                'at_asset_id' => $Asset_Add->ta_asset_id,
                'at_asset_attribute_name' => $value['at_asset_attribute_name'],
                'at_asset_attribute_value_text' => $value['at_asset_attribute_value_text'],
                'at_asset_type_attribute_master_id' => $value['at_asset_type_attribute_master_id']
            ];
            $newData[0][$value['at_asset_attribute_name']] = $value['at_asset_attribute_value_text'];
        }




        Observable::storeLog('STN Modification', 'App\Models\asset', 'UPDATED', $asset->ta_asset_id, $oldDataArray[0], $newData[0], $tech_id->stn_created_by, 'Mobile App');

        $Master_Asset_Data['attr'] = $Master_Asset_Data_attr;

        AssetHistoryModel::create(['movein_date' => Carbon::now(), 'status' => 1, 'asset_id' => $assetid, 'location_id' => $asst_details->ta_asset_location_id, 'asset_data' => json_encode($Master_Asset_Data)]);
        return response()->json([
            "status" => 200,
            "message" => 'STN Approved Successfully',
        ]);
    }


    public function reject_pm_request_stn(Request $request)
    {
        $project_id = $request->project_id;
        $comment = $request->comment;
        stnModal::where('stn_projectt_id', $project_id)->update(['stn_comment' => $comment]);
        $data = stnModal::where('stn_projectt_id', $project_id)->select('far_to_ats_id', 'stn_asset_id', 'stn_created_by')->first();
        $farid = $data['far_to_ats_id'];
        $assetid = $data['stn_asset_ids'];
        $technicianid = $data->stn_created_by;

        $technician_details = User::where('id', $technicianid)->first(['name', 'email']);
        $email = $technician_details['email'];
        $name = $technician_details['name'];
        $STNDetails = FarToAts::where('id', $farid)->select('f2a_file_name', 'f2a_site_code', 'f2a_manufacture_serial_no')->first();
        $Serial_No = $STNDetails->f2a_manufacture_serial_no;
        $STNFileName1 = $STNDetails->f2a_file_name;
        $path_parts = explode("/", $STNFileName1);
        $STNFileName = str_replace(".xlsx", "", $path_parts[count($path_parts) - 1]);
        $STNSiteCode = $STNDetails->f2a_site_code;
        FarToAts::where('id', $farid)->update(['f2a_status' => 'Rejected']);
        asset::where('ta_asset_id', $assetid)->update(['is_shown' => false]);

        mailLog::create(['mail_type' => 'STNUpdate', 'subject' => 'STN has been rejected.', 'mail_to' => $email, 'mail_body' => 'STN ' . $STNFileName . ' for Asset Serial No:' . $Serial_No . ' at site ' . $STNSiteCode . ' has been rejected.']);


        return response()->json([
            "status" => 200,
            "message" => 'STN Rejected',
        ]);
    }


    public function add_asset(Request $request)
    {
        Log::debug($request);

        $requestData = json_decode($request["fields"]);

        if ($requestData->ta_asset_manufacture_serial_no == '') {
            return response()->json([
                'status' => 404,
                'message' => 'please input a manufactural serial number',
            ]);
        }
        $asset_id_check = asset::where('ta_asset_manufacture_serial_no', $requestData->ta_asset_manufacture_serial_no)->first();
        if (!empty($asset_id_check)) {

            $checktag_number = asset::where('ta_asset_tag_number', $requestData->ta_asset_tag_number)->where('ta_asset_id', '!=', $asset_id_check->ta_asset_id)->count();
            $checktag_number1 = AssetEditModel::where('ta_asset_tag_number', $requestData->ta_asset_tag_number)->where('ta_asset_id', '!=', $asset_id_check->ta_asset_id)->count();
        } else {
            $checktag_number = asset::where('ta_asset_tag_number', $requestData->ta_asset_tag_number)->count();
            $checktag_number1 = AssetEditModel::where('ta_asset_tag_number', $requestData->ta_asset_tag_number)->count();
        }
        if ($checktag_number > 0 || $checktag_number1 > 0) {
            return response()->json([
                'status' => 404,
                'message' => 'please give a unique tag number',
            ]);
        }

        $existingasset = asset::where('ta_asset_manufacture_serial_no', $requestData->ta_asset_manufacture_serial_no)->where('ta_asset_location_id', $requestData->ta_asset_location_id)->where('is_shown', true)->count();
        if ($existingasset > 0) {
            return response()->json([
                'status' => 404,
                'message' => 'This asset is already in this site.',
            ]);
        }
        if (isset($requestData->latitude)) {
            $resultsites = DB::connection('pgsql')->select("select tl_location_id from ats.lat_long(?, ?, ?)", [$requestData->latitude, $requestData->longitude, env('Asset_Add_Radius') / 1000]);
            $editable = 0;
            foreach ($resultsites as $sites) {
                if ($sites->tl_location_id == $requestData->ta_asset_location_id) {
                    $editable = 1;
                    break;
                }
            }
            if ($editable == 0) {
                return response()->json([
                    'status' => 404,
                    'message' => "Asset can be added only  " . env('Asset_Add_Radius') . " meter distance from site",
                ]);
            }
        }



        $user_id = auth('api')->user()->id;
        $supervisor_id = $this->findSupervisor($user_id);
        if ($supervisor_id == 0) {
            return response()->json([
                'status' => 404,
                'message' => "No suppervisor is assigned with you.",
            ]);
        }
        $supervisor_details = Supervisor_to_technician::where('supervisor_id', $supervisor_id)->first(['supervisor_id', 'pm_user_id']);

        $supervisorData = User::where('id', $supervisor_details["supervisor_id"])->first(['email', 'name']);
        $pm_user_id = $supervisor_details['pm_user_id'];
        $technician_details = User::where('id', $user_id)->first(['name']);
        $PMClass = new PMClass();
        $accessToken = $PMClass->pm_login(env('PM_USERNAME'), env('PM_PASSWORD'));
        $arrayResponse = $PMClass->pm_project_import("Add_Assets.pmx", $accessToken);
        $task_id = $PMClass->get_act_uid($arrayResponse['prj_uid'], $accessToken);
        $assign = $PMClass->assign_task_users($arrayResponse['prj_uid'], $accessToken, $task_id, $pm_user_id);

        // fields

        $Parent_Asset_Add = AssetEditModel::updateOrCreate(
            ['ta_asset_manufacture_serial_no' => $requestData->ta_asset_manufacture_serial_no],
            [
                'ta_asset_type_master_id' => $requestData->ta_asset_type_master_id,
                'ta_asset_manufacture_serial_no' => $requestData->ta_asset_manufacture_serial_no,
                'ta_asset_name' => $requestData->ta_asset_name,
                'ta_asset_tag_number' => $requestData->ta_asset_tag_number,
                'ta_asset_location_id' => $requestData->ta_asset_location_id,
                'ta_asset_catagory' => strtoupper($requestData->ta_asset_catagory),
                'ta_asset_active_inactive_status' => $requestData->ta_asset_active_inactive_status,
                'ta_asset_parent_id' => isset($requestData->ta_asset_parent_id) ? $requestData->ta_asset_parent_id : 0,
                'ta_asset_type_code' => $requestData->ta_asset_type_code,
                'operator_id' => $requestData->operator_id,
                'pm_project_id' => $arrayResponse["prj_uid"],
                'ta_created_by' => $user_id,
                'is_shown' => 0,
            ]
        );
        $site_code = Location::where('tl_location_id', $requestData->ta_asset_location_id)->first();


        FarToAts::create([
            'proj_id' => $arrayResponse["prj_uid"],
            'f2a_asset_name' => $requestData->ta_asset_name,
            'f2a_manufacture_serial_no' => $requestData->ta_asset_manufacture_serial_no,
            'f2a_status' => 'Received',
            'f2a_type' => 'ADDASSET',
            'f2a_creation_date' => Carbon::now(),
            'f2a_created_by' => $user_id
        ]);
        TPmApproval::create([
            'tpm_asset_id' => $Parent_Asset_Add->id, 'tpm_asset_site_id' => $requestData->ta_asset_location_id, 'pm_project_id' => $arrayResponse["prj_uid"], 'tpm_technician_id' => $user_id, 'tpm_supervisor_id' => $supervisor_details["supervisor_id"],
            'technician_name' => $technician_details->name, 'approver_name' => $supervisorData->name, 'site_code' => $site_code->tl_location_code, 'task_title' => 'Add Asset', 'task_status' => 'Pending'

        ]);
        $data = $requestData->TypeAttr;

        $Asset_Attr_Add_Update = [];
        foreach ($data as $value) {
            if ($value->at_asset_attribute_value_text != "") {
                $Asset_Attr_Add_Update[] = AssetEditAttribute::updateOrCreate(
                    [
                        'at_asset_type_attribute_master_id' => $value->TypeAttrMaster->ata_asset_type_attribute_id,
                        'at_asset_edit_id' => $Parent_Asset_Add->id,
                    ],
                    [
                        'at_asset_edit_id' => $Parent_Asset_Add->id,
                        'at_asset_attribute_name' => $value->TypeAttrMaster->ata_asset_type_attribute_name,
                        'at_asset_attribute_value_text' => $value->at_asset_attribute_value_text,
                    ]
                );
            }
        }
        $Serial_Number = $Parent_Asset_Add->ta_asset_manufacture_serial_no;

        $Site_details = Location::where('tl_location_id', $requestData->ta_asset_location_id)->first(['tl_location_code', 'tl_location_name']);
        $Site_Code = $Site_details->tl_location_code;
        $Site_name = $Site_details->tl_location_name;
        $email = $supervisorData['email'];
        $name = $supervisorData['name'];
        $Parent_Asset_Add->makehidden(['TypeAttr', 'childs']);
        $rqdata = $requestData->ta_asset_manufacture_serial_no;
        $asset_img = $request->$rqdata;
        if (!empty($asset_img)) {
            $asset_img_name = $asset_img->getClientOriginalName();
            $asset_img->move(base_path() . '/storage/app/public/assetimage/', $asset_img_name);
            $asset_img = url('/storage/assetimage/' . $asset_img_name);
            AssetEditModel::where('id', $Parent_Asset_Add->id)->update(['ta_asset_image' => $asset_img]);
            $asset_img = "";
        }
        $Child_Serial_Number = "";
        if (count($requestData->childs) > 0) {

            $Child_Serial_Number = $this->childs_insert($requestData->childs, $Parent_Asset_Add->id, $user_id, $request);
        }
        if (strlen($Child_Serial_Number) > 1) {
            $Child_Serial_Number = 'Child(s) Asset Serial No: ' . trim($Child_Serial_Number, ", ") . '<br>';
        }
        mailLog::create(['mail_type' => 'AddAsset', 'subject' => 'New Add Asset Ticket Created', 'mail_to' => $email, 'mail_body' => 'An asset has been created in PM.<br>
          Here are the details:<br>
          Parent Asset Serial No: ' . $Serial_Number . '<br>
          ' . $Child_Serial_Number . '
          Site Name: ' . $Site_name . '<br>
          Site Code: ' . $Site_Code]);

        return response()->json([
            'status' => 200,
            'ta_asset_id' => $Parent_Asset_Add->ta_asset_id,
            'message' => "Asset added Successfully"
        ]);
    }
    public function approve_pm_request_asset(Request $request)
    {
        $project_id = $request->project_id;
        $comment = $request->comment;

        $data = AssetEditModel::where('pm_project_id', $project_id)->first();
        $farid = $data->ta_asset_manufacture_serial_no;
        $ta_created_by = $data->ta_created_by;
        Log::debug($ta_created_by);
        $supervisor_id = $this->findSupervisor($data->ta_created_by);
        $supervisor_details = Supervisor_to_technician::where('supervisor_id', $supervisor_id)->first(['supervisor_id', 'pm_user_id']);
        $supervisorData = User::where('id', $supervisor_details["supervisor_id"])->first(['email', 'name']);
        $email = $supervisorData['email'];

        $Serial_Number = $data->ta_asset_manufacture_serial_no;
        if (strtoupper($data->ta_asset_catagory) == 'ACTIVE') {
            $op_id = $data->operator_id;
        } else {
            $op_id = null;
        }
        // Parent asset add
        $Asset_Add = asset::updateOrCreate(
            ['ta_asset_manufacture_serial_no' => $data->ta_asset_manufacture_serial_no],
            [
                'ta_asset_type_master_id' => $data->ta_asset_type_master_id,
                'ta_asset_manufacture_serial_no' => $data->ta_asset_manufacture_serial_no,
                'ta_asset_name' => $data->ta_asset_name,
                'ta_asset_tag_number' => $data->ta_asset_tag_number,
                'ta_asset_location_id' => $data->ta_asset_location_id,
                'ta_asset_catagory' => $data->ta_asset_catagory,
                'ta_asset_active_inactive_status' => $data->ta_asset_active_inactive_status,
                'ta_asset_parent_id' => $data->ta_asset_parent_id,
                'ta_asset_type_code' => $data->ta_asset_type_code,
                'operator_id' => $op_id,
                'ta_asset_image' => $data->ta_asset_image,
                'pm_project_id' => $data->pm_project_id,
                'ta_created_by' => $data->ta_created_by,
                'created_at' => now(),
                'is_shown' => true,
            ]
        );
        $asset_details = asset::where('ta_asset_manufacture_serial_no', $data->ta_asset_manufacture_serial_no)->first();
        $childs = asset::where('ta_asset_parent_id', $asset_details->ta_asset_id)->count();

        if ($childs > 0) {

            $childs_data = asset::where('ta_asset_parent_id', $asset_details->ta_asset_id)->get();
            $this->child_asset_move($childs_data, $asset_details->ta_asset_id, $data->ta_asset_location_id);
        }

        $AssetTagHistory = AssetTaggingHistory::updateOrCreate(
            [
                'th_location_id' => $data->ta_asset_location_id,
                'th_asset_id' => $Asset_Add->ta_asset_id,
                'th_asset_tag_number' => $data->ta_asset_tag_number
            ],
            [
                'th_location_id' => $data->ta_asset_location_id,
                'th_asset_id' => $Asset_Add->ta_asset_id,
                'th_asset_name' => $data->ta_asset_name,
                'th_asset_manufacture_serial_no' => $data->ta_asset_manufacture_serial_no,
                'th_asset_tag_number' => $data->ta_asset_tag_number,
                'th_asset_tagged_by' => $data->ta_created_by,
            ]
        );
        $parent_asset_name = asset::where('ta_asset_id', $data->ta_asset_parent_id)->first();
        $locationid = $Asset_Add->ta_asset_location_id;
        $Site_details = Location::where('tl_location_id', $locationid)->first(['tl_location_code', 'tl_location_name']);
        $Site_Code = $Site_details->tl_location_code;
        $Site_name = $Site_details->tl_location_name;
        $user_name = User::where('id', $data->ta_created_by)->first();
        if ($data->operator_id != "") {
            $operator_name = Operator::where('op_id', $data->operator_id)->first();
        }


        $Asset_type = Asset_type_model::where('at_asset_type_id', $data->ta_asset_type_master_id)->first();
        $Master_Asset_Data = [
            'ta_asset_id' => $Asset_Add->ta_asset_id,
            'ta_asset_type_master_id' => $data->ta_asset_type_master_id,
            'ta_asset_manufacture_serial_no' => $data->ta_asset_manufacture_serial_no,
            'ta_asset_name' => $data->ta_asset_name,
            'ta_asset_tag_number' => $data->ta_asset_tag_number,
            'ta_asset_location_id' => $data->ta_asset_location_id,
            'ta_asset_catagory' => $data->ta_asset_catagory,
            'ta_asset_active_inactive_status' => $data->ta_asset_active_inactive_status,
            'ta_asset_parent_id' => $data->ta_asset_parent_id,
            'ta_asset_type_code' => $data->ta_asset_type_code,
            'operator_id' => $data->operator_id,
            'ta_asset_image' => $data->ta_asset_image,
            'pm_project_id' => $data->pm_project_id,
            'is_shown' => $Asset_Add->is_shown,
            'Asset_Type' => $Asset_type->at_asset_type_name,
            'Site_Name' => $Site_name,
            'Site_Code' => $Site_Code,
            'Parent_asset_name' => isset($parent_asset_name->ta_asset_name) ? $parent_asset_name->ta_asset_name : null,
            'Operator_Name' => isset($operator_name->op_operator_name) ? $operator_name->op_operator_name : null,
            'Action_By' => $user_name->name,
            'Creation_Date' => $Asset_Add->created_at

        ];
        $astid = $Asset_Add->ta_asset_id;


        $dataAttributes = AssetEditAttribute::where('at_asset_edit_id', $data->id)->get();
        $Asset_Attr_Add_Update = [];
        foreach ($dataAttributes as $value) {

            $Asset_Attr_Add_Update[] = Asset_Attribute::updateOrCreate(
                [
                    'at_asset_id' => $Asset_Add->ta_asset_id,
                    'at_asset_type_attribute_master_id' => $value['at_asset_type_attribute_master_id']
                ],
                [
                    'at_asset_id' => $Asset_Add->ta_asset_id,
                    'at_asset_attribute_name' => $value['at_asset_attribute_name'],
                    'at_asset_attribute_value_text' => $value['at_asset_attribute_value_text'],
                    'at_asset_type_attribute_master_id' => $value['at_asset_type_attribute_master_id']
                ]
            );
            if ($value['at_asset_attribute_name'] == 'Status' && in_array($value['at_asset_attribute_value_text'], ['In Transit', 'Used', 'Idle'])) {
                asset::where('ta_asset_manufacture_serial_no', $data->ta_asset_manufacture_serial_no)->update(['is_shown' => true]);
            }
            $Attribute_type = Asset_type_attribute_master_model::where('ata_asset_type_attribute_id', $value['at_asset_type_attribute_master_id'])->first();
            $Master_Asset_Data_attr[] = [
                'at_asset_id' => $Asset_Add->ta_asset_id,
                'at_asset_attribute_name' => $value['at_asset_attribute_name'],
                'at_asset_attribute_value_text' => $value['at_asset_attribute_value_text'],
                'at_asset_type_attribute_master_id' => $value['at_asset_type_attribute_master_id'],
                'attr_catagory' => $Attribute_type->attribute_catagory
            ];
            // }     
        }
        $Master_Asset_Data['attr'] = $Master_Asset_Data_attr;

        AssetHistoryModel::whereNull('moveout_date')->where('asset_id', $astid)->where('status', 1)->update(['moveout_date' => Carbon::now(), 'status' => 0]);

        AssetHistoryModel::create(['movein_date' => Carbon::now(), 'status' => 1, 'asset_id' => $astid, 'location_id' => $locationid, 'asset_data' => json_encode($Master_Asset_Data)]);

        FarToAts::updateOrCreate(
            ['proj_id' => $project_id],
            [
                'f2a_status' => 'Approved', 'f2a_reason' => $comment,
                'f2a_creation_date' => Carbon::now(),
            ]
        );
        TPmApproval::updateOrCreate(
            ['pm_project_id' => $project_id],
            [
                'task_status' => 'Completed',
                'asset_data' => json_encode($Master_Asset_Data)
            ]
        );


        // Child Asset Add
        $childs = AssetEditModel::where('ta_asset_parent_id', $data->id)->count();
        $Child_Serial_Number = "";
        if ($childs > 0) {

            $childs_data = AssetEditModel::where('ta_asset_parent_id', $data->id)->get();
            $Child_Serial_Number = $this->childs_asset_approve($childs_data, $astid);
        }

        $childSlno = trim($Child_Serial_Number, ", ");
        if (strlen($Child_Serial_Number) > 1) {
            $Child_Serial_Number = 'Child(s) Asset Serial No: ' . $childSlno . '<br>';
        }

        mailLog::create(['mail_type' => 'AddAsset', 'subject' => 'Add Asset Ticket Approved', 'mail_to' => $email, 'mail_body' => 'Add asset has been Approved in PM.<br>
          Here are the details:<br>
          Parent Asset Serial No: ' . $Serial_Number . '<br>
          ' . $Child_Serial_Number . '
          Site Name: ' . $Site_name . '<br>
          Site Code: ' . $Site_Code]);
        $oldDataArray = [];
        $newData = ['Asset Serial No' => $Serial_Number, 'Child Asset Serial No' => $childSlno, 'Site Name' => $Site_name, 'Site Code' => $Site_Code];
        Observable::storeLog('Asset Addition', 'App\Models\asset', 'CREATED', 0, $oldDataArray, $newData, $ta_created_by, 'Mobile App');
        return response()->json([
            "status" => 200,
            "message" => 'Assets Added Successfully',
        ]);
    }
    public function reject_pm_request_asset(Request $request)
    {

        $project_id = $request->project_id;
        $comment = $request->comment;
        $data = AssetEditModel::where('pm_project_id', $project_id)->first();
        $farid = $data['ta_asset_manufacture_serial_no'];
        FarToAts::where('f2a_manufacture_serial_no', $farid)->where('f2a_status', 'Pending')->where('f2a_type', 'ADDASSET')->update(['f2a_status' => 'Reject', 'f2a_reason' => $comment]);
        $AssetDetails = AssetEditModel::where('pm_project_id', $project_id)->select('ta_asset_manufacture_serial_no', 'ta_asset_name', 'ta_asset_location_id')->first();
        $serial_no = $AssetDetails->ta_asset_manufacture_serial_no;
        $asset_name = $AssetDetails->ta_asset_name;
        $Site_details = Location::where('tl_location_id', $AssetDetails->ta_asset_location_id)->first(['tl_location_code', 'tl_location_name']);
        $Site_Code = $Site_details->tl_location_code;
        $Site_name = $Site_details->tl_location_name;
        $supervisor_id = $this->findSupervisor($data->ta_created_by);
        $supervisor_details = Supervisor_to_technician::where('supervisor_id', $supervisor_id)->first(['supervisor_id', 'pm_user_id']);
        $supervisorData = User::where('id', $supervisor_details["supervisor_id"])->first(['email', 'name']);
        $email = $supervisorData['email'];
        $childs = AssetEditModel::where('ta_asset_parent_id', $data->id)->get();
        $Child_Serial_Number = "";
        foreach ($childs as $child) {
            $Child_Serial_Number = $Child_Serial_Number . $child->ta_asset_manufacture_serial_no . ", ";
        }
        if (strlen($Child_Serial_Number) > 1) {
            $Child_Serial_Number = 'Child(s) Asset Serial No: ' . trim($Child_Serial_Number, ", ") . '<br>';
        }
        mailLog::create(['mail_type' => 'SRNUpdate', 'subject' => 'An asset has been rejected.', 'mail_to' => $email, 'mail_body' => 'An asset has been rejected in PM.<br>
        Here are the details:<br>
        Asset Serial No: ' . $serial_no . '<br>
        ' . $Child_Serial_Number . '
        Site Name: ' . $Site_name . '<br>
        Site Code: ' . $Site_Code]);


        return response()->json([
            "status" => 200,
            "message" => 'Asset Rejected Successfully',
        ]);
    }

    public function edit_asset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'manufacture_serial_no' => 'required',
            'user_name' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 404,
                'message' => $validator->errors()->first(),
            ]);
        } else {
            $user_id = Auth::User()->id;
            $supervisor_id = $this->findSupervisor($user_id);
            Log::debug($supervisor_id);
            if (isset($request->latitude)) {
                $resultsites = DB::connection('pgsql')->select("select tl_location_id from ats.lat_long(?, ?, ?)", [$request->latitude, $request->longitude, env('Asset_Add_Radius') / 1000]);
                $editable = 0;
                foreach ($resultsites as $sites) {
                    if ($sites->tl_location_id == $request->location_id) {
                        $editable = 1;
                        break;
                    }
                }
                if ($editable == 0) {
                    return response()->json([
                        'status' => 404,
                        'message' => "Asset can be edited only  " . env('Asset_Add_Radius') . " meter distance from site",
                    ]);
                }
            }
            $supervisor_details = Supervisor_to_technician::where('supervisor_id', $supervisor_id)->first(['supervisor_id', 'pm_user_id']);

            $supervisorData = User::where('id', $supervisor_details["supervisor_id"])->first(['email', 'name']);
            $pm_user_id = $supervisor_details['pm_user_id'];
            $technician_details = User::where('id', $user_id)->first(['name']);
            $PMClass = new PMClass();
            $accessToken = $PMClass->pm_login(env('PM_USERNAME'), env('PM_PASSWORD'));
            $arrayResponse = $PMClass->pm_project_import("Edit_Asset.pmx", $accessToken);
            $task_id = $PMClass->get_act_uid($arrayResponse['prj_uid'], $accessToken);
            $assign = $PMClass->assign_task_users($arrayResponse['prj_uid'], $accessToken, $task_id, $pm_user_id);
            Log::debug($task_id);
            Log::debug(json_encode($assign));

            $Asset_Add = AssetEditModel::create(

                [
                    'ta_asset_type_master_id' => $request->ta_asset_type_master_id,
                    'ta_asset_manufacture_serial_no' => $request->manufacture_serial_no,
                    'ta_asset_name' => $request->asset_name,
                    'ta_asset_tag_number' => $request->asset_tag_number,
                    'ta_asset_location_id' => $request->location_id,
                    'ta_asset_catagory' => strtoupper($request->asset_catagory),
                    'ta_asset_active_inactive_status' => $request->asset_active_inactive_status,
                    'ta_asset_parent_id' => ($request->asset_parent_id) != null ? $request->asset_parent_id : 0,
                    'ta_asset_type_code' => $request->asset_type_name,
                    'operator_id' => $request->operator_id,
                    'pm_project_id' => $arrayResponse["prj_uid"],
                    'is_shown' => $request->is_shown ? $request->is_shown : "0",
                    'ta_created_by' => $user_id
                ]
            );

            FarToAts::create([
                'proj_id' => $arrayResponse["prj_uid"],
                'f2a_asset_name' => $request->asset_name,
                'f2a_manufacture_serial_no' => $request->manufacture_serial_no,
                'f2a_status' => 'Received',
                'f2a_type' => 'Edit Asset',
                'f2a_creation_date' => Carbon::now(),
                'f2a_created_by' => $user_id
            ]);
            $asset = asset::where('ta_asset_manufacture_serial_no', $request->manufacture_serial_no)->first();
            $site_code = Location::where('tl_location_id', $request->location_id)->first();
            TPmApproval::create([
                'tpm_asset_id' => $Asset_Add->id, 'tpm_asset_site_id' => $request->location_id, 'pm_project_id' => $arrayResponse["prj_uid"], 'tpm_technician_id' => $user_id, 'tpm_supervisor_id' => $supervisor_details["supervisor_id"],
                'technician_name' => $technician_details->name, 'approver_name' => $supervisorData->name, 'site_code' => $site_code->tl_location_code, 'task_title' => 'Edit Asset', 'task_status' => 'Pending'
            ]);
            $data = $request->input('attributes');
            $Asset_Attr_Add_Update = [];

            foreach ($data as $value) {
                if ($value['attribute_value'] != "") {
                    $Asset_Attr_Add_Update[] = AssetEditAttribute::updateOrCreate(
                        [
                            'at_asset_type_attribute_master_id' => $value['attr_master_id'],
                            'at_asset_edit_id' => $Asset_Add->id,
                        ],
                        [
                            'at_asset_id' => $asset->ta_asset_id,
                            'at_asset_attribute_name' => $value['attribute_name'],
                            'at_asset_attribute_value_text' => $value['attribute_value'],
                        ]
                    );
                }
            }

            $email = $supervisorData['email'];
            $name = $supervisorData['name'];
            $Serial_Number = $Asset_Add->ta_asset_manufacture_serial_no;

            $Site_details = Location::where('tl_location_id', $request->location_id)->first(['tl_location_code', 'tl_location_name']);
            $Site_Code = $Site_details->tl_location_code;
            $Site_name = $Site_details->tl_location_name;

            mailLog::create(['mail_type' => 'EditAsset', 'subject' => 'New Edit Asset ticket created in PM', 'mail_to' => $email, 'mail_body' => 'An asset has been updated in PM.<br>
Here are the details:<br>
Asset Serial No: ' . $Serial_Number . '<br>
Site Name: ' . $Site_name . '<br>
Site Code: ' . $Site_Code]);
            $Asset_Add->makehidden(['TypeAttr', 'childs']);
            return response()->json([
                'status' => 200,
                'message' => "Update Ticket created Successfully"
            ]);
        }
    }


    public function approve_pm_request_editasset(Request $request)
    {
        $project_id = $request->project_id;
        $comment = $request->comment;

        $data = AssetEditModel::where('pm_project_id', $project_id)->first();
        $farid = $data->ta_asset_manufacture_serial_no;
        $FarToATSData = FarToAts::where('f2a_manufacture_serial_no', $farid)->where('f2a_status', 'Received')->where('f2a_type', 'ADDASSET')->orderby('f2a_creation_date', 'desc')->first();

        FarToAts::where('f2a_manufacture_serial_no', $farid)->where('f2a_status', 'Received')->where('f2a_type', 'ADDASSET')->update(['f2a_status' => 'Approved', 'f2a_reason' => $comment]);

        $oldAssetData = asset::where('ta_asset_manufacture_serial_no', $data->ta_asset_manufacture_serial_no)->first();
        $location_code = Location::where('tl_location_id', $oldAssetData->ta_asset_location_id)->first();
        $operator_name = Operator::where('op_id', $oldAssetData->operator_id)->first();
        $oldDataArray[0] = [
            'Serial No' => $oldAssetData->ta_asset_manufacture_serial_no,
            'Asset Name' => $oldAssetData->ta_asset_name,
            'Tag Number' => $oldAssetData->ta_asset_tag_number,
            'Location Code' => isset($location_code->tl_location_code) ? $location_code->tl_location_code : '',
            'Asset Category' => $oldAssetData->ta_asset_catagory,
            'Status' => $oldAssetData->ta_asset_active_inactive_status,
            'Operator Name' => isset($operator_name->op_operator_name) ? $operator_name->op_operator_name : ''
        ];
        if (strtoupper($data->ta_asset_catagory) == 'ACTIVE') {
            $op_id = $data->operator_id;
        } else {
            $op_id = null;
        }
        $Asset_Add = asset::updateOrCreate(
            ['ta_asset_manufacture_serial_no' => $data->ta_asset_manufacture_serial_no],
            [
                'ta_asset_type_master_id' => $data->ta_asset_type_master_id,
                'ta_asset_manufacture_serial_no' => $data->ta_asset_manufacture_serial_no,
                'ta_asset_name' => $data->ta_asset_name,
                'ta_asset_tag_number' => $data->ta_asset_tag_number,
                'ta_asset_location_id' => $data->ta_asset_location_id,
                'ta_asset_catagory' => $data->ta_asset_catagory,
                'ta_asset_active_inactive_status' => $data->ta_asset_active_inactive_status,
                'ta_asset_type_code' => $data->ta_asset_type_code,
                'operator_id' => $op_id,
                'ta_created_by' => $data->ta_created_by,
                'created_at' => now(),
            ]
        );

        $parent_asset_name = asset::where('ta_asset_id', $data->ta_asset_parent_id)->first();
        $user_name = User::where('id', $data->ta_created_by)->first();
        $Site_details = Location::where('tl_location_id', $data->ta_asset_location_id)->first(['tl_location_code', 'tl_location_name']);
        $Site_Code = $Site_details->tl_location_code;
        $Site_name = $Site_details->tl_location_name;
        $Master_Asset_Data = [
            'ta_asset_id' => $Asset_Add->ta_asset_id,
            'ta_asset_type_master_id' => $data->ta_asset_type_master_id,
            'ta_asset_manufacture_serial_no' => $data->ta_asset_manufacture_serial_no,
            'ta_asset_name' => $data->ta_asset_name,
            'ta_asset_tag_number' => $data->ta_asset_tag_number,
            'ta_asset_location_id' => $data->ta_asset_location_id,
            'ta_asset_catagory' => $data->ta_asset_catagory,
            'ta_asset_active_inactive_status' => $data->ta_asset_active_inactive_status,
            'ta_asset_parent_id' => $data->ta_asset_parent_id,
            'ta_asset_type_code' => $data->ta_asset_type_code,
            'operator_id' => $data->operator_id,
            'ta_asset_image' => $data->ta_asset_image,
            'pm_project_id' => $data->pm_project_id,
            'is_shown' => $Asset_Add->is_shown,
            'Operator_Name' => isset($operator_name->op_operator_name) ? $operator_name->op_operator_name : null,
            'Parent_asset_name' => isset($parent_asset_name->ta_asset_name) ? $parent_asset_name->ta_asset_name : null,
            'Site_Name' => $Site_name,
            'Site_Code' => $Site_Code,
            'Action_By' => $user_name->name,
            'Creation_Date' => $Asset_Add->created_at
        ];
        $AssetTagHistory = AssetTaggingHistory::updateOrCreate(
            [
                'th_location_id' => $Asset_Add->ta_asset_location_id,
                'th_asset_id' => $Asset_Add->ta_asset_id,
                'th_asset_tag_number' => $Asset_Add->ta_asset_tag_number
            ],
            [
                'th_location_id' => $Asset_Add->ta_asset_location_id,
                'th_asset_id' => $Asset_Add->ta_asset_id,
                'th_asset_name' => $Asset_Add->ta_asset_name,
                'th_asset_manufacture_serial_no' => $Asset_Add->ta_asset_manufacture_serial_no,
                'th_asset_tag_number' => $Asset_Add->ta_asset_tag_number,
                'th_asset_tagged_by' => $data->ta_created_by,
            ]
        );


        $asset = asset::where('ta_asset_manufacture_serial_no', $data->ta_asset_manufacture_serial_no)->first();
        $location_code1 = Location::where('tl_location_id', $Asset_Add->ta_asset_location_id)->first();
        $operator_name1 = Operator::where('op_id', $Asset_Add->operator_id)->first();
        $newData[0] = [
            'SerialNo' => $Asset_Add->ta_asset_manufacture_serial_no,
            'Asset Name' => $Asset_Add->ta_asset_name,
            'Tag Number' => $Asset_Add->ta_asset_tag_number,
            'Location Code' => isset($location_code1->tl_location_code) ? $location_code1->tl_location_code : '',
            'Asset Category' => $Asset_Add->ta_asset_catagory,
            'Status' => $Asset_Add->ta_asset_active_inactive_status,
            'Operator Name' => isset($operator_name1->op_operator_name) ? $operator_name1->op_operator_name : '',
        ];

        $AssetTagHistory = AssetTaggingHistory::create([
            'th_location_id' => $Asset_Add->ta_asset_location_id,
            'th_asset_id' => $asset->ta_asset_id,
            'th_asset_name' => $Asset_Add->ta_asset_name,
            'th_asset_manufacture_serial_no' => $Asset_Add->ta_asset_manufacture_serial_no,
            'th_asset_tag_number' => $Asset_Add->ta_asset_tag_number,
            'th_asset_tagged_by' => $data->ta_created_by,
        ]);

        $dataAttributes = AssetEditAttribute::where('at_asset_id', $asset->ta_asset_id)->get();
        $Asset_Attr_Add_Update = [];
        foreach ($dataAttributes as $value) {
            if ($value['at_asset_attribute_name'] == 'Status' && in_array($value['at_asset_attribute_value_text'], ['Missing', 'Redundant', 'Scrap'])) {
                asset::where('ta_asset_manufacture_serial_no', $data->ta_asset_manufacture_serial_no)->update(['is_shown' => false]);
            }
            $oldAttr = Asset_Attribute::where('at_asset_type_attribute_master_id', $value['at_asset_type_attribute_master_id'])->where(
                'at_asset_id',
                $value['at_asset_id']
            )->first();
            if ($oldAttr) {
                $oldDataArray[0][$oldAttr->at_asset_attribute_name] = $oldAttr->at_asset_attribute_value_text;
            }
            $newData[0][$value['at_asset_attribute_name']] = $value['at_asset_attribute_value_text'];
            $Asset_Attr_Add_Update[] = Asset_Attribute::updateOrCreate(
                [
                    'at_asset_type_attribute_master_id' => $value['at_asset_type_attribute_master_id'],
                    'at_asset_id' => $value['at_asset_id']
                ],
                [
                    'at_asset_attribute_name' => $value['at_asset_attribute_name'],
                    'at_asset_attribute_value_text' => $value['at_asset_attribute_value_text'],
                ]
            );
            $Master_Asset_Data_attr[] = [
                'at_asset_id' => $Asset_Add->ta_asset_id,
                'at_asset_attribute_name' => $value['at_asset_attribute_name'],
                'at_asset_attribute_value_text' => $value['at_asset_attribute_value_text'],
                'at_asset_type_attribute_master_id' => $value['at_asset_type_attribute_master_id']
            ];
        }

        $Master_Asset_Data['attr'] = $Master_Asset_Data_attr;

        FarToAts::updateOrCreate(
            ['proj_id' => $project_id],
            [
                'f2a_status' => 'Approved', 'f2a_reason' => $comment,
                'f2a_creation_date' => Carbon::now(),
            ]
        );
        TPmApproval::updateOrCreate(
            ['pm_project_id' => $project_id],
            [
                'task_status' => 'Completed',
                'asset_data' => json_encode($Master_Asset_Data)
            ]
        );
        Observable::storeLog('Asset Modification', 'App\Models\asset', 'UPDATED', $asset->ta_asset_id, $oldDataArray[0], $newData[0], $data->ta_created_by, 'Mobile App');
        return response()->json([
            "status" => 200,
            "message" => 'Asset Updated Successfully',
        ]);
    }
    public function edit_asset_reject(Request $request)
    {
        $project_id = $request->project_id;
        $comment = $request->comment;
        $data = AssetEditModel::where('pm_project_id', $project_id)->first();
        $farid = $data->ta_asset_manufacture_serial_no;
        FarToAts::where('f2a_manufacture_serial_no', $farid)->where('f2a_status', 'Pending')->where('f2a_type', 'ADDASSET')->update(['f2a_status' => 'Rejected', 'f2a_reason' => $comment]);


        $serial_no = $data->ta_asset_manufacture_serial_no;
        $asset_name = $data->ta_asset_name;
        $Site_details = Location::where('tl_location_id', $data->ta_asset_location_id)->first(['tl_location_code', 'tl_location_name']);
        $Site_Code = $Site_details->tl_location_code;
        $Site_name = $Site_details->tl_location_name;

        mailLog::create(['mail_type' => 'Edit Asset', 'subject' => 'Rejected asset edit request.', 'mail_to' => $email, 'mail_body' => 'An edit asset has been rejected in PM.<br>
        Here are the details:<br>
        Asset Serial No:' . $serial_no . '<br>
        Site Name:' . $Site_name . '<br>
        Site Code:' . $Site_Code]);

        return response()->json([
            "status" => 200,
            "message" => 'Asset edit rejected successfully',
        ]);
    }
    public function global_search_home(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'search' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'please input a search keywaord',
            ]);
        } else {

            $search = strtoupper($request->get('search'));
            $global_search_home = Location::where(function ($query) use ($search) {
                $query->where(DB::raw('upper(tl_location_name)'), 'LIKE', "%{$search}%")
                    ->orWhere(DB::raw('upper(tl_location_code)'), 'LIKE', "%{$search}%")
                    ->orWhere(DB::raw('upper(tl_location_address)'), 'LIKE', "%{$search}%");
            })
                ->get();
            if (!empty($global_search_home)) {
                return response()->json([
                    "status" => 200,
                    "data" => $global_search_home,
                ]);
            } else {
                return response()->json([
                    'status' => 'No data found',
                ]);
            }
        }
    }


    public function asset_type_attribute(Request $request)
    {


        $asset_type_attr = Asset_type_attribute_master_model::where('ata_asset_type_id', $request->asset_type_id)->where('ata_status', 'Valid')->orWhere('ata_asset_type_id', 0)->select('ata_asset_type_attribute_id as attribute_id', 'ata_asset_type_attribute_datatype as attribute_datatype', 'ata_asset_type_id', 'ata_asset_type_attribute_name as attribute_name', 'ata_display as display', 'ata_status as status', 'ata_field_editable_non_editable_flag as editable_non_editable_flag', 'ata_field_requiered_not_required_flag as requiered_not_required_flag', 'attribute_catagory', 'ata_flov', 'ata_asset_type_attribute_default_value as default_value')->get();

        $operators = Operator::select('op_id as operator_id', 'op_operator_name as operator_name')->get();

        return response()->json([
            "asset_type" => $asset_type_attr,
            "operators" => $operators
        ]);
    }
    public function get_asset_by_process_id(Request $request)
    {

        $project_id = $request->project_id;
        $assets_data = asset::with('locationtype')->where('pm_project_id', $project_id)->get();
        if (count($assets_data) == 0) {
            $assets_data = [];
        }
        return response()->json([
            "status" => 200,
            "data" => count($assets_data) == 0 ? null : call_user_func_array('array_merge', $assets_data->toarray()),
        ]);
    }
    public function get_asset_by_PM_process_id(Request $request)
    {

        $project_id = $request->project_id;
        $assets_data = AssetEditModel::with('locationtype')->where('pm_project_id', $project_id)->get();
        if (count($assets_data) == 0) {
            $assets_data = [];
        }
        return response()->json([
            "status" => 200,
            "data" => count($assets_data) == 0 ? null : call_user_func_array('array_merge', $assets_data->toarray()),
        ]);
    }
    public function get_edit_asset_by_process_id(Request $request)
    {

        $project_id = $request->project_id;
        $assets_data = AssetEditModel::with('locationtype')->where('pm_project_id', $project_id)->get();
        $assets_data_old = [];
        if (count($assets_data) == 0) {
            $assets_data = [];
        } else {

            $assets_data_old = asset::with('locationtype')->where('ta_asset_manufacture_serial_no', $assets_data[0]->ta_asset_manufacture_serial_no)->get();
            $this->childs_html($assets_data[0]->childs, $assets_data[0]->ta_asset_id, $assets_data[0]->AssetType);
            $assets_data[0]->child_HTML = $this->assetdataHTML;
        }
        return response()->json([
            "status" => 200,
            "data" => count($assets_data) == 0 ? null : $assets_data[0],
            "asset_data" => count($assets_data) == 0 ? null : $assets_data,
            "Olddata" => count($assets_data_old) == 0 ? null : call_user_func_array('array_merge', $assets_data_old->toarray()),
        ]);
    }



    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $lat = $request->lat;
        $lng = $request->lng;
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'Failed', 'errors' => $validator->errors()->all()], 422);
        }

        $user = User::where('email', strtolower($request->email))->first();
        if ($user) {
            //Call the API to get available functions
            $urlfunction = env('PASSPORT_URL') . 'api/get-user-functions';
            $ch1 = curl_init();
            curl_setopt($ch1, CURLOPT_URL, $urlfunction);
            curl_setopt($ch1, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch1, CURLOPT_POST, 1);
            curl_setopt($ch1, CURLOPT_POSTFIELDS, ['userId' => $user->id]);
            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);

            $functionData = curl_exec($ch1);
            $httpStatus = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
            curl_close($ch1);

             $access = implode(" ", json_decode($functionData)->data);

            $postParams = array(
                'grant_type'    => 'password',
                'scope'         => $access,
                'client_id'     => env('PASSPORT_CLIENT_ID'),
                'client_secret' => env('PASSPORT_CLIENT_SECRET'),
                'username'      => strtolower($request->email),
                'password'      => $request->password
            );
            $url = env('PASSPORT_URL') . 'oauth/token';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postParams);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $oToken = json_decode(curl_exec($ch));
            $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if (isset($oToken->error)) {
                return response()->json(['status' => 'Failed', 'data' => $oToken]);
            } else {
                $oToken->user = json_decode($functionData)->user;
                return response()->json(['status' => 'Success', 'data' => $oToken]);
            }
        } else {
            $response = ['status' => 'Failed', "message" => 'User does not exist'];
            return response()->json($response, 422);
        }
    }

    public function changepassword(Request $request)
    {
        $userid = $request->userid;
        $oldpassword = $request->oldpassword;
        $newPassword = $request->password;

        $input = $request->all();
        $rules = array(
            'oldpassword' => 'required',
            'password' => 'required|min:6',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
            return \Response::json($arr);
        } else {
            try {
                $user = User::where('id', $userid)->first();

                if ((Hash::check(request('oldpassword'),  $user->password)) == false) {
                    $arr = array("status" => 400, "message" => "Check your old password.", "data" => array());
                } else if ((Hash::check(request('password'),  $user->password)) == true) {
                    $arr = array("status" => 400, "message" => "Please enter a password which is not similar then current password.", "data" => array());
                } else {
                    User::where('id', $userid)->update(['password' => Hash::make($input['password'])]);
                    $arr = array("status" => 200, "message" => "Password updated successfully.", "data" => array());
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "message" => $msg, "data" => array());
            }

            return \Response::json($arr);
        }
    }


    public function Forgot_Password_phone(Request $request)
    {
        $userId = $request->get('userId');
        $userEmail = $request->get('userEmail');
        $email_verification = DB::table('usr.v_user_login')->where('tu_user_email', $userEmail)->first();
        $email = $email_verification->tu_user_email;
        $otp = rand(1234, 9876);
        dd($otp);
        if (!empty($global_search_home)) {
            return response()->json([
                "status" => 200,
                "data" => $global_search_home,
            ]);
        } else {
            return response()->json([
                'status' => 'No data found',
            ]);
        }
    }


    public function asset_Tagging_img(Request $request)
    {

        $tagnumber = $request->get('tagnumber');
        $file = $request->file('tagimage');

        if (isset($file) == true) {

            $file_name = $file->getClientOriginalName();
            $file->move(base_path() . '/assetimage/', $file_name);
            $tagimage = base_path() . '/assetimage/' . $file_name;
            $tagimagearray = (explode("/", $tagimage));
            $app_url = env('APP_URL');
            $app_urlarray = (explode("/", $app_url));
            $app_urlfinal = $app_urlarray[0] . "/" . $app_urlarray[1] . "/" . $app_urlarray[2] . "/" . $app_urlarray[3];
            $tagimagefinal = $app_urlfinal . "/" . $tagimagearray[5] . "/" . $tagimagearray[6];
            $asset_id = $request->get('asset_id');
            $ta_last_updated_date = now();

            $details = DB::table('ats.t_asset')
                ->where('ta_asset_id', $asset_id)
                ->where('ta_effective_end_date', NULL)
                ->update([
                    'ta_asset_tag_number' => $tagnumber,
                    'ta_asset_image' =>  $tagimagefinal,
                    'ta_last_updated_by' => $request->user_name,
                    'ta_last_updated_date' => $ta_last_updated_date,
                    'ta_asset_last_tag_scan_date' => $ta_last_updated_date,

                ]);
        } else {

            $asset_id = $request->get('asset_id');
            $ta_last_updated_date = now();
            $details = DB::table('ats.t_asset')
                ->where('ta_asset_id', $asset_id)
                ->where('ta_effective_end_date', NULL)
                ->update([
                    'ta_asset_tag_number' => $tagnumber,
                    'ta_last_updated_by' => $request->user_name,
                    'ta_last_updated_date' => $ta_last_updated_date,
                ]);
        }


        return response()->json([
            'status' => 'success',
        ]);
    }





    public function update_dynamic_attr(Request $request)
    {

        $assetId = $request->assetId;
        $updatedBy = $request->updatedBy;
        foreach ($request->dynamic_attribute as $item) {

            $key = strtoupper($item['key']);
            $value = $item['value'];
            $value = strlen($value) == 0 || $value == "null" ? null : $value;
            $valueType = $item['valueType'];
            $attrcode = $item['attributeCode'];

            if ($valueType == 'INTEGER') {
                $at_asset_attribute_value = 'at_asset_attribute_value_integer';
            } else if ($valueType == 'TIMESTAMP WITHOUT TIMEZONE') {
                $valuestr = strtotime($value);
                $value =  date("Y-m-d", $valuestr);
                $at_asset_attribute_value = 'at_asset_attribute_value_date_type';
            } else if ($valueType == 'NUMERIC') {
                $at_asset_attribute_value = 'at_asset_attribute_value_number';
            } else {
                $at_asset_attribute_value = 'at_asset_attribute_value_text';
            }


            $update = DB::table('ats.t_asset_attribute')
                ->where('at_asset_id', $assetId)
                ->where('at_asset_attribute_code', $attrcode)
                ->update(
                    [
                        $at_asset_attribute_value => $value,
                        'at_last_updated_date' =>  now(),
                        'at_last_updated_by' => $updatedBy,

                    ],

                );
        }

        return response()->json([
            "status" => 200,
            "message" => 'Asset updated successfully'
        ]);
    }

    public function fetch_asset_by_serialno_toverify(Request $request)
    {

        $serialno = $request->serialno;
        $ta_asset_type_master_id = $request->ta_asset_type_master_id;

        $at_asset_type_code = DB::table('product.t_asset_type_master')->where('at_parent_asset_type_id', $ta_asset_type_master_id)->pluck('at_asset_type_code')->toArray();


        $details = DB::table('ats.t_asset')
            ->where('ta_asset_manufacture_serial_no', $serialno)
            ->whereIn('ta_asset_type_code', $at_asset_type_code)
            ->where('ta_asset_parent_id', null)
            ->where('ta_effective_end_date', null)
            ->first();

        $Child_asset_id    = !empty($details->ta_asset_id) ? $details->ta_asset_id : " ";

        if (!empty($details)) {

            $asset_id = $Child_asset_id;
            $details = DB::table('ats.t_asset')
                ->where('ta_asset_id', $asset_id)
                ->first();

            $parent_asset_id = $details == null ? null : $details->ta_asset_parent_id;

            $parent_asset_name = DB::table('ats.t_asset')
                ->select('ta_asset_name')
                ->where('ta_asset_id', $parent_asset_id)
                ->first();

            $location_id = $details == null ? null : $details->ta_asset_location_id;

            $location_name = DB::table('ats.t_location')
                ->select('tl_location_code')
                ->where('tl_location_id', $location_id)
                ->first();


            $asset_image = DB::table('ats.t_asset')
                ->select('ta_asset_image')
                ->where('ta_asset_id', $asset_id)
                ->first();
            $asset_image = $asset_image->ta_asset_image;

            $asset_type_id = $details == null ? null : $details->ta_asset_type_master_id;


            //dynamic_attribute_name
            $asset_static_dynamic_attribute_name = DB::table('product.t_asset_type_attribute_master')
                ->where('ata_asset_type_id', $asset_type_id)
                ->orWhere('ata_asset_type_attribute_mandatory_flag', 'REQUIRED')
                ->get();

            $asset_static_dynamic_attribute_value = DB::table('ats.t_asset_attribute')
                ->where('at_asset_id', $asset_id)
                ->Where('at_effective_end_date', null)
                ->get();

            $asst_child_details = DB::table('ats.v_asset_child_parent_tag_status')
                ->distinct()
                ->where('parent_asset_id', $asset_id)
                ->get(['child_asset_id as ta_asset_id', 'child_asset_name as ta_asset_name', 'child_manufacture_serial_no as ta_asset_manufacture_serial_no', 'tag_status']);
            $asst_child_details_arr = $asst_child_details->toArray();
            if (!empty($asst_child_details_arr)) {
                $asst_child_details_arr = $asst_child_details_arr[0]->ta_asset_id;
                if ($asst_child_details_arr == null) {
                    $asst_child_details = [];
                }
            }

            return response()->json([
                "status" => 200,
                "static" => $details,
                'site_code' => $location_name == null ? null : $location_name->tl_location_code,
                'parent_asset_name' => $parent_asset_name == null ? null : $parent_asset_name->ta_asset_name,
                'ta_asset_image' => $asset_image,
                "attribute_name" => $asset_static_dynamic_attribute_name,
                "attribute_value" => $asset_static_dynamic_attribute_value,
                "child_asset" => $asst_child_details
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "data" => "Either This Might Not Be Child Of This Parent/ Data Not Found !",
            ]);
        }
    }
    public function audit_list(request $request)
    {
        $Asset_list = Location::with('assets_site')->where('tl_location_id', $request->location_id)->get();

        $Asset_list[0]['assets_site']->makehidden(['TypeAttr']);

        $data = $Asset_list[0]['assets_site'];

        return response()->json([
            "status" => 200,
            "data" => $data
        ]);
    }
    public function audit_list_child(request $request)
    {
        $asst_dynamc_att_value = DB::table('ats.v_asset_audit')
            ->select('ta_asset_id', 'tl_location_name', 'tl_location_code', 'tl_location_id', 'ta_asset_name', 'ta_asset_manufacture_serial_no', 'ta_asset_tag_number', 'ta_asset_active_inactive_status', 'child', 'tag_status')
            ->distinct()
            ->where('ta_asset_parent_id', $request->id)
            ->get();
        return response()->json([
            "status" => 200,
            'message' => 'Ok',
            "data" => $asst_dynamc_att_value
        ]);
    }
    public function audit_details_view(request $request)
    {

        $asset_id = $request->asset_id;
        $details = DB::table('ats.t_asset')
            ->where('ta_asset_id', $asset_id)
            ->first();

        $parent_asset_id = $details == null ? null : $details->ta_asset_parent_id;

        $parent_asset_name = DB::table('ats.t_asset')
            ->select('ta_asset_name')
            ->where('ta_asset_id', $parent_asset_id)
            ->first();

        $location_id = $details == null ? null : $details->ta_asset_location_id;
        //dd($location_id);

        $location_name = DB::table('ats.t_location')
            ->select('tl_location_code', 'tl_location_address', 'tl_location_name')
            ->where('tl_location_id', $location_id)
            ->first();

        $asset_type_id = $details == null ? null : $details->ta_asset_type_master_id;
        $asset_type_name = DB::table('product.t_asset_type_master')
            ->select('at_asset_type_name')
            ->where('at_asset_type_id', $asset_type_id)
            ->first();


        $asset_type_id = $details == null ? null : $details->ta_asset_type_master_id;

        $asset_static_dynamic_attribute_name = DB::table('product.t_asset_type_attribute_master')
            ->where('ata_asset_type_id', $asset_type_id)
            ->orWhere('ata_asset_type_attribute_mandatory_flag', 'REQUIRED')
            ->get();

        $asset_static_dynamic_attribute_value = DB::table('ats.t_asset_attribute')
            ->where('at_asset_id', $asset_id)
            ->Where('at_effective_end_date', null)
            ->get();


        return response()->json([
            "status" => 200,
            "static" => $details,
            'asset_type_name' => $asset_type_name == null ? null : $asset_type_name->at_asset_type_name,
            'site_code' => $location_name == null ? null : $location_name,
            'parent_asset_name' => $parent_asset_name == null ? null : $parent_asset_name->ta_asset_name,
            "attribute_name" => $asset_static_dynamic_attribute_name,
            "attribute_value" => $asset_static_dynamic_attribute_value,

        ]);
    }


    public function findSupervisor($userId)
    {
        $user = User::where('id', $userId)->first();
        if ($user->is_supervisor) {
            return $userId;
        } else {
            $user = Supervisor_to_technician::where('technician_id', $userId)->first();
            if (!empty($user)) {
                return $user->supervisor_id;
            } else {
                return 0;
            }
        }
    }


    function loginWithRefreshtoken(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'refresh_token' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response->json(['status' => 'Failed', 'errors' => $validator->errors()->first()], 422);
        }

        $postParams = array(
            'grant_type'    => 'refresh_token',
            'scope'         => '',
            'client_id'     => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'refresh_token' => $request->refresh_token,

        );
        $url = env('PASSPORT_URL') . 'oauth/token';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postParams);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $oToken = json_decode(curl_exec($ch));
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if (isset($oToken->error)) {
            return response()->json(['status' => 'Failed', 'data' => $oToken]);
        } else {
            return response()->json(['status' => 'Success', 'data' => $oToken]);
        }
    }

    public function getLastAuditDate(&$value, $key)
    {
        $assetAudit = Asset_Audit_Model::where('aa_location_id', $value->tl_location_id)->orderBy('aa_created_date', 'desc')->first();
        if ($assetAudit) {
            $value->last_audit_date = date('d-M-Y H:i', strtotime($assetAudit->aa_created_date));
        } else {
            $value->last_audit_date = "";
        }
    }
    public function site_video(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_id' => 'required',
            'media_type' => 'required',
            'file' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 422, 'errors' => $validator->errors()->first()], 422);
        }

        $user_id = $request->user()->id;
        $asset_img = $request->file('thumb_file');
        if (!empty($asset_img)) {
            $asset_img_name = $asset_img->getClientOriginalName();
            $asset_img->move(base_path() . '/storage/app/public/assetimage/', $asset_img_name);
            $asset_img = url('/storage/assetimage/' . $asset_img_name);
        }

        $video_file = $request->file('file');
        if (!empty($video_file)) {
            $video_file_name = $video_file->getClientOriginalName();
            $video_file->move(base_path() . '/storage/app/public/assetimage/', $video_file_name);
            $video_file = url('/storage/assetimage/' . $video_file_name);
        }

        SiteMedia::create(['site_id' => $request->site_id, 'thumb_image' => $asset_img, 'file_url' => $video_file, 'media_type' => $request->media_type]);
        return response()->json([
            'status' => 200,
            'message' => "Video uploaded Succesfully."
        ]);
    }
    public function getsite_media(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 422, 'errors' => $validator->errors()->first()], 422);
        }
        $data = SiteMedia::where('site_id', $request->site_id)->get();
        return response()->json([
            'status' => 200,
            'message' => "Media Listing",
            'data' => $data
        ]);
    }
    public function getotp(Request $request)
    {
        $email = $request->input('email');
        $otp = mt_rand(100000, 999999); // Generate a random 6-digit numeric OTP

        $usercount = User::where('email', $email)->count();
        if ($usercount > 0) {
            User::where('email', $email)->update(['otp' => $otp]);
            Mail::raw("Your OTP is: $otp", function ($message) use ($email) {
                $message->to($email)->subject('OTP Verification');
            });
            return response()->json(['message' => 'OTP generated and sent successfully', 'status' => 200]);
        } else {
            return response()->json(['message' => 'Invalid Email', 'status' => 401]);
        }
    }


    public function matchotp(Request $request)
    {
        $email = strtolower($request->input('email'));
        $otp = $request->input('otp');

        $userdata = User::where('email', $email)->where('otp', $otp)->count();

        if ($userdata > 0) {
            return response()->json(['message' => 'OTP verified successfully', 'status' => 200]);
        } else {
            return response()->json(['message' => 'Invalid OTP', 'status' => 401]);
        }
    }
    public function forgotpassword(Request $request)
    {
        $email = strtolower($request->input('email'));

        $confrimpassword = $request->confrimpassword;
        $newPassword = $request->newPassword;

        // Change Password For Phone

        $input = $request->all();

        $rules = array(
            'newPassword' => 'required|min:6',
            'confrimpassword' => 'required|same:newPassword',

        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
            return \Response::json($arr);
        } else {
            try {
                User::where('email', $email)->update(['password' => Hash::make($input['confrimpassword'])]);
                $arr = array("status" => 200, "message" => "Password updated successfully.", "data" => array());
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "message" => $msg, "data" => array());
            }

            return \Response::json($arr);
        }
    }
    // Add Childs  

    public function childs_insert($childs, $parent_id, $user_id, $request)
    {


        $Child_Serial_Number = "";
        foreach ($childs as $child) {
            $Child_Serial_Number = $Child_Serial_Number . $child->ta_asset_manufacture_serial_no . ",";
            $checktag_number = asset::where('ta_asset_tag_number', $child->ta_asset_tag_number)->count();
            $checktag_number1 = AssetEditModel::where('ta_asset_tag_number', $child->ta_asset_tag_number)->count();
            if ($checktag_number > 0 || $checktag_number1 > 0) {
                return response()->json([
                    'status' => 404,
                    'message' => 'please give a unique tag number',
                ]);
            }

            $child_Asset_Add = AssetEditModel::updateOrCreate(
                ['ta_asset_manufacture_serial_no' => $child->ta_asset_manufacture_serial_no],
                [
                    'ta_asset_type_master_id' => $child->ta_asset_type_master_id,
                    'ta_asset_manufacture_serial_no' => $child->ta_asset_manufacture_serial_no,
                    'ta_asset_name' => $child->ta_asset_name,
                    'ta_asset_tag_number' => $child->ta_asset_tag_number,
                    'ta_asset_location_id' => $child->ta_asset_location_id,
                    'ta_asset_catagory' => strtoupper($child->ta_asset_catagory),
                    'ta_asset_active_inactive_status' => $child->ta_asset_active_inactive_status,
                    'ta_asset_parent_id' => $parent_id,
                    'ta_asset_type_code' => $child->ta_asset_type_code,
                    'operator_id' => $child->operator_id,
                    'ta_created_by' => $user_id,
                    'is_shown' => 0,
                ]
            );
            $childimg = $child->ta_asset_manufacture_serial_no;
            $asset_img = $request->$childimg;
            if (!empty($asset_img)) {
                $asset_img_name = $asset_img->getClientOriginalName();
                $asset_img->move(base_path() . '/storage/app/public/assetimage/', $asset_img_name);
                $asset_img = url('/storage/assetimage/' . $asset_img_name);
                AssetEditModel::where('id', $child_Asset_Add->id)->update(['ta_asset_image' => $asset_img]);
                $asset_img = "";
            }
            $data = $child->TypeAttr;

            $Asset_Attr_Add_Update = [];
            foreach ($data as $value) {
                if ($value->at_asset_attribute_value_text != "") {
                    $Asset_Attr_Add_Update[] = AssetEditAttribute::updateOrCreate(
                        [
                            'at_asset_type_attribute_master_id' => $value->TypeAttrMaster->ata_asset_type_attribute_id,
                            'at_asset_edit_id' => $child_Asset_Add->id,
                        ],
                        [
                            'at_asset_edit_id' => $child_Asset_Add->id,
                            'at_asset_attribute_name' => $value->TypeAttrMaster->ata_asset_type_attribute_name,
                            'at_asset_attribute_value_text' => $value->at_asset_attribute_value_text,
                        ]
                    );
                }
            }

            if (count($child->childs) > 0) {

                $Child_Serial_Number = $Child_Serial_Number . $this->childs_insert($child->childs, $child_Asset_Add->id, $user_id, $request);
            }
        }

        return $Child_Serial_Number;
    }

    // Approving Childs 

    public function childs_asset_approve($childs, $astid)
    {
        $Child_Serial_Number = "";
        $i = 0;
        foreach ($childs as $child) {
            $Child_Serial_Number = $Child_Serial_Number . $child->ta_asset_manufacture_serial_no . ", ";

            if (strtoupper($child->ta_asset_catagory) == 'ACTIVE') {
                $op_id = $child->operator_id;
            } else {
                $op_id = null;
            }

            $child_Asset_Add = asset::updateOrCreate(
                ['ta_asset_manufacture_serial_no' => $child->ta_asset_manufacture_serial_no],
                [
                    'ta_asset_type_master_id' => $child->ta_asset_type_master_id,
                    'ta_asset_manufacture_serial_no' => $child->ta_asset_manufacture_serial_no,
                    'ta_asset_name' => $child->ta_asset_name,
                    'ta_asset_tag_number' => $child->ta_asset_tag_number,
                    'ta_asset_location_id' => $child->ta_asset_location_id,
                    'ta_asset_catagory' => $child->ta_asset_catagory,
                    'ta_asset_active_inactive_status' => $child->ta_asset_active_inactive_status,
                    'ta_asset_parent_id' => $astid,
                    'ta_asset_type_code' => $child->ta_asset_type_code,
                    'operator_id' => $op_id,
                    'ta_asset_image' => $child->ta_asset_image,
                    'ta_created_by' => $child->ta_created_by,
                    'created_at' => now(),
                    'is_shown' => true,
                ]
            );
            $AssetTagHistory = AssetTaggingHistory::updateOrCreate(
                [
                    'th_asset_id' => $child_Asset_Add->ta_asset_id,
                    'th_asset_manufacture_serial_no' => $child->ta_asset_manufacture_serial_no

                ],
                [
                    'th_location_id' => $child->ta_asset_location_id,
                    'th_asset_id' => $child_Asset_Add->ta_asset_id,
                    'th_asset_name' => $child->ta_asset_name,
                    'th_asset_manufacture_serial_no' => $child->ta_asset_manufacture_serial_no,
                    'th_asset_tag_number' => $child->ta_asset_tag_number,
                    'th_asset_tagged_by' => $child->ta_created_by,

                ]
            );
            $user_name = User::where('id', $child->ta_created_by)->first();
            $parent_asset_name = asset::where('ta_asset_id', $astid)->first();
            $locationid = $child_Asset_Add->ta_asset_location_id;
            $Site_details = Location::where('tl_location_id', $locationid)->first(['tl_location_code', 'tl_location_name']);
            $Site_Code = $Site_details->tl_location_code;
            $Site_name = $Site_details->tl_location_name;
            if ($child->operator_id != "") {
                $operator_name = Operator::where('op_id', $child->operator_id)->first();
            }


            $Asset_type = Asset_type_model::where('at_asset_type_id', $child->ta_asset_type_master_id)->first();
            $child_asset_master_data = [
                'ta_asset_id' => $child_Asset_Add->ta_asset_id,
                'ta_asset_type_master_id' => $child->ta_asset_type_master_id,
                'ta_asset_manufacture_serial_no' => $child->ta_asset_manufacture_serial_no,
                'ta_asset_name' => $child->ta_asset_name,
                'ta_asset_tag_number' => $child->ta_asset_tag_number,
                'ta_asset_location_id' => $child->ta_asset_location_id,
                'ta_asset_catagory' => $child->ta_asset_catagory,
                'ta_asset_active_inactive_status' => $child->ta_asset_active_inactive_status,
                'ta_asset_parent_id' => $astid,
                'ta_asset_type_code' => $child->ta_asset_type_code,
                'operator_id' => $child->operator_id,
                'ta_asset_image' => $child->ta_asset_image,
                'is_shown' => $child_Asset_Add->is_shown,
                'Asset_Type' => $Asset_type->at_asset_type_name,
                'Site_Name' => $Site_name,
                'Site_Code' => $Site_Code,
                'Parent_asset_name' => isset($parent_asset_name->ta_asset_name) ? $parent_asset_name->ta_asset_name : null,
                'Operator_Name' => isset($operator_name->op_operator_name) ? $operator_name->op_operator_name : null,
                'Action_By' => $user_name->name,
                'Creation_Date' => $child_Asset_Add->created_at
            ];

            $childAssetId = $child_Asset_Add->ta_asset_id;

            $data = AssetEditAttribute::where('at_asset_edit_id', $child->id)->get();
            Log::debug($data);
            $Asset_Attr_Add_Update = [];

            foreach ($data as $value) {
                if ($value->at_asset_attribute_value_text != "") {
                    if ($value['at_asset_attribute_name'] == 'Status' && in_array($value['at_asset_attribute_value_text'], ['In Transit', 'Used', 'Idle'])) {
                        asset::where('ta_asset_manufacture_serial_no', $child->ta_asset_manufacture_serial_no)->update(['is_shown' => true]);
                    }
                    $Asset_Attr_Add_Update[] = Asset_Attribute::Create(

                        [
                            'at_asset_attribute_name' => $value['at_asset_attribute_name'],
                            'at_asset_attribute_value_text' => $value['at_asset_attribute_value_text'],
                            'at_asset_id' => $childAssetId,
                            'at_asset_type_attribute_master_id' => $value['at_asset_type_attribute_master_id']

                        ]
                    );
                    $Attribute_type = Asset_type_attribute_master_model::where('ata_asset_type_attribute_id', $value['at_asset_type_attribute_master_id'])->first();
                    $child_asset_master_data_attr[] = [
                        'at_asset_attribute_name' => $value['at_asset_attribute_name'],
                        'at_asset_attribute_value_text' => $value['at_asset_attribute_value_text'],
                        'at_asset_id' => $childAssetId,
                        'at_asset_type_attribute_master_id' => $value['at_asset_type_attribute_master_id'],
                        'attr_catagory' => $Attribute_type->attribute_catagory
                    ];
                }
            }
            $child_asset_master_data['attr'] = $child_asset_master_data_attr;
            AssetHistoryModel::create(['movein_date' => Carbon::now(), 'status' => 1, 'asset_id' => $childAssetId, 'location_id' => $locationid, 'asset_data' => json_encode($child_asset_master_data)]);
            $i++;
        }
        $Child1 = AssetEditModel::where('ta_asset_parent_id', $child->id)->count();
        if ($Child1 > 0) {
            $childs_data = AssetEditModel::where('ta_asset_parent_id', $child->id)->get();
            $Child_Serial_Number = $Child_Serial_Number . $this->childs_asset_approve($childs_data, $child_Asset_Add->ta_asset_id);
        }
    }

    public function childs_html($childs, $astid, $parentAssetType)
    {
        $Child_Serial_Number = "";
        $i = 1;
        foreach ($childs as $child) {

            $this->assetdataHTML .= "<tr><td colspan='2' style='background-color:silver;' >" . $parentAssetType . "->" . $child->AssetType . "</td></tr>";
            $this->assetdataHTML .= "<tr><td>Asset Name</td><td>" . $child->ta_asset_name . "</td></tr><tr><td>Serial Number</td><td>" . $child->ta_asset_manufacture_serial_no . "</td></tr><tr><td>Tag Number</td><td>" . $child->ta_asset_tag_number . "</td></tr><tr><td>Asset Image</td><td><img src='" . $child->ta_asset_image . "'width='100px;'></td></tr>";
            foreach ($child->TypeAttr as $Attr) {
                if ($Attr->AttrCatagory == 0) {
                    $this->assetdataHTML .= "<tr><td>" . $Attr->at_asset_attribute_name . "</td><td>" . $Attr->at_asset_attribute_value_text . "</td></tr>";
                }
                if ($Attr->AttrCatagory == 1) {
                    $this->assetdataHTML .= "<tr><td>" . $Attr->at_asset_attribute_name . "</td><td>" . $Attr->at_asset_attribute_value_text . "</td></tr>";
                    $i++;
                }
            }
            $Child1 = AssetEditModel::where('ta_asset_parent_id', $child->id)->count();
            if ($Child1 > 0) {
                $childs_data = AssetEditModel::where('ta_asset_parent_id', $child->id)->get();
                $this->assetdataHTML .=  $this->childs_html($childs_data, $child->id, $parentAssetType . "->" . $child->AssetType);
            }
        }
        //return $this->assetdataHTML;
    }
    public function child_asset_move($childs, $astid, $location_id)
    {
        $Child_Serial_Number = "";
        $i = 1;

        foreach ($childs as $child) {


            $child_Asset_Add = asset::updateOrCreate(
                ['ta_asset_manufacture_serial_no' => $child->ta_asset_manufacture_serial_no],
                [

                    'ta_asset_location_id' => $location_id,

                ]
            );

            $user_name = User::where('id', $child->ta_created_by)->first();
            $parent_asset_name = asset::where('ta_asset_id', $astid)->first();
            $Site_details = Location::where('tl_location_id', $location_id)->first(['tl_location_code', 'tl_location_name']);
            $Site_Code = $Site_details->tl_location_code;
            $Site_name = $Site_details->tl_location_name;
            if ($child->operator_id != "") {
                $operator_name = Operator::where('op_id', $child->operator_id)->first();
            }


            $Asset_type = Asset_type_model::where('at_asset_type_id', $child->ta_asset_type_master_id)->first();
            $child_asset_master_data = [
                'ta_asset_id' => $child->ta_asset_id,
                'ta_asset_type_master_id' => $child->ta_asset_type_master_id,
                'ta_asset_manufacture_serial_no' => $child->ta_asset_manufacture_serial_no,
                'ta_asset_name' => $child->ta_asset_name,
                'ta_asset_tag_number' => $child->ta_asset_tag_number,
                'ta_asset_location_id' => $location_id,
                'ta_asset_catagory' => $child->ta_asset_catagory,
                'ta_asset_active_inactive_status' => $child->ta_asset_active_inactive_status,
                'ta_asset_parent_id' => $astid,
                'ta_asset_type_code' => $child->ta_asset_type_code,
                'operator_id' => $child->operator_id,
                'ta_asset_image' => $child->ta_asset_image,
                'is_shown' => $child->is_shown,
                'Asset_Type' => $Asset_type->at_asset_type_name,
                'Site_Name' => $Site_name,
                'Site_Code' => $Site_Code,
                'Parent_asset_name' => isset($parent_asset_name->ta_asset_name) ? $parent_asset_name->ta_asset_name : null,
                'Operator_Name' => isset($operator_name->op_operator_name) ? $operator_name->op_operator_name : null,
                'Action_By' => $user_name->name,
                'Creation_Date' => $child_Asset_Add->created_at
            ];

            $childAssetId = $child->ta_asset_id;

            $data = Asset_type_attribute_model::where('at_asset_id', $astid)->get();
            Log::debug($data);


            foreach ($data as $value) {
                if ($value->at_asset_attribute_value_text != "") {


                    $Attribute_type = Asset_type_attribute_master_model::where('ata_asset_type_attribute_id', $value['at_asset_type_attribute_master_id'])->first();
                    $child_asset_master_data_attr[] = [
                        'at_asset_attribute_name' => $value['at_asset_attribute_name'],
                        'at_asset_attribute_value_text' => $value['at_asset_attribute_value_text'],
                        'at_asset_id' => $childAssetId,
                        'at_asset_type_attribute_master_id' => $value['at_asset_type_attribute_master_id'],
                        'attr_catagory' => $Attribute_type->attribute_catagory
                    ];
                }
            }
            $child_asset_master_data['attr'] = $child_asset_master_data_attr;
            AssetHistoryModel::create(['movein_date' => Carbon::now(), 'status' => 1, 'asset_id' => $childAssetId, 'location_id' => $location_id, 'asset_data' => json_encode($child_asset_master_data)]);
            $i++;
        }
        $Child1 = asset::where('ta_asset_parent_id', $child->ta_asset_id)->count();
        if ($Child1 > 0) {
            $childs_data = asset::where('ta_asset_parent_id', $child->ta_asset_id)->get();
            $this->child_asset_move($childs_data, $child->ta_asset_id, $location_id);
        }
    }


    public function completed_task_pm(Request $request)
    {
        $completed_task = TPmApproval::where('task_status', 'Completed')->get();
        return response()->json([
            'message' => 'Success',
            'status' => 200,
            'completed_task' => $completed_task
        ]);
    }

    public function audit_submit(Request $request)
    {
        Log::debug($request);
        $user_id = $request->user_id;
        $location_id = $request->location_id;

        $technician_details = User::where('id', $user_id)->first(['name']);

        $asset_by_location = asset::with('locationtype')->where('ta_asset_location_id', $request->location_id)->get();

        $supervisor_id = $this->findSupervisor($user_id);
        $supervisor_details = Supervisor_to_technician::where('supervisor_id', $supervisor_id)->first(['supervisor_id', 'pm_user_id']);

        $supervisorData = User::where('id', $supervisor_details["supervisor_id"])->first(['email', 'name']);

        $pm_user_id = $supervisor_details->pm_user_id;
        $technician_details = User::where('id', $user_id)->first(['name']);



        $asset_audit = "";
        $asset_audit_details = "";


        $asset_audit = Asset_Audit_Model::Create(
            [
                'aa_location_id' => $request->location_id,
                'aa_technician_id' => $request->user_id,
                'aa_created_date' => Carbon::now()
            ]
        );
        $pmProjectID_assetmissing = "";
        $pmProjectID_tagmissing = "";
        foreach ($asset_by_location as $value) {
            $missing_status = "";
            if (in_array($value['ta_asset_id'], $request->assetMissing)) {
                $missing_status = "Asset Missing";
            }
            if (in_array($value['ta_asset_id'], $request->tagMissing)) {
                $missing_status = "Tag Missing";
            }
            if (in_array($value['ta_asset_id'], $request->Matched)) {
                $missing_status = "All Asset Details Matched";
            }
            if ($missing_status != '') {
                if ($missing_status == "Asset Missing") {

                    $asset = asset::where('ta_asset_id', $value['ta_asset_id'])->first();
                    if ($pmProjectID_assetmissing == '') {
                        $PMClass = new PMClass();
                        $accessToken = $PMClass->pm_login(env('PM_USERNAME'), env('PM_PASSWORD'));
                        $arrayResponse = $PMClass->pm_project_import("Audit_Asset_Missing.pmx", $accessToken);
                        Log::debug($arrayResponse);
                        $task_id = $PMClass->get_act_uid($arrayResponse['prj_uid'], $accessToken);
                        $assign = $PMClass->assign_task_users($arrayResponse['prj_uid'], $accessToken, $task_id, $pm_user_id);
                        $pmProjectID_assetmissing = $arrayResponse['prj_uid'];
                    }
                    $Asset_Add = AssetEditModel::create(

                        [
                            'ta_asset_type_master_id' => $asset->ta_asset_type_master_id,
                            'ta_asset_manufacture_serial_no' => $asset->ta_asset_manufacture_serial_no,
                            'ta_asset_name' => $asset->ta_asset_name,
                            'ta_asset_tag_number' => $asset->tag_number,
                            'ta_asset_location_id' => $asset->ta_asset_location_id,
                            'ta_asset_catagory' => $asset->ta_asset_catagory,
                            'ta_asset_active_inactive_status' => $asset->ta_asset_active_inactive_status,

                            'ta_asset_parent_id' => ($asset->ta_asset_parent_id) != null ? ($asset->ta_asset_parent_id) : 0,
                            'ta_asset_type_code' => $asset->ta_asset_name,
                            'operator_id' => $asset->operator_id,
                            'pm_project_id' => $pmProjectID_assetmissing,
                            'is_shown' => ($asset->is_shown) != null ? $asset->is_shown : "0",
                            'ta_created_by' => Auth::user()->id,

                        ]
                    );
                    $site_code = Location::where('tl_location_id', $asset->ta_asset_location_id)->first();

                    $asset_audit_details = Audit_Details_Model::Create(
                        [
                            'ad_audit_id' => $asset_audit->aa_audit_id,
                            'ad_asset_id' => $value['ta_asset_id'],
                            'ad_missing_status' => $missing_status
                        ]
                    );
                    TPmApproval::create(['tpm_asset_id' => $value['ta_asset_id'], 'tpm_asset_site_id' => $asset->ta_asset_location_id, 'pm_project_id' => $pmProjectID_assetmissing, 'tpm_technician_id' => $user_id, 'tpm_supervisor_id' => $supervisor_details["supervisor_id"], 'technician_name' => $technician_details->name, 'approver_name' => $supervisorData->name, 'site_code' => $site_code->tl_location_code, 'task_title' => 'Audit Asset Missing', 'task_status' => 'Pending']);
                } else if ($missing_status == "Tag Missing") {
                    $asset = asset::where('ta_asset_id', $value['ta_asset_id'])->first();
                    if ($pmProjectID_tagmissing == '') {
                        $PMClass = new PMClass();

                        $accessToken = $PMClass->pm_login(env('PM_USERNAME'), env('PM_PASSWORD'));
                        $arrayResponse = $PMClass->pm_project_import("Audit_Tag_Missing.pmx", $accessToken);
                        Log::debug($arrayResponse);
                        $task_id = $PMClass->get_act_uid($arrayResponse['prj_uid'], $accessToken);
                        $assign = $PMClass->assign_task_users($arrayResponse['prj_uid'], $accessToken, $task_id, $pm_user_id);
                        $pmProjectID_tagmissing = $arrayResponse['prj_uid'];
                    }
                    $Asset_Add = AssetEditModel::create(

                        [
                            'ta_asset_type_master_id' => $asset->ta_asset_type_master_id,
                            'ta_asset_manufacture_serial_no' => $asset->ta_asset_manufacture_serial_no,
                            'ta_asset_name' => $asset->ta_asset_name,
                            'ta_asset_tag_number' => $asset->tag_number,
                            'ta_asset_location_id' => $asset->ta_asset_location_id,
                            'ta_asset_catagory' => $asset->ta_asset_catagory,
                            'ta_asset_active_inactive_status' => $asset->ta_asset_active_inactive_status,
                            'ta_asset_parent_id' => ($asset->ta_asset_parent_id) != null ? ($asset->ta_asset_parent_id) : 0,
                            'ta_asset_type_code' => $asset->ta_asset_name,
                            'operator_id' => $asset->operator_id,
                            'pm_project_id' => $pmProjectID_tagmissing,
                            'is_shown' => ($asset->is_shown) != null ? $asset->is_shown : "0",
                            'ta_created_by' => Auth::user()->id,

                        ]
                    );
                    $site_code = Location::where('tl_location_id', $asset->ta_asset_location_id)->first();

                    $asset_audit_details = Audit_Details_Model::Create(
                        [
                            'ad_audit_id' => $asset_audit->aa_audit_id,
                            'ad_asset_id' => $value['ta_asset_id'],
                            'ad_missing_status' => $missing_status
                        ]
                    );

                    TPmApproval::create(['tpm_asset_id' => $value['ta_asset_id'], 'tpm_asset_site_id' => $asset->ta_asset_location_id, 'pm_project_id' => $pmProjectID_tagmissing, 'tpm_technician_id' => $user_id, 'tpm_supervisor_id' => $supervisor_details["supervisor_id"], 'technician_name' => $technician_details->name, 'approver_name' => $supervisorData->name, 'site_code' => $site_code->tl_location_code, 'task_title' => 'Asset Tag Missing', 'task_status' => 'Pending']);
                } else if ($missing_status == "All Asset Details Matched") {
                    $asset_audit_details = Audit_Details_Model::Create(
                        [
                            'ad_audit_id' => $asset_audit->aa_audit_id,
                            'ad_asset_id' => $value['ta_asset_id'],
                            'ad_missing_status' => $missing_status
                        ]
                    );
                }
            }
        }
        return response()->json([
            "status" => 200,
            "message" => "Asset Audit submitted successfully",
        ]);
    }

    public function audit_accept(Request $request)
    {

        $project_id = $request->project_id;
        $comment = $request->comment;
        $task = $request->missing_task;

        //$data = AssetEditModel::where('pm_project_id', $project_id)->first();
        $Audit_Tag_Missing = TPmApproval::where('pm_project_id', $project_id)->where('task_title', 'Asset Tag Missing')->get();
        $Audit_Asset_Missing = TPmApproval::where('pm_project_id', $project_id)->where('task_title', 'Audit Asset Missing')->get();
        $tag_missing_data = [];
        $asset_missing_data = [];

        //Tag missing
        if ($task == 'tag_missing') {
            foreach ($Audit_Tag_Missing as $tag_missing) {
                $tag_missing_data = AssetEditModel::where('pm_project_id', $tag_missing->pm_project_id)->get();
                foreach ($tag_missing_data as $tag_missing) {
                    asset::where('ta_asset_manufacture_serial_no', $tag_missing->ta_asset_manufacture_serial_no)->update(['ta_asset_tag_number' => '']);
                }
            }
            TPmApproval::where('pm_project_id', $project_id)->where('task_title', 'Asset Tag Missing')->update(['task_status' => 'Completed']);
        }
        //Asset Missing
        if ($task == 'asset_missing') {

            foreach ($Audit_Asset_Missing as $asset_missing) {
                $asset_missing_data = AssetEditModel::where('pm_project_id', $asset_missing->pm_project_id)->get();
                foreach ($asset_missing_data as $assetmissing_data) {
                    asset::where('ta_asset_manufacture_serial_no', $assetmissing_data->ta_asset_manufacture_serial_no)->update(['is_shown' => 'f']);
                    $assetupd = asset::where('ta_asset_manufacture_serial_no', $assetmissing_data->ta_asset_manufacture_serial_no)->first();
                    Asset_Attribute::where('at_asset_attribute_name', 'Status')->where('at_asset_id', $assetupd->ta_asset_id)->update(
                        [
                            'at_asset_attribute_value_text' => "Missing",
                        ]
                    );
                }
            }
            TPmApproval::where('pm_project_id', $project_id)->where('task_title', 'Audit Asset Missing')->update(['task_status' => 'Completed']);
        }
        return response()->json([
            "status" => 200,
            "message" => " Audit accepted successfully",
        ]);
    }
    public function audit_reject(Request $request)
    {
        $project_id = $request->project_id;
        $comment = $request->comment;
        $task = $request->missing_task;
        $t1 = "";
        $t2 = "";
        //Tag missing
        if ($task == 'tag_missing') {
            $t1 = TPmApproval::where('pm_project_id', $project_id)->where('task_title', 'Asset Tag Missing')->update(['task_status' => 'Rejected']);;
            Log::debug($t1);
        }
        //Asset Missing
        if ($task == 'asset_missing') {
            $t2 = TPmApproval::where('pm_project_id', $project_id)->where('task_title', 'Audit Asset Missing')->update(['task_status' => 'Rejected']);;
            Log::debug("Inside asst miss");
        }
        return response()->json([
            "status" => 200,
            "message" => " Audit rejected successfully",
        ]);
    }
}
