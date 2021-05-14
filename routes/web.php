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
//Route::get('hospital_details',[\App\Http\Livewire\HospitalDetails::class, 'render'])->name('hospital_details');
Route::get('hospital_details',[\App\Http\Controllers\HospitalController::class, 'hospitalDetails'])->name('hospital_details');
Route::put('hospital_details_update',[\App\Http\Controllers\HospitalController::class, 'hospitalDetailsUpdate'])->name('hospital_details_update');
Route::put('hospital_change_password',[\App\Http\Controllers\HospitalController::class, 'hospitalChangePassword'])->name('hospital_change_password');
Route::put('hospital_update_mobile_no',[\App\Http\Controllers\HospitalController::class, 'hospitalUpdateMobileNo'])->name('hospital_update_mobile_no');
Route::put('hospital_update_email',[\App\Http\Controllers\HospitalController::class, 'hospitalUpdateEmail'])->name('hospital_update_email');
