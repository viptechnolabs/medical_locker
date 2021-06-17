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

/* Hospital*/
Route::get('/',[\App\Http\Controllers\HospitalController::class, 'index'])->name('index');
Route::get('login',[\App\Http\Controllers\HospitalController::class, 'login'])->name('login');
Route::post('do_login',[\App\Http\Controllers\HospitalController::class, 'doLogin'])->name('do_login');
Route::get('logout',[\App\Http\Controllers\HospitalController::class, 'logout'])->name('logout');
//Route::get('hospital_details',[\App\Http\Livewire\HospitalDetails::class, 'render'])->name('hospital_details');
Route::get('hospital_details',[\App\Http\Controllers\HospitalController::class, 'hospitalDetails'])->name('hospital_details');
Route::get('profile/{user_type}/{id}', [App\Http\Controllers\HospitalController::class, 'profile'])->name('profile');

Route::post('email/popup/{user}', [\App\Http\Controllers\HospitalController::class, 'getEmailPopup'])->name('email.popup.get');
Route::post('mobile/popup/{user}', [\App\Http\Controllers\HospitalController::class, 'getMobilePopup'])->name('mobile.popup.get');


Route::prefix('check')->as('check.')->group(function () {
    Route::post('email', [\App\Http\Controllers\HospitalController::class, 'checkEmail'])->name('email');
    Route::post('mobile', [\App\Http\Controllers\HospitalController::class, 'checkMobile'])->name('mobile');
    //Route::post('password', [\App\Http\Controllers\HospitalController::class, 'checkPassword'])->name('password');
//    Route::post('password', [\App\Http\Controllers\HospitalController::class, 'checkPassword'])->name('password');
});


Route::prefix('profile')->as('profile.')->group(function () {
    Route::post('update/email', [\App\Http\Controllers\HospitalController::class, 'hospitalUpdateEmail'])->name('update.email');
    Route::post('update/email_verification_code', [\App\Http\Controllers\HospitalController::class, 'email_verification_code'])->name('update.email_verification_code');
    Route::post('update/mobile_no', [\App\Http\Controllers\HospitalController::class, 'hospitalUpdateMobileNo'])->name('update.mobile');
    Route::post('update/mobile_verification_code', [\App\Http\Controllers\HospitalController::class, 'mobile_verification_code'])->name('update.mobile_verification_code');
//    Route::post('update/password', [\App\Http\Controllers\HospitalController::class, 'updatePassword'])->name('update.password');
});

Route::put('hospital_details_update',[\App\Http\Controllers\HospitalController::class, 'hospitalDetailsUpdate'])->name('hospital_details_update');
Route::put('change_password',[\App\Http\Controllers\HospitalController::class, 'changePassword'])->name('change_password');
//Route::put('hospital_update_mobile_no',[\App\Http\Controllers\HospitalController::class, 'hospitalUpdateMobileNo'])->name('hospital_update_mobile_no');
//Route::put('hospital_update_email',[\App\Http\Controllers\HospitalController::class, 'hospitalUpdateEmail'])->name('hospital_update_email');

// Change 11 Jun 2021
