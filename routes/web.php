<?php

use App\Http\Controllers\RecitationController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\Auth\SessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('player.index');
});

Route::get('/recitations', [RecitationController::class, 'index']);
Route::get('/recitations/upload', [RecitationController::class, 'create']);
Route::post('/recitations', [RecitationController::class, 'store']);

Route::get('/register', [UserRegisterController::class, 'register']);
Route::post('/register', [UserRegisterController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);

Route::delete('/logout', [SessionController::class, 'destroy']);
