<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;

// Welcome/home page
Route::get('/', function () {
    $articles = \App\Models\Article::where('status', 'published')->orderBy('created_at', 'desc')->limit(6)->get();
    return view('welcome', compact('articles'));
})->name('home');

// Article Routes
Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/create', [ArticleController::class, 'create'])->name('create');
    Route::post('/', [ArticleController::class, 'store'])->name('store');
    Route::get('/{id}', [ArticleController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [ArticleController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ArticleController::class, 'update'])->name('update');
    Route::delete('/{id}', [ArticleController::class, 'destroy'])->name('destroy');
});

// Category Routes
Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
});
