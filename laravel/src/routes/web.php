<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebloginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserhotspotController;
use App\Http\Controllers\MikrotikController;
use App\Http\Controllers\RadreplyController;
use App\Http\Controllers\RadgroupreplyController;
use App\Http\Controllers\GuestuserController;
use App\Http\Controllers\RadcheckController;
use App\Http\Controllers\CountryController;

//Route::get('/', [UserController::class,'index']);
Route::get('/', [MikrotikController::class,'system'])->name('root');

Route::get('/home', [AdminController::class,'index']);
Route::get('/login', [UserController::class,'index']);
Route::get('/user/register',[UserController::class,'registeruser']);
Route::post('/user/register',[UserController::class,'store']);
Route::post('/login',[UserController::class,'authenticate']);


Route::prefix('/web')->group(function () {
    Route::get('/email',[WebloginController::class,'testloginmail']);
    Route::get('/api/test',[WebloginController::class,'testlogin']);
    Route::get('/api/users',[WebloginController::class,'getAllUsers']);
    Route::post('/api/logmail',[WebloginController::class,'loginemail']);
    Route::post('/login',[WebloginController::class,'reqlogin']); /** login hotspot */
    //Route::post('/login',[TestController::class,'loginv2']);
    Route::post('/loginv3',[WebloginController::class,'reqloginv3'])->name('weblogin');
    Route::post('/loginv4',[WebloginController::class,'reqloginv4'])->name('webloginv4');
    Route::post('/loginv3/store',[WebloginController::class,'store']);
    Route::post('/loginv4/store',[WebloginController::class,'storev4']);
    Route::get('/countries', [CountryController::class,'show'])->name('country');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout',[UserController::class,'actionlogout']);
});

// Route::middleware('admin')->prefix('/admin')->group(function () {
    
// });

// Route::middleware('operator')->prefix('/op')->group(function () {
    
// });

Route::post('/web/api/checkmember',[WebloginController::class,'checkMember']);

Route::post('/web/checkmem',[MemberController::class,'memberValidator']);

Route::post('/web/member',[MemberController::class,'store']);

Route::get('/web/members',[MemberController::class,'getMembers']);


Route::prefix('/test')->group(function () {
    Route::get('/tab1',[TestController::class,'index']);
    Route::get('/tab2',[TestController::class,'tab2']);
    Route::get('/tab3',[TestController::class,'tab3']);
    Route::get('/loginv2',[TestController::class,'loginv2']);
    Route::post('/loginv2',[TestController::class,'loginv2']);
    Route::get('/modal',[WebloginController::class,'viewModal']);
    Route::get('/users/{username}',[WebloginController::class,'showUser']);
    Route::get('/csv', function () {
        return view('test.exportcsv');
    });
    Route::get('/form', function () {
        return view('test.form1');
    });
    Route::get('/dashboard',[MikrotikController::class,'system']);
    Route::post('/user/profile',[MikrotikController::class,'set_login_email_profile']);
    Route::get('/userguest/export',[RadcheckController::class,'export_email_users']);
});

Route::middleware('auth')->prefix('/hotspot')->group(function () {
    Route::post('/mac/binding',[MikrotikController::class,'add_mac_binding']); /** api */
    Route::get('/mac/binding/{id}',[MikrotikController::class,'edit_mac_binding']); /** api */
    Route::patch('/mac/binding/{id}',[MikrotikController::class,'update_mac_binding']); /** api */
    Route::post('/mac/binding/{id}',[MikrotikController::class,'delete_mac_binding']); /** api */
    Route::get('/users',[UserhotspotController::class,'index']); /** blade */
    Route::post('/user',[UserhotspotController::class,'store']); /** api */
    Route::get('/user/{id}',[UserhotspotController::class,'edit']); /** api */
    Route::patch('/user/{id}',[UserhotspotController::class,'update']); /** api */
    Route::patch('/user/profile/{id}',[UserhotspotController::class,'userprofile']); /** api */
    Route::get('/guest/users',[GuestuserController::class,'index']); /** blade */
    Route::post('/guest/user',[GuestuserController::class,'store']); /** API */
    Route::get('/guest/user/{id}',[GuestuserController::class,'edit']); /** API */
    Route::patch('/guest/profile/{id}',[GuestuserController::class,'update_profile']); /** api */
    Route::patch('/guest/user/{id}',[GuestuserController::class,'update']); /** api */
    Route::get('/mac/{code}', [MikrotikController::class,'show_mac_binding']);/** blade || api*/
    Route::get('/user/email/profile', [MikrotikController::class,'form_login_email_profile']);/** blade */
    Route::patch('/user/email/profile/{id}', [MikrotikController::class,'set_login_email_profile']);/** api */
    Route::get('/login/user',[WebloginController::class,'getAllUsers']);
    Route::get('/user/create',[WebloginController::class,'create']);
    Route::post('/radreply',[RadreplyController::class,'store']);
    Route::get('/usergroup',[RadgroupreplyController::class,'show']);
    Route::get('/user/email/active',[MikrotikController::class,'login_email_active']); /** blade */
    Route::get('/email/users',[RadcheckController::class,'get_email_users']); /** blade */
});

Route::middleware('auth')->prefix('/mikrotik')->group(function () {
    Route::get('/system',[MikrotikController::class,'system']);
    Route::get('/userprofile',[MikrotikController::class,'hotspot_user_profile']); /** api */
    Route::get('/profile',function() {
        return view('admin.dashboardv2');
    });
});

