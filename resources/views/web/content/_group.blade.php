<div class="mb-4">
    <div class="flex items-center justify-between">
        <p class="px-4 py-1 text-xs">{{ $item['label'] }}</p>
        <button class="pr-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
    <div class="w-full px-3 py-3 space-y-2 text-sm bg-gray-50">
        @forelse (is_array($item['value']) ? $item['value'] : [] as $groupKey => $groupItem)
            <button
                type="button" 
                wire:click="showGroup('{{ $key }}', '{{ $groupKey }}')" 
                class="block w-full px-4 py-2 font-semibold truncate bg-white border cursor-pointer rounded-xl text-light-blue-500 hover:text-light-blue-800"
            >
                {{ isset($groupNames[$groupKey]) ? $groupNames[$groupKey] : $loop->iteration }}
            </button>
        @empty
            <p class="text-xs text-center text-gray-400">
                List je prázdný
            </p>
        @endforelse
    </div>
</div>