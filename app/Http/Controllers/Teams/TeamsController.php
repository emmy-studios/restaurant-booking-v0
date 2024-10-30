<?php

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeamsController extends Controller
{

    public function teams()
    {

        // Get Current Locale
        $locale = app()->getLocale();

        return Inertia::render("Teams", [
            "locale" => $locale,
        ]);

    }

}
