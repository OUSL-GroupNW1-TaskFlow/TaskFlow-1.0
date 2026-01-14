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

            {{-- Add User Button --}}
            <button
                x-data
                x-on:click="$dispatch('open-add-user-modal')"
                class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 transition">
                            + Add User
            </button>
        </div>
    </x-slot>
    
             {{-- Page Content --}}
    <div class="py-6 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
       
            <div class="bg-white p-6 rounded shadow">

                {{-- USER LIST AREA --}}
                {{-- NOTE FOR TEAM:
                   Each row represents a user.
                   Replace static rows with @foreach later.
                --}}

                {{-- User List Table --}}
                          
<div class="mt-6 overflow-x-auto">

    <table class="w-full border">
        <thead class=" border-b sticky top-0 z-10">
            <tr >
                <th class="text-left p-3 text-sm font-semibold text-gray-1">Name</th>
                <th class="text-left p-3 text-sm font-semibold text-gray-1000">Email</th>
                <th class="text-left p-3 text-sm font-semibold text-gray-1000">Role</th>
                <th class="text-center p-3 text-sm font-semibold text-gray-1000">Actions</th>

            </tr>
        </thead>

        <tbody>
            @forelse($users as $user)
                <tr class="hover:bg-gray-200 transition border-l-4 border-transparent hover:border-indigo-500">
                    <td class="p-3">{{ $user->name }}</td>
                    <td class="p-3">{{ $user->email }}</td>
                     <td class="p-3">
                                        @php  $role = $user->roles->first()?->name; @endphp
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                            {{ $role === 'Admin'
                                                ? 'bg-indigo-100 text-indigo-700'
                                                : 'bg-blue-100 text-blue-700' }}">
                                            {{ $role ?? '—' }}
                                        </span>
                                    </td>
                                                 <td class="p-3 text-center">
                                        <div x-data="{ open: false }" class="relative inline-block">
                                            {{-- 3-dot Button --}}
                                            <button
                                                @click="open = !open"
                                                class="p-2 rounded-full hover:bg-gray-100 relative"
                                            >
                                                ...
                                            </button>

                                            {{-- Dropdown Menu --}}
                                            <div
                                                x-show="open"
                                                @click.outside="open = false"
                                                x-transition
                                                class="absolute right-0 mt-2 w-32 bg-white border rounded-lg shadow-lg z-50"
                                            >
                                                <ul class="py-1 text-sm text-gray-700">
                                                    <li>
                                                        {{-- Edit button --}}
                                                        <button class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                                            ✏️ Edit
                                                        </button>
                                                    </li>
                                                    <li>
                                                        {{-- Delete button --}}
                                                        <button class="w-full text-left px-4 py-2 hover:bg-red-50 text-red-600">
                                                             🗑 Delete
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            {{-- Empty State --}}
                            @empty
                                <tr>
                                    <td colspan="4" class="p-4 text-center text-gray-500">
                                        <div class="text-gray-400">
                                            <p class="text-lg font-semibold">No users found</p>
                                        </div>
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


