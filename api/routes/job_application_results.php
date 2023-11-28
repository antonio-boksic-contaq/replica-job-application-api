<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobApplicationRejectionReasonController;
use App\Http\Controllers\JobApplicationResultController;

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

Route::prefix('job_application_results')->group(function () {
  Route::get('/', [JobApplicationResultController::class, 'index']);
  Route::post('/', [JobApplicationResultController::class,'store']);
    Route::prefix('{jobApplicationResult}')->group(function () {
      Route::get('/', [JobApplicationResultController::class, 'show']);
      Route::put('/', [JobApplicationResultController::class, 'update']);
      Route::delete('/', [JobApplicationResultController::class, 'delete']);
      Route::put('/restore', [JobApplicationResultController::class, 'restore']);
    });
});