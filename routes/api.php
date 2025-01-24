<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\OrdersController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('users',UserController::class);
Route::post('login',[UserController::class,'login']);
Route::post('logout',[UserController::class,'logout']);


    
    Route::middleware(['auth', 'adminMiddleware'])->group(function () {
        Route::apiResource('products',ProductController::class);
    Route::apiResource('orders',OrdersController::class);
    });