<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class AdminProjectController extends Controller
{
    public function approve(Project $project)
    {
        $project->update(['status' => 'approved']);
        return back()->with('success', 'Project approved');
    }

    public function decline(Project $project)
    {
        $project->update(['status' => 'declined']);
        return back()->with('success', 'Project declined');
    }
}
