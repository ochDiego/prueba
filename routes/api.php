<?php

use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;

Route::apiResource('users', UserController::class)->only('index', 'store', 'show');

Route::apiResource('products', ProductController::class)->only('index', 'store', 'show');

Route::apiResource('orders', OrderController::class)->only('show');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
