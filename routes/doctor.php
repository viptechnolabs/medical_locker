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
    /* Hospital Middleware*/
    Route::get('/', [App\Http\Controllers\Doctor\DoctorController::class, 'index'])->name('index');
    Route::get('add_doctor', [App\Http\Controllers\Doctor\DoctorController::class, 'addDoctor'])->name('add_doctor');
    Route::post('submit_doctor', [App\Http\Controllers\Doctor\DoctorController::class, 'submitDoctor'])->name('submit_doctor');
    Route::get('doctor_details/{id}', [App\Http\Controllers\Doctor\DoctorController::class, 'doctorDetails'])->name('doctor_details');
    Route::get('doctor_delete/{id}', [App\Http\Controllers\Doctor\DoctorController::class, 'doctorDelete'])->name('doctor_delete');
    Route::get('deleted_doctor', [App\Http\Controllers\Doctor\DoctorController::class, 'deletedDoctor'])->name('deleted_doctor');
    Route::put('restore_doctor/{id}', [App\Http\Controllers\Doctor\DoctorController::class, 'restoreDoctor'])->name('restore_doctor');
});
