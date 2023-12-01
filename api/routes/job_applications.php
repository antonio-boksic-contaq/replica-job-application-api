<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobApplicationController;

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

Route::prefix('job_applications')->group(function () {
  Route::get('/', [JobApplicationController::class, 'index']);
  Route::post('/', [JobApplicationController::class,'store']);
    Route::prefix('{jobApplication}')->group(function () {
      Route::get('/', [JobApplicationController::class, 'show']);
      Route::put('/', [JobApplicationController::class, 'update']);
      Route::delete('/', [JobApplicationController::class, 'delete']);
      Route::put('/restore', [JobApplicationController::class, 'restore']);
    });
});