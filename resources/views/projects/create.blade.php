@extends('layouts.app')

@section('title', 'Tambah Project')

@section('content')
    <h1 class="mb-4">Tambah Project Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf 
        <div class="mb-3">
            <label for="name" class="form-label">Nama Project:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Tanggal Mulai:</label>
            <input type="date" id="start_date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
        </div>
        
        <button type="submit" class="btn btn-success">Simpan Project</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection