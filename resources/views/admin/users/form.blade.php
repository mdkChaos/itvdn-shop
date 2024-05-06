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

            <form action="{{ route('admin.users.update', $user->getKey()) }}" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ $user->name }}">
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Last Name" value="{{ $user->lastname }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ $user->email }}">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" value="{{ $user->phone }}">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" id="address" placeholder="Address" value="{{ $user->address }}">
                </div>
                @if(auth()->user()->is_admin)
                    <div class="mb-3 form-check">
                        <input type="checkbox"
                               name="is_admin"
                               class="form-check-input"
                               id="is_admin"
                               value="1"
                               {{ $user->is_admin ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_admin">Admin</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox"
                               name="is_manager"
                               class="form-check-input"
                               id="is_manager"
                               value="1"
                               {{ $user->is_manager ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_manager">Manager</label>
                    </div>
                @endif
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
