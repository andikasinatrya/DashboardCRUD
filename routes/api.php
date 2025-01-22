<?php

use App\Http\Controllers\Api\ApiAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ApiHobbyController;
use App\Http\Controllers\Api\ApiPersonesController;
use App\Http\Controllers\Api\ApiTelephoneController;


Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/register', [ApiAuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [ApiAuthController::class, 'logout']);
    Route::get('/user', [ApiAuthController::class, 'user']);
    Route::get('/user/{id}', [ApiAuthController::class, 'show']);
    Route::delete('/user/delete', [ApiAuthController::class, 'deleteAccount']);
    Route::apiResource('hobbies', ApiHobbyController::class);
    Route::apiResource('persones', ApiPersonesController::class);
    Route::apiResource('telephones', ApiTelephoneController::class);
});

Route::post('/registrasi/submit', [AuthController::class, 'submitRegistrasi'])->name('registrasi.submit');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
