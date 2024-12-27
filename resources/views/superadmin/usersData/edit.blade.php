@extends('superadmin.layouts.base')

@section('title', 'Edit User')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Edit User</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('superadmin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="role_id">Role ID</label>
                    <input type="number" name="role_id" id="role_id" class="form-control"
                        value="{{ old('role_id', $user->role_id) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
