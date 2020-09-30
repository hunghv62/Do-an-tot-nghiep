<?php


Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('getLogin');
Route::post('/', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('create', [App\Http\Controllers\UserController::class, 'create'])->name('create');
Route::post('store', [App\Http\Controllers\UserController::class, 'store'])->name('store');
Route::get('verify/{id}', [App\Http\Controllers\UserController::class, 'verify'])->name('verify');


Route::middleware('auth')->group(function () {
    Route::get('index', [App\Http\Controllers\UserController::class, 'index'])->name('index');

    Route::get('chat', [App\Http\Controllers\ChatsController::class, 'index']);
    Route::get('messages', [App\Http\Controllers\ChatsController::class, 'fetchMessages']);
    Route::post('messages', [App\Http\Controllers\ChatsController::class, 'sendMessage']);
});
//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//
//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
