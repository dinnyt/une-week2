<?php

use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function() {
    Route::resource('posts', PostController::class);
    Route::resource('photos', PhotoController::class);
    Route::get('/home', [PostController::class, 'index'])->name('home');
});

Route::get('/test', [PostController::class, 'test']);

Auth::routes();


