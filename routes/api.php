<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

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

Route::apiResource('users', UserController::class);
Route::apiResource('categories', \App\Http\Controllers\Api\CategoryController::class);
Route::apiResource('products', \App\Http\Controllers\Api\ProductController::class);
Route::apiResource('cart', \App\Http\Controllers\Api\CartController::class);
Route::apiResource('orders', \App\Http\Controllers\Api\OrderController::class);
