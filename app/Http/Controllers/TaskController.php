<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    
    public function index(Request $request)
    {
        $projects = Project::pluck('name', 'id'); 
        $selectedProject = $request->project_id;

        // Filter tasks berdasarkan project_id jika ada
        $tasks = Task::when($selectedProject, function ($query, $selectedProject) {
        return $query->where('project_id', $selectedProject);
        })->get();
    
        return view('tasks.index', compact('tasks', 'projects', 'selectedProject'));
    }

  
    public function create()
    {
        // Kirim data projects agar bisa memilih Project mana yang memiliki Task ini
        $projects = Project::all();
        return view('tasks.create', compact('projects'));
    }


    public function store(Request $request)
    {
            $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|integer|min:1|max:3', // 1=Low, 3=High
            'deadline' => 'nullable|date',
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task berhasil ditambahkan!');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $projects = Project::all();
        return view('tasks.edit', compact('task', 'projects'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
        'project_id' => 'required|exists:projects,id',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'priority' => 'required|integer|min:1|max:3',
        'deadline' => 'nullable|date',
        'status' => 'required|integer|min:1|max:4', // Tambah validasi Status (1-4)
    ]);

    $task->update($request->all());

    return redirect()->route('tasks.index')->with('success', 'Task berhasil diupdate!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task berhasil dihapus.');
    }
}
