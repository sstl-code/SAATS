<?php


use App\Http\Controllers\login;
use App\Http\Controllers\testdb;
use App\Http\Controllers\menupage;
use App\Http\Controllers\assetView;
use App\Http\Middleware\RoleChecker;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Asset_details;
//use App\Http\Controllers\changePassword;
use App\Http\Controllers\asset_History;
use App\Http\Controllers\batch_process;
use App\Http\Controllers\forgotPassView;
use App\Http\Controllers\srnUpload_json;
use App\Http\Controllers\stnUpload_json;
use App\Http\Controllers\UserController;
use App\Http\Controllers\change_passwordweb;
use App\Http\Controllers\configuration_site;
use App\Http\Controllers\Asset_History_Jason;
use App\Http\Controllers\operator_site_jason;
use App\Http\Controllers\pendingApprovalView;
use App\Http\Controllers\Auditbatchcontroller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\configViewController;
use App\Http\Controllers\Asset_json_controller;
use App\Http\Controllers\operatorSiteAssetView;
use App\Http\Controllers\Report_View_Controller;
use App\Http\Controllers\AdditionalBatchProcess;
use App\Http\Controllers\locationViewController;
use App\Http\Controllers\location_listController;
use App\Http\Controllers\operator_active_passive;
use App\Http\Controllers\stnTaskClosureController;
use App\Http\Controllers\ExcelFarMisMatchInventory;
use App\Http\Controllers\location_jason_controller;
use App\Http\Controllers\technician_site_map_jason;
use App\Http\Controllers\technicianSiteMappingView;
use App\Http\Controllers\configuration_site_details;
use App\Http\Controllers\technicianSiteWorklistView;
use App\Http\Controllers\assetaddbatchcontroller_jason;
use App\Http\Controllers\Configuration_assetcontroller;
use App\Http\Controllers\technician_site_active_passive;
use App\Http\Controllers\SystemLogController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});
Route::get('check-session', [UserController::class, 'checkSession']); 
Route::middleware(['auth',RoleChecker::class])->group(function () {
Route::get('/dashboard','App\Http\Controllers\DashboardController@dashboard');
// Route::get('/asset_view','App\Http\Controllers\DashboardController@asset_view');
// Route::get('/location_view', [location_listController::class, 'index']);
Route::get('/location_view', [location_listController::class, 'index']);
// Route::get('/', $controller_path . '\location_view\locationViewController@index');
Route::get('/asset_view', [assetView::class, 'index']);

//Route::get('/change_password',[changePassword::class, 'index']);
Route::get('/change_password',[change_passwordweb::class, 'index']);

Route::post('/supervisor_technician_mapping', [Asset_details::class, 'supervisor_technician_mapping']);



Route::post('/pendingApprovalAccept', [pendingApprovalView::class, 'pendingApprovalAccept']);
Route::get('/Operator_Site_Asset_view', [operatorSiteAssetView::class, 'index']);
// Route::get('/Technician_site_Mapping', [technicianSiteMappingView::class, 'index']);
Route::get('/Technician_site_Worklist_view', [technicianSiteWorklistView::class, 'index']);

// Route::get('/Technician_site_Worklist_view', [technicianSiteWorklistView::class, 'index']);








Route::get('/configuration_site', [configuration_site::class, 'index']);





Route::get('/configuration_location_details', [configuration_site_details::class, 'index']);

//Route::get('/configuration_location_edit', [configuration_site_details::class, 'index']);
//Route::get('/configuration_site', [configuration_site_details::class, 'index']);



Route::get('/srnUpload_json', [srnUpload_json::class, 'getSrNData']);
Route::post('/location_user_mapping', [batch_process::class, 'location_user_mapping']);
Route::post('/mapview', [location_jason_controller::class, 'near_site']);
Route::post('/addasset_srn_stn', [batch_process::class, 'addasset_srn_stn']);



Route::get('/stnClosure', [stnTaskClosureController::class, 'stnClosure']);
//Route::get('/stnClosure', [stnTaskClosureController::class, 'srnClosure']);


Route::get('/AdditionalIteamBatchProcess', [AdditionalBatchProcess::class, 'index']);
Route::post('/additional_item_batch', [AdditionalBatchProcess::class, 'assetbatch']);



//Route::get('/inventory_far', [ExcelFarMisMatchInventory::class, 'index']);
Route::get('/bulkasst_upload', [assetaddbatchcontroller_jason::class, 'assetaddbatch']);
Route::post('/congiguration_assettype', [Configuration_assetcontroller::class, 'addasset_type']);
Route::post('/congiguration_asset_update', [Configuration_assetcontroller::class, 'updasset_type']);
Route::post('/configuration_fixedasstadd', [Configuration_assetcontroller::class, 'fixedassetattr']);
Route::post('/configuration_updfixfetch', [Configuration_assetcontroller::class, 'updfix_asst']);
Route::post('/congiguration_add_site', [configuration_site::class, 'add_site']);
Route::post('/congiguration_update_site', [configuration_site::class, 'update_site']);
Route::post('/location_add_site', [configuration_site::class, 'add_locationdetails']);
Route::post('/location_update_site', [configuration_site::class, 'update_locationdetails']);
Route::post('/configuration_dynamicadd_atr', [configuration_site::class, 'add_dynamic_atr']);
Route::post('/configuration_dynamicupdate_atr', [configuration_site::class, 'dynamic_update_atr']);
Route::post('/configuration_fixedadd_atr', [configuration_site::class, 'add_fix_atr']);
Route::post('/configuration_fixedupdate_atr', [configuration_site::class, 'fixed_update_atr']);
Route::post('/configuration_dynamicattribute', [Configuration_assetcontroller::class, 'dynamicattribute']);
Route::post('/configuration_updatedynamic', [Configuration_assetcontroller::class, 'updatedynamic']);
Route::post('/technician_delete', [Asset_details::class, 'technician_delete']);
Route::get('/pendingApproval', [pendingApprovalView::class, 'index']);
Route::get('/Configuration_management', [configViewController::class, 'index']);

Route::get('/audit_batch', [Auditbatchcontroller::class, 'index']);

Route::post('/reason_add', [Configuration_assetcontroller::class, 'Add_Update_Reason']);
Route::get('/reason_fetch', [Configuration_assetcontroller::class, 'ReasonDetails']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});

Route::post('/Weblogin', [login::class, 'Weblogin']);
Auth::routes();
Route::get('/unauthorize', function () {
    return view('unauthorize');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/locationdb', [location_jason_controller::class, 'location']);
    Route::get('/technician_site_map_jason', [technician_site_map_jason::class, 'index']);
    Route::get('/technician_search', [technician_site_map_jason::class, 'search_user']);
    Route::get('/technician_site_active_passive', [technician_site_active_passive::class, 'index']);
    Route::get('/search_location', [location_jason_controller::class, 'search_location']);
    Route::get('/asset_json_data', [Asset_json_controller::class, 'test']);
    Route::get('/operator_site_jason', [operator_site_jason::class, 'index']);
    Route::get('/operator_active_passive', [operator_active_passive::class, 'index']);
    Route::get('/operator_active_passive_serarch', [operator_site_jason::class, 'search_location']);
    Route::get('/Asset_Details', [Asset_details::class, 'index']);
    Route::get('/Asset_History_Jason', [Asset_History_Jason::class, 'search']);
    Route::get('/site_assets', [Asset_History_Jason::class, 'site_asset_details']);
    Route::get('/history_site_assets', [location_jason_controller::class, 'site_asset_details_history']);
    Route::get('/systemlog', [SystemLogController::class, 'index']);
    Route::post('/systemlog', [SystemLogController::class, 'index']);
    Route::get('/batch_upload', [batch_process::class, 'index']);
    Route::get('/AssetHistory', [asset_History::class, 'index']);
    Route::get('/congiguration_asset', [Configuration_assetcontroller::class, 'index']);
    Route::post('/congiguration_check_site', [configuration_site::class, 'check_site']);
   
    Route::get('/location_edit_site', [configuration_site::class, 'edit_location']);
    Route::get('/congiguration_edit_site', [configuration_site::class, 'edit_site']);
    Route::get('/sub_reasons', [Configuration_assetcontroller::class, 'Sub_Reasons']);
    Route::get('/configuration_fixedfetch_atr', [configuration_site::class, 'fixed_fetch_atr_edit']);
    Route::post('/configuration_dynamicfetch_atr', [configuration_site::class, 'dynamic_fetch_atr_edit']);
    Route::get('/configuration_editfixfetch', [Configuration_assetcontroller::class, 'fixfetchedit']);
    Route::get('/configuration_editdynamic', [Configuration_assetcontroller::class, 'dynamiceditatt']);
    Route::get('/SingAsstDetails', [Asset_details::class, 'AssetDetails']);
    Route::get('/site_fetch_attribute', [configuration_site::class, 'siteattributes']);
    Route::get('/menu_page',[menupage::class, 'index']);
    Route::get('/Operator_to_technician', [Asset_details::class, 'supervisor']);
    Route::any('/report', [Report_View_Controller::class, 'index']);
    Route::post('/generate_report', [Report_View_Controller::class, 'generateReport']);
   
    Route::get('/all_sites', [location_jason_controller::class, 'all_data']);
});

Route::get('/forgot_password',[forgotPassView::class, 'index']);
Route::get('/logout', [login::class, 'logout']);
Route::post('authorize_user', [login::class, 'LoginfromuserMgmt']);
Route::get('/testingweb',[testdb::class, 'index']);
Route::get('/generate_output_file', [Report_View_Controller::class, 'generateOutputFile']);