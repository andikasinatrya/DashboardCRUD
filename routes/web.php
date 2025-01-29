<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HobbyController;
use App\Http\Controllers\JsHobbyController;
use App\Http\Controllers\PersonesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TelephoneController;
use App\Http\Controllers\JsPersonesController;


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

//  javascript
    Route::resource('javascript', JsHobbyController::class);

    // Rute untuk resource Person
    Route::resource('javascriptpersones', JsPersonesController::class);
    
    // Rute tambahan untuk Telephone
    Route::prefix('javascript/telephones')->name('telephones.')->group(function () {
        Route::post('store', [JsPersonesController::class, 'storeTelephone'])->name('store');
        Route::get('create', [JsPersonesController::class, 'createTelephone'])->name('create');
        Route::get('edit/{id}', [JsPersonesController::class, 'editTelephone'])->name('edit');
        Route::put('update/{id}', [JsPersonesController::class, 'updateTelephone'])->name('update');
        Route::delete('destroy/{id}', [JsPersonesController::class, 'destroyTelephone'])->name('destroy');
    });
    
    Route::resource('blog', BlogController::class);
    Route::post('blog/upload-image', [BlogController::class, 'uploadImage'])->name('blog.uploadImage');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/dashboard/{blog:slug}', [DashboardController::class, 'show'])->name('dashboard.show');



});

