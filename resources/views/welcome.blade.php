@extends('layouts/app')

@section('title', 'Welcome!')

@section('content')
    <!--Carousel Wrapper-->
    <div id="carouselExampleCrossfade" class="carousel slide carousel-fade" data-mdb-ride="carousel" data-mdb-carousel-init>
        <!--Indicators-->
        <div class="carousel-indicators">
            <button
                type="button"
                data-mdb-target="#carouselExampleCrossfade"
                data-mdb-slide-to="0"
                class="active"
                aria-current="true"
                aria-label="Slide 1"
            ></button>
            <button
                type="button"
                data-mdb-target="#carouselExampleCrossfade"
                data-mdb-slide-to="1"
                aria-label="Slide 2"
            ></button>
            <button
                type="button"
                data-mdb-target="#carouselExampleCrossfade"
                data-mdb-slide-to="2"
                aria-label="Slide 3"
            ></button>
        </div>
        <!--/.Indicators-->
        <!--Slides-->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://mdbcdn.b-cdn.net/img/new/slides/041.webp" class="d-block w-100" alt="Wild Landscape" style="max-height: 400px"/>
            </div>
            <div class="carousel-item">
                <img src="https://mdbcdn.b-cdn.net/img/new/slides/042.webp" class="d-block w-100" alt="Camera" style="max-height: 400px"/>
            </div>
            <div class="carousel-item">
                <img src="https://mdbcdn.b-cdn.net/img/new/slides/043.webp" class="d-block w-100" alt="Exotic Fruits" style="max-height: 400px"/>
            </div>
        </div>
        <!--/.Slides-->
        <!--Controls-->
        <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleCrossfade" data-mdb-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleCrossfade" data-mdb-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        <!--/.Controls-->
    </div>
    <!--/.Carousel Wrapper-->

    <div class="container">

        <!--Navbar-->
        <nav class="navbar navbar-expand-lg text-bg-secondary mt-3 mb-5" data-bs-theme="dark">

            <!-- Navbar brand -->
            <span class="navbar-brand ms-3">Categories:</span>

            <!-- Collapse button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible content -->
            <div class="collapse navbar-collapse container-fluid" id="basicExampleNav">

                <!-- Links -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">All
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Phones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Laptops</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Headphones</a>
                    </li>
                </ul>
                <!-- Links -->

                <form class="d-flex input-group w-auto">
                    <div class="md-form my-0">
                        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                    </div>
                </form>
            </div>
            <!-- Collapsible content -->
        </nav>
        <!--/.Navbar-->

        <!--Section: Products v.3-->
        <section class="text-center mb-4">
            <!--Grid row-->
            <div class="row wow fadeIn">
                @foreach($products as $product)
                    @include('catalog.card', compact('product'))
                @endforeach
            </div>
            <!--Grid row-->
            <a href="{{ route('catalog.index') }}" class="btn btn-block btn-primary">To catalog</a>
        </section>
    </div>
        <!--Section: Products v.3-->
@endsection
