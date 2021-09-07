@if($state[$element['id']]['delete'] ?? false)
    <div class="flex justify-between w-full px-1 py-3 font-medium text-left text-red-500 transition duration-300 border-2 border-red-300 rounded-lg bg-red-50 group border-opacity-20">
        <div class="flex-grow pl-4">
            @if(($isList ?? false) && substr($element['label'], 0, 1 ) == "!")
                @php
                    $label = collect($state)->where('parent_id', $element['id'])->where('name', substr( $element['label'], 1, 255 ))->first();
                @endphp
                {{ $label['value'][$lang] ?? $loop->iteration }}
            @else
                {{ $element['label'] }}
            @endif
        </div>
        <button wire:key="redelete{{ $element['id'] }}" wire:click="$set('state.{{ $element['id'] }}.delete', false)" type="button" class="px-1 mr-2 text-light-blue-300 hover:text-light-blue-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
            </svg>
        </button>
    </div>
@else
    <div class="flex justify-between w-full px-1 py-3 font-medium text-left text-gray-500 transition duration-300 bg-white border-2 rounded-lg draggable-w-265 border-blue-gray-400 group border-opacity-20">
        <div 
            wire:sortable.handle
            class="flex -space-x-3 text-gray-300 cursor-move"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
            </svg>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
            </svg>
        </div>
        @if($element['type'] != 'group')
            <div class="flex-grow pl-1 truncate">
                {{ $element['label'] }}
            </div>
        @else
            <button 
                wire:click="$set('group', '{{ $element['id'] }}', true)" 
                type="button"
                class="flex-grow pl-1 font-medium text-left truncate hover:text-light-blue-500"
            >
                @if(($isList ?? false) && substr($element['label'], 0, 1 ) == "!")
                    @php
                        $label = collect($state)->where('parent_id', $element['id'])->where('name', substr( $element['label'], 1, 255 ))->first();
                    @endphp
                    {{ $label['value'][$lang] ?? $loop->iteration }}
                @else
                    {{ $element['label'] }}
                @endif
            </button>
        @endif
        @if($element['type'] == 'list')
            <button 
                wire:click="$set('group', '{{ $element['id'] }}', true)" 
                class="px-1 text-light-blue-300 hover:text-light-blue-500"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                </svg>
            </button>
        @else
            <button 
                wire:key="open{{ $element['id'] }}" 
                @click="open = !open, $dispatch('open-item', { open: '{{ $element["id"] }}' })" 
                class="px-1 text-light-blue-300 hover:text-light-blue-500"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                </svg>
            </button>
        @endif
        @if(($isList ?? false))
            <button wire:key="duplicate{{ $element['id'] }}" class="px-1 text-light-blue-300 hover:text-light-blue-500">
                <svg class="w-6 h-6 -my-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                </svg>
            </button>
        @endif
        <button wire:key="delete{{ $element['id'] }}" wire:click="$set('state.{{ $element['id'] }}.delete', true)" type="button" class="px-1 mr-2 text-red-300 hover:text-red-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        </button>
    </div>
@endif