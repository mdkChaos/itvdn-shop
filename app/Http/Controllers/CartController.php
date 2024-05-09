<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartDropItemRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    private CartService $cartService;
    private OrderService $orderService;
    public function __construct(CartService $cartService, OrderService $orderService)
    {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('cart.index');
    }

    /**
     * @param int $productId
     * @return RedirectResponse
     */
    public function add(int $productId): RedirectResponse
    {
        $this->cartService->addProduct($productId);

        return back();
    }

    /**
     * @param CartUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(CartUpdateRequest $request): RedirectResponse
    {
        $this->cartService->updateCart($request);

        return back();
    }

    /**
     * @param CartDropItemRequest $request
     * @return RedirectResponse
     */
    public function drop(CartDropItemRequest $request): RedirectResponse
    {
        $this->cartService->dropItem($request);

        return back();
    }

    /**
     * @return RedirectResponse
     */
    public function destroy(): RedirectResponse
    {
        $this->cartService->destroyCart();

        return back();
    }

    /**
     * @return View
     */
    public function checkout(): View
    {
        return view('orders.checkout');
    }

    /**
     * @param int $orderId
     * @return View
     */
    public function success(int $orderId): View
    {
        $order = $this->orderService->getOrder($orderId);
        return view('cart.success', compact('order'));
    }
}
