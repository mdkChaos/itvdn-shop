<?php

namespace App\Services;

use App\Http\Requests\CartDropItemRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartService
{
    /**
     * @param int $productId
     * @return void
     */
    public function addProduct(int $productId): void
    {
        $product = Product::findOrFail($productId);

        $cartRow = Cart::add($product->id, $product->title, 1, $product->price);
        $cartRow->associate(Product::class);
    }

    /**
     * @param CartUpdateRequest $request
     * @return void
     */
    public function updateCart(CartUpdateRequest $request): void
    {
        Cart::update($request->productId, $request->qty);
    }

    public function dropItem(CartDropItemRequest $request): void
    {
        Cart::remove($request->productId);
    }

    /**
     * @return void
     */
    public function destroyCart(): void
    {
        Cart::destroy();
    }
}
