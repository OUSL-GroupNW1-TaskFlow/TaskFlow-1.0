{{--
|--------------------------------------------------------------------------
| Project Management
|--------------------------------------------------------------------------
| PURPOSE:
| - View all projects created by agent
| - Add new projects
| - Track project status (pending/approved/declined)
|
| DESIGN BASED ON:
| - Admin User Management wireframe structure
|
| TODO (UI TEAM):
| - Style project list rows
| - Implement dropdown actions (⋮)
| - Improve spacing & responsiveness
| - Add status badges with colors
|
--}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Projects') }}
            </h2>

            {{-- Add Project Button (opens modal) --}}
            <button
                x-data
                x-on:click="$dispatch('open-add-project-modal')"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
            >
                + Add Project
            </button>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 rounded shadow">

                {{-- PROJECT LIST AREA --}}
                {{-- NOTE FOR TEAM:
                   Each row represents a project.
                   Status will show pending/approved/declined.
                --}}

                {{-- Project List Table --}}
                <div class="mt-6">

                    <table class="w-full border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="text-left p-3">Project Title</th>
                                <th class="text-left p-3">Start Date</th>
                                <th class="text-left p-3">End Date</th>
                                <th class="text-left p-3">Priority</th>
                                <th class="text-left p-3">Status</th>
                                <th class="text-center p-3">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($projects as $project)
                                <tr class="border-t">
                                    <td class="p-3">
                                        <div class="font-medium">{{ $project->title }}</div>
                                        <div class="text-xs text-gray-500">
                                            {{ Str::limit($project->description, 50) }}
                                        </div>
                                    </td>
                                    <td class="p-3">
                                        {{ $project->expected_start_date->format('M d, Y') }}
                                    </td>
                                    <td class="p-3">
                                        {{ $project->expected_end_date->format('M d, Y') }}
                                    </td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 text-xs rounded
                                            @if($project->priority === 'high') bg-red-100 text-red-800
                                            @elseif($project->priority === 'medium') bg-yellow-100 text-yellow-800
                                            @else bg-green-100 text-green-800
                                            @endif">
                                            {{ ucfirst($project->priority) }}
                                        </span>
                                    </td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 text-xs rounded
                                            @if($project->status === 'approved') bg-green-100 text-green-800
                                            @elseif($project->status === 'declined') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($project->status) }}
                                        </span>
                                    </td>
                                    <td class="p-3 text-center">
                                        {{-- TODO: Edit / Delete / View --}}
                                        •••
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-4 text-center text-gray-500">
                                        No projects found. Click "Add Project" to create your first project.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </div>

    {{-- Include Add Project Modal --}}
    @include('agent.partials.add-project-modal')

</x-app-layout>