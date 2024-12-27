@extends('superadmin.layouts.base')

@section('title', 'Index Users')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Data Users</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Role ID</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th style="width: 100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr class="align-middle">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->userid }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->role_id }}</td>
                            <td>{{ $user->created_at ?? '-' }}</td>
                            <td>{{ $user->updated_at ?? '-' }}</td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('superadmin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                {{ route('superadmin.users.edit', $user->id) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div> <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-end">
                {{-- Tambahkan pagination --}}
                {{ $users->links('pagination::bootstrap-5') }}
            </ul>
        </div>
    </div> <!-- /.card -->
@endsection
