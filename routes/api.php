<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->middleware('auth:sanctum')->group(function () {
    Route::get('list', [AuthController::class, 'index'])->name('user.list');
    Route::post('logout', [AuthController::class,'logout'])->name('user.logout');
});

Route::middleware('guest:sanctum')->group(function () {
    Route::post('user/register', [AuthController::class, 'register'])->name('user.register');
    Route::post('manager/register', [AuthController::class, 'register'])->name('manager.register');
    Route::post('itdesk/register', [AuthController::class, 'register'])->name('itdesk.register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});
Route::prefix('category')->middleware('auth:sanctum')->group(function () {
    Route::post('create', [CategoryController::class, 'create'])->name('category.create');
    Route::get('list', [CategoryController::class, 'index'])->name('category.index');
    Route::post('update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::post('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
});

Route::prefix('subcategory')->middleware('auth:sanctum')->group(function () {
    Route::post('create', [SubCategoryController::class, 'create'])->name('subcategory.create');
    Route::post('update/{id}', [SubCategoryController::class, 'update'])->name('category.update');
    Route::post('delete/{id}', [SubCategoryController::class, 'delete'])->name('category.delete');
});

Route::prefix('ticket')->middleware('auth:sanctum')->group(function () {
    Route::post('create', [TicketController::class, 'create'])->name('ticket.create');
    Route::get('list', [TicketController::class, 'index']);
    Route::post('update/{id}', [TicketController::class, 'update'])->name('ticket.update');
    Route::post('delete/{id}', [SubCategoryController::class, 'delete'])->name('category.delete');
});

Route::prefix('branch')->middleware('auth:sanctum')->group(function () {
    Route::post('create', [BranchController::class, 'create'])->name('branch.create');
    Route::get('list', [BranchController::class, 'index']);
    Route::post('update/{id}', [BranchController::class, 'update'])->name('ticket.update');
    Route::post('delete/{id}', [BranchController::class, 'delete'])->name('category.delete');
});
