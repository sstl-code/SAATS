<?php

use App\Http\Middleware\RoleChecker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userloginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ModuleManagementController;
use App\Http\Controllers\userManagementAjaxController;
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
    return view('welcome');
});

Auth::routes();


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::middleware(['auth'])->group(function () {
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');


Route::post('roleManagement',[ModuleManagementController::class,'roleAdd']);
Route::get('roleEditview/{id}',[userManagementAjaxController::class,'roleEditview']);

Route::get('searchRole',[userManagementAjaxController::class,'searchRole']);
Route::get('removeRoleSearch',[userManagementAjaxController::class,'removeRoleSearch']);
Route::get('AllFunctionSearch',[userManagementAjaxController::class,'AllFunctionSearch']);


//Route::get('dashboard',[ModuleManagementController::class,'dashboard']);

Route::post('roleModuleFunctionMap',[ModuleManagementController::class,'roleModuleFunctionMap']);
Route::post('roleUserMap',[ModuleManagementController::class,'roleUserMap']);

Route::get('searchFunction',[userManagementAjaxController::class,'searchFunction']);
Route::get('moduleName',[userManagementAjaxController::class,'moduleName']);
Route::get('roleAllName',[userManagementAjaxController::class,'roleAllName']);

Route::get('functionName',[userManagementAjaxController::class,'functionName']);
Route::get('modalEditview/{id}',[userManagementAjaxController::class,'modalEditview']);

Route::post('addUser',[ModuleManagementController::class,'addUser']); //user management add user

Route::get('userDelete/{id}',[ModuleManagementController::class,'userDelete']);
Route::post('userStatusUpdate',[ModuleManagementController::class,'statusAddUser']);

Route::post('checkexistinRole',[ModuleManagementController::class,'checkexistinRole']);


Route::get('searchUser',[userManagementAjaxController::class,'searchUser']);
Route::get('removeUserSearch',[userManagementAjaxController::class,'removeUserSearch']);

Route::get('splashScreen',[ModuleManagementController::class,'splashScreen'])->name('splashScreen');
Route::post('changepassword',[userloginController::class,'changepassword']);
Route::get('changePass',[ModuleManagementController::class,'changePass']);
Route::get('passwordPolicy',[ModuleManagementController::class,'passwordPolicy']); //password Policy
Route::post('polyStatus',[ModuleManagementController::class,'polyStatus']);
Route::post('updatePolicyValue',[userManagementAjaxController::class,'updatePolicyValue']);
});
Route::get('getallPolycies',[userManagementAjaxController::class,'getPasswordPolicy']);

Route::get('success',[ModuleManagementController::class,'success']);
Route::post('checkexistingemail',[ModuleManagementController::class,'checkexistingemail']);
Route::get('getPassworddata',[ModuleManagementController::class,'getPassworddata']);


Route::post('userLogin',[userloginController::class,'userLogin']);

//Route::middleware(['auth',RoleChecker::class])->group(function () {
    Route::get('userRoleMapp',[ModuleManagementController::class,'userRoleMapp']);
    Route::get('userManagement',[ModuleManagementController::class,'userManagement']);
    Route::get('module',[ModuleManagementController::class,'moduleManagement']);
    Route::get('function',[ModuleManagementController::class,'functionManagement']);
    
    Route::get('roleManagement',[ModuleManagementController::class,'rolemanagement']);
//});
Route::get('/unauthorize', function () {
    return view('unauthorize');
});
Route::any('userLoginByToken',[userloginController::class,'userLoginByToken']);
