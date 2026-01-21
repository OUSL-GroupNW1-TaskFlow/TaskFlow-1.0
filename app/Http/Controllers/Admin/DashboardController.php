<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $agents = User::role('agent')
            ->withCount([
                'projects as pending_projects_count' => function ($q) {
                    $q->where('status', 'pending');
                }
            ])->get();

        return view('admin.dashboard', compact('agents'));
    }
}