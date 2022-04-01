<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Frontend\HomeController;

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




// Admin User Auth
Route::get('admin/login', [AdminLoginController::class, 'showLoginForm']);
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

//User Auth
Auth::routes();

Route::get('/', function(){
    return view('welcome');
});

Route::middleware('auth')->group(function(){
    Route::get('/', function(){
        return view('welcome');
    });
    
    //    Route::get('/home', [HomeController::class, 'index'])->name('home');
   Route::get('/home', [HomeController::class, 'index'])->name('home');


   Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/update-password', [HomeController::class, 'updatePassword'])->name('update-password');
    Route::post('/update-password', [HomeController::class, 'updatePasswordStore'])->name('update-password.store');
    Route::get('/wallet', [HomeController::class, 'wallet'])->name('wallet');
    
    Route::get('/transfer', [HomeController::class, 'transfer']);
    Route::get('/transfer/confirm', [HomeController::class ,'transferConfirm']);
    Route::post('/transfer/complete', [HomeController::class, 'transferComplete']);
    
    Route::get('/to-account-verify', [HomeController::class, 'toAccountVerify']);
    Route::get('/password-check', [HomeController::class, 'passwordCheck']);

    Route::get('/transaction', [HomeController::class, 'transaction']);
    Route::get('/transaction/{trs_id}', [HomeController::class, 'transactionDetail']);
    
});
