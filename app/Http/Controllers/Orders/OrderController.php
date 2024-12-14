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
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();

        return Inertia::render('Orders',
            [
                'orders' => $orders,
            ]);
    }

    public function order(Request $request)
    {
        $user = Auth::user();
        $lastOrderCreated = Order::where('user_id', $user->id)->latest()->first();
        $shoppingcartProducts = Shoppingcart::where('user_id', $user->id)
            ->with(['products.prices.currency'])
            ->first();

        // Get Products Discounts
        $productDiscounts = Discount::with('products')->get();

        return Inertia::render('Order',
            [
                'lastOrderCreated' => $lastOrderCreated,
                'user' => $user,
                'shoppingcartProducts' => $shoppingcartProducts,
                'productDiscounts' => $productDiscounts,
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

    public function addOrderItem(Request $request)
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->latest()->first();
        $order->order_status = 'Processing';
        $order->save();

        return redirect()->route('order');
    }

}
