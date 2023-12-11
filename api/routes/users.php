<?php

use App\Http\Controllers\UserContractController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
Route::prefix('users')->group(function () {
  //Route::get('/', [UserController::class, 'index']);
  //Route::post('/', [UserController::class, 'store']);
   Route::prefix('{user}')->group(function () {
    //Route::get('/', [UserController::class, 'show']);
    //Route::get('/internal-trainings', [UserController::class, 'internalTrainings']);
    //Route::get('/training-courses', [UserController::class, 'trainingCourses']);
    //Route::put('/', [UserController::class, 'update']);
    Route::put('/update-password', [UserController::class, 'updatePassword']);
    Route::put('/send-password', [UserController::class, 'sendPassword']);
    //Route::post('/headquarters', [UserController::class, 'storeHeadquarters']);
    //Route::post('/internal-trainings', [UserController::class, 'storeInternalTrainings']);
    //Route::delete('/', [UserController::class, 'delete']);
    //Route::put('/restore', [UserController::class, 'restore']);
    //Route::prefix('contracts')->group(function () {
      //Route::get('/', [UserController::class, 'contracts']);
      //Route::post('/', [UserContractController::class, 'store']);
      //Route::prefix('{userContract}')->group(function () {
        //Route::get('/', [UserContractController::class, 'show']);
        //Route::get('/pdf', [UserContractController::class, 'pdf']);
        //Route::put('/', [UserContractController::class, 'update']);
      });
    });
  //});
//});