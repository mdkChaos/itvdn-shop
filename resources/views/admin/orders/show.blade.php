@extends('admin.content')

@section('title', 'Order info')

@section('content')
    <div class="container">
        <h1 class="mt-3">Order Details</h1>
        <h4>Order ID: {{ $order->id }}</h4>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">
                        Customer Information
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Customer Name:</strong> {{ $order->customerName }}</li>
                            <li class="list-group-item"><strong>Customer Last Name:</strong> {{ $order->customerLastName }}</li>
                            <li class="list-group-item"><strong>Customer Email:</strong> {{ $order->customerEmail }}</li>
                            <li class="list-group-item"><strong>Customer Phone:</strong> {{ $order->customerPhone }}</li>
                            <li class="list-group-item"><strong>Customer Address:</strong> {{ $order->customerAddress }}</li>
                            <li class="list-group-item"><strong>Comment:</strong> {{ $order->comment }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Order Items
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Barcode</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orderItems as $orderItem)
                                    <tr>
                                        <td>{{ $orderItem->product_id }}</td>
                                        <td>{{ $orderItem->product->title }}</td>
                                        <td>{{ $orderItem->product->barcode }}</td>
                                        <td>{{ $orderItem->quantity }}</td>
                                        <td>${{ number_format($orderItem->price, 2) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end"><strong>Total:</strong></td>
                                    <td>${{ $order->total }}</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
