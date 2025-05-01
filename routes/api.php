<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\MeasurementController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProviderController;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {

    /* User Route */
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
    /* End User Route */

    /** Authenention Route */
    Route::prefix('auth')->group(function () {
        Route::get('/google', [ProviderController::class, 'redirectToGoogle']);
        Route::get('/google/callback', [ProviderController::class, 'handleGoogleCallback']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    });
    /** End Authenention Route */

    /** Customer Route */
    Route::apiResource('customers',CustomerController::class)->middleware('auth:sanctum');
    /** End Customer Route */

    Route::apiResource('customers.measurement', MeasurementController::class)->middleware('auth:sanctum');

    /**Customer Product */
    Route::apiResource('user.products', ProductController::class);
    Route::apiResource('products', ProductController::class)->only(['index', 'show']);
    /** End Customer Product */

    /* Order Route */
    // Route::apiResource()
    /* Order Route */

});