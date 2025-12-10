@extends('layouts.app')

@section('title', 'Detail Task: ' . $task->title)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Detail Task: {{ $task->title }}</h1>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Kembali ke Daftar Tasks</a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Informasi Task</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Project:</strong> <span class="badge bg-primary">{{ $task->project->name }}</span></p>
                    <p><strong>Judul:</strong> {{ $task->title }}</p>
                    <p><strong>Deskripsi:</strong></p>
                    <div class="alert alert-light border p-3">
                        {{ $task->description ?? 'Tidak ada deskripsi' }}
                    </div>
                </div>
                <div class="col-md-6">
                    <p><strong>Prioritas:</strong> 
                        <span class="badge bg-{{ $task->priority == 3 ? 'danger' : ($task->priority == 2 ? 'warning' : 'success') }}">
                            {{ $task->priority }} ({{ $task->priority == 3 ? 'High' : ($task->priority == 2 ? 'Medium' : 'Low') }})
                        </span>
                    </p>
                    <p><strong>Deadline:</strong> 
                        <span class="badge bg-secondary">{{ $task->deadline ?? 'N/A' }}</span>
                    </p>
                    <p><strong>Status:</strong> 
                        <span class="badge fs-6 
                            @if ($task->status == 4) bg-success
                            @elseif ($task->status == 1) bg-danger
                            @elseif ($task->status == 2) bg-info
                            @else bg-secondary
                            @endif">
                            {{ $task->status }} ({{ $task->status == 4 ? 'Done' : 'In Progress' }})
                        </span>
                    </p>
                    <hr>
                    <p class="text-muted small">Dibuat pada: {{ $task->created_at }}</p>
                    <p class="text-muted small">Terakhir diupdate: {{ $task->updated_at }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning me-2">Edit Task</a>
            
            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus Task ini?')">Hapus Task</button>
            </form>
        </div>
    </div>
@endsection