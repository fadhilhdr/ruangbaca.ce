@extends('admin.layouts.base')

@section('title', 'Index Lecturers')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Data Lecturers</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>NIP</th>
                        <th>Name</th>
                        <th>Kode Dosen</th>
                        <th>Riwayat S1</th>
                        <th>Riwayat S2</th>
                        <th>Riwayat S3</th>
                        <th>Kepakaran 1</th>
                        <th>Kepakaran 2</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th> <!-- Tambahkan kolom Action -->
                    </tr>
                </thead>
                <tbody>
                    @forelse($lecturers as $index => $lecturer)
                        <tr class="align-middle">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $lecturer->nip }}</td>
                            <td>{{ $lecturer->name }}</td>
                            <td>{{ $lecturer->kode_dosen }}</td>
                            <td>{{ $lecturer->riwayat_s1 }}</td>
                            <td>{{ $lecturer->riwayat_s2 }}</td>
                            <td>{{ $lecturer->riwayat_s3 ?? '-' }}</td>
                            <td>{{ $lecturer->kepakaran1 }}</td>
                            <td>{{ $lecturer->kepakaran2 ?? '-' }}</td>
                            <td>{{ $lecturer->created_at ?? '-' }}</td>
                            <td>{{ $lecturer->updated_at ?? '-' }}</td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('admin.lecturers.edit', $lecturer->nip) }}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div> <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-end">
                {{-- Tambahkan pagination --}}
                {{ $lecturers->links('pagination::bootstrap-5') }}
            </ul>
        </div>
    </div> <!-- /.card -->
@endsection
