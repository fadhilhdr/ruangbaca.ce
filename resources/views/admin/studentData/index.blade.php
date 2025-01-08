@extends('admin.layouts.base')

@section('title', 'Index Students')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Data Students</h3>
            <div class="float-end">
                <!-- Search Bar -->
                <form action="{{ route('admin.students.index') }}" method="GET" class="d-flex">
                    <div class="input-group">
                        <input type="search" name="search" id="search" class="form-control"
                            placeholder="Search by name/NIM" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div> <!-- /.card-header -->

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Angkatan</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Action</th> <!-- Tambahkan kolom Action -->
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $index => $student)
                        <tr class="align-middle">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $student->nim }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->angkatan }}</td>
                            <td>{{ $student->gender }}</td>
                            <td>{{ $student->status }}</td>

                            <td>
                                <a href="{{ route('admin.students.edit', $student->nim) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <!-- Tombol Edit -->

                                <!-- Tombol Delete -->
                                <form action="{{ route('admin.students.destroy', $student->nim) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this student?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
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
                {{ $students->links('pagination::bootstrap-5') }}
            </ul>
        </div>
    </div> <!-- /.card -->
@endsection
