@extends('admin.layouts.base')

@section('title', 'Upload Excel for Students')

@section('content')
    <div class="card card-primary card-outline mb-4">
        <div class="card-header d-flex align-items-center">
            <a href="javascript:history.back()" class="me-3">
                <i class="bi bi-arrow-left-circle"></i>
            </a>
            <h3 class="card-title">Upload Students Data From Excel</h3>
        </div> <!-- /.card-header -->
        <form action="{{ route('admin.students.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="excelFile" class="form-label">Choose Excel File</label>
                    <input type="file" name="file" id="excelFile"
                        class="form-control @error('file') is-invalid @enderror" accept=".xls,.xlsx" required>
                    @error('file')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div> <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div> <!-- /.card-footer -->
        </form>
    </div> <!-- /.card -->
@endsection
