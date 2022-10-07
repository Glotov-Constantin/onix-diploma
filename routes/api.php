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

Route::prefix('users')->group(function (){
    Route::get('', [\App\Http\Controllers\Api\UserController::class, 'index']);
    Route::get('{user}', [\App\Http\Controllers\Api\UserController::class, 'show']);
    Route::post('create', [\App\Http\Controllers\Api\UserController::class, 'store']);
    Route::put('{user}', [\App\Http\Controllers\Api\UserController::class, 'update']);
    Route::delete('{user}', [\App\Http\Controllers\Api\UserController::class, 'destroy']);
});

Route::prefix('categories')->group(function (){
    Route::get('', [\App\Http\Controllers\Api\CategoryController::class, 'index']);
    Route::get('{category}', [\App\Http\Controllers\Api\CategoryController::class, 'show']);
    Route::post('create', [\App\Http\Controllers\Api\CategoryController::class, 'store']);
    Route::put('{category}', [\App\Http\Controllers\Api\CategoryController::class, 'update']);
    Route::delete('{category}', [\App\Http\Controllers\Api\CategoryController::class, 'destroy']);
});

Route::prefix('products')->group(function (){
    Route::get('', [\App\Http\Controllers\Api\ProductController::class, 'index']);
    Route::get('{product}', [\App\Http\Controllers\Api\ProductController::class, 'show']);
    Route::post('create', [\App\Http\Controllers\Api\ProductController::class, 'store']);
    Route::put('{category}', [\App\Http\Controllers\Api\ProductController::class, 'update']);
    Route::delete('{category}', [\App\Http\Controllers\Api\ProductController::class, 'destroy']);
});
