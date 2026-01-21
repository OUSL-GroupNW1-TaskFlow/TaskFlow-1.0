<div class="bg-white p-4 rounded-xl shadow-sm hover:shadow-md border border-gray-200 mb-4 cursor-move task-card transition-all duration-150 relative"
    draggable="true" ondragstart="handleDragStart(event)" ondragend="handleDragEnd(event)"
    data-task-id="{{ $task->id }}">

    {{-- Header Row --}}
    <div class="flex justify-between items-start mb-2">

        <div>
            <div class="font-semibold text-gray-900 text-sm leading-tight">
                {{ $task->title }}
            </div>

            @if ($task->description)
                <div class="text-xs text-gray-500 mt-1">
                    {{ $task->description }}
                </div>
            @endif
        </div>

        {{-- Priority --}}
        @php
            $priorityColor = match ($task->priority ?? 'medium') {
                'high' => 'bg-red-100 text-red-700 border border-red-200',
                'medium' => 'bg-yellow-100 text-yellow-700 border border-yellow-200',
                default => 'bg-green-100 text-green-700 border border-green-200',
            };
        @endphp

        <span class="text-[11px] px-2 py-0.5 rounded-full font-medium {{ $priorityColor }}">
            {{ ucfirst($task->priority ?? 'medium') }}
        </span>
    </div>

    {{-- Files --}}
    @if ($task->files->count())
        <div class="mt-2 space-y-1 text-xs border-t pt-2">

            @foreach ($task->files as $file)
                @php
                    $url = asset('storage/' . $file->file_path);
                    $ext = strtolower(pathinfo($file->file_path, PATHINFO_EXTENSION));
                    $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                    $isPdf = $ext === 'pdf';
                @endphp

                <div class="flex items-center justify-between gap-2 bg-gray-50 rounded px-2 py-1">

                    <div class="flex items-center gap-2 truncate">

                        {{-- Icon --}}
                        <span class="text-sm">
                            @if ($isPdf)
                                📄
                            @elseif ($isImage)
                                🖼️
                            @else
                                📎
                            @endif
                        </span>

                        {{-- Name --}}
                        <a href="{{ $url }}" target="_blank" rel="noopener noreferrer"
                            class="text-blue-600 hover:underline truncate max-w-[160px]">
                            {{ $file->original_name }}
                        </a>

                        <span class="text-gray-400 text-[10px]">
                            {{ formatFileSize($file->size) }}
                        </span>
                    </div>

                    {{-- Delete File --}}
                    <form method="POST" action="{{ route('agent.task-files.destroy', $file->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-400 hover:text-red-600 text-xs">✕</button>
                    </form>
                </div>
            @endforeach

        </div>
    @endif

    {{-- Admin Comments --}}
    @if ($task->comments->count())
        <div class="mt-2 border-t pt-2 text-xs space-y-1">

            <p class="font-semibold text-gray-500 text-[11px]">
                Admin Feedback
            </p>

            @foreach ($task->comments as $comment)
                <div class="bg-blue-50 border border-blue-100 rounded p-2">
                    <p class="text-gray-700 text-[11px]">
                        {{ $comment->comment }}
                    </p>
                    <p class="text-[10px] text-gray-400 mt-1">
                        — {{ $comment->admin->name }},
                        {{ $comment->created_at->diffForHumans() }}
                    </p>
                </div>
            @endforeach

        </div>
    @endif

    {{-- Footer Actions --}}
    <div class="flex justify-between items-center mt-3 pt-2 border-t">

        <div class="flex gap-4 text-xs">
            <button onclick="openTaskModal({{ $task->id }})" class="text-blue-600 hover:underline font-medium">
                Edit
            </button>

            <form method="POST" action="{{ route('agent.tasks.destroy', $task->id) }}">
                @csrf
                @method('DELETE')
                <button class="text-red-600 hover:underline font-medium">
                    Delete
                </button>
            </form>
        </div>

    </div>
</div>
