<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CoreController extends Controller
{
    
    public function index()
    {
        return Inertia::render('Home');
    }

    public function teams()
    {
        return Inertia::render('Teams');
    }
}
