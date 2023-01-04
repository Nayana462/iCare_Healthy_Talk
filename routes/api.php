<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ChatController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

  Route::post('/login'  , [LoginController::class, 'login']);
  Route::get('/homeData'  , [HomeController::class, 'getCategories']);
  Route::get('/getDoctors/{id}'  , [HomeController::class, 'getDoctorsByCategoy']);
Route::get('/getConversations/{id}'  , [ChatController::class, 'getConversations']);
Route::get('/getChat/{id}'  , [ChatController::class, 'getChat']);
Route::get('/getProfile/{id}'  , [LoginController::class, 'getProfile']);
Route::post('/registerUser'  , [LoginController::class, 'registerUser']);


