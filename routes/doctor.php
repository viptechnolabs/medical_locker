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
//Route::get('/',[\App\Http\Controllers\HospitalController::class, 'index'])->name('index');
//Route::get('login',[\App\Http\Controllers\HospitalController::class, 'login'])->name('login');
//Route::get('hospital_details',[\App\Http\Controllers\HospitalController::class, 'hospitalDetails'])->name('hospital_details');
//Route::put('hospital_details_update',[\App\Http\Controllers\HospitalController::class, 'hospitalDetailsUpdate'])->name('hospital_details_update');
//Route::name('doctor.')->prefix('doctor')->group(function () {
//    Route::get('/', [App\Http\Controllers\Doctor\DoctorController::class, 'index'])->name('index');
//});
Route::get('/', [App\Http\Controllers\Doctor\DoctorController::class, 'index'])->name('index');
Route::get('add_doctor', [App\Http\Controllers\Doctor\DoctorController::class, 'addDoctor'])->name('add_doctor');
Route::post('submit_doctor', [App\Http\Controllers\Doctor\DoctorController::class, 'submitDoctor'])->name('submit_doctor');
