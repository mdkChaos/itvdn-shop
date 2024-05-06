@extends('admin.content')

@section('title', 'Edit user')

@section('content')
    @include('admin.users.form', compact('user'))
@endsection
