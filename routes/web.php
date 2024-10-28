<?php

use App\Http\Controllers\Core\CoreController;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Accounts\AuthenticationController;

Route::get('/', function () {
    return redirect(app()->getLocale());
});

Route::prefix('{locale}')
    ->middleware(Localization::class)
    ->group(function() {

        // Core Routes
        Route::get('/', [CoreController::class, 'index'])->name('home');
        Route::get('/teams', [CoreController::class, 'teams'])->name('teams');
        Route::get('/products', [CoreController::class, 'products'])->name('products');
        // Authentication Routes
        Route::get('/signup', [AuthenticationController::class, 'signup'])->name('signup');
        Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
        Route::get('/dashboard', [AuthenticationController::class, 'dashboard'])->name('dashboard');
    });
