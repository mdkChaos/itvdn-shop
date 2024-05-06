@extends('admin.content')

@section('title', 'Edit product')

@section('content')
    @include('admin.products.form', compact('product'))
@endsection
