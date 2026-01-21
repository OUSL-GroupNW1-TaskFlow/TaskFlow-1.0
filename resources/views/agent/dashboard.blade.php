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
                                <p class="text-gray-800 font-medium opacity-90">Manage your projects and track progress
                                    from here.</p>
                            </div>
                        </div>

                        {{-- Add Project Button --}}
                        <button x-data x-on:click="$dispatch('open-add-project-modal')"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            + Add Project
                        </button>
                    </div>

                    {{-- Projects List --}}
                    <div class="space-y-6">

                        @forelse ($projects as $project)
                            <div
                                class="flex items-center justify-between p-4 bg-gray-100 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                <div class="flex items-center space-x-4 flex-1">
                                    <h3 class="text-base font-medium text-gray-800">
                                        {{ $project->title }}
                                    </h3>
                                </div>

                                <div class="flex items-center space-x-3">
                                    @php
                                        $statusLabel = match ($project->status) {
                                            'approved' => 'Approved',
                                            'declined' => 'Declined',
                                            default => 'Pending Approval',
                                        };

                                        $statusClass = match ($project->status) {
                                            'approved' => 'bg-green-100 text-green-800 border-green-300',
                                            'declined' => 'bg-red-600 text-white border-red-600',
                                            default => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                                        };
                                    @endphp

                                    <span class="px-4 py-1 text-sm rounded border font-medium {{ $statusClass }}">
                                        {{ $statusLabel }}
                                    </span>
                                    <a href="{{ route('agent.projects.index', $project->id) }}"
                                        class="p-4 hover:bg-gray-200 rounded">
                                        ⋮
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 text-gray-500">
                                No projects yet. Click <strong>+ Add Project</strong> to start.
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>


            {{-- Future placeholders --}}
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="p-4 border rounded text-center text-sm text-gray-600">
                    My Projects<br>
                    <span class="text-xl font-bold">{{ $stats['projects'] ?? 0 }}</span>
                </div>

                <div class="p-4 border rounded text-center text-sm text-gray-600">
                    Active Tasks<br>
                    <span class="text-xl font-bold">{{ $stats['active_tasks'] ?? 0 }}</span>
                </div>

                <div class="p-4 border rounded text-center text-sm text-gray-600">
                    Completed Tasks<br>
                    <span class="text-xl font-bold">{{ $stats['completed_tasks'] ?? 0 }}</span>
                </div>
            </div>

        </div>
    </div>

    </div>
    </div>

    {{-- Include Add Project Modal --}}
    @include('agent.partials.add-project-modal')
</x-app-layout>
