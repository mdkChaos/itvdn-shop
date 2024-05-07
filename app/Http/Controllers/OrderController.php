<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $orders = Order::paginate();
        $trashedOrders = Order::onlyTrashed()->get();
        return view('admin.orders.index', compact('orders', 'trashedOrders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $order = Order::create([
            'customerName' => $request->customerName,
            'customerLastName' => $request->customerLastName,
            'customerEmail' => $request->customerEmail,
            'customerPhone' => $request->customerPhone,
            'customerAddress' => $request->customerAddress,
            'comment' => $request->customerComment,
            'total' => Cart::total(),
        ]);

        foreach (Cart::content() as $cartRow) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartRow->id,
                'price' => $cartRow->price,
                'quantity' => $cartRow->qty,
            ]);
        }
        if ($request->has('updateUser')) {
            $user = auth()->guest() ? User::where('email', $request->customerEmail)->first() : auth()->user();

            if (!is_null($user)) {
                $user->update([
                    'name' => $request->customerName,
                    'lastname' => $request->customerLastName,
                    'email' => $request->customerEmail,
                    'phone' => $request->customerPhone,
                    'address' => $request->customerAddress,
                ]);

                $order->update([
                    'user_id' => $user->id,
                ]);
            }
        }

        Cart::destroy();

        return redirect()->route('cart.success', ['orderId' => $order->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $orderItems = OrderItem::where('order_id', $order->id)->with('product')->get();
        $productIds = $orderItems->pluck('product_id')->unique()->toArray();
        $products = Product::whereIn('id', $productIds)->get();

        $orderItems->map(function ($orderItem) use ($products) {
            $product = $products->where('id', $orderItem->product_id)->first();
            $orderItem->product = $product;
            return $orderItem;
        });

        return view('admin.orders.show', compact('order', 'orderItems'));
    }

    /**
     * Delete the specified resource from storage.
     */
    public function delete(Order $order): RedirectResponse
    {
        $order->delete();

        return redirect()->route('admin.orders.index');
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(int $id): RedirectResponse
    {
        $order = Order::onlyTrashed()->whereId($id)->first();
        Gate::authorize('restore', $order);
        $order->restore();

        return redirect()->route('admin.orders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $order = Order::onlyTrashed()->whereId($id)->first();
        Gate::authorize('forceDelete', $order);
        $order->forceDelete();

        return redirect()->route('admin.orders.index');
    }
}
