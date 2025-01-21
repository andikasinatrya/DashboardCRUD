<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ApiHobbyController;
use App\Http\Controllers\Api\ApiPersonesController;
use App\Http\Controllers\Api\ApiTelephoneController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/registrasi/submit', [AuthController::class, 'submitRegistrasi'])->name('registrasi.submit');
Route::apiResource('hobbies', ApiHobbyController::class);
Route::apiResource('persones', ApiPersonesController::class);
Route::apiResource('telephones', ApiTelephoneController::class);