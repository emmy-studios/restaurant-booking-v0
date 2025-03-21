<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Orders\Order;
use App\Models\Orders\OrderItem;
use App\Models\UserNotification;
use App\Models\Reservations\Reservation;
use App\Enums\Countries;
use App\Enums\CountryCode;
use App\Enums\Gender;

class DashboardController extends Controller
{

    public function dashboard()
    {
        $user = Auth::user();
        $lastOrderMade = Order::where('user_id', $user->id)->latest()->first();
        $orderItems = OrderItem::where('order_id', $lastOrderMade->id)->with('product')->get();

        $totalOrders = Order::where('user_id', $user->id)->get()->count();
        $totalNotifications = UserNotification::where('user_id', $user->id)->get()->count();
        $totalReservations = Reservation::where('user_id', $user->id)->get()->count();

        $translations = getTranslations(['dashboard']);
        $locale = app()->getLocale();

        return Inertia::render('Accounts/Dashboard', [
            'user' => $user,
            'locale' => $locale,
            'translations' => $translations,
            'lastOrderMade' => $lastOrderMade,
            'orderItems' => $orderItems,
            'totalOrders' => $totalOrders,
            'totalNotifications' => $totalNotifications,
            'totalReservations' => $totalReservations,
        ]);
    }

    public function profile()
    {
        $user = Auth::user();
        $translations = getTranslations(['profile']);
        $locale = app()->getLocale();

        return Inertia::render('Accounts/Profile', [
            'user' => $user,
            'translations' => $translations,
            'locale' => $locale,
        ]);
    }

    public function editProfile()
    {
        $user = Auth::user();
        $locale = app()->getLocale();
        $countries = Countries::getValues();
        $countryCodes = CountryCode::getValues();
        $genderOptions = Gender::getValues();

        return Inertia::render('Accounts/EditProfile', [
            'user' => $user,
            'locale' => $locale,
            'countries' => $countries,
            'countryCodes' => $countryCodes,
            'genderOptions' => $genderOptions,
        ]);
    }

    public function editProfilePost(Request $request)
    {
        $user = Auth::user();
        // Validate Rules
        $rules = [
            'username' => 'required|string|max:255|min:6',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'identificationNumber' => 'string|max:255',
            'email' => 'required|email',
            'birth' => 'date',
            'gender' => 'string',
            'phoneCode' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:255',
            'postalCode' => 'string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string',
        ];

        if ($request->hasFile('imageUrl')) {
            $rules['imageUrl'] = 'image|mimes:jpeg,png,jpg|max:2048';
        }

        $validated = $request->validate($rules);

        if ($request->hasFile('imageUrl')) {
            $path = $request->file('imageUrl')->storeAs('users-image', $user->id . '.' . $request->file('imageUrl')->getClientOriginalExtension(), 'public');
            $user->image_url = $path;
        }

        // Update User
        $user->name = $validated['username'];
        $user->first_name = $validated['firstName'];
        $user->last_name = $validated['lastName'];
        $user->identification_number = $validated['identificationNumber'];
        $user->email = $validated['email'];
        $user->birth = $validated['birth'];
        $user->gender = $validated['gender'];
        $user->country_code = $validated['phoneCode'];
        $user->phone_number = $validated['phoneNumber'];
        $user->postal_code = $validated['postalCode'];
        $user->city = $validated['city'];
        $user->country = $validated['country'];
        $user->address = $validated['address'];
        $user->save();

        return redirect()->route('profile');
    }

    public function notifications()
    {
        $user = Auth::user();
        $userNotifications = UserNotification::where('user_id', $user->id)->get();

        $locale = app()->getLocale();
        $translations = getTranslations(['notifications']);

        return Inertia::render('Accounts/Notifications', [
            'userNotifications' => $userNotifications,
            'user' => $user,
            'locale' => $locale,
            'translations' => $translations,
        ]);
    }

    public function notification(Request $request)
    {
        $notificationId = request()->route()->parameter('notificationId');
        $notificationId = (int) $notificationId;
        $notificationDetails = UserNotification::where('id', $notificationId)->firstOrFail();
        $notificationDetails->is_read = true;
        $notificationDetails->save();

        $locale = app()->getLocale();
        $translations = getTranslations(['notifications']);

        return Inertia::render('Accounts/Notification', [
            'notificationDetails' => $notificationDetails,
            'locale' => $locale,
            'translations' => $translations,
        ]);
    }

    public function analytics()
    {
        return Inertia::render('Accounts/Analytics');
    }

    public function reservations()
    {
        return Inertia::render('Accounts/Reservations');
    }

}
