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

                    {{-- Header with Add Project Button --}}
                    <div class="flex justify-between items-center">
                        <div>
                        <div class="mb-10">
                            <h1 class="text-3xl font-bold text-gray-900 italic">Hi, {{ Auth::user()->name }} 👋</h1>
                            <p class="text-gray-800 font-medium opacity-90">Manage your projects and track progress from here.</p>
                        </div>
                        </div>

                        {{-- Add Project Button --}}
                        <button
                            x-data
                            x-on:click="$dispatch('open-add-project-modal')"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                        >
                            + Add Project
                        </button>
                    </div>

                    <ul class="mt-6 list-disc list-inside text-sm text-gray-700 space-y-1 mb-8">
                        <li>Create new projects</li>
                        <li>View and manage my projects</li>
                        <li>Update Kanban board progress</li>
                    </ul>
                
        {{-- Projects List --}}
        <div class="space-y-6">
            
            {{-- Project Item 1 - In Progress --}}
            <div class="flex items-center justify-between p-4 bg-gray-100 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <div class="flex items-center space-x-4 flex-1">
                    <h3 class="text-base font-medium text-gray-800">
                        Project 1
                    </h3>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="px-4 py-1 bg-blue-100 text-blue-700 text-sm rounded border border-blue-300 font-medium">
                        In Progress
                    </span>
                    <button class="p-1 hover:bg-gray-200 rounded">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Project Item 2 - Done --}}
            <div class="flex items-center justify-between p-4 bg-gray-100 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <div class="flex items-center space-x-4 flex-1">
                    <h3 class="text-base font-medium text-gray-800">
                        Project 2
                    </h3>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="px-4 py-1 bg-green-100 text-green-700 text-sm rounded border border-green-300 font-medium">
                        Done
                    </span>
                    <button class="p-1 hover:bg-gray-200 rounded">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Project Item 3 - Pending --}}
            <div class="flex items-center justify-between p-4 bg-gray-100 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <div class="flex items-center space-x-4 flex-1">
                    <h3 class="text-base font-medium text-gray-800">
                        Project 3
                    </h3>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="px-4 py-1 bg-white text-gray-700 text-sm rounded border border-gray-300">
                        Pending
                    </span>
                    <button class="p-1 hover:bg-gray-200 rounded">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Project Item 4 - Rejected --}}
            <div class="flex items-center justify-between p-4 bg-gray-100 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <div class="flex items-center space-x-4 flex-1">
                    <h3 class="text-base font-medium text-gray-800">
                        Project 4
                    </h3>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="px-4 py-1 bg-red-600 text-white text-sm rounded font-medium">
                        Rejected
                    </span>
                    <button class="p-1 hover:bg-gray-200 rounded">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Project Item 5 - No Status --}}
            <div class="flex items-center justify-between p-4 bg-gray-100 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <div class="flex items-center space-x-4 flex-1">
                    <h3 class="text-base font-medium text-gray-800">
                        Project 5
                    </h3>
                </div>
                <div class="flex items-center space-x-3">
                    <button class="p-1 hover:bg-gray-200 rounded">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                        </svg>
                    </button>
                </div>
            </div>

        </div>

        {{-- Empty State (Show when no projects) --}}
        {{-- Uncomment this when you want to show empty state --}}
        {{--
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No projects</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by creating a new project.</p>
        </div>
        --}}

    </div>
</div>
                    

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

    {{-- Include Add Project Modal --}}
    @include('agent.partials.add-project-modal')
</x-app-layout>