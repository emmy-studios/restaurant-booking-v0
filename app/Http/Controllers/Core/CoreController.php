<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Products\Product;

class CoreController extends Controller
{

    public function index()
    {
        // Translation Helper
        $translations = getTranslations(['home']);

        // Get Current Language
        $locale = app()->getLocale();
        $products = Product::with('prices')->latest()->take(6)->get();

        return Inertia::render('Home', [
            'translations' => $translations,
            'locale' => $locale,
            'products' => $products,
        ]);
    }

    public function products()
    {
        $products = Product::all();
        $test = 'test';

        return Inertia::render('Products',
            [
                'products' => $products,
                'test' => $test,
            ]);
    }

    public function teams()
    {
        return Inertia::render('Teams');
    }
}
