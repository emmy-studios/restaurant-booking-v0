<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\User;
use App\Models\UserNotification;

class DashboardController extends Controller
{

    public function dashboard()
    {
        return Inertia::render('Accounts/Dashboard');
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
        return Inertia::render('Accounts/EditProfile');
    }

    public function notifications()
    {
        $user = Auth::user();
        $notifications = UserNotification::where('user_id', $user->id)->get();

        return Inertia::render('Accounts/Notifications', [
            'notifications' => $notifications,
        ]);
    }

    public function notification(Request $request)
    {
        $notificationId = request()->route()->parameter('notificationId');
        $notificationId = (int) $notificationId;
        $notificationDetails = UserNotification::where('id', $notificationId)->firstOrFail();
        $notificationDetails->is_read = true;
        $notificationDetails->save();

        return Inertia::render('Accounts/Notification', [
            'notificationDetails' => $notificationDetails,
        ]);
    }

    public function analytics()
    {
        return Inertia::render('Accounts/Analytics');
    }

    public function invoices()
    {
        return Inertia::render('Accounts/Invoices');
    }

    public function reservations()
    {
        return Inertia::render('Accounts/Reservations');
    }

}
