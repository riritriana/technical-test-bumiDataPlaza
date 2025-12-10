@extends('layouts.app')

@section('title', 'Edit Project: ' . $project->name)

@section('content')
    <h1 class="mb-4">Edit Project: {{ $project->name }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm p-4">
        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf 
            @method('PUT') 
            
            <div class="mb-3">
                <label for="name" class="form-label">Nama Project:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $project->name) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="start_date" class="form-label">Tanggal Mulai:</label>
                <input type="date" id="start_date" name="start_date" class="form-control" value="{{ old('start_date', $project->start_date) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="end_date" class="form-label">Tanggal Selesai (Opsional):</label>
                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ old('end_date', $project->end_date) }}">
            </div>
            
            <div class="mb-3">
                <label for="status" class="form-label">Status Project:</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="1" {{ old('status', $project->status) == 1 ? 'selected' : '' }}>1: Planning</option>
                    <option value="2" {{ old('status', $project->status) == 2 ? 'selected' : '' }}>2: On Progress</option>
                    <option value="3" {{ old('status', $project->status) == 3 ? 'selected' : '' }}>3: Done</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-success me-2">Update Project</button>
            <a href="{{ route('projects.index') }}" class="btn btn-secondary">Batalkan</a>
        </form>
    </div>
@endsection