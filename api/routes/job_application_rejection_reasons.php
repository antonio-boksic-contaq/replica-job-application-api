<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobApplicationRejectionReasonController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('job_application_rejection_reasons')->group(function () {
  Route::get('/', [JobApplicationRejectionReasonController::class, 'index']);
  Route::post('/', [JobApplicationRejectionReasonController::class,'store']);
    Route::prefix('{jobApplicationRejectionReason}')->group(function () {
      Route::get('/', [JobApplicationRejectionReasonController::class, 'show']);
      Route::put('/', [JobApplicationRejectionReasonController::class, 'update']);
      Route::delete('/', [JobApplicationRejectionReasonController::class, 'delete']);
      Route::put('/restore', [JobApplicationRejectionReasonController::class, 'restore']);
    });
});