<?php

use App\Http\Controllers\Core\CoreController;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Accounts\AuthenticationController;
use App\Http\Controllers\Teams\TeamsController;

Route::get('/', function () {
    return redirect(app()->getLocale());
});

Route::prefix('{locale}')
    ->middleware(Localization::class)
    ->group(function() {

        // Core Routes
        Route::get('/', [CoreController::class, 'index'])->name('home');
        Route::get('/products', [CoreController::class, 'products'])->name('products');
        // Authentication Routes
        Route::get('/signup', [AuthenticationController::class, 'signup'])->name('signup');
        Route::post('/register', [AuthenticationController::class, 'register'])->name('register');
        Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
        Route::post('/authenticate', [AuthenticationController::class, 'authenticate'])->name('authenticate');
        Route::get('/dashboard', [AuthenticationController::class, 'dashboard'])->name('dashboard');
        Route::get('/edit-profile', [AuthenticationController::class, 'edit'])->name('edit.profile');
        Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
        // Teams
        Route::get('/teams', [TeamsController::class, 'teams'])->name('teams');
    });
