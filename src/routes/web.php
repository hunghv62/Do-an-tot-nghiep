<?php
use App\Events\MyEvent;

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('getLogin');
Route::post('/', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('create', [App\Http\Controllers\UserController::class, 'create'])->name('create');
Route::post('store', [App\Http\Controllers\UserController::class, 'store'])->name('store');
Route::get('verify/{id}', [App\Http\Controllers\UserController::class, 'verify'])->name('verify');

Route::get('alert', function () {
   return view('alert');
});
Route::get('text', function () {
    event(new MyEvent('hello world'));
//    return view('text');
});
Route::post('text', function () {
    event(new MyEvent('hello world'));
});
Route::middleware('auth')->group(function () {
    Route::get('index', [App\Http\Controllers\UserController::class, 'index'])->name('index');
});
//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//
//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
