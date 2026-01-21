{{-- 
|-------------------------------------------------------------------------- 
| Admin Dashboard Agents List (Reusable Partial) 
|-------------------------------------------------------------------------- 
| PURPOSE: 
| - Shared agent/project overview for Admin + System Admin 
|-------------------------------------------------------------------------- 
--}}

<div class="space-y-4">

    @forelse ($agents as $agent)
        <a href="{{ route('admin.agents.projects', $agent) }}"
           class="block bg-gray-200 rounded-md px-6 py-4 hover:bg-gray-300 transition">
            <div class="flex items-center justify-between">
                <span class="text-lg font-medium">{{ $agent->name }}</span>

                @if ($agent->pending_projects_count > 0)
                    <div class="relative w-8 h-8 flex items-center justify-center group">
                        <i class="fas fa-bell text-gray-800 text-3xl animate-bell"></i>

                        <span
                            class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] min-w-[18px] h-[18px]
                                   flex items-center justify-center rounded-full px-1 shadow">
                            {{ $agent->pending_projects_count }}
                        </span>

                        <span
                            class="absolute top-full mt-2 hidden group-hover:block bg-black text-white text-xs px-2 py-1 rounded whitespace-nowrap z-10">
                            {{ $agent->pending_projects_count }} pending approvals
                        </span>
                    </div>
                @endif
            </div>
        </a>
    @empty
        <div class="text-sm text-gray-500 italic">
            No agents found.
        </div>
    @endforelse

</div>

<style>
    @keyframes bell-shake {
        0%   { transform: rotate(0); }
        10%  { transform: rotate(15deg); }
        20%  { transform: rotate(-15deg); }
        30%  { transform: rotate(10deg); }
        40%  { transform: rotate(-10deg); }
        50%  { transform: rotate(5deg); }
        60%  { transform: rotate(-5deg); }
        70%  { transform: rotate(0); }
    }

    .animate-bell {
        animation: bell-shake 1.5s ease-in-out infinite;
        transform-origin: top center;
    }
</style>