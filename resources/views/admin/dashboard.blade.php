{{--
|--------------------------------------------------------------------------
| Admin Dashboard
|--------------------------------------------------------------------------
| PURPOSE:
| - Dashboard for ADMIN role
| - Display list of agents
| - Admin manages Agents and Projects
|
| TEAM INSTRUCTIONS:
| - Make items clickable
| - Add notification badge logic
|--------------------------------------------------------------------------
--}}

<x-app-layout>
    {{-- Page Header --}}
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>

            {{-- Add Agent Button --}}
            <a href="{{ route('admin.users.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md font-medium flex items-center gap-2">
                <span class="text-lg">+</span>
                Add Agent
            </a>
        </div>
    </x-slot>

    {{-- Page Content --}}
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @include('admin.partials.dashboard-agents')

        </div>
    </div>
</x-app-layout>
