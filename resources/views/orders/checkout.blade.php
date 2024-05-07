@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="container wow fadeIn">

        <!-- Heading -->
        <h2 class="my-5 h2 text-center">Checkout</h2>

        <!-- Grid row -->
        <div class="row">
            <!-- Grid column -->
            <div class="col-md-8 mb-4">
                <!-- Card -->
                <div class="card">
                    <!-- Card content -->
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('order.store') }}" method="post">
                            @csrf

                            <!-- Grid row -->
                            <div class="row">
                                <!-- Grid column -->
                                <div class="col-md-6 mb-2">
                                    <!-- First name -->
                                    <div class="form-group">
                                        <label for="firstName" class="form-label">First name</label>
                                        <input type="text" id="firstName" class="form-control" name="customerName"
                                               value="{{ auth()->user()->name ?? old('customerName') }}" required>
                                    </div>
                                </div>
                                <!-- Grid column -->

                                <!-- Grid column -->
                                <div class="col-md-6 mb-2">
                                    <!-- Last name -->
                                    <div class="form-group">
                                        <label for="lastName" class="form-label">Last name</label>
                                        <input type="text" id="lastName" class="form-control" name="customerLastName"
                                               value="{{ auth()->user()->lastname ?? old('customerLastName') }}" required>
                                    </div>

                                </div>
                                <!-- Grid column -->

                            </div>
                            <!-- Grid row -->

                            <!-- Email -->
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" class="form-control" placeholder="youremail@example.com"
                                       name="customerEmail" value="{{ auth()->user()->email ?? old('customerEmail') }}" required>
                            </div>

                            <!-- Phone number -->
                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Phone number</label>
                                <input type="tel" id="phone" class="form-control" placeholder="+1 (123) 456-7890"
                                       name="customerPhone" value="{{ auth()->user()->phone ?? old('customerPhone') }}" required>
                            </div>

                            <!-- Address -->
                            <div class="form-group mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" id="address" class="form-control"
                                       placeholder="Park av., 123, New York, USA"
                                       name="customerAddress" value="{{ auth()->user()->address ?? old('customerAddress') }}" required>
                            </div>

                            <!-- Comment -->
                            <div class="form-group mb-3">
                                <label for="comment" class="form-label">Comment</label>
                                <textarea id="comment" class="form-control" placeholder="Comment"
                                          name="customerComment">{{ old('customerComment') }}</textarea>
                            </div>

                            <hr class="mb-4">

                            @guest
                            @else
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="save-info" name="updateUser" value="1">
                                    <label class="custom-control-label" for="save-info">Save this information for next time</label>
                                </div>
                                <hr class="mb-4">
                            @endif
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Order it</button>

                        </form>
                    </div>
                </div>
                <!-- /.Card -->

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-4 mb-4">
                <!-- Heading -->
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-info rounded-pill text-dark">{{ Cart::total() }}</span>
                </h4>

                <!-- Cart -->
                <ul class="list-group mb-3 z-depth-1">
                    @foreach(Cart::content() as $item)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{ $item->name }}</h6>
                                <small class="text-muted">x {{ $item->qty }}</small>
                            </div>
                            <span class="text-muted">&dollar;{{ $item->price *  $item->qty }}</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total</span>
                        <strong>&dollar;{{ Cart::total() }}</strong>
                    </li>
                </ul>
                <!-- Cart -->
                <a href="{{ route('cart.index') }}" class="btn btn-info btn-lg"><i class="fa fa-arrow-left"></i> Change order</a>
            </div>
            <!-- Grid column -->
        </div>
        <!-- Grid row -->
    </div>
@endsection
