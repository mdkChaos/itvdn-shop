<div class="col-3 mb-4 d-flex align-items-stretch">
    <div class="card">
        <img src="{{ $product->cover }}" class="card-img-top" alt="{{ $product->title }}">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('catalog.show', ['slug' => $product->slug]) }}">{{ $product->title }}</a>
            </h5>
            <p>
                @foreach($product->categories as $category)
                    <a href="" class="badge
                        @switch($category->id)
                            @case(1) bg-primary @break
                            @case(2) bg-secondary @break
                            @case(3) bg-danger @break
                            @case(4) bg-dark @break
                            @case(5) bg-success @break
                        @endswitch
                        mr-1">{{ $category->name }}</a>
                @endforeach
            </p>
            <p>&dollar;{{ $product->price }}</p>
            <p class="card-text">{{ Str::limit($product->description, 120, '...') }}</p>
        </div>
        <div class="card-footer">
            <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger'}} float-start">
                {{ $product->stock > 0 ? 'on stock' : 'not on stock'}}
            </span>
            <span class="float-end">
                <a href="{{ $product->stock > 0 ? route('cart.add', ['productId' => $product->id]) : '#' }}"
                   class="btn btn-sm btn-outline-secondary waves-effect {{ $product->stock <= 0 ? 'disabled' : '' }}">
                    to cart <i class="fas fa-cart-arrow-down"></i>
                </a>
            </span>
        </div>
    </div>
</div>
