<?php

namespace App\Http\Controllers\Agent;

use App\Models\TaskFile;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskFileController extends Controller
{
    public function destroy(TaskFile $file)
    {
        if ($file->task->project->agent_id !== Auth::id()) abort(403);

        if (Storage::disk('public')->exists($file->file_path)) {
            Storage::disk('public')->delete($file->file_path);
        }

        $file->delete();

        return back()->with('success', 'File removed!');
    }

    public function destroyAll(Task $task)
    {
        foreach ($task->files as $file) {
            if (Storage::disk('public')->exists($file->file_path)) {
                Storage::disk('public')->delete($file->file_path);
            }
            $file->delete();
        }

        return back()->with('success', 'All files deleted successfully.');
    }

    public function download(TaskFile $file)
    {
        // Authorization check
        if ($file->task->project->agent_id !== Auth::id()) {
            abort(403);
        }

        $path = storage_path('app/public/' . $file->file_path);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path, $file->original_name);
    }
}
