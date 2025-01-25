<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HobbyController;
use App\Http\Controllers\PersonesController;
use App\Http\Controllers\TelephoneController;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'showRegistrasi'])->name('home');

Route::get('/registrasi', [AuthController::class, 'showRegistrasi'])->name('registrasi.show');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login/submit', [AuthController::class, 'submitLogin'])
     ->name('login.submit')
     ->middleware('throttle:5,1');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgot-password/{token?}', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'processForgotPassword'])->name('password.process');
Route::get('/reset-password/{token}', [AuthController::class, 'showForgotPasswordForm'])
     ->name('password.reset');



Route::middleware(['auth'])->group(function () {
    Route::resource('hobbies', HobbyController::class);
    Route::resource('persones', PersonesController::class);
    Route::resource('telephones', TelephoneController::class);
});

