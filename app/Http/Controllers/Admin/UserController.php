<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * User Management Page
     * --------------------
     * PURPOSE:
     * - List Agents & Admins
     * - Allow Admin/System Admin to manage users
     */
    public function index()
    {
        // NOTE FOR TEAM:
        // This will fetch users later with filters
        $users = User::with('roles')->get();

        return view('admin.users.index', compact('users'));
    }

    protected function authorizeUserAction(User $target)
    {
        /** @var \App\Models\User $current */
        $current = Auth::user();

        // System Admin can modify anyone
        if ($current->hasRole('system_admin')) {
            return;
        }

        // Admin rules
        if ($current->hasRole('admin')) {

            // Admin cannot modify system admin
            if ($target->hasRole('system_admin')) {
                abort(403, 'You cannot modify a system admin.');
            }

            // Admin cannot modify self
            if ($target->id === $current->id) {
                abort(403, 'You cannot modify your own account.');
            }

            return;
        }

        abort(403);
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

    public function edit(User $user)
    {
        $this->authorizeUserAction($user);

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorizeUserAction($user);

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|in:admin,agent',
        ]);
        $user->update([
            'name'  => $validated['name'],
            'email' => $validated['email'],
        ]);
        // Sync role
        $user->syncRoles([$validated['role']]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated.');
    }

    public function destroy(User $user)
    {
        $this->authorizeUserAction($user);

        $user->delete();
        return back()->with('success', 'User deleted.');
    }
}
