<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class KanbanController extends Controller
{
    public function show(Project $project)
    {
        // Security: allow only owner agent
        if ($project->agent_id !== Auth::id()) {
            abort(403);
        }

        // Block only declined projects
        if ($project->status === 'declined') {
            return redirect()
                ->route('agent.projects.index')
                ->with('error', 'This project was declined and cannot be managed.');
        }

        $todo = $project->tasks()->with('comments.admin')->where('status', 'todo')->orderBy('position')->get();
        $inProgress = $project->tasks()->with('comments.admin')->where('status', 'in_progress')->orderBy('position')->get();
        $done = $project->tasks()->with('comments.admin')->where('status', 'done')->orderBy('position')->get();

        return view('agent.projects.kanban.show', compact('project', 'todo', 'inProgress', 'done'));
    }
}
