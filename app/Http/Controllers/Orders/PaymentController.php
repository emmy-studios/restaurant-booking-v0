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
            'userOrderCode' => 'required|string|exists:orders,order_code'
        ]);

        $payment = new Billing();
        $user = Auth::user();
        $orderCode = $validated['userOrderCode'];
        $order = Order::where('order_code', $orderCode)->first();
        $order->order_status = 'Completed';
        $order->save();
        return redirect()->route('order');
    }

}
