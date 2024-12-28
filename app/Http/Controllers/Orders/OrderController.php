<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Orders\Order;
use App\Models\Orders\OrderItem;
use App\Models\Shoppingcarts\Shoppingcart;
use App\Models\Discounts\Discount;
use App\Enums\PaymentMethod;
use App\Enums\Countries;
use App\Enums\CountryCode;

class OrderController extends Controller
{

    public function index()
    {
        $translations = [
            'orders' => __('orders.orders'),
        ];
        $locale = app()->getLocale();
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $totalOrders = Order::where('user_id', $user->id)->get()->count();
        $pendingOrders = Order::where('user_id', $user->id)->get()->where('order_status', 'Pending')->count();
        $deliveredOrders = Order::where('user_id', $user->id)->get()->where('order_status', 'Delivered')->count();

        return Inertia::render('Orders',
            [
                'orders' => $orders,
                'totalOrders' => $totalOrders,
                'pendingOrders' => $pendingOrders,
                'deliveredOrders' => $deliveredOrders,
                'translations' => $translations,
                'locale' => $locale,
            ]);
    }

    public function order(Request $request)
    {
        $user = Auth::user();

        if ($request->filled('orderCode')) {
            $orderCode = $request->orderCode;
            $lastOrderCreated = Order::where('order_code', $orderCode)->first();
        } else {
            $lastOrderCreated = Order::where('user_id', $user->id)->latest()->first();
        }

        $shoppingcartProducts = Shoppingcart::where('user_id', $user->id)
            ->with(['products.prices.currency'])
            ->first();
        $locale = app()->getLocale();
        // Get Products Discounts
        $productDiscounts = Discount::with('products')->get();
        // Get Enums
        $paymentMethods = PaymentMethod::getValues();
        $countries = Countries::getValues();
        $countryCodes = CountryCode::getValues();

        return Inertia::render('Order',
            [
                'user' => $user,
                'shoppingcartProducts' => $shoppingcartProducts,
                'productDiscounts' => $productDiscounts,
                'locale' => $locale,
                'lastOrderCreated' => $lastOrderCreated,
                'paymentMethods' => $paymentMethods,
                'countries' => $countries,
                'countryCodes' => $countryCodes,
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
        // RECEIVE DATA
        $orderData = $request->all();
        $currency = $orderData['orderCurrency'];
        $orderSubtotal = $orderData['orderSubtotal'];
        $orderTotal = $orderData['orderTotal'];
        $orderItemsData = $orderData['orderItems'];

        $user = Auth::user();
        $order = Order::where('order_code', $request->orderCode)->first();

        // UPDATE ORDER DATA
        // Order Subtotal
        $filteredSubtotal = null;
        foreach ($orderSubtotal as $subtotal) {
            if ($subtotal['currency'] === $currency) {
                $filteredSubtotal = $subtotal['amount'];
                break;
            }
        }
        // Order Total
        $filteredTotal = null;
        foreach ($orderTotal as $total) {
            if ($total['currency'] === $currency) {
                $filteredTotal = $total['amount'];
                break;
            }
        }

        $order->order_status = 'Processing';
        $order->subtotal = $filteredSubtotal;
        $order->total = $filteredTotal;
        $order->currency_symbol = $currency;
        $order->save();

        // CREATE ORDERITEMS
        $orderId = $order->id;

        foreach ($orderItemsData as $itemData) {

            $subtotal = collect($itemData['itemSubtotal'])->firstWhere('currency', $currency)['number'] ?? 0;
            $total = collect($itemData['itemTotal'])->firstWhere('currency', $currency)['number'] ?? 0;

            OrderItem::create([
                'order_id' => $orderId,
                'product_id' => $itemData['id'],
                'quantity' => $itemData['quantity'],
                'subtotal' => $subtotal,
                'total' => $total,
            ]);
        }

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
