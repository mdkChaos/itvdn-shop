@extends('admin.content')

@section('title', 'Users')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title')</h3>

                <div class="card-tools">
                    {{ $users->links() }}
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->getKey() }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge bg-{{ $user->is_admin ? 'success' : 'danger'}}">Admin</span>
                                    <span class="badge bg-{{ $user->is_manager ? 'success' : 'danger'}}">Manager</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.users.edit', ['user' => $user->getKey()]) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('admin.users.destroy', ['user' => $user->getKey()]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
