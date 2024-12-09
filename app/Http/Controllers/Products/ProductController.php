<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Products\Product;
use App\Models\Products\Category;
use App\Models\Shoppingcarts\Shoppingcart;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        // Translation Helper
        $translations = getTranslations(['home']);

        // Get Current Language
        $locale = app()->getLocale();

        // Obtén todos los productos, o filtra por categoría si se pasa un parámetro 'category_id'
        $categories = Category::all();

        $products = Product::paginate(2);

        // Filters Here -----------------------------------------------------------------
        $searchTerm = $request->input('searchTerm', '');
        $tag = $request->input('tagChoose', null);

        $productsQuery = Product::query();

        if (!empty($searchTerm)) {
            $productsQuery->where('name', 'like', '%' . $searchTerm . '%');
        }

        if (!is_null($tag) && $tag !== '') {
            $productsQuery->whereHas('categories', function ($query) use ($tag) {
                $query->where('name', $tag);
            });
        }

        $products = $productsQuery->paginate(2);

        // Shoppingcart ++++++++++++++++++++++++++++++++++++++++++++++
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

        return Inertia::render('Products',
            [
                'products' => $products,
                'locale' => $locale,
                'categories' => $categories,
                'shoppingcartProducts' => $shoppingcartProducts,
            ]);
    }

}
