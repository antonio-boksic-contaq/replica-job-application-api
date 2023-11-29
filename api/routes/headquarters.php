<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HeadquarterController;

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

Route::prefix('headquarters')->group(function () {
  Route::get('/', [HeadquarterController::class, 'index']);
  Route::post('/', [HeadquarterController::class,'store']);
    Route::prefix('{headquarter}')->group(function () {
      Route::get('/', [HeadquarterController::class, 'show']);
      Route::put('/', [HeadquarterController::class, 'update']);
      Route::delete('/', [HeadquarterController::class, 'delete']);
      Route::put('/restore', [HeadquarterController::class, 'restore']);
    });
});