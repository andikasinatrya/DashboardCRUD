<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

    //  Login dengan Account
     Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
     Route::get('auth/google-callback', [AuthController::class, 'handleGoogleCallback']);
     Route::get('auth/facebook', [AuthController::class, 'redirectToFacebook'])->name('auth.facebook');
     Route::get('auth/facebook-callback', [AuthController::class, 'handleFacebookCallback']);
       

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgot-password/{token?}', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'processForgotPassword'])->name('password.process');
Route::get('/reset-password/{token}', [AuthController::class, 'showForgotPasswordForm'])
     ->name('password.reset');

     Route::middleware(['auth'])->group(function () {
        // Hobbies
        Route::middleware(['permission:view hobbies'])->group(function () {
            Route::get('hobbies', [HobbyController::class, 'index'])->name('hobbies.index');
        });
        Route::middleware(['permission:create hobbies'])->group(function () {
            Route::get('hobbies/create', [HobbyController::class, 'create'])->name('hobbies.create');
            Route::post('hobbies', [HobbyController::class, 'store'])->name('hobbies.store');
        });
        Route::middleware(['permission:edit hobbies'])->group(function () {
            Route::get('hobbies/{id}/edit', [HobbyController::class, 'edit'])->name('hobbies.edit');
            Route::put('hobbies/{id}', [HobbyController::class, 'update'])->name('hobbies.update');
        });
        Route::middleware(['permission:delete hobbies'])->group(function () {
            Route::delete('hobbies/{id}', [HobbyController::class, 'destroy'])->name('hobbies.destroy');
        });
    
        // Persones
        Route::middleware(['permission:view persons'])->group(function () {
            Route::get('persones', [PersonesController::class, 'index'])->name('persones.index');
        });
        Route::middleware(['permission:create persons'])->group(function () {
            Route::get('persones/create', [PersonesController::class, 'create'])->name('persones.create');
            Route::post('persones', [PersonesController::class, 'store'])->name('persones.store');
        });
        Route::middleware(['permission:edit persons'])->group(function () {
            Route::get('persones/{id}/edit', [PersonesController::class, 'edit'])->name('persones.edit');
            Route::put('persones/{id}', [PersonesController::class, 'update'])->name('persones.update');
        });
        Route::middleware(['permission:delete persons'])->group(function () {
            Route::delete('persones/{id}', [PersonesController::class, 'destroy'])->name('persones.destroy');
        });
    
        // Telephones
        Route::middleware(['permission:view telephones'])->group(function () {
            Route::get('telephones', [TelephoneController::class, 'index'])->name('telephones.index');
        });
        Route::middleware(['permission:create telephones'])->group(function () {
            Route::get('telephones/create', [TelephoneController::class, 'create'])->name('telephones.create');
            Route::post('telephones', [TelephoneController::class, 'store'])->name('telephones.store');
        });
        Route::middleware(['permission:edit telephones'])->group(function () {
            Route::get('telephones/{id}/edit', [TelephoneController::class, 'edit'])->name('telephones.edit');
            Route::put('telephones/{id}', [TelephoneController::class, 'update'])->name('telephones.update');
        });
        Route::middleware(['permission:delete telephones'])->group(function () {
            Route::delete('telephones/{id}', [TelephoneController::class, 'destroy'])->name('telephones.destroy');
        });
    
        // Javascript
        Route::middleware(['permission:view javascript'])->group(function () {
            Route::get('javascript', [JsHobbyController::class, 'index'])->name('javascript.index');
        });
        Route::middleware(['permission:create javascript'])->group(function () {
            Route::get('javascript/create', [JsHobbyController::class, 'create'])->name('javascript.create');
            Route::post('javascript', [JsHobbyController::class, 'store'])->name('javascript.store');
        });
        Route::middleware(['permission:edit javascript'])->group(function () {
            Route::get('javascript/{id}/edit', [JsHobbyController::class, 'edit'])->name('javascript.edit');
            Route::put('javascript/{id}', [JsHobbyController::class, 'update'])->name('javascript.update');
        });
        Route::middleware(['permission:delete javascript'])->group(function () {
            Route::delete('javascript/{id}', [JsHobbyController::class, 'destroy'])->name('javascript.destroy');
        });
    
        // Javascript Persons
        Route::middleware(['permission:view javascriptpersones'])->group(function () {
            Route::get('javascriptpersones', [JsPersonesController::class, 'index'])->name('javascriptpersones.index');
        });
        Route::middleware(['permission:create javascriptpersones'])->group(function () {
            Route::get('javascriptpersones/create', [JsPersonesController::class, 'create'])->name('javascriptpersones.create');
            Route::post('javascriptpersones', [JsPersonesController::class, 'store'])->name('javascriptpersones.store');
        });
        Route::middleware(['permission:edit javascriptpersones'])->group(function () {
            Route::get('javascriptpersones/{id}/edit', [JsPersonesController::class, 'edit'])->name('javascriptpersones.edit');
            Route::put('javascriptpersones/{id}', [JsPersonesController::class, 'update'])->name('javascriptpersones.update');
        });
        Route::middleware(['permission:delete javascriptpersones'])->group(function () {
            Route::delete('javascriptpersones/{id}', [JsPersonesController::class, 'destroy'])->name('javascriptpersones.destroy');
        });
    
        // Blog
        Route::middleware(['permission:view blog'])->group(function () {
            Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
        });
     
        Route::middleware(['permission:create blog'])->group(function () {
            Route::get('blog/create', [BlogController::class, 'create'])->name('blog.create');
            Route::post('blog', [BlogController::class, 'store'])->name('blog.store');
        });
        Route::middleware(['permission:edit blog'])->group(function () {
            Route::get('blog/{blog}/edit', [BlogController::class, 'edit'])->name('blog.edit');
            Route::put('blog/{blog}', [BlogController::class, 'update'])->name('blog.update');
        });
        Route::middleware(['permission:delete blog'])->group(function () {
            Route::delete('blog/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');
        });
        
    
        // Dashboard
        Route::middleware(['permission:view dashboard'])->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
            Route::get('/dashboard/{blog:slug}', [DashboardController::class, 'show'])->name('dashboard.show');
        });
    
        // Roles with permissions
        Route::middleware(['permission:view roles'])->group(function () {
            Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
        });

        Route::middleware(['permission:create roles'])->group(function () {
            Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
            Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
        });

        Route::middleware(['permission:edit roles'])->group(function () {
            Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
            Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
        });
        Route::middleware(['permission:show roles'])->group(function () {
            Route::get('roles/{role}', [RoleController::class, 'show'])->name('roles.show');
        });

        Route::middleware(['permission:delete roles'])->group(function () {
            Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
        });
    
        // Users permissions
        Route::middleware(['permission:view users'])->group(function () {
            Route::get('/users', [UserController::class, 'index'])->name('users.index');
        
        });
        Route::middleware(['permission:create users'])->group(function () {
            Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/users', [UserController::class, 'store'])->name('users.store');
        });
        Route::middleware(['permission:edit users'])->group(function () {
            Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        });
        Route::middleware(['permission:delete users'])->group(function () {
            Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        });
    
        // Special role assignment for users
        Route::middleware(['permission:assign roles'])->group(function () {
            Route::get('/users/{id}/edit-roles', [UserController::class, 'editUserRoles'])->name('users.edit_roles');
            Route::put('/users/{id}/update-roles', [UserController::class, 'updateUserRoles'])->name('users.update_roles');
        });
    });
    