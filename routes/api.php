<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PatternController;
use App\Http\Controllers\Api\PostController;
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
        Route::get('/', 'list')->withoutMiddleware('auth:api');
        Route::patch('/{postId}', 'update');
        Route::delete('/{postId}', 'delete');
        Route::get('/{postId}', 'view');
    });

Route::controller(PatternController::class)
    ->prefix('test-pattern')
    ->middleware('auth:api')
    ->group(function () {
        Route::post('/singleton-order', 'buyItem');
        Route::post('/register-user', 'register');
    });