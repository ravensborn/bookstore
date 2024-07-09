<?php

use App\Http\Controllers\API\Admin\AuthController;
use App\Http\Controllers\API\Admin\BookController as AdminBookController;
use App\Http\Controllers\API\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\API\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\API\Public\BookController as PublicBookController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group( function () {

    Route::post('/token/create', [AuthController::class, 'createToken']);

    Route::middleware('auth:api')->group(function () {

        Route::apiResource('books', AdminBookController::class);
        Route::apiResource('categories', AdminCategoryController::class);
        Route::apiResource('orders', AdminOrderController::class);
    });
});

Route::apiResource('books', PublicBookController::class)->only('index');
