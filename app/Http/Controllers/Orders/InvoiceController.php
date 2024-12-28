<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Orders\Billing;

class InvoiceController extends Controller
{
    public function invoices()
    {
        $user = Auth::user();
        $invoices = Billing::where('user_id', $user->id)->paginate(6);

        return Inertia::render('Accounts/Invoices', [
            'invoices' => $invoices,
            'user' => $user,
        ]);
    }
}
