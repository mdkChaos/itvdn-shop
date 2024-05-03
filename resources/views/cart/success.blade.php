@extends('layouts.app')

@section('title', 'Thanks for your order')

@section('content')
    <div class="container">
        <figure class="border-start border-success border-3">
            <blockquote class="blockquote ms-3">
                <p class="text-success">Thanks for your order!</p>
                <p>Hey, {{ $order->user->name ?? 'dear customer' }}!</p>
            </blockquote>
            <figcaption class="blockquote-footer ms-3">
                Your order <strong>#{{ $order->id }}</strong> was successfully created. We will call you as soon as possible!
            </figcaption>
        </figure>

        <div class="row mt-3">
            <div class="col">
                <a href="{{ route('index') }}" class="btn btn-success">Get back</a>
            </div>
        </div>
    </div>
@endsection
