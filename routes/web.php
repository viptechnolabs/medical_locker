<?php

use Illuminate\Support\Facades\Route;


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

//Route::get('/', function () {
//    return view('welcome');
//})->name('index');

Route::middleware(['auth:hospital'])->group(function () {
    /* Hospital Middleware */
    Route::get('profile/{user_type}/{id}', [App\Http\Controllers\HospitalController::class, 'profile'])->name('profile');
    Route::get('hospital_details',[\App\Http\Controllers\HospitalController::class, 'hospitalDetails'])->name('hospital_details');
    Route::put('hospital_details_update',[\App\Http\Controllers\HospitalController::class, 'hospitalDetailsUpdate'])->name('hospital_details_update');
});

Route::middleware(['auth:doctor'])->group(function () {
    /* Doctor Middleware */
    Route::get('profile/{user_type}/{id}', [App\Http\Controllers\HospitalController::class, 'profile'])->name('profile');
});

Route::middleware(['auth:hospital,doctor'])->group(function () {
    /* Hospital and Doctor Middleware*/
    Route::get('/',[\App\Http\Controllers\HospitalController::class, 'index'])->name('index');
    Route::post('email/popup/{user}', [\App\Http\Controllers\HospitalController::class, 'getEmailPopup'])->name('email.popup.get');
    Route::post('mobile/popup/{user}', [\App\Http\Controllers\HospitalController::class, 'getMobilePopup'])->name('mobile.popup.get');
    Route::prefix('check')->as('check.')->group(function () {
        Route::post('email', [\App\Http\Controllers\HospitalController::class, 'checkEmail'])->name('email');
        Route::post('mobile', [\App\Http\Controllers\HospitalController::class, 'checkMobile'])->name('mobile');
    });
    Route::prefix('profile')->as('profile.')->group(function () {
        Route::post('update/email', [\App\Http\Controllers\HospitalController::class, 'hospitalUpdateEmail'])->name('update.email');
        Route::post('update/email_verification_code', [\App\Http\Controllers\HospitalController::class, 'email_verification_code'])->name('update.email_verification_code');
        Route::post('update/mobile_no', [\App\Http\Controllers\HospitalController::class, 'hospitalUpdateMobileNo'])->name('update.mobile');
        Route::post('update/mobile_verification_code', [\App\Http\Controllers\HospitalController::class, 'mobile_verification_code'])->name('update.mobile_verification_code');
    });
    Route::put('change_password',[\App\Http\Controllers\HospitalController::class, 'changePassword'])->name('change_password');
});

Route::get('login',[\App\Http\Controllers\HospitalController::class, 'login'])->name('login');
Route::post('do_login',[\App\Http\Controllers\HospitalController::class, 'doLogin'])->name('do_login');
Route::get('logout',[\App\Http\Controllers\HospitalController::class, 'logout'])->name('logout');









