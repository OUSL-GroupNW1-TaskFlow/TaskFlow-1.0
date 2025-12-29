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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- Page Content --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Agent List --}}
            <div class="bg-white p-6 rounded shadow">
                
                {{-- NOTE FOR TEAM:
                    Display list of agents.
                --}}

            </div>

        </div>
    </div>
</x-app-layout>
