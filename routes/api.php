<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\ChatController;
use App\Pattern\Singleton\SingletonController;
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
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(PostController::class)
    ->prefix('posts')
    ->middleware('auth:api')
    ->group(function () {
        Route::post('/', 'create')->name('posts.create');
        Route::get('/', 'list')->withoutMiddleware('auth:api')->name('posts.list');
        Route::patch('/{postId}', 'update')->name('posts.update');
        Route::delete('/{postId}', 'delete')->name('posts.delete');
        Route::get('/{postId}', 'view')->name('posts.view');
    });

Route::controller(MediaController::class)
    ->prefix('media')
    ->middleware('auth:api')
    ->group(function () {
        Route::post('/upload', 'upload')->name('media.upload');
    });

Route::controller(SingletonController::class)
    ->prefix('test-pattern')
    ->middleware('auth:api')
    ->group(function () {
        Route::post('/singleton-order', 'buyItem');
        Route::post('/register-user', 'register');
    });