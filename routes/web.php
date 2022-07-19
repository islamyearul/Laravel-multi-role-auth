<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\PermissionController;

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

Route::get('/admin-login', function () {
    return view('backend.layouts.ad-login');
});
Route::get('/admin-register', function () {
    return view('backend.layouts.register');
});
Route::get('/admin-logout', function () {
    Auth::logout();
   return redirect('/admin-login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('backend/dashboard');
    })->name('dashboard');

});
Route::resource('/admin-role', RoleController::class);
Route::resource('/admin-permission', PermissionController::class);