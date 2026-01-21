<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class AdminKanbanController extends Controller
{
    public function show(Project $project)
    {
        $todo = $project->tasks()->with('files', 'comments.admin')->where('status', 'todo')->orderBy('position')->get();
        $inProgress = $project->tasks()->with('files', 'comments.admin')->where('status', 'in_progress')->orderBy('position')->get();
        $done = $project->tasks()->with('files', 'comments.admin')->where('status', 'done')->orderBy('position')->get();

        return view('admin.projects.kanban', compact('project', 'todo', 'inProgress', 'done'));
    }
}
