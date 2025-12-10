@extends('layouts.app')

@section('title', 'Statistik Task Selesai per Bulan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Statistik Task Selesai (Done) per Bulan (2d)</h1>
    </div>
    
    <p class="lead">Laporan ini menampilkan jumlah Task yang telah diselesaikan (Status Done / 4) yang dikelompokkan berdasarkan bulan dan tahun.</p>
    <hr>

    @if ($monthlyStats->isEmpty())
        <div class="alert alert-info text-center">
            Belum ada Task yang diselesaikan (Status 4) untuk dilaporkan.
        </div>
    @else
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Data Task Selesai</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Tahun</th>
                            <th>Bulan</th>
                            <th>Total Task Done</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($monthlyStats as $stat)
                        <tr>
                            <td>{{ $stat->year }}</td>
                            <td>
                                {{ DateTime::createFromFormat('!m', $stat->month)->format('F') }}
                            </td>
                            <td>
                                <span class="badge bg-success fs-6">{{ $stat->total_done }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection