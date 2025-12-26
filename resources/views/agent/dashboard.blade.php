{{-- 
|--------------------------------------------------------------------------
| Agent Dashboard
|--------------------------------------------------------------------------
| PURPOSE:
| - Dashboard for AGENT role
| - Agent creates and manages own projects
|
| TEAM INSTRUCTIONS:
| - Edit ONLY inside <div class="dashboard-content">
| - Keep structure unchanged
|--------------------------------------------------------------------------
--}}

<x-app-layout>
    {{-- Page Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Agent Dashboard
        </h2>
    </x-slot>

    {{-- Page Content --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Dashboard Card --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dashboard-content">

                    {{-- TODO (TEAM): Agent UI goes here --}}
                    <p><strong>Welcome Agent</strong></p>

                    <ul class="mt-4 list-disc list-inside text-sm text-gray-700">
                        <li>Create new project</li>
                        <li>View my projects</li>
                        <li>Update Kanban progress</li>
                    </ul>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
