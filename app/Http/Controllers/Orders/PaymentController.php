<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Orders\Billing;
use App\Models\Orders\Order;

class PaymentController extends Controller
{

    public function createPayment(Request $request)
    {
        // Validate Data
        $validated = $request->validate([
            'userOrderCode' => 'required|string|exists:orders,order_code',
            'paymentMethod' => 'required|string',
        ]);

        $payment = new Billing();
        $user = Auth::user();

        $orderCode = $validated['userOrderCode'];
        $paymentMethod = $validated['paymentMethod'];
        $order = Order::where('order_code', $orderCode)->first();
        $order->order_status = 'Completed';
        $order->save();

        $payment->user_id = $user->id;
        $payment->billing_code = 'e22223e23e';
        $payment->order_id = $order->id;
        $payment->status = 'Pending';
        $payment->currency_symbol = $order->currency_symbol;
        $payment->subtotal = $order->subtotal;
        $payment->payment_method = $paymentMethod;
        $payment->total = $order->total;
        $payment->save();

        return redirect()->route('order');
    }

}
