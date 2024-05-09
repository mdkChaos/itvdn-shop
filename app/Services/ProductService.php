<?php

namespace App\Services;

use App\Http\Requests\ProductFormRequest;
use App\Models\Product;

class ProductService
{
    /**
     * @param ProductFormRequest $request
     * @return void
     */
    public function storeProduct(ProductFormRequest $request): void
    {
        $product = Product::create($request->all());

        foreach ($request->categories as $categoryId) {
            $product->categories()->attach($categoryId);
        }
    }

    /**
     * @param ProductFormRequest $request
     * @param Product $product
     * @return void
     */
    public function updateProduct(ProductFormRequest $request, Product $product): void
    {
        $product->update($request->all());

        foreach ($request->categories as $categoryId) {
            $product->categories()->sync($categoryId);
        }
    }

    /**
     * @param Product $product
     * @return void
     */
    public function deleteProduct(Product $product): void
    {
        $product->delete();
    }

    /**
     * @param Product $product
     * @return void
     */
    public function restoreProduct(Product $product): void
    {
        $product->restore();
    }

    /**
     * @param Product $product
     * @return void
     */
    public function destroyProduct(Product $product): void
    {
        $product->forceDelete();
    }
}
