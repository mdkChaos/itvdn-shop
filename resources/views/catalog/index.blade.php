@extends('layouts.app')

@section('title', 'Catalog')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @foreach($products as $product)
                @include('catalog.card', compact('product'))
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
@endsection
