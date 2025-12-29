<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * User Management Page
     * --------------------
     * PURPOSE:
     * - List Agents & Admins
     * - Allow Admin/System Admin to manage users
     *
     * NOTE FOR TEAM:
     * - UI implementation happens in:
     *   resources/views/admin/users/index.blade.php
     * - Business logic will be added later
     */
    public function index()
    {
        // NOTE FOR TEAM:
        // This will fetch users later with filters
        $users = User::with('roles')->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Store new user
     * --------------------------
     * Handles Add User form submission
     */
    
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,agent',
        ]);

        // Create user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign role (Spatie)
        $user->assignRole($request->role);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully');
    }
}