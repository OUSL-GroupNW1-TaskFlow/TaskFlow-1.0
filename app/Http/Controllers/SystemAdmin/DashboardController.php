<?php

namespace App\Http\Controllers\SystemAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;

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

        return view('system_admin.dashboard', compact('agents'));
    }
}
