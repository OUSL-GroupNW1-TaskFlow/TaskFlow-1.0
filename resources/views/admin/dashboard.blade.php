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


{{-- font awesome icon --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

{{-- change the url with the rout --}}

<x-app-layout>
    {{-- Page Header --}}
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>

            {{-- Add Agent Button ui --}}
            <button
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md font-medium flex items-center gap-2">
                <span class="text-lg">+</span>
                Add Agent
            </button>
        </div>
    </x-slot>



    {{-- Page Content --}}
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            {{-- Agent 1 --}}
            <a href="/admin/projects/1" class="block bg-gray-200 rounded-md px-6 py-4 hover:bg-gray-300 transition">
                <div class="flex items-center justify-between">
                    <span class="text-lg font-medium"> <span class="text-lg font-medium">Agent </span>1</span>

                    {{-- bell icon --}}
                    <div class="flex items-center gap-4">
                        <span class="relative pointer-events-none">
                            {{-- Notification dot --}}
                            <i class="fa fa-bell text-black"></i>
                            <span
                                class="absolute -top-0 -right-0 bg-red-500 text-white text-xs w-2 h-2 flex items-center justify-center rounded-full">
                            </span>
                        </span>
                    </div>
                </div>
            </a>

            {{-- Agent 2 --}}
            <a href="/admin/projects/2" class="block bg-gray-200 rounded-md px-6 py-4 hover:bg-gray-300 transition">
                <div class="flex items-center justify-between">
                    <span class="text-lg font-medium"> <span class="text-lg font-medium">Agent </span>2</span>

                    {{-- bell icon --}}
                    <div class="flex items-center gap-4">
                        <span class="relative pointer-events-none">
                            {{-- Notification dot --}}
                            <i class="fa fa-bell text-black"></i>
                            <span
                                class="absolute -top-0 -right-0 bg-red-500 text-white text-xs w-2 h-2 flex items-center justify-center rounded-full">
                            </span>
                        </span>
                    </div>
                </div>
            </a>

            {{-- Agent 3 --}}

            <a href="/admin/projects/3" class="block bg-gray-200 rounded-md px-6 py-4 hover:bg-gray-300 transition">
                <div class="flex items-center justify-between">
                    <span class="text-lg font-medium"> <span class="text-lg font-medium">Agent </span>2</span>


                    {{-- bell icon --}}
                    <div class="flex items-center gap-4">
                        <span class="relative pointer-events-none">
                            <i class="fa fa-bell text-black"></i>
                            {{-- Notification dot --}}
                            <span
                                class="absolute -top-0 -right-0 bg-red-500 text-white text-xs w-2 h-2 flex items-center justify-center rounded-full">
                            </span>
                        </span>
                    </div>
                </div>
            </a>

            {{-- Agent 4 --}}
            <a href="/admin/projects/4" class="block bg-gray-200 rounded-md px-6 py-4 hover:bg-gray-300 transition">
                <div class="flex items-center justify-between">
                    <span class="text-lg font-medium"> <span class="text-lg font-medium">Agent </span>2</span>


                    {{-- bell icon --}}
                    <div class="flex items-center gap-4">
                        <span class="relative pointer-events-none">
                            <i class="fa fa-bell text-black"></i>
                            {{-- Notification dot --}}
                            <span
                                class="absolute -top-0 -right-0 bg-red-500 text-white text-xs w-2 h-2 flex items-center justify-center rounded-full">
                            </span>
                        </span>
                    </div>
                </div>
            </a>

            {{-- Agent 5 --}}
            <a href="/admin/projects/5" class="block bg-gray-200 rounded-md px-6 py-4 hover:bg-gray-300 transition">
                <div class="flex items-center justify-between">
                    <span class="text-lg font-medium"> <span class="text-lg font-medium">Agent </span>5</span>


                    {{-- bell icon --}}
                    <div class="flex items-center gap-4">
                        <span class="relative pointer-events-none">
                            <i class="fa fa-bell text-black"></i>

                            {{-- Notification dot --}}
                            <span
                                class="absolute -top-0 -right-0 bg-red-500 text-white text-xs w-2 h-2 flex items-center justify-center rounded-full">
                            </span>
                        </span>
                    </div>
                </div>
            </a>

        </div>
    </div>
</x-app-layout>