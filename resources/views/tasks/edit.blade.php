@extends('layouts.app')

@section('title', 'Edit Task: ' . $task->title)

@section('content')
    <h1 class="mb-4">Edit Task: {{ $task->title }}</h1>
    
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
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf 
            @method('PUT') 
            
            <div class="mb-3">
                <label for="project_id" class="form-label">Pilih Project:</label>
                <select name="project_id" id="project_id" class="form-select" required>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label for="title" class="form-label">Judul Task:</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $task->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi:</label>
                <textarea id="description" name="description" class="form-control">{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="priority" class="form-label">Prioritas (1=Low, 3=High):</label>
                    <input type="number" id="priority" name="priority" class="form-control" value="{{ old('priority', $task->priority) }}" min="1" max="3" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="deadline" class="form-label">Deadline:</label>
                    <input type="date" id="deadline" name="deadline" class="form-control" value="{{ old('deadline', $task->deadline) }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="status" class="form-label">Status (1=Todo, 4=Done):</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="1" {{ old('status', $task->status) == 1 ? 'selected' : '' }}>1: Todo</option>
                        <option value="2" {{ old('status', $task->status) == 2 ? 'selected' : '' }}>2: Doing</option>
                        <option value="3" {{ old('status', $task->status) == 3 ? 'selected' : '' }}>3: Review</option>
                        <option value="4" {{ old('status', $task->status) == 4 ? 'selected' : '' }}>4: Done</option>
                    </select>
                </div>
            </div>
            
            <button type="submit" class="btn btn-success me-2">Update Task</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Batalkan</a>
        </form>
    </div>
@endsection