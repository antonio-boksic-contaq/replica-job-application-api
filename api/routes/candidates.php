<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;

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

Route::prefix('candidates')->group(function () {
  Route::get('/', [CandidateController::class, 'index']);
  Route::post('/', [CandidateController::class,'store']);
    Route::prefix('{candidate}')->group(function () {
      Route::get('/', [CandidateController::class, 'show']);
      Route::put('/', [CandidateController::class, 'update']);
      Route::delete('/', [CandidateController::class, 'delete']);
      Route::put('/restore', [CandidateController::class, 'restore']);
    });
});