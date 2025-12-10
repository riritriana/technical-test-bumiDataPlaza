<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController; 
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ReportController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('projects.index');
});

Route::resource('projects', ProjectController::class);
Route::resource('tasks', TaskController::class);
Route::get('reports/monthly-done', [ReportController::class, 'taskStatistics'])->name('reports.monthly_done');
