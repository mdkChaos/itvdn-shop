<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::with(['categories'])->paginate();
        $trashedProducts = Product::onlyTrashed()->get();
        return view('admin.products.index', compact('products', 'trashedProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();
        $categories = $categories->pluck('name', 'id');
        $productCategories = [];

        return view('admin.products.create', compact('categories', 'productCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductFormRequest $request): RedirectResponse
    {
        $request->merge(['slug' => Str::slug($request->input('title'))]);
        $product = Product::create($request->all());
        $categoryIds = $request->input('categories', []);
        $product->categories()->attach($categoryIds);

        return redirect()->route('admin.products.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        $categories = Category::all();
        $categories = $categories->pluck('name', 'id');
        $productCategories = $product->categories()->pluck('id')->toArray();

        return view('admin.products.edit', compact('product', 'categories', 'productCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductFormRequest $request, Product $product): RedirectResponse
    {
        $request->merge(['slug' => Str::slug($request->input('title'))]);
        $product->update($request->all());
        $categoryIds = $request->input('categories', []);
        $product->categories()->sync($categoryIds);

        return redirect()->route('admin.products.index');
    }

    /**
     * Delete the specified resource from storage.
     */
    public function delete(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index');
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(int $id): RedirectResponse
    {
        $product = Product::onlyTrashed()->whereId($id)->first();
        Gate::authorize('restore', $product);
        $product->restore();

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $product = Product::onlyTrashed()->whereId($id)->first();
        Gate::authorize('forceDelete', $product);
        $product->forceDelete();

        return redirect()->route('admin.products.index');
    }
}
