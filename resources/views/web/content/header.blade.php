<div class="flex items-center justify-between mb-6">
    @if($group)
    <div class="flex items-center">
        <button type="button" wire:click="back" class="p-2 border rounded-xl hover:text-light-blue-400">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </button>
        <p class="ml-4 font-bold">
            {{ isset($groupNames[$groupName]) ? $groupNames[$groupName] : "" }}
        </p>
    </div>
    @else
    <div class="flex items-center">
        <a href="{{ url('web/dashboard') }}" class="p-2 border rounded-xl hover:text-light-blue-400">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <p class="ml-4 font-bold">Úprava textů</p>
    </div>
    <button type="submit" class="shadow-sm btn-primary">
        Uložit
    </button>
    @endif
</div>