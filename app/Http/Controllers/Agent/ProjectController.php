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
     * - Allow Agent to view/edit their submitted projects
     */
    public function index(Request $request)
    {

        // Fetch only projects created by the logged-in agent
        $projects = Project::where('agent_id', Auth::id())
            ->latest()
            ->get();

        $selectedProject = null;

        if ($request->has('project')) {
            $selectedProject = Project::where('agent_id', Auth::id())
                ->where('id', $request->project)
                ->firstOrFail();
        }

        return view('agent.projects.index', compact('projects', 'selectedProject'));
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
            ->route('agent.dashboard')
            ->with('success', 'Project created successfully and sent for review');
    }

    public function destroy(Project $project)
    {
        // Security: ensure agent owns the project
        if ($project->agent_id !== Auth::id()) {
            abort(403);
        }

        $project->delete();

        return redirect()
            ->route('agent.projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    public function edit(Project $project)
    {
        if ($project->agent_id !== Auth::id()) {
            abort(403);
        }

        return view('agent.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        if ($project->agent_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'expected_start_date' => 'required|date',
            'expected_end_date' => 'required|date|after_or_equal:expected_start_date',
            'priority' => 'required|in:low,medium,high',
        ]);

        $project->update($request->only('title', 'description', 'expected_start_date', 'expected_end_date', 'priority'));

        return redirect()
            ->route('agent.projects.index')
            ->with('success', 'Project updated successfully.');
    }
}
