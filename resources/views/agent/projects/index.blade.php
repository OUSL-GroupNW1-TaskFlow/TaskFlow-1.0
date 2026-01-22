{{--
|--------------------------------------------------------------------------
| Project View
|--------------------------------------------------------------------------
| PURPOSE:
| - Track project status (pending/approved/declined)
| - Project View/ Edit/ Delete
--}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Projects') }}
            </h2>

            {{-- Add Project Button (opens modal) --}}
            <button x-data x-on:click="$dispatch('open-add-project-modal')"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Add Project
            </button>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error Message --}}
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white p-6 rounded shadow">

                {{-- PROJECT LIST AREA --}}

                {{-- Project List Table --}}
                <div class="mt-6">

                    <table class="w-full border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="text-center p-3">Project Title</th>
                                <th class="text-center p-3">Start Date</th>
                                <th class="text-center p-3">End Date</th>
                                <th class="text-center p-3">Priority</th>
                                <th class="text-center p-3">Status</th>
                                <th class="text-center p-3">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($projects as $project)
                                <tr class="border-t">
                                    <td class="p-3 text-center">
                                        <div class="font-medium">{{ $project->title }}</div>
                                        <div class="text-xs text-gray-500">
                                            {{ Str::limit($project->description, 50) }}
                                        </div>
                                    </td>
                                    <td class="p-3 text-center">
                                        {{ $project->expected_start_date->format('M d, Y') }}
                                    </td>
                                    <td class="p-3 text-center">
                                        {{ $project->expected_end_date->format('M d, Y') }}
                                    </td>
                                    <td class="p-3 text-center">
                                        <span
                                            class="px-2 py-1 text-xs rounded
                                            @if ($project->priority === 'high') bg-red-100 text-red-800
                                            @elseif($project->priority === 'medium') bg-yellow-100 text-yellow-800
                                            @else bg-green-100 text-green-800 @endif">
                                            {{ ucfirst($project->priority) }}
                                        </span>
                                    </td>
                                    <td class="p-3 text-center">
                                        @php
                                            $statusLabel = match ($project->status) {
                                                'approved' => 'Approved',
                                                'declined' => 'Declined',
                                                default => 'Pending Approval',
                                            };

                                            $statusClass = match ($project->status) {
                                                'approved' => 'bg-green-100 text-green-800',
                                                'declined' => 'bg-red-100 text-red-800',
                                                default => 'bg-yellow-100 text-yellow-800',
                                            };
                                        @endphp

                                        <span class="px-2 py-1 text-xs rounded {{ $statusClass }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                    <td class="p-3 text-center relative">
                                        <div x-data="{ open: false }" class="inline-block">
                                            <button @click="open = !open"
                                                class="px-2 py-1 rounded hover:bg-gray-200 text-lg font-bold">
                                                •••
                                            </button>

                                            <div x-show="open" @click.outside="open = false"
                                                class="absolute right-0 mt-2 w-32 bg-white border rounded shadow z-50 text-sm">
                                                {{-- View / Load Kanban --}}
                                                <a href="{{ route('agent.projects.kanban', ['project' => $project->id]) }}"
                                                    class="block px-4 py-2 hover:bg-gray-100">
                                                    View
                                                </a>

                                                {{-- Edit --}}
                                                <a href="{{ route('agent.projects.edit', $project->id) }}"
                                                    class="block px-4 py-2 hover:bg-gray-100">
                                                    Edit
                                                </a>

                                                {{-- Delete --}}
                                                <form method="POST"
                                                    action="{{ route('agent.projects.destroy', $project->id) }}"
                                                    onsubmit="return confirm('Are you sure you want to delete this project?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="w-full text-center px-4 py-2 text-red-600 hover:bg-gray-100">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
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
