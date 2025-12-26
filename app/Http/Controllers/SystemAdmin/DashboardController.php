<?php

namespace App\Http\Controllers\SystemAdmin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('system_admin.dashboard');
    }
}