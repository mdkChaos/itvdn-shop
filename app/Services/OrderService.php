<?php

namespace App\Services;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Collection;

class OrderService
{
    /**
     * @param int $id
     * @return Order
     */
    public function getOrder(int $id): Order
    {
        return Order::findOrFail($id);
    }

    /**
     * @return array
     */
    public function getOrders(): array
    {
        $orders = Order::paginate();
        $trashedOrders = Order::onlyTrashed()->get();

        return compact('orders', 'trashedOrders');
    }

    /**
     * @param StoreOrderRequest $request
     * @return Order
     */
    public function storeOrder(StoreOrderRequest $request): Order
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

        return $order;
    }

    /**
     * @param Order $order
     * @return Collection
     */
    public function showOrder(Order $order): Collection
    {
        $orderItems = OrderItem::where('order_id', $order->id)->with('product')->get();
        $productIds = $orderItems->pluck('product_id')->unique()->toArray();
        $products = Product::whereIn('id', $productIds)->get();

        return $orderItems->map(function ($orderItem) use ($products) {
            $product = $products->where('id', $orderItem->product_id)->first();
            $orderItem->product = $product;
            return $orderItem;
        });
    }

    /**
     * @param Order $order
     * @return void
     */
    public function deleteOrder(Order $order): void
    {
        $order->delete();
    }

    /**
     * @param Order $order
     * @return void
     */
    public function restoreOrder(Order $order): void
    {
        $order->restore();
    }

    /**
     * @param Order $order
     * @return void
     */
    public function destroyOrder(Order $order): void
    {
        $order->forceDelete();
    }
}
