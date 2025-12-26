{{-- 
|--------------------------------------------------------------------------
| Admin Dashboard
|--------------------------------------------------------------------------
| PURPOSE:
| - Dashboard for ADMIN role
| - Admin manages Agents and Projects
|
| TEAM INSTRUCTIONS:
| - Edit ONLY inside <div class="dashboard-content">
| - Do NOT touch role logic
|--------------------------------------------------------------------------
--}}

<x-app-layout>
    {{-- Page Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    {{-- Page Content --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Dashboard Card --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dashboard-content">

                    {{-- TODO (TEAM): Build Admin dashboard UI here --}}
                    <p><strong>Welcome Admin</strong></p>

                    <ul class="mt-4 list-disc list-inside text-sm text-gray-700">
                        <li>View Agents list</li>
                        <li>Create new Agents</li>
                        <li>Review & approve projects</li>
                        <li>Comment on Kanban boards</li>
                    </ul>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
