<?php

use App\Pattern\Delegation\DelegationController;
use App\Pattern\EventChanel\EventChanelController;
use App\Pattern\PropertyContainer\PropertyContainerController;
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
});