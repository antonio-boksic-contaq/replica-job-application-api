<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcquisitionChannelController;

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

Route::prefix('acquisition_channels')->group(function () {
  Route::get('/', [AcquisitionChannelController::class, 'index']);
  Route::post('/', [AcquisitionChannelController::class,'store']);
    Route::prefix('{acquisitionChannel}')->group(function () {
      Route::get('/', [AcquisitionChannelController::class, 'show']);
      Route::put('/', [AcquisitionChannelController::class, 'update']);
      Route::delete('/', [AcquisitionChannelController::class, 'delete']);
      Route::put('/restore', [AcquisitionChannelController::class, 'restore']);
    });
});