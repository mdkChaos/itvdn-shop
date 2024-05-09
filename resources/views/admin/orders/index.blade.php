@extends('admin.content')

@section('title', 'Orders')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title')</h3>
                <div class="card-tools">
                    {{ $orders->links() }}
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Lastname</th>
                        <th>Total</th>
                        <th>Actions</th> <!-- Changed from an empty header to make it clear -->
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        @unless($order->trashed())
                            <tr>
                                <td>{{ $order->getKey() }}</td>
                                <td>{{ $order->customerName }}</td>
                                <td>{{ $order->customerLastName }}</td>
                                <td>${{ $order->total }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.orders.show', ['order' => $order->getKey()]) }}" class="btn btn-warning">Show</a>
                                        <a href="{{ route('admin.orders.delete', ['order' => $order->getKey()]) }}" class="btn btn-danger">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @endunless
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    @if(count($trashedOrders) > 0)
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@yield('title') | Trashed</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Lastname</th>
                            <th>Total</th>
                            <th>Actions</th> <!-- Changed from an empty header to make it clear -->
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trashedOrders as $trashedOrder)
                            @canany(['can-order-destroy', 'can-order-restore'], $trashedOrder)
                                <tr>
                                    <td>{{ $trashedOrder->getKey() }}</td>
                                    <td>{{ $trashedOrder->customerName }}</td>
                                    <td>{{ $trashedOrder->customerLastName }}</td>
                                    <td>${{ $trashedOrder->total }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.orders.restore', ['id' => $trashedOrder->getKey()]) }}" class="btn btn-warning">Restore</a>
                                            <a href="{{ route('admin.orders.destroy', ['id' => $trashedOrder->getKey()]) }}" class="btn btn-danger">DROP</a>
                                        </div>
                                    </td>
                                </tr>
                            @endcanany
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    @endif
@endsection
