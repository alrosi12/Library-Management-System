<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('dashboard.dashboard');
// });

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// // Route::get('/books/{id}/edit', [BookController::class, 'edit']);
Route::resource('books', BookController::class);

// Route::group('/')