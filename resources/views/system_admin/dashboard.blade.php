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
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- ========================= --}}
            {{-- ADMIN DASHBOARD SECTION --}}
            {{-- ========================= --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Project Oversight (Admin View)
                        </h3>

                        <a href="{{ route('admin.dashboard') }}" class="text-sm text-indigo-600 hover:underline">
                            Open Full Admin Dashboard →
                        </a>
                    </div>

                    {{-- Reuse Admin dashboard content --}}
                    @include('admin.partials.dashboard-agents')

                </div>
            </div>

            {{-- =============================== --}}
            {{-- SYSTEM ADMIN CONTROL PANEL --}}
            {{-- =============================== --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        System Administration
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <a href="{{ route('admin.users.index') }}"
                            class="block p-4 border rounded-lg hover:bg-gray-50 transition">
                            <div class="font-semibold text-gray-800">
                                👥 User Management
                            </div>
                            <div class="text-sm text-gray-600">
                                Manage all Admins and Agents
                            </div>
                        </a>

                        <div class="block p-4 border rounded-lg bg-gray-50">
                            <div class="font-semibold text-gray-800">
                                ⚙ System Settings
                            </div>
                            <div class="text-sm text-gray-600">
                                (Coming soon)
                            </div>
                        </div>

                        <div class="block p-4 border rounded-lg bg-gray-50">
                            <div class="font-semibold text-gray-800">
                                🛡 Audit Logs
                            </div>
                            <div class="text-sm text-gray-600">
                                (Coming soon)
                            </div>
                        </div>

                        <div class="block p-4 border rounded-lg bg-gray-50">
                            <div class="font-semibold text-gray-800">
                                🔑 Role Permissions
                            </div>
                            <div class="text-sm text-gray-600">
                                (Coming soon)
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
