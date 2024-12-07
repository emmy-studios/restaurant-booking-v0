<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Products\Product;
use App\Models\Products\Category;

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
        /*
        $searchTerm = request('searchTerm');
        $tag = request('tagChoose', null);
        */
        // Search by Name
        /*if ($searchTerm !== '') {
            $products = Product::where('name', 'like', '%' . $searchTerm . '%')->get();
        } else {
            $products = Product::all();
        }*/

        // Search by Category Tag
        /*if (!is_null($tag) && $tag !== '') {
             $products = Product::whereHas('categories', function ($query) use ($tag) {
                $query->where('name', $tag);
            })->get();
        }*/

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


        return Inertia::render('Products',
            [
                'products' => $products,
                'locale' => $locale,
                'categories' => $categories,
            ]);
    }

}
