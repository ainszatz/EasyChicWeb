<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TodoController;
use Illuminate\Support\Facades\Validator;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/login', [UserController::class, 'login']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);


