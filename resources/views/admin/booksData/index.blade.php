@extends('admin.layouts.base')

@section('title', 'Index Books')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Data Books</h3>
        </div> <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>ISBN</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Stock</th>
                        <th>Thumbnail</th>
                        <th>Specialization</th>
                        <th>Synopsis</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th> <!-- Tambahkan kolom Action -->
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $index => $book)
                        <tr class="align-middle">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->stock }}</td>
                            <td>
                                @if ($book->thumbnail)
                                    <img src="{{ asset('storage/' . $book->thumbnail) }}" alt="Thumbnail"
                                        style="width: 50px; height: auto;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $book->specialization->name ?? 'N/A' }}</td> <!-- Tampilkan nama specialization -->
                            <td>{{ Str::limit($book->synopsis, 50) }}</td> <!-- Batas 50 karakter -->
                            <td>{{ $book->created_at }}</td>
                            <td>{{ $book->updated_at }}</td>
                            <td>
                                <a href="{{ route('admin.books.edit', $book->id) }}"
                                    class="btn btn-sm btn-primary">Edit</a> <!-- Tombol Edit -->
                                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center">No data available</td>
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
