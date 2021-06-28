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
/* Patient*/
Route::get('/', [App\Http\Controllers\Patient\PatientController::class, 'index',])->name('index');
Route::get('add_patient', [App\Http\Controllers\Patient\PatientController::class, 'addPatient'])->name('add_patient');
Route::post('submit_patient', [App\Http\Controllers\Patient\PatientController::class, 'submitPatient'])->name('submit_patient');
Route::get('patient_details/{id}', [App\Http\Controllers\Patient\PatientController::class, 'patientDetails'])->name('patient_details');
Route::put('patient_details_update', [App\Http\Controllers\Patient\PatientController::class, 'patientDetailsUpdate'])->name('patient_details_update');
Route::get('add_report/{id}', [App\Http\Controllers\Patient\PatientController::class, 'addReport'])->name('add_report');
Route::post('submit_report', [App\Http\Controllers\Patient\PatientController::class, 'submitReport'])->name('submit_report');


