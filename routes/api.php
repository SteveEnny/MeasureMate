<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\MeasurementController;
use App\Http\Controllers\Api\ProviderController;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

///// Google sign in 
Route::get('/auth/google', [ProviderController::class, 'redirectToGoogle']);

//http://localhost:8000/api/auth/google

Route::get('/auth/google/callback', [ProviderController::class, 'handleGoogleCallback']);


////////////


Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource('customers',CustomerController::class)->middleware('auth:sanctum');
// Route::apiResources([
//     'customers' => CustomerController::class,
//     'measurement' => MeasurementController::class,
// ]);