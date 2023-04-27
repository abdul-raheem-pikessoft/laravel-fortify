<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/',function (){
   return view('welcome');
});
Route::redirect('/','/login');
Route::get('/two-factor-recovery',[App\Http\Controllers\AuthController::class,'twoFactorRecovery'])->name('twoFactorRecovery');

Route::group(['middleware' => ['auth']], function (){
    Route::prefix('/user')->group(function (){
        Route::get('/',[App\Http\Controllers\UserController::class,'index'])->middleware('role:admin')->name('users');
        Route::post('/',[App\Http\Controllers\UserController::class,'store'])->middleware('role:admin')->name('users.store');
        Route::delete('/{id}',[App\Http\Controllers\UserController::class,'delete'])->middleware('role:admin')->name('users.delete');
        Route::delete('/status/{id}',[App\Http\Controllers\UserController::class,'status'])->middleware('role:admin')->name('users.block');

        Route::get('/profile',[App\Http\Controllers\HomeController::class,'userProfile'])->name('user-profile');
        Route::get('/two-factor',[App\Http\Controllers\AuthController::class,'twoFactor'])->name('twoFactor');
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth'])->name('home');

    Route::prefix('/notification')->group(function () {
        Route::get('/', [App\Http\Controllers\NotificationController::class, 'index'])->name('notification');
        Route::post('/store-token', [App\Http\Controllers\NotificationController::class, 'updateDeviceToken'])->name('store.token');
        Route::post('/send-web-notification', [App\Http\Controllers\NotificationController::class, 'sendNotification'])->name('send.web-notification');
    });
});

    Route::prefix('/auth')->group(function () {
        Route::get('/{token}', [App\Http\Controllers\AuthController::class, 'activeUser'])->name('auth.token');
    });


