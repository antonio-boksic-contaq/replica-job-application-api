<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Models\Question;

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

Route::prefix('questions')->group(function () {
  Route::get('/', [QuestionController::class, 'index']);
  Route::post('/', [QuestionController::class,'store']);
    Route::prefix('{question}')->group(function () {
      Route::get('/', [QuestionController::class, 'show']);
      Route::put('/', [QuestionController::class, 'update']);
      Route::delete('/', [QuestionController::class, 'delete']);
      Route::put('/restore', [QuestionController::class, 'restore']);
    });
});