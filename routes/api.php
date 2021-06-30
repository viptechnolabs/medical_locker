<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::group(['middleware' => ['auth']], function()
//{
//    Route::get('report_download/{id}', [App\Http\Controllers\Patient\PatientController::class, 'reportDownload'])->name('report_download');
//    Route::get('patient_list_download', [App\Http\Controllers\Patient\PatientController::class, 'reportDownload'])->name('patient_list_download');
//});
