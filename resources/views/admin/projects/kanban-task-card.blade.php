<div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 mb-4">

    {{-- Title + Priority --}}
    <div class="flex justify-between items-start">
        <div>
            <div class="font-semibold text-gray-800">{{ $task->title }}</div>

            @if ($task->description)
                <div class="text-sm text-gray-500 mt-1">
                    {{ $task->description }}
                </div>
            @endif
        </div>

        @php
            $priorityColor = match ($task->priority ?? 'medium') {
                'high' => 'bg-red-100 text-red-700',
                'medium' => 'bg-yellow-100 text-yellow-700',
                default => 'bg-green-100 text-green-700',
            };
        @endphp

        <span class="text-xs px-2 py-1 rounded-full {{ $priorityColor }}">
            {{ ucfirst($task->priority ?? 'medium') }}
        </span>
    </div>

    {{-- Files --}}
    @if ($task->files->count())
        <div class="mt-3 space-y-2 text-xs">
            @foreach ($task->files as $file)
                @php
                    $url = asset('storage/' . $file->file_path);
                    $ext = strtolower(pathinfo($file->file_path, PATHINFO_EXTENSION));
                    $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                    $isPdf = $ext === 'pdf';
                @endphp

                @if ($isImage)
                    <div class="flex items-center gap-2">
                        <a href="{{ $url }}" target="_blank" download>
                            <img src="{{ $url }}"
                                class="w-14 h-14 object-cover rounded border hover:opacity-80 transition">
                        </a>

                        <a href="{{ $url }}" target="_blank" download
                            class="text-gray-500 text-xs hover:underline">
                            {{ $file->original_name }}
                        </a>
                    </div>
                @else
                    <a href="{{ $url }}" target="_blank" 
                        class="text-blue-600 underline flex items-center gap-1">
                        {{ $isPdf ? '📄' : '📎' }} {{ $file->original_name }}
                    </a>
                @endif
            @endforeach
        </div>
    @endif

    {{-- Comments --}}
    @if ($task->comments->count())
        <div class="mt-3 border-t pt-2 text-xs text-gray-600 space-y-2">
            <p class="font-semibold text-gray-500">Internal Comments</p>

            @foreach ($task->comments as $comment)
                <div class="bg-gray-50 p-2 rounded flex justify-between items-start gap-2">

                    <div>
                        <p>{{ $comment->comment }}</p>
                        <p class="text-[10px] text-gray-400">
                            — {{ $comment->admin->name }},
                            {{ $comment->created_at->diffForHumans() }}
                        </p>
                    </div>

                    @auth
                        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('system_admin'))
                            <form method="POST" action="{{ route('admin.tasks.comments.destroy', $comment->id) }}"
                                onsubmit="return confirm('Delete this comment?')">
                                @csrf
                                @method('DELETE')

                                <button class="text-red-600 text-xs hover:underline">
                                    Delete
                                </button>
                            </form>
                        @endif
                    @endauth

                </div>
            @endforeach
        </div>
    @endif

    {{-- Comment Form (Admin + System Admin) --}}
    @auth
        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('system_admin'))
            <form method="POST" action="{{ route('admin.tasks.comments.store', $task->id) }}" class="mt-2">
                @csrf

                <textarea name="comment" rows="2" class="w-full border rounded p-1 text-xs" placeholder="Add internal comment..."></textarea>

                <button class="mt-1 text-xs bg-blue-600 text-white px-2 py-1 rounded">
                    Comment
                </button>
            </form>
        @endif
    @endauth

</div>
