@extends('admin.layouts.base')

@section('title', 'Upload Excel')

@section('content')
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <h3 class="card-title">Upload Excel</h3>
        </div>
        <form action="{{ route('admin.lecturers.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="file" class="form-label">Pilih File Excel</label>
                    <input type="file" class="form-control @error('file') is-invalid @enderror" id="file"
                        name="file" required>
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
    </div>
@endsection
