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


/* Hospital*/
Route::get('/', [App\Http\Controllers\Doctor\DoctorController::class, 'index'])->name('index');
Route::get('add_doctor', [App\Http\Controllers\Doctor\DoctorController::class, 'addDoctor'])->name('add_doctor');
Route::post('submit_doctor', [App\Http\Controllers\Doctor\DoctorController::class, 'submitDoctor'])->name('submit_doctor');
Route::get('doctor_details/{id}', [App\Http\Controllers\Doctor\DoctorController::class, 'doctorDetails'])->name('doctor_details');
Route::put('doctor_details_update', [App\Http\Controllers\Doctor\DoctorController::class, 'doctorDetailsUpdate'])->name('doctor_details_update');
Route::get('doctor_delete/{id}', [App\Http\Controllers\Doctor\DoctorController::class, 'doctorDelete'])->name('doctor_delete');
Route::get('deleted_doctor', [App\Http\Controllers\Doctor\DoctorController::class, 'deletedDoctor'])->name('deleted_doctor');
Route::put('restore_doctor/{id}', [App\Http\Controllers\Doctor\DoctorController::class, 'restoreDoctor'])->name('restore_doctor');
//Route::put('doc_change_status',[\App\Http\Controllers\Doctor\DoctorController::class, 'doctorChangeStatus'])->name('doc_change_status');

Route::post('status_popup', [\App\Http\Controllers\Doctor\DoctorController::class, 'changeStatusPopup'])->name('change_status_popup');
Route::put('change_status/{id}', [\App\Http\Controllers\Doctor\DoctorController::class, 'changeStatus'])->name('change_status');
//Route::post('status/popup/{user}', [\App\Http\Controllers\HospitalController::class, 'getEmailPopup'])->name('email.popup.get');
