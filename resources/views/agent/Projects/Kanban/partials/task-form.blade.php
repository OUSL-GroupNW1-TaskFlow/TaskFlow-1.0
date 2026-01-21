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

<form method="POST" action="{{ route('agent.tasks.store', $project->id) }}" class="mb-6">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <input type="text" name="title" placeholder="Task title" class="border rounded p-2" required>

        <input type="text" name="description" placeholder="Description (optional)" class="border rounded p-2">

        <button type="submit" class="bg-blue-600 text-white rounded px-4 py-2 hover:bg-blue-700">
            Add Task
        </button>
    </div>
</form>
