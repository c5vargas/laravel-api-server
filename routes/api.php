<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('auth')->group(function () {
    Route::get('check', [AuthController::class, 'getAuth'])->name('auth.check');
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('update', [AuthController::class, 'updateUserProfile']);
    Route::post('password/forget', [AuthController::class, 'forgetPassword'])->name('auth.forget-password');
    Route::post('password/reset', [AuthController::class, 'resetPassword'])->name('auth.reset-password');
});

Route::prefix('users')->group(function () {
    Route::get('', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);

    Route::middleware('auth:api')->group(function () {
        Route::post('', [UserController::class, 'create']);
        Route::post('/update', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'delete']);
    });
});

Route::prefix('products')->group(function () {
    Route::get('', [ProductController::class, 'index']);
    Route::get('/random', [ProductController::class, 'getRandom']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::get('/slug/{slug}', [ProductController::class, 'getBySlug']);
    Route::get('/cat/{cat}', [ProductController::class, 'getByCat']);
    Route::get('/search/{slug}', [ProductController::class, 'search']);

    Route::post('', [ProductController::class, 'create']); //TODO move to auth middleware
    Route::middleware('auth:api')->group(function () {
        Route::post('/update', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'delete']);
    });
});

Route::prefix('categories')->group(function () {
    Route::get('', [CategoryController::class, 'index']);
    Route::get('/featured', [CategoryController::class, 'getFeatured']);
    Route::get('/{id}', [CategoryController::class, 'show']);
    Route::get('/slug/{slug}', [CategoryController::class, 'getBySlug']);
});

Route::prefix('brands')->group(function () {
    Route::get('', [BrandController::class, 'index']);
    Route::get('/{id}', [BrandController::class, 'show']);
});


