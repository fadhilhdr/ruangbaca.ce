@extends('admin.layouts.base')

@section('title', 'Indeks Dosen')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Data Lecturers</h3>
            <div class="float-end">
                <!-- Search Bar -->
                <form action="{{ route('admin.lecturers.index') }}" method="GET" class="d-flex">
                    <div class="input-group">
                        <input type="search" name="search" id="search" class="form-control"
                            placeholder="Cari dengan Nama/NIP" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> </button>
                    </div>
                </form>
            </div>
        </div> <!-- /.card-header -->

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Kode Dosen</th>
                        <th>Riwayat S1</th>
                        <th>Riwayat S2</th>
                        <th>Riwayat S3</th>
                        <th>Kepakaran 1</th>
                        <th>Kepakaran 2</th>
                        <th style="width: 100px">Action</th>
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
                            <td>
                                <a href="{{ route('admin.lecturers.edit', $lecturer->nip) }}"
                                    class="btn btn-sm btn-warning">
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
                {{ $lecturers->links('pagination::bootstrap-5') }}
            </ul>
        </div>
    </div> <!-- /.card -->
@endsection
