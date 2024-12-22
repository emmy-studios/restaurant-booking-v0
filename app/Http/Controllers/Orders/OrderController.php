<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Orders\Order;
use App\Models\Shoppingcarts\Shoppingcart;
use App\Models\Discounts\Discount;

class OrderController extends Controller
{

    public function index()
    {
        $translations = [
            'orders' => __('orders.orders'),
        ];
        $locale = app()->getLocale();
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();

        return Inertia::render('Orders',
            [
                'orders' => $orders,
                'translations' => $translations,
                'locale' => $locale,
            ]);
    }

    public function order(Request $request)
    {
        $user = Auth::user();
        $lastOrderCreated = Order::where('user_id', $user->id)->latest()->first();
        $shoppingcartProducts = Shoppingcart::where('user_id', $user->id)
            ->with(['products.prices.currency'])
            ->first();
        $locale = app()->getLocale();
        // Get Products Discounts
        $productDiscounts = Discount::with('products')->get();

        return Inertia::render('Order',
            [
                'lastOrderCreated' => $lastOrderCreated,
                'user' => $user,
                'shoppingcartProducts' => $shoppingcartProducts,
                'productDiscounts' => $productDiscounts,
                'locale' => $locale,
            ]);
    }

    public function createOrder(Request $request)
    {
        $user = Auth::user();
        $order = new Order();
        // Generate Order Code
        $username = $user->name;
        $timestamp = now()->format('YmdHis');
        $order_code =  $username . $timestamp;
        // Store Data
        $order->user_id = $user->id;
        $order->order_code = $order_code;
        $order->currency_symbol = "USD $";
        $order->subtotal = 0;
        $order->total = 0;
        $order->order_status = 'Pending';
        $order->save();

        return redirect()->route('order');
    }

    public function addOrderItems(Request $request)
    {
        $user = Auth::user();
        $order = Order::where('order_code', $request->orderCode)->first();
        $order->order_status = 'Processing';
        $order->subtotal = $request->orderSubtotal;
        $order->total = $request->orderTotal;
        $order->currency_symbol = $request->orderCurrency;
        $order->save();

        return redirect()->route('order');
    }

    public function updateCustomerAddress(Request $request)
    {
        $user = Auth::user();
        // Validate Data
        $validated = $request->validate([
            'userCity' => 'required|string|max:255',
            'userCountry' => 'required|string|max:255',
            'userAddress' => 'required|string|max:500',
            'userOrderCode' => 'required|string|exists:orders,order_code',
        ]);
        // Updated Data
        $user->city = $validated['userCity'];
        $user->country = $validated['userCountry'];
        $user->address = $validated['userAddress'];
        $orderCode = $validated['userOrderCode'];
        $user->save();

        $order = Order::where('order_code', $orderCode)->first();
        $order->order_status = 'Awaiting Payment';
        $order->save();

        return redirect()->route('order');
    }

}
