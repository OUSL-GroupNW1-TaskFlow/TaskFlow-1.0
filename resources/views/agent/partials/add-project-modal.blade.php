{{--
|--------------------------------------------------------------------------
| Add Project Modal
|--------------------------------------------------------------------------
| PURPOSE:
| - Allow Agent to create new project for admin review
|
| FIELDS (FINAL VERSION):
| - Project Title
| - Project Description
| - Expected Start Date
| - Expected End Date
| - Priority
--}}

<div
    x-data="{ open: false }"
    x-on:open-add-project-modal.window="open = true"
    x-show="open"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
    style="display: none;"
>

    {{-- Modal Box --}}
    <div class="bg-white w-full max-w-md rounded shadow-lg p-6">

        {{-- Modal Header --}}
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">
                Add New Project
            </h3>

            <button
                x-on:click="open = false"
                class="text-gray-500 hover:text-black"
            >
                ✕
            </button>
        </div>

         {{-- Add Project Form --}}
        <form method="POST" action="{{ route('agent.projects.store') }}">
            @csrf

            {{-- Project Title --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Project Title</label>
                <input
                    type="text"
                    name="title"
                    class="w-full border rounded px-3 py-2"
                    placeholder="Enter project title"
                    required
                >
            </div>

            {{-- Project Description --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Project Description</label>
                <textarea
                    name="description"
                    rows="4"
                    class="w-full border rounded px-3 py-2"
                    placeholder="Enter project description"
                    required
                ></textarea>
            </div>

            {{-- Expected Start Date --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Expected Start Date</label>
                <input
                    type="date"
                    name="expected_start_date"
                    class="w-full border rounded px-3 py-2"
                    required
                >
            </div>

            {{-- Expected End Date --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Expected End Date</label>
                <input
                    type="date"
                    name="expected_end_date"
                    class="w-full border rounded px-3 py-2"
                    required
                >
            </div>

            {{-- Priority --}}
            <div class="mb-6">
                <label class="block text-sm font-medium mb-1">Priority</label>
                <select
                    name="priority"
                    class="w-full border rounded px-3 py-2"
                    required
                >
                    <option value="">Select Priority</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-2">
                <button
                    type="button"
                    x-on:click="open = false"
                    class="px-4 py-2 bg-gray-200 rounded"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded"
                >
                    Create Project
                </button>
            </div>

        </form>

    </div>
</div>