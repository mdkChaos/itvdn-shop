@extends('layouts.app')

@section('title', 'Cart')

@section('content')
    <div class="container wow fadeIn">
        <h2 class="my-5 h2 text-center">Your cart</h2>

        @if(Cart::count() > 0)
            <table class="table table-striped">
                <thead class="bg-dark text-white">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product</th>
                    <th scope="col">Quantity</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @php $i = 0; @endphp
                @foreach(Cart::content() as $key => $item)
                    @php $i++; @endphp
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>{{ $item->name }}</td>
                        <td>
                            <form action="{{ route('cart.update') }}" method="post">
                                @method('patch')
                                @csrf
                                <input type="hidden" name="productId" value="{{ $item->rowId }}">
                                <input type="number" name="qty" value="{{ $item->qty }}" min="1">
                                <button class="btn btn-sm btn-primary" type="submit">Update</button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('cart.drop', ['productId' => $item->rowId]) }}" type="button"
                               class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3">Total:</td>
                    <td><strong>&dollar;{{ Cart::total() }}</strong></td>
                </tr>
                </tfoot>
            </table>
            <a href="{{ route('cart.destroy') }}" class="btn btn-danger btn-lg">Clear cart</a>
            <a href="{{ route('cart.checkout') }}" class="btn btn-success btn-lg">
                Checkout <i class="fa fa-arrow-right"></i>
            </a>
        @else
            <figure class="border-start border-3 border-warning">
                <blockquote class="blockquote ms-3">
                    <p class="text-warning">Do you like our products?</p>
                </blockquote>
                <figcaption class="blockquote-footer ms-3">
                    Your cart is empty now. You can choose products in our <a href="{{ url('catalog') }}">catalog</a> and
                    enjoy them!
                </figcaption>
            </figure>
        @endif
    </div>
@endsection
