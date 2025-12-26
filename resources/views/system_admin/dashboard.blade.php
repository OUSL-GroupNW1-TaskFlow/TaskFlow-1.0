{{-- 
|--------------------------------------------------------------------------
| System Admin Dashboard
|--------------------------------------------------------------------------
| PURPOSE:
| - Main dashboard for SYSTEM ADMIN role
| - System Admin has ALL permissions
|
| TEAM INSTRUCTIONS:
| - Edit ONLY the content inside <div class="dashboard-content">
| - DO NOT change layout, slots, or auth-related code
|--------------------------------------------------------------------------
--}}

<x-app-layout>
    {{-- Page Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            System Admin Dashboard
        </h2>
    </x-slot>

    {{-- Page Content --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Dashboard Card --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dashboard-content">

                    {{-- TODO (TEAM): Replace this section with UI components --}}
                    <p><strong>Welcome System Admin</strong></p>

                    <ul class="mt-4 list-disc list-inside text-sm text-gray-700">
                        <li>Manage Admin accounts</li>
                        <li>Manage Agent accounts</li>
                        <li>View all projects</li>
                        <li>Access system-wide settings</li>
                    </ul>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>