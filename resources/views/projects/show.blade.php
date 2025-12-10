@extends('layouts.app')

@section('title', 'Detail Project: ' . $project->name)

@section('content')
    <div class="row mb-4">
        <div class="col-md-9">
            <h1 class="mb-0">{{ $project->name }}</h1>
        </div>
        <div class="col-md-3 text-end">
            <a href="{{ route('projects.index') }}" class="btn btn-secondary">Kembali ke Daftar Projects</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Progress Project (2c)</h5>
                </div>
                <div class="card-body text-center">
                    <div class="progress mb-3" style="height: 30px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated 
                             @if ($progress == 100) bg-success
                             @elseif ($progress > 50) bg-info
                             @else bg-warning text-dark
                             @endif" 
                             role="progressbar" style="width: {{ $progress }}%" 
                             aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                            <strong>{{ $progress }}% Selesai</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Rekap Tasks berdasarkan Status (2b)</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Total Tasks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($statusMap as $key => $statusName)
                            <tr>
                                <td>
                                    <span class="badge 
                                        @if ($key == 4) bg-success
                                        @elseif ($key == 1) bg-danger
                                        @elseif ($key == 2) bg-info
                                        @else bg-secondary
                                        @endif">
                                        {{ $statusName }}
                                    </span>
                                </td>
                                <td>
                                    <strong>{{ $taskRecap[$key] ?? 0 }}</strong>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
             <div class="card shadow-sm mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Informasi Dasar</h5>
                </div>
                <div class="card-body">
                    <p><strong>Tanggal Mulai:</strong> {{ $project->start_date }}</p>
                    <p><strong>Tanggal Selesai:</strong> {{ $project->end_date ?? 'Belum Selesai' }}</p>
                    <p><strong>Status Project:</strong> 
                        <span class="badge 
                            @if ($project->status == 3) bg-success
                            @elseif ($project->status == 1) bg-info
                            @else bg-warning
                            @endif">
                            {{ $project->status == 1 ? 'Planning' : ($project->status == 2 ? 'On Progress' : 'Done') }}
                        </span>
                    </p>
                    
                    <hr>
                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning me-2">Edit Project</a>
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('PERINGATAN! Semua Task akan terhapus. Lanjutkan?')">Hapus Project</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <hr class="my-4">

    <h2 class="mb-3">Daftar Tasks ({{ $project->tasks->count() }})</h2>
    
    @forelse ($project->tasks as $task)
        <div class="card mb-2 @if($task->status == 4) border-success @elseif($task->priority == 3) border-danger @endif">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-1">{{ $task->title }}</h6>
                        <p class="card-text text-muted mb-0" style="font-size: 0.9em;">
                            Prioritas: <span class="badge bg-{{ $task->priority == 3 ? 'danger' : ($task->priority == 2 ? 'warning' : 'success') }}">{{ $task->priority }}</span> | 
                            Deadline: {{ $task->deadline ?? 'N/A' }}
                        </p>
                    </div>
                    <div>
                        <span class="badge fs-6 
                            @if ($task->status == 4) bg-success
                            @elseif ($task->status == 1) bg-danger
                            @elseif ($task->status == 2) bg-info
                            @else bg-secondary
                            @endif">
                            {{ $statusMap[$task->status] ?? 'Unknown' }}
                        </span>
                        <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-outline-primary ms-2">Detail</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center">
            Tidak ada Task di Project ini.
        </div>
    @endforelse

@endsection