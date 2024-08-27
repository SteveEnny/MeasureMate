<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\MeasurementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResources([
    'customers' => CustomerController::class,
    'measurement' => MeasurementController::class,
]);