<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\User;

class DashboardController extends Controller
{

    public function dashboard()
    {
        //
    }

    public function profile()
    {

        // Get User Info
        $user = Auth::user();

        return Inertia::render('Accounts/Profile', [
            'user' => $user,
        ]);
    }

    public function editProfile()
    {
        //
    }

}
