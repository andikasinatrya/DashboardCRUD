<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HobbyController;
use App\Http\Controllers\PersonesController;
use App\Http\Controllers\TelephoneController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('hobbies', HobbyController::class);
Route::resource('persones', PersonesController::class);
Route::resource('telephones', TelephoneController::class);