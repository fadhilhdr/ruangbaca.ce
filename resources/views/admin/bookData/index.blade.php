@extends('admin.layouts.base')

@section('title', 'Indeks Buku')

@section('content')
    <div class="card mb-4">

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>ISBN</th>
                        <th>Peminatan</th>
                        <th>Sub Peminatan</th>
                        <th>Kode Unik</th>
                        <th>Thumbnail</th>
                        <th>Status</th>
                        <th>Action</th> <!-- Tambahkan kolom Action -->
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $index => $book)
                        <tr class="align-middle">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $book->judul }}</td>
                            <td>{{ $book->penulis }}</td>
                            <td>{{ $book->penerbit }}</td>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ $book->peminatan }}</td>
                            <td>{{ $book->sub_peminatan }}</td>
                            <td>{{ $book->kode_unik }}</td>
                            <td>
                                @if ($book->thumbnail)
                                    <img src="{{ asset('storage/' . $book->thumbnail) }}" alt="Thumbnail" width="50">
                                @else
                                    <span class="text-muted">NULL</span>
                                @endif
                            </td>
                            <td>{{ $book->is_available ? 'Tersedia' : 'Terpinjam' }}</td>

                            <td>
                                <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-sm btn-primary"><i
                                        class="bi bi-pencil-square"></i></a> <!-- Tombol Edit -->
                                <!-- Tombol Delete -->
                                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this book?')"><i
                                            class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13" class="text-center">No data available</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div> <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-end">
                {{-- Tambahkan pagination --}}
                {{ $books->links('pagination::bootstrap-5') }}
            </ul>
        </div>
    </div> <!-- /.card -->
@endsection
