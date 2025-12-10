@extends('layouts.app')

@section('title', 'Daftar Tasks')

@section('content')
    <h1 class="mb-4">Daftar Tasks</h1>
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Tambah Task Baru</a>
    <hr class="my-3">

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Project</th>
                <th>Judul Task</th>
                <th>Prioritas</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td><span >{{ $task->project->name }}</span></td> 
                <td>{{ $task->title }}</td>
                <td><span >{{ $task->priority }}</span></td>
                <td>{{ $task->deadline ?? 'N/A' }}</td> 
                
                <td>
                    @if ($task->status == 4)
                        <span class="badge bg-success">Done</span>
                    @elseif ($task->status == 3)
                        <span class="badge bg-primary">Review</span>
                    @elseif ($task->status == 2)
                        <span class="badge bg-info text-dark">Doing</span>
                    @elseif ($task->status == 1)
                        <span class="badge bg-danger">Todo</span>
                    @else
                        <span class="badge bg-secondary">Unknown</span>
                    @endif
                </td> 
                
                <td>
                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-info me-1">Detail</a>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">Edit</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Belum ada Task yang dibuat.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endsection