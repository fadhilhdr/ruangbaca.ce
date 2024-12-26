@extends('admin.layouts.base')

@section('title', 'Index Students')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Data Students</h3>
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
                        <th>Created At</th>
                        <th>Updated At</th>
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
                            <td>{{ $student->created_at }}</td>
                            <td>{{ $student->updated_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div> <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-end">
                {{-- Tambahkan pagination --}}
                {{ $students->links('pagination::bootstrap-5') }}
            </ul>
        </div>
    </div> <!-- /.card -->
@endsection
