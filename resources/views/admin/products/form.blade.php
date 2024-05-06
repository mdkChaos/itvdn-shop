<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">@yield('title')</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if($errors->count() > 0)
                <div class="alert alert-danger" role="alert">
                    <p>The following errors have occurred:</p>
                    <ul>
                        @foreach($errors->all() as $message)
                            <li>{{$message}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(!isset($product))
                <form action="{{ route('admin.products.store') }}" method="POST">
                    @else
                        <form action="{{ route('admin.products.update', ['product' => $product->getKey()]) }}" method="POST">
                            @method('PUT')
                            @endif
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ $product->title ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="description" placeholder="Description">{{ $product->description ?? '' }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" name="price" class="form-control" id="price" placeholder="Price" value="{{ $product->price ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="barcode" class="form-label">Barcode</label>
                                <input type="text" name="barcode" class="form-control" id="barcode" placeholder="Barcode" value="{{ $product->barcode ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">On Stock Count</label>
                                <input type="number" name="stock" class="form-control" id="stock" placeholder="On Stock Count" value="{{ $product->stock ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="categories" class="form-label">Categories</label>
                                <select name="categories[]" class="form-control" id="categories" multiple>
                                    @foreach($categories as $categoryId => $categoryName)
                                        <option value="{{ $categoryId }}" {{ in_array($categoryId, $productCategories) ? 'selected' : '' }}>{{ $categoryName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cover" class="form-label">Cover image</label>
                                <input type="text" name="cover" class="form-control" id="cover" placeholder="Cover Image URL" value="{{ $product->cover ?? '' }}">
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
