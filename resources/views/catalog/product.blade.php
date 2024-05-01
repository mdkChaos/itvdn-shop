@extends('layouts.app')

@section('title') {{ $product->title }} @stop

@section('content')
    <div class="container dark-grey-text mt-5">

        <!--Grid row-->
        <div class="row wow fadeIn">
            <!--Grid column-->
            <div class="col-md-6 mb-4">
                <div class="row">
                    <div class="col-12">
                        <img src="{{ $product->cover }}" class="img-fluid img-thumbnail"
                             alt="">
                    </div>
                </div>
                <div class="row mt-2">
                    @foreach(json_decode($product->gallery->images) as $image)
                        <div class="col-3">
                            <img src="{{ $image->path }}" alt="" class="img-fluid img-thumbnail">
                        </div>
                    @endforeach
                </div>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-6 mb-4">

                <!--Content-->
                <div class="p-4">

                    <div class="mb-3">
                        @foreach($product->categories as $category)
                            <a href="">
                            <span class="badge
                             @switch($category->id)
                                @case(1)
                                    text-bg-primary
                                    @break
                                @case(2)
                                    text-bg-info
                                    @break
                                @case(3)
                                    text-bg-danger
                                    @break
                                @case(4)
                                    text-bg-warning
                                    @break
                                @case(5)
                                    text-bg-success
                                    @break
                            @endswitch
                                mr-1">{{ $category->name }}</span>
                            </a>
                        @endforeach
                    </div>

                    <p class="lead">
              <span class="mr-1">
              </span>
                        <span>${{ $product->price }}</span>
                    </p>

                    <p class="lead font-weight-bold">Description</p>

                    <p>
                        {{ $product->description }}
                    </p>
                </div>
                <!--Content-->

            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

        <hr>

        <!--Grid row-->
        <div class="row d-flex justify-content-center wow fadeIn">

            <!--Grid column-->
            <div class="col-md-6 text-center">

                <h4 class="my-4 h4">Additional information</h4>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus suscipit modi sapiente illo soluta
                    odit voluptates,
                    quibusdam officia. Neque quibusdam quas a quis porro? Molestias illo neque eum in laborum.</p>

            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

        <!--Grid row-->
        <div class="row wow fadeIn">

            <!--Grid column-->
            <div class="col-lg-4 col-md-12 mb-4">

                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/11.jpg" class="img-fluid"
                     alt="">

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-4 col-md-6 mb-4">

                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/12.jpg" class="img-fluid"
                     alt="">

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-4 col-md-6 mb-4">

                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/13.jpg" class="img-fluid"
                     alt="">

            </div>
            <!--Grid column-->
        </div>
    </div>
@stop
