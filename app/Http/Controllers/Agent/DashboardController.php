<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $agent = Auth::user();

        // Agent's projects
        $projects = Project::where('agent_id', $agent->id)
            ->latest()
            ->get();

        // Collect project IDs for task queries
        $projectIds = $projects->pluck('id');

        // Stats
        $stats = [
            'projects' => $projects->count(),

            'active_tasks' => Task::whereIn('project_id', $projectIds)
                ->whereIn('status', ['todo', 'in_progress'])
                ->count(),

            'completed_tasks' => Task::whereIn('project_id', $projectIds)
                ->where('status', 'done')
                ->count(),
        ];

        return view('agent.dashboard', compact('projects', 'stats'));
    }
}
