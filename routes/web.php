<?php

use App\Http\Controllers\RecitationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('player.index');
});

Route::get('/recitations', [RecitationController::class, 'index']);
Route::get('/recitations/upload', [RecitationController::class, 'create']);
Route::post('/recitations', [RecitationController::class, 'store']);
