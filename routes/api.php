<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware("auth:api")->group(function () {
    Route::prefix('/auth')->controller(AuthController::class)->group(function () {
        Route::get('/user', 'user');
        Route::post('/logout', 'logout');
        Route::post('/refresh', 'refresh');
    });

    Route::get('/test', function () {
        return response()->json([
            "message" => "здесь только наши люди"
        ]);
    });
});

Route::fallback(function () {
    return response()->json([
        "error" => "Page not found"
    ]);
});
