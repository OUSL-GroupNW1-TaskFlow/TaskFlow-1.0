{{-- 
|--------------------------------------------------------------------------
| Agent Dashboard
|--------------------------------------------------------------------------
| PURPOSE:
| - Dashboard for AGENT role
| - Agent creates and manages own projects
|
| TEAM INSTRUCTIONS:
| - Edit ONLY inside <div class="dashboard-content">
| - Keep structure unchanged
|--------------------------------------------------------------------------
--}}

<x-app-layout>
    {{-- Page Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Agent Dashboard
        </h2>
    </x-slot>

    {{-- Page Content --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Dashboard Card --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dashboard-content">

                    {{-- TODO (TEAM): Agent UI goes here --}}

                    <p class="text-lg font-semibold">
                        Welcome, Agent 👋
                    </p>

                    <p class="mt-2 text-sm text-gray-600">
                        Manage your projects and track progress from here.
                    </p>

                    <ul class="mt-6 list-disc list-inside text-sm text-gray-700 space-y-1">
                        <li>Create new projects</li>
                        <li>View and manage my projects</li>
                        <li>Update Kanban board progress</li>
                    </ul>

                    {{-- Future placeholders --}}
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="p-4 border rounded text-center text-sm text-gray-600">
                            My Projects<br>
                            <span class="text-xl font-bold">0</span>
                        </div>

                        <div class="p-4 border rounded text-center text-sm text-gray-600">
                            Active Tasks<br>
                            <span class="text-xl font-bold">0</span>
                        </div>

                        <div class="p-4 border rounded text-center text-sm text-gray-600">
                            Completed Tasks<br>
                            <span class="text-xl font-bold">0</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
