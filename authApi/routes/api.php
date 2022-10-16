<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\userController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user/login',[userController::class, 'userLogin'])->name('login');

Route::post('user/rigister',[userController::class, 'rigister'])->name('userrigister');
Route::group( ['prefix' => 'user','middleware' => ['auth:user-api'] ],function(){
   // authenticated staff routes here 
    Route::get('dashboard',[userController::class, 'dashboard']);
});


Route::post('admin/login',[AdminController::class, 'AdminLogin'])->name('AdminLogin.login');

Route::post('admin/rigister',[AdminController::class, 'rigister'])->name('Admin.rigister');
Route::group( ['prefix' => 'admin','middleware' => ['auth:admin-api'] ],function(){
   // authenticated staff routes here 
    Route::get('dashboard',[AdminController::class, 'dashboard']);
});