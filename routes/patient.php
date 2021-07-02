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

Route::middleware(['auth:hospital,doctor,web', 'checkStatus'])->group(function () {
    /* Hospital, Doctor and User Middleware*/
    Route::get('/', [App\Http\Controllers\Patient\PatientController::class, 'index',])->name('index');
    Route::get('patient_details/{id}', [App\Http\Controllers\Patient\PatientController::class, 'patientDetails'])->name('patient_details');
});

Route::middleware(['auth:hospital,doctor', 'checkStatus'])->group(function () {
    /* Hospital and Doctor Middleware*/
    Route::get('report_download/{id}', [App\Http\Controllers\Patient\PatientController::class, 'reportDownload'])->name('report_download');
    Route::get('patient_list_download', [App\Http\Controllers\Patient\PatientController::class, 'patientListDownload'])->name('patient_list_download');
});

Route::middleware(['auth:hospital,web', 'checkStatus'])->group(function () {
    /* Hospital and User Middleware*/
    Route::get('add_patient', [App\Http\Controllers\Patient\PatientController::class, 'addPatient'])->name('add_patient');
    Route::post('submit_patient', [App\Http\Controllers\Patient\PatientController::class, 'submitPatient'])->name('submit_patient');
    Route::put('patient_details_update', [App\Http\Controllers\Patient\PatientController::class, 'patientDetailsUpdate'])->name('patient_details_update');
    Route::get('add_report/{id}', [App\Http\Controllers\Patient\PatientController::class, 'addReport'])->name('add_report');
    Route::post('submit_report', [App\Http\Controllers\Patient\PatientController::class, 'submitReport'])->name('submit_report');
});
