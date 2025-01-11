@extends('admin.layouts.base')

@section('title', 'Visitor')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <div class="float-end">
                <!-- Search Bar -->
                <form action="{{ route('admin.visitor.index') }}" method="GET" class="d-flex">
                    <div class="input-group">
                        <input type="search" name="search" id="search" class="form-control"
                            placeholder="Search by Name or NIM" value="{{ request('search') }}">
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
                        <th style="width: 10px">No</th>
                        <th>Nama/NIM</th>
                        <th>Instansi</th>
                        <th>Check-in Time</th>
                        <th>Check-out Time</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataVisitor as $index => $visitor)
                        <tr class="align-middle">
                            <td>{{ $loop->iteration + ($dataVisitor->currentPage() - 1) * $dataVisitor->perPage() }}</td>
                            <td>{{ $visitor->name }}</td>
                            <td>{{ $visitor->instansi }}</td>
                            <td>{{ $visitor->check_in_at }}</td>
                            <td>{{ $visitor->check_out_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div> <!-- /.card-body -->

        <!-- Pagination -->
        @if ($dataVisitor->hasPages())
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-end">
                    {{ $dataVisitor->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
                </ul>
            </div>
        @endif
    </div> <!-- /.card -->
@endsection
