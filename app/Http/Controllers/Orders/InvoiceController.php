<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Orders\Order;
use App\Models\Orders\OrderItem;
use App\Models\Orders\Billing;
use App\Models\Products\Product;

class InvoiceController extends Controller
{
    public function invoices()
    {
        $user = Auth::user();
        $invoices = Billing::where('user_id', $user->id)->paginate(6);
        $locale = app()->getLocale();
        $translations = getTranslations(['invoices']);

        return Inertia::render('Accounts/Invoices', [
            'invoices' => $invoices,
            'user' => $user,
            'locale' => $locale,
            'translations' => $translations,
        ]);
    }

    public function invoice(Request $request)
    {
        $user = Auth::user();
        $locale = app()->getLocale();
        $translations = getTranslations(['invoices']);
        $invoiceId = request()->route()->parameter('invoiceId');
        $invoiceId = (int) $invoiceId;
        $invoiceDetails = Billing::where('id', $invoiceId)->first();

        $order = Order::where('id', $invoiceDetails->order_id)->first();
        $orderItems = OrderItem::where('order_id', $order->id)->get();

        $invoiceItems = $orderItems->map(function ($item) {
            $product = Product::find($item->product_id);
            return [
                'id' => $item->id,
                'product_id' => $item->product_id,
                'product_name' => $product->name ?? 'N/A',
                'order_id' => $item->order_id,
                'quantity' => $item->quantity,
                'subtotal' => $item->subtotal,
                'total' => $item->total,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

        return Inertia::render('Accounts/Invoice', [
            'invoiceDetails' => $invoiceDetails,
            'locale' => $locale,
            'translations' => $translations,
            'orderItems' => $orderItems,
            'invoiceItems' => $invoiceItems,
            'user' => $user,
        ]);
    }

}
