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
--}}

<x-app-layout>
    <x-slot name="header">

        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User Management') }}
            </h2>

            {{-- Add User Button --}}
            <button x-data x-on:click="$dispatch('open-add-user-modal')"
                class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 transition">
                + Add User
            </button>
        </div>
    </x-slot>

    {{-- Page Content --}}
    <div class="py-6 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 rounded shadow" x-data="userFilters()">

                <div class="mb-4 flex flex-wrap gap-3 items-center">

                    {{-- Search --}}
                    <input type="text" placeholder="Search name or email..." x-model="search"
                        class="border rounded-lg px-3 py-2 w-64 focus:ring focus:ring-indigo-200">

                    {{-- Role Filter --}}
                    <select x-model="role" class="border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-200">
                        <option value="">All Roles</option>
                        <option value="system_admin">System Admin</option>
                        <option value="admin">Admin</option>
                        <option value="agent">Agent</option>
                    </select>

                    {{-- Clear --}}
                    <button @click="clear()" class="text-sm px-3 py-2 border rounded-lg hover:bg-gray-100">
                        Clear
                    </button>

                </div>

                {{-- USER LIST AREA --}}

                {{-- User List Table --}}

                <div class="mt-6 overflow-auto max-h-[500px] relative">

                    <table class="w-full border">
                        <thead class="border-b sticky top-0 z-10 bg-white shadow-sm">
                            <tr>
                                <th class="text-left p-3 text-sm font-semibold text-gray-1">Name</th>
                                <th class="text-left p-3 text-sm font-semibold text-gray-1000">Email</th>
                                <th class="text-left p-3 text-sm font-semibold text-gray-1000">Role</th>
                                <th class="text-center p-3 text-sm font-semibold text-gray-1000">Actions</th>

                            </tr>
                        </thead>

                        <tbody>
                            @forelse($users as $user)
                                <tr x-show="matches('{{ $user->name }}', '{{ $user->email }}', '{{ $user->roles->first()?->name }}')"
                                    class="hover:bg-gray-200 transition border-l-4 border-transparent hover:border-indigo-500">
                                    <td class="p-3">{{ $user->name }}</td>
                                    <td class="p-3">{{ $user->email }}</td>
                                    <td class="p-3">
                                        @php  $role = $user->roles->first()?->name; @endphp
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold
                                            @if ($role === 'system_admin') bg-red-100 text-red-700
                                            @elseif ($role === 'admin')
                                                    bg-indigo-100 text-indigo-700
                                            @elseif ($role === 'agent')
                                                    bg-blue-100 text-blue-700
                                            @else
                                                    bg-gray-100 text-gray-600 @endif
                                            ">
                                            {{ $role ?? '—' }}
                                        </span>
                                    </td>
                                    <td class="p-3 text-center">
                                        <div x-data="{ open: false }" class="relative inline-block">
                                            {{-- 3-dot Button --}}
                                            <button @click="open = !open"
                                                class="p-2 rounded-full hover:bg-gray-100 relative">
                                                ...
                                            </button>

                                            {{-- Dropdown Menu --}}
                                            <div x-show="open" @click.outside="open = false" x-transition
                                                :class="open
                                                    ?
                                                    'opacity-100 scale-100' :
                                                    'opacity-0 scale-95'"
                                                class="absolute right-0 z-50 w-32 bg-white border rounded-lg shadow-lg
                                                      bottom-full mb-2 origin-bottom-right">
                                                <ul class="py-1 text-sm text-gray-700">
                                                    @php
                                                        $current = auth()->user();
                                                        $currentIsSystemAdmin = $current->hasRole('system_admin');
                                                        $currentIsAdmin = $current->hasRole('admin');

                                                        $targetIsSystemAdmin = $user->hasRole('system_admin');
                                                        $isSelf = $user->id === $current->id;

                                                        $canManage =
                                                            $currentIsSystemAdmin ||
                                                            ($currentIsAdmin && !$targetIsSystemAdmin && !$isSelf);
                                                    @endphp

                                                    @if ($canManage)
                                                        <li>
                                                            {{-- Edit --}}
                                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                                class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                                                                ✏️ Edit
                                                            </a>
                                                        </li>

                                                        <li>
                                                            {{-- Delete --}}
                                                            <form method="POST"
                                                                action="{{ route('admin.users.destroy', $user->id) }}"
                                                                onsubmit="return confirm('Delete this user?')">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button
                                                                    class="w-full text-left px-4 py-2 hover:bg-red-50 text-red-600">
                                                                    🗑 Delete
                                                                </button>
                                                            </form>
                                                        </li>
                                                    @endif
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

    <script>
        function userFilters() {
            return {
                search: '',
                role: '',

                matches(name, email, role) {
                    const q = this.search.toLowerCase();

                    const matchesSearch =
                        name.toLowerCase().includes(q) ||
                        email.toLowerCase().includes(q);

                    const matchesRole =
                        this.role === '' ||
                        role === this.role;

                    return matchesSearch && matchesRole;
                },

                clear() {
                    this.search = '';
                    this.role = '';
                }
            }
        }
    </script>

</x-app-layout>
