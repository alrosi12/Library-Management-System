<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');

Route::resource('books', BookController::class);
Route::resource('members', MemberController::class)->only('index', 'show');
Route::resource('borrowing', BorrowingController::class)->only('store', 'update');
