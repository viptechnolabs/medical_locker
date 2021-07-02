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

Route::middleware(['auth:hospital', 'checkStatus'])->group(function () {
    /* Hospital Middleware */
    Route::get('hospital_details', [\App\Http\Controllers\HospitalController::class, 'hospitalDetails'])->name('hospital_details');
    Route::put('hospital_details_update', [\App\Http\Controllers\HospitalController::class, 'hospitalDetailsUpdate'])->name('hospital_details_update');
    Route::prefix('user')->as('user.')->group(function () {
        Route::get('/', [App\Http\Controllers\User\UserController::class, 'index'])->name('index');
        Route::get('add_user', [App\Http\Controllers\User\UserController::class, 'addUser'])->name('add_user');
        Route::post('submit_doctor', [App\Http\Controllers\User\UserController::class, 'submitUser'])->name('submit_user');
        Route::get('user_details/{id}', [App\Http\Controllers\User\UserController::class, 'userDetails'])->name('user_details');
        Route::get('user_delete/{id}', [App\Http\Controllers\User\UserController::class, 'userDelete'])->name('user_delete');
        Route::get('deleted_user', [App\Http\Controllers\User\UserController::class, 'deletedUser'])->name('deleted_user');
    });
    Route::put('restore/{id}', [App\Http\Controllers\HospitalController::class, 'restore'])->name('restore');
    Route::post('status_popup', [\App\Http\Controllers\HospitalController::class, 'changeStatusPopup'])->name('change_status_popup');
    Route::put('change_status/{id}', [\App\Http\Controllers\HospitalController::class, 'changeStatus'])->name('change_status');
    Route::get('activity', [\App\Http\Controllers\HospitalController::class, 'activity'])->name('activity');
});

Route::middleware(['auth:doctor,web', 'checkStatus'])->group(function () {
    /* Doctor and User Middleware */
    Route::get('profile', [App\Http\Controllers\HospitalController::class, 'profile'])->name('profile');
});

Route::middleware(['auth:hospital,web', 'checkStatus'])->group(function () {
    /* Hospital and User Middleware */
    Route::put('user_details_update', [App\Http\Controllers\User\UserController::class, 'userDetailsUpdate'])->name('user_details_update');
});

Route::middleware(['auth:hospital,doctor', 'checkStatus'])->group(function () {
    /* Hospital and Doctor Middleware */
    Route::put('doctor_details_update', [App\Http\Controllers\Doctor\DoctorController::class, 'doctorDetailsUpdate'])->name('doctor_details_update');
});

Route::middleware(['auth:hospital,doctor,web', 'checkStatus'])->group(function () {
    /* Hospital, Doctor and User Middleware*/
    Route::get('/', [\App\Http\Controllers\HospitalController::class, 'index'])->name('index');
    Route::post('email/popup/{user}', [\App\Http\Controllers\HospitalController::class, 'getEmailPopup'])->name('email.popup.get');
    Route::post('mobile/popup/{user}', [\App\Http\Controllers\HospitalController::class, 'getMobilePopup'])->name('mobile.popup.get');
    Route::prefix('check')->as('check.')->group(function () {
        Route::post('email', [\App\Http\Controllers\HospitalController::class, 'checkEmail'])->name('email');
        Route::post('mobile', [\App\Http\Controllers\HospitalController::class, 'checkMobile'])->name('mobile');
        Route::post('password', [\App\Http\Controllers\HospitalController::class, 'checkPassword'])->name('password');
    });
    Route::prefix('profile')->as('profile.')->group(function () {
        Route::post('update/email', [\App\Http\Controllers\HospitalController::class, 'hospitalUpdateEmail'])->name('update.email');
        Route::post('update/email_verification_code', [\App\Http\Controllers\HospitalController::class, 'email_verification_code'])->name('update.email_verification_code');
        Route::post('update/mobile_no', [\App\Http\Controllers\HospitalController::class, 'hospitalUpdateMobileNo'])->name('update.mobile');
        Route::post('update/mobile_verification_code', [\App\Http\Controllers\HospitalController::class, 'mobile_verification_code'])->name('update.mobile_verification_code');
    });
    Route::put('change_password', [\App\Http\Controllers\HospitalController::class, 'changePassword'])->name('change_password');
});

Route::get('login', [\App\Http\Controllers\HospitalController::class, 'login'])->name('login');
Route::post('do_login', [\App\Http\Controllers\HospitalController::class, 'doLogin'])->name('do_login');
Route::get('logout', [\App\Http\Controllers\HospitalController::class, 'logout'])->name('logout');



//Route::post('getStates', [\App\Http\Controllers\HospitalController::class, 'fetchStates'])->name('fetchStates');
Route::post('getCities', [\App\Http\Controllers\HospitalController::class, 'fetchCities'])->name('fetchCities');






