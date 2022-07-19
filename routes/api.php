<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('Api')->group(function(){
    Route::get('/test', [HomeController::class, 'test']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function(){
        Route::get('profile', [HomeController::class, 'profile']);
        Route::post('logout', [AuthController::class, 'logout']);
    
        Route::get('transaction', [HomeController::class, 'transaction']);
        Route::get('transaction/{trs_id}', [HomeController::class, 'transactionDetail']);
    
        Route::get('notification', [HomeController::class, 'notification']);
        Route::get('notification/{id}', [HomeController::class, 'notificationDetail']);
        Route::get('to-account-verify', [HomeController::class, 'toAccountVerify']);
        
        Route::get('transfer/confirm', [HomeController::class, 'transferConfirm']);
        Route::post('transfer/complete', [HomeController::class, 'transferComplete']);

        Route::get('scan-and-pay-form', [HomeController::class, 'scanAndPayForm']);
        Route::get('scan-and-pay/confirm', [HomeController::class, 'scanAndPayConfirm']);
        Route::post('scan-and-pay/complete', [HomeController::class, 'scanAndPayComplete']);
    });
  
});