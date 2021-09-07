<div x-data="{ showMore: false }">
    @foreach(collect($state)->where('parent_id', $element['id'])->sortByDesc('order') as $item)
        <div
            @if($loop->iteration > 2) x-show="showMore" @endif
            class="
                {{ ($state[$item['id']]['delete'] ?? false) ? 
                'bg-red-50 text-red-500 border-red-300' : 
                'bg-white text-gray-500 border-blue-gray-400' }} 
                flex justify-between w-full px-1 py-3 font-medium text-left transition mb-4 duration-300 border-2 rounded-lg group border-opacity-20
            "
            wire:key="{{ $key . $item['id'] }}"
        >
            <button 
                wire:click="$set('group', '{{ $item['id'] }}', true)" 
                type="button" 
                class="flex-grow pl-3 font-medium text-left truncate transition duration-300 border-blue-gray-400 border-opacity-20 hover:text-light-blue-500"
            >
                @if(substr($item['label'], 0, 1 ) == "!")
                    @php
                        $label = collect($state)->where('parent_id', $item['id'])->where('name', substr( $item['label'], 1, 255 ))->first();
                    @endphp
                    {{ $label['value'][$lang] ?? $loop->iteration }}
                @else
                    {{ $item['label'] }}
                @endif
            </button>
            @if($state[$item['id']]['delete'] ?? false)
                <button wire:key="redelete{{ $item['id'] }}" wire:click="$set('state.{{ $item['id'] }}.delete', false)" type="button" class="px-1 mr-2 text-light-blue-300 hover:text-light-blue-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                    </svg>
                </button>
            @else
                <button wire:key="delete{{ $item['id'] }}" wire:click="$set('state.{{ $item['id'] }}.delete', true)" type="button" class="px-1 mr-2 text-red-300 hover:text-red-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            @endif
        </div>
    @endforeach
    <button x-show="!showMore" @click="showMore = true" class="w-full -my-1 hover:text-light-blue-500">Zobrazit více</button>
    <button x-show="showMore" @click="showMore = false" class="w-full -my-1 hover:text-light-blue-500">Zobrazit méně</button>
</div>