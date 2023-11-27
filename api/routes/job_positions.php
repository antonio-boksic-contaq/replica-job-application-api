<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobPositionController;


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

Route::prefix('job_positions')->group(function () {
  Route::get('/', [JobPositionController::class, 'index']);
  Route::post('/', [JobPositionController::class,'store']);
    Route::prefix('{job_position}')->group(function () {
      Route::get('/', [JobPositionController::class, 'show']);
      Route::put('/', [JobPositionController::class, 'update']);
      Route::delete('/', [JobPositionController::class, 'delete']);
      Route::put('/restore', [JobPositionController::class, 'restore']);
    });
});