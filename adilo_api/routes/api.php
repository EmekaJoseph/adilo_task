<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\VideoController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoriesController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});


// Route::middleware('auth:sanctum')->group(function () {
Route::apiResource('videos', VideoController::class);
Route::apiResource('categories', CategoriesController::class);
// });
