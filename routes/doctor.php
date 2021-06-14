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
Route::put('doc_change_status',[\App\Http\Controllers\Doctor\DoctorController::class, 'doctorChangeStatus'])->name('doc_change_status');
