@extends('layouts.app')

@section('title', 'Daftar Projects')

@section('content')
    <h1 class="mb-4">Daftar Projects</h1>

@if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Project Baru
    </a>
    <hr class="my-3">

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Project</th>
                <th>Mulai</th>
                <th>Progress (2c)</th> 
                <th>Jumlah Tasks (2a)</th>
                <th>Status Bermasalah (2e)</th> 
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td>{{ $project->name }}</td>
                <td>{{ $project->start_date }}</td>
                <td>
                    <div class="progress" style="height: 25px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ $project->progress }}%" aria-valuenow="{{ $project->progress }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $project->progress }}%
                        </div>
                    </div>
                </td>
                <td><span class="badge bg-secondary">{{ $project->tasks_count }}</span></td>
                <td>
                    @if ($project->is_problematic)
                        <span class="badge bg-danger">BERMASALAH</span>
                        (Overdue: {{ $project->overdue_tasks }})
                    @else
                        <span class="badge bg-success">Aman</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('projects.show', $project->id) }}" class="btn btn-sm btn-info me-1">Detail</a>
                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                    
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus Project?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Belum ada Project yang dibuat.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endsection