<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('posts/ajax-like-dislike', [PostController::class, 'ajaxLike'])->name('posts.ajax.like.dislike');
});