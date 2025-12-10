<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::withCount('tasks')->get();

        foreach ($projects as $project) {
        
        // 1. Hitung Overdue Tasks 
        $overdueCount = $project->tasks()
            ->where('deadline', '<', now()) 
            ->where('status', '<', 4)      
            ->count();
        $project->overdue_tasks = $overdueCount; 

        // 2. Hitung Progress (2c) 
        $totalTasks = $project->tasks_count;
        $doneTasks = $project->tasks()->where('status', 4)->count();
        $progress = ($totalTasks > 0) ? round(($doneTasks / $totalTasks) * 100, 2) : 0;
        $project->progress = $progress; 

        // 3. FUNGSI 2e: Tentukan Project Bermasalah 
        $project->is_problematic = (
            $overdueCount > 0 && // Kriteria 1: Ada overdue task
            $progress < 50       // Kriteria 2: Progress di bawah 50%
        );
    }

    return view('projects.index', compact('projects'));    }

    public function create()
    {
       return view('projects.create');
    }

    public function store(Request $request)
    {
       $request->validate([
        'name' => 'required|string|max:255',
        'start_date' => 'required|date',

    ]);

    Project::create([
        'name' => $request->name,
        'start_date' => $request->start_date,
        'status' => 1, // Default status: Planning
    ]);

    return redirect()->route('projects.index')->with('success', 'Project berhasil ditambahkan!');
    }

    public function show(Project $project)
    {
     // FUNGSI 2b: Rekap jumlah task berdasarkan status per project 
    $taskRecap = Task::select('status', DB::raw('count(*) as total'))
        ->where('project_id', $project->id)
        ->groupBy('status')
        ->orderBy('status')
        ->pluck('total', 'status')
        ->all();

    // Mapping Status 
    $statusMap = [
        1 => 'Todo',
        2 => 'Doing',
        3 => 'Review',
        4 => 'Done',
    ];

    // FUNGSI 2c: Progress project (persentase task Done) 
    $totalTasks = $project->tasks()->count();
    $doneTasks = $project->tasks()->where('status', 4)->count();
    $progress = ($totalTasks > 0) ? round(($doneTasks / $totalTasks) * 100, 2) : 0;
    
    return view('projects.show', compact('project', 'taskRecap', 'statusMap', 'progress'));
    }


    public function edit(Project $project)
    {
       return view('projects.edit', compact('project'));
    }


    public function update(Request $request, Project $project)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date',
        'status' => 'required|integer|min:1|max:3', // Status 1=Planning, 3=Done
    ]);

    $project->update($request->all());

    return redirect()->route('projects.index')->with('success', 'Project berhasil diupdate!');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project berhasil dihapus!');
    }
}
