<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\ChatAuthMiddleware;
use App\Pattern\Fundamental\Delegation\DelegationController;
use App\Pattern\Fundamental\EventChanel\EventChanelController;
use App\Pattern\Fundamental\Interface\InterfaceController;
use App\Pattern\Fundamental\PropertyContainer\PropertyContainerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('main');

Route::get('/patterns-list', function () {
    return view('pattern.pattern-list');
})->name('pattern-list');

Route::prefix('/patterns')->group(function () {
    Route::get('/property-container', PropertyContainerController::class)->name('propertyContainer');
    Route::get('/delegation', DelegationController::class)->name('delegation');
    Route::get('/event-chanel', EventChanelController::class)->name('eventChanel');
    Route::get('/interface', InterfaceController::class)->name('interface');
});

Route::controller(ChatController::class)
    ->prefix('chat')
    ->group(function () {
        Route::get('/messages', 'messages');
        Route::post('/send-message', 'sendMessage');
        Route::get('/', 'index')->name('chat');
    });