<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    private OrderService $orderService;

    /**
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $result = $this->orderService->getOrders();

        return view('admin.orders.index', $result);
    }

    /**
     * @param StoreOrderRequest $request
     * @return RedirectResponse
     */
    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $order = $this->orderService->storeOrder($request);

        return redirect()->route('cart.success', ['orderId' => $order->id]);
    }

    /**
     * @param Order $order
     * @return View
     */
    public function show(Order $order): View
    {
        $orderItems = $this->orderService->showOrder($order);

        return view('admin.orders.show', compact('order', 'orderItems'));
    }

    /**
     * @param Order $order
     * @return RedirectResponse
     */
    public function delete(Order $order): RedirectResponse
    {
        $this->orderService->deleteOrder($order);

        return back();
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        $order = Order::onlyTrashed()->whereId($id)->first();
        Gate::authorize('restore', $order);

        $this->orderService->restoreOrder($order);

        return back();
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $order = Order::onlyTrashed()->whereId($id)->first();
        Gate::authorize('forceDelete', $order);

        $this->orderService->destroyOrder($order);

        return back();
    }
}
