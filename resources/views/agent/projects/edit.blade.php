{{-- 
|--------------------------------------------------------------------------
| Edit Project (Agent)
|--------------------------------------------------------------------------
| PURPOSE:
| - Allow agent to edit their own project
|-------------------------------------------------------------------------- 
--}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Project
            </h2>

            <a href="{{ route('agent.projects.index') }}"
               class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                ← Back to Projects
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white p-6 rounded shadow">

                <form method="POST" action="{{ route('agent.projects.update', $project->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- Title --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Project Title</label>
                        <input type="text" name="title"
                               value="{{ old('title', $project->title) }}"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="4"
                                  class="w-full border rounded px-3 py-2">{{ old('description', $project->description) }}</textarea>
                    </div>

                    {{-- Dates --}}
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" name="expected_start_date"
                                   value="{{ old('expected_start_date', $project->expected_start_date?->format('Y-m-d')) }}"
                                   class="w-full border rounded px-3 py-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" name="expected_end_date"
                                   value="{{ old('expected_end_date', $project->expected_end_date?->format('Y-m-d')) }}"
                                   class="w-full border rounded px-3 py-2">
                        </div>
                    </div>

                    {{-- Priority --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Priority</label>
                        <select name="priority" class="w-full border rounded px-3 py-2">
                            @foreach (['low', 'medium', 'high'] as $priority)
                                <option value="{{ $priority }}"
                                    {{ old('priority', $project->priority) === $priority ? 'selected' : '' }}>
                                    {{ ucfirst($priority) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Actions --}}
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('agent.projects.index') }}"
                           class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                            Cancel
                        </a>

                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Save Changes
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>