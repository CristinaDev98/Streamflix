<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\StreamflixController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::post('newsletter', NewsletterController::class);

Route::middleware('guest')->group(function () {
    Route::get('login', [SessionsController::class, 'create'])->name('login');
    Route::post('login', [SessionsController::class, 'store']);
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [SessionsController::class, 'destroy'])->name('logout');
    Route::get('/movies', [StreamflixController::class, 'index'])->name('streamflix.index');
    Route::get('/movie/{watch}', [StreamflixController::class, 'show'])->name('movies.show');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('login/google', 'redirectToProvider');
    Route::get('login/google/callback', 'handleProviderCallback');
});

Route::middleware('can:admin')->group(function () {
    Route::view('admin', 'livewire.admin-controller');
});
