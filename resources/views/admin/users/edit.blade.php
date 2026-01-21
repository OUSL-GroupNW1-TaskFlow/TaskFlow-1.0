<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit User
        </h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">

            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Role</label>
                    <select name="role" class="w-full border rounded px-3 py-2">
                        <option value="admin" @selected($user->hasRole('admin'))>
                            Admin
                        </option>
                        <option value="agent" @selected($user->hasRole('agent'))>
                            Agent
                        </option>
                    </select>
                </div>

                <div class="flex justify-end gap-2">
                    <a href="{{ route('admin.users.index') }}" class="px-4 py-2 border rounded">
                        Cancel
                    </a>

                    <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Save Changes
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
