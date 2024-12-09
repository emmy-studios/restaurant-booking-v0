<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shoppingcarts\Shoppingcart;
use App\Models\Products\Product;

class ShoppingcartController extends Controller
{

    public function addProduct(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $shoppingcart = Shoppingcart::where('user_id', $user->id)->first();
        $shoppingcart->products()->syncWithoutDetaching([$request->product_id]);

        return back()->with('success', 'Product added to cart!');
    }

    public function removeProduct(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $shoppingcart = Shoppingcart::where('user_id', $user->id)->first();

        if ($shoppingcart) {
            $shoppingcart->products()->detach($request->product_id);
            return back()->with('success', 'Product removed from cart!');
        }

        return back()->with('error', 'Cart not found!');
    }

}
