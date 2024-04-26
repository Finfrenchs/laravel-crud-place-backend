<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PlacesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//login
Route::post('/login', [AuthController::class, 'login']);

//logout
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

//register
Route::post('/register', [AuthController::class, 'register']);

Route::apiResource('/api-places', PlacesController::class)->middleware('auth:sanctum');

