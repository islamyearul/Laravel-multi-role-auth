<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\PermissionController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin-register', function () {
    return view('backend.layouts.register');
});
Route::get('/admin-logout', function () {
    Auth::logout();
   return redirect('/login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('backend/dashboard');
    })->name('dashboard');

});


Route::group(['middleware' => ['role:super-admin|admin']], function () {
   
    Route::resource('/admin-role', RoleController::class);
    Route::resource('/admin-permission', PermissionController::class);
    Route::resource('/admin-user', UserController::class);
});





// Route::get('/admin-login', [DashboardController::class, 'userlogin'])->name('admin-user-login'); 
// Route::post('/admin-login-submit', [DashboardController::class, 'userloginsubmit'])->name('admin-user-login.submit'); 
// Route::get('/admin-register', [DashboardController::class, 'createuser'])->name('admin-register');
// Route::post('/admin-register-store', [DashboardController::class, 'userstore'])->name('admin-register-store');





// sample routes 
Route::group(['middleware' => ['can:publish articles']], function () {
    //
});
Route::group(['middleware' => ['role:super-admin']], function () {
    //
});

Route::group(['middleware' => ['permission:publish articles']], function () {
    //
});

Route::group(['middleware' => ['role:super-admin','permission:publish articles']], function () {
    //
});

Route::group(['middleware' => ['role_or_permission:super-admin|edit articles']], function () {
    //
});

Route::group(['middleware' => ['role_or_permission:publish articles']], function () {
    //
});
Route::group(['middleware' => ['role:super-admin|writer']], function () {
    //
});

Route::group(['middleware' => ['permission:publish articles|edit articles']], function () {
    //
});

Route::group(['middleware' => ['role_or_permission:super-admin|edit articles']], function () {
    //
});