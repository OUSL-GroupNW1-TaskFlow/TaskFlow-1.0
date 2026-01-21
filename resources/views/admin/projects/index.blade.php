<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    {{-- Page Header --}}
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Agent Projects
            </h2>
        </div>
    </x-slot>

    <div class="mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

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

                        <td class="p-3 text-center">
                            <div class="flex gap-2 justify-center">

                                @if ($project->status === 'pending')
                                    <form method="POST" action="{{ route('admin.projects.approve', $project) }}">
                                        @csrf
                                        <button
                                            class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-3 py-1 text-sm rounded shadow">
                                            Approve
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('admin.projects.decline', $project) }}">
                                        @csrf
                                        <button
                                            class="bg-red-600 hover:bg-red-700 text-white font-semibold px-3 py-1 text-sm rounded shadow">
                                            Decline
                                        </button>
                                    </form>
                                @endif

                                <a href="{{ route('admin.projects.kanban', $project) }}"
                                    class="text-blue-600 underline text-xs">
                                    View
                                </a>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-6 text-gray-400">
                            No projects found for this agent.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
