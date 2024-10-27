<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CoreController extends Controller
{

    public function index()
    {

        // Translation Helper
        $translations = getTranslations(['home']);

        // Get Current Language
        $locale = app()->getLocale();

        return Inertia::render('Home', [
            'translations' => $translations,
            'locale' => $locale,
        ]);
    }

    public function products()
    {
        return Inertia::render('Products');
    }

    public function teams()
    {
        return Inertia::render('Teams');
    }
}
