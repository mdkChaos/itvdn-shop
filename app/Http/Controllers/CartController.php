<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartDropItemRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Models\Order;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        return view('cart.index');
    }

    public function add($productId): RedirectResponse
    {
        $product = Product::findOrFail($productId);

        Cart::add($product->id, $product->title, 1, $product->price);

        return back();
    }

    public function update(CartUpdateRequest $request): RedirectResponse
    {
        Cart::update($request->productId, $request->qty);

        return back();
    }

    public function drop(CartDropItemRequest $request): RedirectResponse
    {
        Cart::remove($request->productId);

        return back();
    }

    public function destroy(): RedirectResponse
    {
        Cart::destroy();

        return back();
    }

    public function checkout(): View
    {
        return view('orders.checkout');
    }

    public function success($orderId): View
    {
        $order = Order::findOrFail($orderId);
        return view('cart.success', compact('order'));
    }
}
