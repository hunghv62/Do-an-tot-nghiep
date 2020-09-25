<?php


Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('index');
Route::post('/', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//
//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
