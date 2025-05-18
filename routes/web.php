<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageContoller;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Route::get('/', [HomeController::class, 'index']);
// Route::get('/view-page', [PageContoller::class, 'viewpage']);

Route::get('/', [PostController::class, 'index']);
Route::get('/create', [PostController::class, 'createPost']);
Route::post('/submit-post', [PostController::class, 'submitPost']);

Route::put('/posts/{id}', [PostController::class, 'updatePost'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

