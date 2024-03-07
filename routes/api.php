<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user/register', [AuthController::class,'register'])->name('user.register');
Route::post('manager/register', [AuthController::class,'register'])->name('manager.register');
Route::post('itdesk/register', [AuthController::class,'register'])->name('itdesk.register');
Route::post('login', [AuthController::class,'login'])->name('login');;