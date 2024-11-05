<?php

use App\Http\Controllers\Core\CoreController;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Accounts\AuthenticationController;
use App\Http\Controllers\Teams\TeamsController;
use App\Http\Controllers\Accounts\DashboardController;

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
        Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
        Route::post('/register', [AuthenticationController::class, 'register'])->name('register');
        Route::post('/authenticate', [AuthenticationController::class, 'authenticate'])->name('authenticate');
        Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
       	// Dashboard Routes
       	Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
        Route::get('/edit-profile', [DashboardController::class, 'editProfile'])->name('edit.profile');
        // Teams
        Route::get('/teams', [TeamsController::class, 'teams'])->name('teams');
    });
