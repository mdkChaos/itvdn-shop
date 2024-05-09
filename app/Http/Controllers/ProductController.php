<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $products = Product::with(['categories'])->paginate();
        $trashedProducts = Product::onlyTrashed()->get();

        return view('admin.products.index', compact('products', 'trashedProducts'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $categories = Category::all();
        $categories = $categories->pluck('name', 'id');
        $productCategories = [];

        return view('admin.products.create', compact('categories', 'productCategories'));
    }

    /**
     * @param ProductFormRequest $request
     * @return RedirectResponse
     */
    public function store(ProductFormRequest $request): RedirectResponse
    {
        $this->productService->storeProduct($request);

        return redirect()->route('admin.products.index');
    }

    /**
     * @param Product $product
     * @return View
     */
    public function edit(Product $product): View
    {
        $categories = Category::all();
        $categories = $categories->pluck('name', 'id');
        $productCategories = $product->categories()->pluck('id')->toArray();

        return view('admin.products.edit', compact('product', 'categories', 'productCategories'));
    }

    /**
     * @param ProductFormRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(ProductFormRequest $request, Product $product): RedirectResponse
    {
        $this->productService->updateProduct($request, $product);

        return redirect()->route('admin.products.index');
    }

    /**
     * @param Product $product
     * @return RedirectResponse
     */
    public function delete(Product $product): RedirectResponse
    {
        $this->productService->deleteProduct($product);

        return back();
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        $product = Product::onlyTrashed()->whereId($id)->first();
        Gate::authorize('restore', $product);

        $this->productService->restoreProduct($product);

        return back();
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $product = Product::onlyTrashed()->whereId($id)->first();
        Gate::authorize('forceDelete', $product);

        $this->productService->destroyProduct($product);

        return back();
    }
}
