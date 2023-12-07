<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(PostController::class)
    ->prefix('posts')
    ->middleware('auth:api')
    ->group(function () {
        Route::post('/', 'create');
        Route::get('/', 'list');
        Route::patch('/{postId}', 'update');
        Route::delete('/{postId}', 'delete');
        Route::get('/{postId}', 'view');
    });
