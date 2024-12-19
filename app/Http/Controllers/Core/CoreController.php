<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Products\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Shoppingcarts\Shoppingcart;

class CoreController extends Controller
{

    public function index()
    {
        // Translation Helper
        $translations = getTranslations(['home']);
        // Get Current Language
        $locale = app()->getLocale();
        // Products
        $products = Product::with('prices')->latest()->take(6)->get();
        // Shoppingcart
        //$user = Auth::user();
        //$shoppingcart = $user ? Shoppingcart::where('user_id', $user->id) : [];

        // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        $user = Auth::user();
        $shoppingcart = $user ? Shoppingcart::with('products')->where('user_id', $user->id)->first() : null;

        $shoppingcartProducts = $shoppingcart ? $shoppingcart->products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'image_url' => $product->image_url,
            ];
        })->toArray()
        : [];

        return Inertia::render('Home', [
            'translations' => $translations,
            'locale' => $locale,
            'products' => $products,
            'user' => $user,
            'shoppingcartProducts' => $shoppingcartProducts,
        ]);
    }

    public function products()
    {
        $products = Product::all();
        $test = 'test';

        return Inertia::render('Products',
            [
                'products' => $products,
                'test' => $test,
            ]);
    }

    public function teams()
    {
        return Inertia::render('Teams');
    }
}
