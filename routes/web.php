<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::prefix('posts')->group(function() {
    Route::get('/', [PostController::class, 'listPost'])->name('posts.index');
    Route::get('show/{id}', [PostController::class, 'singlePost'])->name('posts.show');
});

Route::get('/posts/create', function () {
    return view('posts.create');
})->name('posts.create');

Route::get('/posts/edit', function () {
    return view('posts.edit');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
