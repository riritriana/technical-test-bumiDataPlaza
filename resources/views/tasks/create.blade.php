@extends('layouts.app')

@section('title', 'Tambah Task Baru')

@section('content')
    <h1 class="mb-4">Tambah Task Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm p-4">
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="project_id" class="form-label">Pilih Project:</label>
                <select name="project_id" id="project_id" class="form-select" required>
                    <option value="">-- Pilih Project --</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label for="title" class="form-label">Judul Task:</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi:</label>
                <textarea id="description" name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="priority" class="form-label">Prioritas (1=Low, 3=High):</label>
                    <input type="number" id="priority" name="priority" class="form-control" value="{{ old('priority', 1) }}" min="1" max="3" required>
                    <small class="form-text text-muted">1: Low, 2: Medium, 3: High</small>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="deadline" class="form-label">Deadline:</label>
                    <input type="date" id="deadline" name="deadline" class="form-control" value="{{ old('deadline') }}">
                </div>
            </div>
            
            <hr>
            
            <button type="submit" class="btn btn-success me-2">Simpan Task</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Batalkan</a>
        </form>
    </div>
@endsection