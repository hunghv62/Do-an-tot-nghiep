<?php

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('getLogin');
Route::post('/', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('create', [App\Http\Controllers\UserController::class, 'create'])->name('create');
Route::post('store', [App\Http\Controllers\UserController::class, 'store'])->name('store');
Route::get('verify/{id}', [App\Http\Controllers\UserController::class, 'verify'])->name('verify');


Route::middleware('auth')->group(function () {
    Route::get('index', [App\Http\Controllers\UserController::class, 'index'])->name('index');

    Route::prefix('message')->name('message.')->group(function () {
        Route::get('/', [App\Http\Controllers\MessageController::class, 'getMessage'])->name('index');
        Route::post('/store', [App\Http\Controllers\MessageController::class, 'storeMessage'])->name('store');
    });
    Route::prefix('friend')->name('friend.')->group(function () {
        Route::get('/', [App\Http\Controllers\FriendController::class, 'index'])->name('index');
        Route::post('/find_friend', [App\Http\Controllers\FriendController::class, 'search'])->name('find_friend');
        Route::post('/add_friend', [App\Http\Controllers\FriendController::class, 'create'])->name('create');
    });
    Route::post('pusher/auth', [App\Http\Controllers\UserController::class, 'pusherAuth'])->name('pusherAuth');
});
//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//
//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
