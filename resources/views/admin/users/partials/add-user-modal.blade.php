{{--
|--------------------------------------------------------------------------
| Add User Modal
|--------------------------------------------------------------------------
| PURPOSE:
| - Allow Admin/System Admin to create new users
|
| FIELDS (FINAL VERSION):
| - Name
| - Email
| - Role (Admin / Agent)
| - Password
|
| TODO (UI TEAM):
| - Improve modal styling
| - Add validation messages
| - Add animations
|
--}}

<div
    x-data="{ open: false }"
    x-on:open-add-user-modal.window="open = true"
    x-show="open"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
    style="display: none;"
>

    {{-- Modal Box --}}
    <div class="bg-white w-full max-w-md rounded shadow-lg p-6">

        {{-- Modal Header --}}
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">
                Add New User
            </h3>

            <button
                x-on:click="open = false"
                class="text-gray-500 hover:text-black"
            >
                ✕
            </button>
        </div>

         {{-- Add User Form --}}
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            {{-- User Name --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Name</label>
                <input
                    type="text"
                    name="name"
                    class="w-full border rounded px-3 py-2"
                    placeholder="Enter full name"
                >
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Email</label>
                <input
                    type="email"
                    name="email"
                    class="w-full border rounded px-3 py-2"
                    placeholder="Enter email address"
                >
            </div>

            {{-- Role --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Role</label>
                <select
                    name="role"
                    class="w-full border rounded px-3 py-2"
                >
                    <option value="">Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="agent">Agent</option>
                </select>
            </div>

            {{-- Password --}}
            <div class="mb-6">
                <label class="block text-sm font-medium mb-1">Password</label>
                <input
                    type="password"
                    name="password"
                    class="w-full border rounded px-3 py-2"
                >
            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-2">
                <button
                    type="button"
                    x-on:click="open = false"
                    class="px-4 py-2 bg-gray-200 rounded"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded"
                >
                    Create User
                </button>
            </div>

        </form>

    </div>
</div>