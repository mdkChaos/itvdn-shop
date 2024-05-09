<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $products = Product::orderBy('created_at', 'desc')->take(12)->get();

        return view('welcome', compact('products'));
    }
}
