{{--
|--------------------------------------------------------------------------
| User Management
|--------------------------------------------------------------------------
| PURPOSE:
| - View all users (Agents + Admins)
| - Add new users
| - Perform actions (edit / delete later)
|
| DESIGN BASED ON:
| - Provided wireframe (Admin User Management)
|
| TODO (UI TEAM):
| - Style user list rows
| - Implement dropdown actions (⋮)
| - Improve spacing & responsiveness
|
--}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User Management') }}
            </h2>

            {{-- Add User Button (opens modal) --}}
            <button
                x-data
                x-on:click="$dispatch('open-add-user-modal')"
                class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300"
            >
                + Add User
            </button>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 rounded shadow">

                {{-- USER LIST AREA --}}
                {{-- NOTE FOR TEAM:
                   Each row represents a user.
                   Replace static rows with @foreach later.
                --}}

                {{-- User List Table --}}
<div class="mt-6">

    <table class="w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="text-left p-3">Name</th>
                <th class="text-left p-3">Email</th>
                <th class="text-left p-3">Role</th>
                <th class="text-center p-3">Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($users as $user)
                <tr class="border-t">
                    <td class="p-3">{{ $user->name }}</td>
                    <td class="p-3">{{ $user->email }}</td>
                    <td class="p-3">
                        {{ $user->roles->first()?->name ?? '—' }}
                    </td>
                    <td class="p-3 text-center">
                        {{-- TODO: Edit / Delete --}}
                        •••
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">
                        No users found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

            </div>

        </div>
    </div>

    {{-- Include Add User Modal --}}
    @include('admin.users.partials.add-user-modal')

</x-app-layout>