<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
