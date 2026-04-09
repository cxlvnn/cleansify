<?php

use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\RecitationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/recitations', [RecitationController::class, 'index']);
    Route::get('/recitations/upload', [RecitationController::class, 'create']);
    Route::post('/recitations', [RecitationController::class, 'store']);

    Route::get('/recitations/edit/{recitation}', [RecitationController::class, 'edit']);
    Route::patch('/recitations/{recitation}', [RecitationController::class, 'update']);

    Route::delete('/recitations/{recitation}', [RecitationController::class, 'destroy']);

    Route::delete('/logout', [SessionController::class, 'destroy']);
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [UserRegisterController::class, 'register'])->name('register');
    Route::post('/register', [UserRegisterController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});
