<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Project;
use App\Models\TaskFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function store(Request $request, Project $project)
    {
        // Security: only project owner can add tasks
        if ($project->agent_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $position = Task::where('project_id', $project->id)
            ->where('status', 'todo')
            ->max('position') + 1;

        Task::create([
            'project_id' => $project->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'status' => 'todo',         // always start in To Do
            'position' => $position,
            'priority' => $request->priority ?? 'medium',
            'created_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Task added successfully!');
    }

    public function destroy(Task $task)
    {
        if ($task->project->agent_id !== Auth::id()) {
            abort(403);
        }

        if ($task->file_path && Storage::disk('public')->exists($task->file_path)) {
            Storage::disk('public')->delete($task->file_path);
        }

        $task->delete();

        return redirect()->back()->with('success', 'Task deleted!');
    }

    public function move(Request $request, Task $task)
    {
        // Security: only owner agent can move tasks
        if ($task->project->agent_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:todo,in_progress,done',
            'position' => 'required|integer|min:0',
        ]);

        Task::where('project_id', $task->project_id)
            ->where('status', $validated['status'])
            ->where('id', '!=', $task->id)
            ->where('position', '>=', $validated['position'])
            ->increment('position');

        $task->update([
            'status' => $validated['status'],
            'position' => $validated['position'],
        ]);

        return response()->json(['success' => true]);
    }

    public function show(Task $task)
    {
        if ($task->project->agent_id !== Auth::id()) abort(403);
        return response()->json($task);
    }

    public function update(Request $request, Task $task)
    {
        if ($task->project->agent_id !== Auth::id()) abort(403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'files.*' => 'nullable|file|max:5120|mimes:pdf,doc,docx,xls,xlsx,png,jpg,jpeg', // 5MB
        ]);

        // Handle file upload
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('task_files', 'public');

                TaskFile::create([
                    'task_id' => $task->id,
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize(),
                ]);
            }
        }

        $task->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],
        ]);

        return redirect()->back()->with('success', 'Task updated successfully!');
    }

    public function deleteFile(Task $task)
    {
        if ($task->project->agent_id !== Auth::id()) abort(403);

        if ($task->file_path && Storage::disk('public')->exists($task->file_path)) {
            Storage::disk('public')->delete($task->file_path);
        }

        $task->update(['file_path' => null]);

        return redirect()->back()->with('success', 'File removed successfully!');
    }
}
