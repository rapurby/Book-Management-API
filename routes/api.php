<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;

Route::prefix('books')->group(function () {
    Route::get('/', [BookController::class, 'index']);        // List books with pagination
    Route::post('/', [BookController::class, 'store']);       // Create new book
    Route::put('/{id}', [BookController::class, 'update']);   // Update book description
    Route::delete('/{id}', [BookController::class, 'destroy']); // Delete book
    Route::get('/search', [BookController::class, 'search']); // Search books
});