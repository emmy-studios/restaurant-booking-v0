<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;


class AuthenticationController extends Controller
{
    public function signup()
    {
        return Inertia::render("SignUp");
    }

    public function login()
    {
        return Inertia::render("LogIn");
    }

    public function dashboard()
    {
        return Inertia::render("Dashboard");
    }
}
