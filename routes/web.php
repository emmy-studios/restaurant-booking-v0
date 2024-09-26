<?php

use App\Http\Controllers\Core\CoreController;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect(app()->getLocale());
});

Route::prefix('{locale}')
    ->middleware(Localization::class)
    ->group(function() {
        
        // Core Routes
        Route::get('/', function() {
            return Inertia::render('Home');
        }); 

        Route::get('/about-us', function() {
            return Inertia::render('About', [
                'name' => 'Jesucristo',
                'last_name' => 'de Nazareth'
            ]);
        });
    });