<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //FUNGSI 2d: Statistik task selesai (Done) per bulan
    public function taskStatistics()
    {
        // Query untuk menghitung jumlah task yang statusnya 4 (Done) per bulan dan tahun
            $monthlyStats = Task::select(
                DB::raw('MONTH(updated_at) as month'),
                DB::raw('YEAR(updated_at) as year'),
                DB::raw('count(*) as total_done')
            )
            ->where('status', 4) // Hanya Task yang DONE
            // updated_at digunakan karena status Task selesai tercatat saat Task diupdate ke status 4
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('reports.monthly_done', compact('monthlyStats'));
    }

}
