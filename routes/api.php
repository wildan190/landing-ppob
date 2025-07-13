<?php

use App\Http\Controllers\Api\Admin\AdminCategoryController;
use App\Http\Controllers\Api\Admin\AdminPostController;
use App\Http\Controllers\Api\Admin\WebSettingController;
use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('posts', [\App\Http\Controllers\Api\Web\PostController::class, 'index']);

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {

    Route::get('dashboard', [\App\Http\Controllers\Api\Admin\DashboardController::class, 'index']);
    
    // 📂 CATEGORY ROUTES
    Route::get('categories',        [AdminCategoryController::class, 'index']);
    Route::post('categories',       [AdminCategoryController::class, 'store']);
    Route::get('categories/{id}',   [AdminCategoryController::class, 'show']);
    Route::put('categories/{id}',   [AdminCategoryController::class, 'update']);
    Route::delete('categories/{id}',[AdminCategoryController::class, 'destroy']);

    // 📝 POST ROUTES
    Route::get('posts',        [AdminPostController::class, 'index']);
    Route::post('posts',       [AdminPostController::class, 'store']);
    Route::get('posts/{id}',   [AdminPostController::class, 'show']);
    Route::put('posts/{id}',   [AdminPostController::class, 'update']);
    Route::delete('posts/{id}',[AdminPostController::class, 'destroy']);
});

Route::prefix('admin')->prefix('admin')->group(function () {
    Route::get('web-setting', [WebSettingController::class, 'index']);
    Route::post('web-setting', [WebSettingController::class, 'store']);
    Route::put('web-setting/{id}', [WebSettingController::class, 'update']);
});