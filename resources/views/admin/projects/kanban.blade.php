<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Project Workspace — {{ $project->title }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- ================= TO DO ================= --}}
            <div class="bg-gray-50 rounded-xl p-4 shadow-sm border border-gray-200 min-h-[300px]">
                <h3 class="font-semibold mb-4 text-gray-700 flex justify-between items-center">
                    <span>📝 To Do</span>
                    <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-full">
                        {{ $todo->count() }}
                    </span>
                </h3>

                @forelse($todo as $task)
                    @include('admin.projects.kanban-task-card', ['task' => $task])
                @empty
                    <p class="text-sm text-gray-400 italic text-center mt-8">
                        No tasks here
                    </p>
                @endforelse
            </div>

            {{-- ================= IN PROGRESS ================= --}}
            <div class="bg-gray-50 rounded-xl p-4 shadow-sm border border-gray-200 min-h-[300px]">
                <h3 class="font-semibold mb-4 text-gray-700 flex justify-between items-center">
                    <span>⚙️ In Progress</span>
                    <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-full">
                        {{ $inProgress->count() }}
                    </span>
                </h3>

                @forelse($inProgress as $task)
                    @include('admin.projects.kanban-task-card', ['task' => $task])
                @empty
                    <p class="text-sm text-gray-400 italic text-center mt-8">
                        No tasks here
                    </p>
                @endforelse
            </div>

            {{-- ================= DONE ================= --}}
            <div class="bg-gray-50 rounded-xl p-4 shadow-sm border border-gray-200 min-h-[300px]">
                <h3 class="font-semibold mb-4 text-gray-700 flex justify-between items-center">
                    <span>✅ Done</span>
                    <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-full">
                        {{ $done->count() }}
                    </span>
                </h3>

                @forelse($done as $task)
                    @include('admin.projects.kanban-task-card', ['task' => $task])
                @empty
                    <p class="text-sm text-gray-400 italic text-center mt-8">
                        No tasks here
                    </p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>

