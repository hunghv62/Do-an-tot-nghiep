<?php


Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('index');
Route::post('/', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
//Route::get('index', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::get('create', [App\Http\Controllers\UserController::class, 'create'])->name('create');
Route::post('store', [App\Http\Controllers\UserController::class, 'store'])->name('store');

//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//
//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
