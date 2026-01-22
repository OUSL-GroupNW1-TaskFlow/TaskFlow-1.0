<div class="bg-gradient-to-b from-gray-50 to-gray-100 rounded-xl p-4 dropzone min-h-[300px] shadow-sm border border-gray-200 transition-all duration-200"
    data-status="{{ $status }}" ondragover="event.preventDefault()"
    ondrop="handleDrop(event, '{{ $status }}')">

    <h3 class="font-semibold mb-4 text-gray-700 flex justify-between items-center">
        <span class="flex items-center gap-2">
            {{ $icon }} {{ $label }}
        </span>
        <span class="task-count text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-full">
            {{ $tasks->count() }}
        </span>
    </h3>

    @forelse ($tasks as $task)
        @include('agent.projects.kanban.partials.task-card', ['task' => $task])
    @empty
        <p class="text-sm text-gray-400 italic empty-message text-center mt-8">
            Drop tasks here
        </p>
    @endforelse
</div>
