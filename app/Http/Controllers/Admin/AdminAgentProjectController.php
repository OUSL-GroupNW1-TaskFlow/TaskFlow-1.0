<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAgentProjectController extends Controller
{
    public function index(User $agent)
    {
        if (!$agent->hasRole('agent')) {
            abort(403, 'User is not an agent');
        }

        $projects = $agent->projects()->latest()->get();

        return view('admin.projects.index', compact('agent', 'projects'));
    }
}
