<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\User;
use App\Models\Orders\Order;

class AuthenticationController extends Controller
{
    public function signup()
    {
        // Get Current Language
        $locale = app()->getLocale();

        return Inertia::render("SignUp", [
            "locale" => $locale,
        ]);
    }

    public function register(Request $request)
    {

        // Get Current Language
        $locale = app()->getLocale();

        // Create User
        $user = User::create($request->validate([
          "name" => ["required", "max:50"],
          "password" => ["required", "max:50"],
          "email" => ["required", "max:50", "email"],
        ]));

        // Login
        Auth::login($user);

        // Redirect to Dashboard
        return to_route("dashboard");

    }

    public function login()
    {

        // Get Current Locale
        $locale = app()->getLocale();

        return Inertia::render("LogIn", [
            "locale" => $locale,
        ]);
    }

    public function authenticate(Request $request)
    {

        // Validate User Data
        $credentials = $request->validate([
            "name" => ["required", "string", "max:255", "min:4"],
            "password" => ["required"],
        ]);

        // Autentication Attempt
        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return to_route("dashboard");
        }
        // Return Error
        return back()->withErrors([
            "name" => "Las credenciales proporcionadas no coinciden con nuestros registros.",
        ])->onlyInput("name");

    }

    public function dashboard()
    {

        // Get Current Locale
        $locale = app()->getLocale();

        // Get User Information
        $user = Auth::user();
        $orders = $user->orders()->latest()->get();

        return Inertia::render("Dashboard", [
            "user" => $user,
            "locale" => $locale,
            "orders" => $orders,
        ]);
    }

    public function edit()
    {

        //Get Current Locale
        $locale = app()->getLocale();

        return Inertia::render("EditProfile", [
            "locale" => $locale,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route("home");

    }

}
