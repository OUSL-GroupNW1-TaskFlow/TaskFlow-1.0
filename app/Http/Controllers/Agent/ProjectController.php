<?php

namespace App\Http\Controllers\Agent;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Project Management Page
     * --------------------
     * PURPOSE:
     * - List Agent's Projects
     * - Allow Agent to view their submitted projects
     *
     * NOTE FOR TEAM:
     * - UI implementation happens in:
     *   resources/views/agent/projects/index.blade.php
     * - Shows all projects created by logged-in agent
     */
    public function index()
    {
        // NOTE FOR TEAM:
        // Fetch only projects created by the logged-in agent
        $projects = Project::where('agent_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('agent.projects.index', compact('projects'));
    }

    /**
     * Store new project
     * --------------------------
     * Handles Add Project form submission
     */
    
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'title'               => 'required|string|max:255',
            'description'         => 'required|string',
            'expected_start_date' => 'required|date|after_or_equal:today',
            'expected_end_date'   => 'required|date|after:expected_start_date',
            'priority'            => 'required|in:low,medium,high',
        ]);

        // Create project
        $project = Project::create([
            'title'               => $request->title,
            'description'         => $request->description,
            'expected_start_date' => $request->expected_start_date,
            'expected_end_date'   => $request->expected_end_date,
            'priority'            => $request->priority,
            'status'              => 'pending',
            'agent_id'            => Auth::id(),
        ]);

        return redirect()
            ->route('agent.projects.index')
            ->with('success', 'Project created successfully and sent for review');
    }
}