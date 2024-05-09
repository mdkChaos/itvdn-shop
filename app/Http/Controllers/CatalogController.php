<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class CatalogController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(12);

        return view('catalog.index', compact('products'));
    }

    /**
     * @param string $slug
     * @return View
     */
    public function show(string $slug): View
    {
        $product = Product::where('slug', $slug)->first();

        return view('catalog.product', compact('product'));
    }
}
