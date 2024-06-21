<?php

use App\Models\asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\configuration_site;
use App\Http\Controllers\API\CommonController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/audit_accept', [ApiController::class, 'audit_accept']);

//Route::resource('/home', HomeController::class);

Route::post('/login', [ApiController::class, 'login']);
Route::post('/testapi', [ApiController::class, 'testapi']);
Route::Post('/asset_tagging_approve', [ApiController::class, 'asset_tagging_approve']);
Route::post('/get_asset_by_process_id', [ApiController::class, 'get_asset_by_process_id']);
Route::post('/get_asset_by_PM_process_id', [ApiController::class, 'get_asset_by_PM_process_id']);

Route::post('/get_edit_asset_by_process_id', [ApiController::class, 'get_edit_asset_by_process_id']);
Route::post('/approve_pm_request', [ApiController::class, 'approve_pm_request']);
Route::post('/reject_pm_request', [ApiController::class, 'reject_pm_request']);
Route::post('/approve_pm_request_asset', [ApiController::class, 'approve_pm_request_asset']);
Route::post('/reject_pm_request_asset', [ApiController::class, 'reject_pm_request_asset']);
Route::post('/approve_pm_request_editasset', [ApiController::class, 'approve_pm_request_editasset']);
Route::post('/approve_pm_request_stn', [ApiController::class, 'approve_pm_request_stn']);
Route::post('/reject_pm_request_stn', [ApiController::class, 'reject_pm_request_stn']);
Route::post('/reject_pm_request_editasset', [ApiController::class, 'edit_asset_reject']);
Route::post('/audit_reject_pm', [ApiController::class, 'audit_reject']);
Route::get('/commondata', [CommonController::class, 'commondata']);
Route::post('/getotp', [ApiController::class, 'getotp']);
Route::post('/matchotp', [ApiController::class, 'matchotp']);
Route::post('/forgotpassword', [ApiController::class, 'forgotpassword']);
Route::get('/sitetypefetch', [configuration_site::class, 'sitetypefetch']);
Route::post('/audit_trail', [CommonController::class, 'auditTrail']);
Route::get('/completed_task', [ApiController::class, 'completed_task_pm']);

Route::middleware(['auth:api'])->group(function () {
   
    
Route::Post('/asset_attributes', [ApiController::class, 'asset_attributes']);
Route::post('/my_sites', [ApiController::class, 'my_sites'])->middleware(['scope:api-my_sites']);
Route::post('/my_site_home', [ApiController::class, 'my_sites'])->middleware(['scope:api-my_site_home']);
Route::post('/near_site', [ApiController::class, 'near_site'])->middleware(['scope:api-near_site']);
Route::post('/nearby_site_home', [ApiController::class, 'near_site'])->middleware(['scope:api-near_site']);
Route::get('/assets_list_location_wise/{id}', [ApiController::class, 'assets_list_location_wise'])->middleware(['scope:api-assets_list_location_wise']);
Route::get('/single_asset_details/{asset_id}', [ApiController::class, 'single_asset_details'])->middleware(['scope:api-single_asset_details']);
Route::post('/fetch_asset_by_serialno', [ApiController::class, 'fetch_asset_by_serialno'])->middleware(['scope:api-fetch_asset_by_serialno']);
Route::post('/asset_type', [ApiController::class, 'asset_type']);

Route::Post('/asset_tagging', [ApiController::class, 'asset_tagging'])->middleware(['scope:api-asset_tagging']);


Route::post('/get_task_list_by_location', [ApiController::class, 'Get_task_list_by_location'])->middleware(['scope:api-get_task_list_by_location']);
Route::post('/update_srn', [ApiController::class, 'update_srn'])->middleware(['scope:api-update_srn']);



Route::post('/add_location', [ApiController::class, 'add_location']);
Route::post('/Update_location/{location_id}', [ApiController::class, 'Update_location']);
Route::post('/Add_location_atribute', [ApiController::class, 'Add_location_atribute']);
Route::post('/edit_asset', [ApiController::class, 'edit_asset'])->middleware(['scope:api-edit_asset']);


Route::post('/add_asset', [ApiController::class, 'add_asset'])->middleware(['scope:api-add_asset']);;
Route::post('/add_child_asset', [ApiController::class, 'add_child_asset']);
Route::post('/asset_type_attr', [ApiController::class, 'asset_type_attribute']);

Route::post('/add_asset_attribute', [ApiController::class, 'add_asset_attribute']);

Route::post('/changepassword', [ApiController::class, 'changepassword'])->middleware(['scope:api-changepassword']);


Route::post('/global_search_home', [ApiController::class, 'global_search_home'])->middleware(['scope:api-global_search_home']);

Route::post('/update_asset_details', [ApiController::class, 'update_asset_details'])->middleware(['scope:api-update_asset_details']);

Route::post('/Forgot_Password_phone', [ApiController::class, 'Forgot_Password_phone'])->middleware(['scope:api-Forgot_Password_phone']);
Route::get('/asset_child_details/{id}', [ApiController::class, 'asset_child_details']);
Route::post('/child_sat_dynamic', [ApiController::class, 'child_sat_dynamic']);
Route::get('/get_asset_attribute/{asset_type}', [ApiController::class, 'get_asset_attribute']);
Route::post('/asset_Tagging_img', [ApiController::class, 'asset_Tagging_img'])->middleware(['scope:api-asset_Tagging_img']);
Route::post('/add_srn', [ApiController::class, 'add_srn'])->middleware(['scope:api-add_srn']);
Route::post('/add_stn', [ApiController::class, 'add_stn'])->middleware(['scope:api-add_stn']);

Route::post('/get_srn', [ApiController::class, 'get_srn']);
Route::post('/update_stn', [ApiController::class, 'update_stn'])->middleware(['scope:api-update_stn']);

Route::post('/update_dynamic_attr', [ApiController::class, 'update_dynamic_attr']);
Route::post('/audit_list', [ApiController::class, 'audit_list']);
Route::post('/audit_list_child', [ApiController::class, 'audit_list_child']);
Route::post('/audit_details_view', [ApiController::class, 'audit_details_view']);
Route::post('/audit_submit', [ApiController::class, 'audit_submit'])->middleware(['scope:api-audit_submit']);
Route::get('/get_asset_static_attribute/{asset_type}', [ApiController::class, 'get_asset_static_attribute']);

Route::post('/add_child_asset', [ApiController::class, 'add_child_asset']);
Route::post('/fetch_asset_by_serialno_toverify', [ApiController::class, 'fetch_asset_by_serialno_toverify']);
//Route::post('/asset_getall', [Add_asset::class, 'asset_getall']);
Route::post('/notification_mail', [MailController::class, 'sendMessage']);
Route::post('/upload_site_media', [ApiController::class, 'site_video']);
Route::post('/getsite_media', [ApiController::class, 'getsite_media']);
Route::post('/fetch_by_barcode', [CommonController::class, 'fetch_asset_by_barcode']);
});
Route::post('/refreshtoken_login', [ApiController::class, 'loginWithRefreshtoken']);

//Route::post('/deallocate_srn', [Add_STN::class, 'deallocate_srn']);


// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::resource('/home', HomeController::class);
// });