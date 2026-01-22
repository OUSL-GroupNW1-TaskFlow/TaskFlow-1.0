<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            MY WORKSPACE — {{ $project->title }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        @include('agent.projects.kanban.partials.task-form')

    </div>

    @php
        function formatFileSize($bytes)
        {
            if (!$bytes) {
                return '';
            }
            if ($bytes >= 1048576) {
                return round($bytes / 1048576, 1) . ' MB';
            }
            if ($bytes >= 1024) {
                return round($bytes / 1024, 1) . ' KB';
            }
            return $bytes . ' B';
        }
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        @include('agent.projects.kanban.partials.column', [
            'status' => 'todo',
            'label' => 'To Do',
            'icon' => '📝',
            'tasks' => $todo,
        ])

        @include('agent.projects.kanban.partials.column', [
            'status' => 'in_progress',
            'label' => 'In Progress',
            'icon' => '⚙️',
            'tasks' => $inProgress,
        ])

        @include('agent.projects.kanban.partials.column', [
            'status' => 'done',
            'label' => 'Done',
            'icon' => '✅',
            'tasks' => $done,
        ])

    </div>

    <script>
        let draggedTaskId = null;

        function handleDragStart(event) {
            draggedTaskId = event.target.dataset.taskId;
            event.target.classList.add('dragging');

            // required for Firefox
            event.dataTransfer.setData('text/plain', draggedTaskId);
        }

        function handleDrop(event, newStatus) {
            event.preventDefault();

            if (!draggedTaskId) return;

            const draggedEl = document.querySelector(`[data-task-id="${draggedTaskId}"]`);
            const sourceColumn = draggedEl.closest('[data-status]').dataset.status;
            const targetColumn = document.querySelector(`[data-status="${newStatus}"]`);

            const dropTarget = event.target.closest('.task-card');

            let newPosition = 0;

            if (dropTarget && dropTarget.dataset.taskId !== draggedTaskId) {
                const siblings = [...targetColumn.querySelectorAll('.task-card')]
                    .filter(el => el !== draggedEl);

                newPosition = siblings.indexOf(dropTarget);
                targetColumn.insertBefore(draggedEl, dropTarget);
            } else {
                const tasks = [...targetColumn.querySelectorAll('.task-card')]
                    .filter(el => el !== draggedEl);

                newPosition = tasks.length;
                targetColumn.appendChild(draggedEl);
            }

            fetch(`/agent/tasks/${draggedTaskId}/move`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: newStatus,
                        position: newPosition
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        draggedEl.classList.remove('dragging');
                        draggedTaskId = null;
                        updateEmptyMessages();
                        updateColumnCounts();
                    }
                })
                .catch(err => console.error(err));
        }

        function updateColumnCounts() {
            document.querySelectorAll('[data-status]').forEach(column => {
                const countBadge = column.querySelector('.task-count');
                const taskCount = column.querySelectorAll('.task-card').length;
                if (countBadge) countBadge.innerText = taskCount;
            });
        }

        function updateEmptyMessages() {
            document.querySelectorAll('[data-status]').forEach(column => {
                const tasks = column.querySelectorAll('.task-card');
                let emptyMsg = column.querySelector('.empty-message');

                if (tasks.length === 0 && !emptyMsg) {
                    const msg = document.createElement('p');
                    msg.className = 'text-sm text-gray-400 italic empty-message text-center mt-8';
                    msg.innerText = 'Drop tasks here';
                    column.appendChild(msg);
                }

                if (tasks.length > 0 && emptyMsg) {
                    emptyMsg.remove();
                }
            });
        }

        function handleDragEnd(event) {
            event.target.classList.remove('dragging');
            draggedTaskId = null;
        }

        function openTaskModal(taskId) {
            fetch(`/agent/tasks/${taskId}`)
                .then(res => res.json())
                .then(task => {
                    document.getElementById('modal_task_id').value = task.id;
                    document.getElementById('modal_title').value = task.title;
                    document.getElementById('modal_description').value = task.description ?? '';
                    document.getElementById('modal_priority').value = task.priority ?? 'medium';

                    const form = document.getElementById('taskEditForm');
                    form.action = `/agent/tasks/${task.id}`;

                    document.getElementById('taskModal').classList.remove('hidden');
                    document.getElementById('taskModal').classList.add('flex');
                });
        }

        function closeTaskModal() {
            document.getElementById('taskModal').classList.add('hidden');
            document.getElementById('taskModal').classList.remove('flex');
        }

        function openPreview(url, type) {
            const modal = document.getElementById('filePreviewModal');
            const content = document.getElementById('previewContent');

            content.innerHTML = '';

            if (type === 'image') {
                const img = document.createElement('img');
                img.src = url;
                img.className = 'max-h-full max-w-full rounded shadow';
                content.appendChild(img);
            }

            if (type === 'pdf') {
                const iframe = document.createElement('iframe');
                iframe.src = url;
                iframe.className = 'w-full h-full border rounded';
                content.appendChild(iframe);
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closePreview() {
            const modal = document.getElementById('filePreviewModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.addEventListener('DOMContentLoaded', () => {

            document.querySelectorAll('[data-status]').forEach(zone => {
                zone.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    zone.classList.add('drop-zone-hover');
                });

                zone.addEventListener('dragleave', () => {
                    zone.classList.remove('drop-zone-hover');
                });

                zone.addEventListener('drop', () => {
                    zone.classList.remove('drop-zone-hover');
                });
            });
            updateEmptyMessages();
            updateColumnCounts();
        });
    </script>

    <div id="taskModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

        <div class="bg-white rounded-xl w-full max-w-lg p-6 shadow-lg relative">

            <h3 class="text-lg font-semibold mb-4">Edit Task</h3>

            <form id="taskEditForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="task_id" id="modal_task_id">

                {{-- Title --}}
                <div class="mb-3">
                    <label class="text-sm">Title</label>
                    <input type="text" name="title" id="modal_title" class="w-full border rounded p-2" required>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="text-sm">Description</label>
                    <textarea name="description" id="modal_description" class="w-full border rounded p-2"></textarea>
                </div>

                {{-- Priority --}}
                <div class="mb-3">
                    <label class="text-sm">Priority</label>
                    <select name="priority" id="modal_priority" class="w-full border rounded p-2">
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>

                {{-- File Upload --}}
                <div class="mb-3">
                    <label class="text-sm">Attach File</label>
                    <input type="file" name="files[]" multiple class="w-full border rounded p-2">
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end gap-3 mt-4">
                    <button type="button" onclick="closeTaskModal()" class="px-4 py-2 border rounded">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .dragging {
            opacity: 0.4;
            transform: scale(0.98);
        }

        .drop-zone-hover {
            background-color: #e0f2fe;
            border: 2px dashed #3b82f6;
        }

        .task-card {
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .task-card:hover {
            transform: translateY(-2px);
        }

        .task-card.dragging {
            opacity: 0.4;
            transform: scale(0.97);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.15);
        }

        .task-count {
            transition: all 0.15s ease-in-out;
        }
    </style>
</x-app-layout>
