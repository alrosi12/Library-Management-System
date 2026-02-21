<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('dashboard.dashboard');
// });

Route::prefix('dashboard')
    // ->name('dashboard.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::resource('books', BookController::class);
    });
// Route::group('/')