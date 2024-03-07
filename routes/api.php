<?php

use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user/register', [AuthController::class,'register'])->name('user.register');
Route::post('manager/register', [AuthController::class,'register'])->name('manager.register');
Route::post('itdesk/register', [AuthController::class,'register'])->name('itdesk.register');
Route::post('login', [AuthController::class,'login'])->name('login');

Route::prefix('category')->middleware('auth:sanctum')->group(function () {
    Route::post('create', [CategoryController::class,'create'])->name('category.create');
    Route::get('list', [CategoryController::class,'index'])->name('category.index');
    Route::post('update/{id}', [CategoryController::class,'update'])->name('category.update');
    Route::post('delete/{id}', [CategoryController::class,'delete'])->name('category.delete');
});

Route::prefix('subcategory')->middleware('auth:sanctum')->group(function () {
    Route::post('create',  [SubCategoryController::class,'create'])->name('subcategory.create');
    Route::post('update/{id}', [SubCategoryController::class,'update'])->name('category.update');
    Route::post('delete/{id}', [SubCategoryController::class,'delete'])->name('category.delete');
});

